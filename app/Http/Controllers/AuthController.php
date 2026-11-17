<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\BridgeSSOService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Tampilkan Halaman Login jika diakses via URL langsung
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin() 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('mahasiswa.dashboard');
        }
        return view('auth.login');
    }

    /**
     * Proses Login untuk Mahasiswa & Admin
     * - Email: Autentikasi lokal database (Admin / Mitra Luar)
     * - NIM / NIP: Autentikasi Single Sign-On (SSO) Portal Kampus (Bridge API v2 eCampuz)
     */
    public function login(Request $request, BridgeSSOService $ssoService)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'login.required'    => 'Email atau NIM wajib diisi.',
            'password.required' => 'Kata sandi akun wajib diisi.',
            'password.min'      => 'Kata sandi minimal 6 angka/huruf.',
        ]);

        $loginInput = trim($request->input('login', $request->input('email', '')));
        $password   = $request->input('password');
        $remember   = $request->boolean('remember');

        // ── Rate Limiter: maks 3 percobaan, kunci 4 menit (240 detik) ──
        $throttleKey = Str::lower($loginInput) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $menit   = ceil($seconds / 60);
            $lockMsg = "Terlalu banyak percobaan login salah (3x). Akun dikunci sementara. Silakan tunggu {$menit} menit ({$seconds} detik) lagi sebelum mencoba kembali.";

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success'     => false,
                    'locked'      => true,
                    'retry_after' => $seconds,
                    'message'     => $lockMsg,
                ], 429);
            }

            return back()->withErrors([
                'login'    => $lockMsg,
                'password' => $lockMsg,
            ])->withInput($request->only('login', 'email', 'remember'))
              ->with('lockout_seconds', $seconds)
              ->with('auto_open_modal', 'login');
        }

        // Deteksi format: Email (Admin/Lokal) ATAU NIM/NIP (SSO Portal Kampus)
        $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL);
        $ssoErrorMessage = null;

        // ==========================================
        // SKENARIO 1: Login via Email (Lokal Admin/Mitra)
        // ==========================================
        if ($isEmail) {
            if (Auth::attempt(['email' => $loginInput, 'password' => $password], $remember)) {
                RateLimiter::clear($throttleKey);
                $request->session()->regenerate();

                $user = Auth::user();
                $redirectUrl = $user->isAdmin() ? route('admin.dashboard') : route('mahasiswa.dashboard');

                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success'  => true,
                        'redirect' => $redirectUrl,
                        'message'  => 'Login berhasil, mengalihkan...',
                    ]);
                }

                if ($user->isAdmin()) {
                    return redirect()->intended(route('admin.dashboard'))
                        ->with('success', 'Selamat datang kembali, Administrator Kurasi Kampus!');
                }

                return redirect()->intended(route('mahasiswa.dashboard'))
                    ->with('success', "Selamat datang kembali, {$user->name}!");
            }
        } 
        // ==========================================
        // SKENARIO 2: Login via NIM / NIP (SSO Portal Kampus)
        // ==========================================
        else {
            if ($ssoService->isEnabled()) {
                // Lempar ke Bridge SSO API Portal Kampus
                $ssoResult = $ssoService->login($loginInput, $password);

                if ($ssoResult['success']) {
                    // Tarik data profil mahasiswa/dosen dari server kampus
                    $profile = $ssoService->getProfile($ssoResult['token'] ?? '', $loginInput);

                    $email = !empty($profile['email']) ? $profile['email'] : "{$loginInput}@mahasiswa.uinssc.ac.id";

                    // Cari atau sinkronisasi user di database lokal (updateOrCreate)
                    $user = User::where('nim', $loginInput)->first();
                    if (!$user) {
                        $user = User::where('email', $email)->first();
                    }

                    if ($user) {
                        $user->update([
                            'name'     => $profile['name'] ?? $user->name,
                            'nim'      => $loginInput,
                            'prodi'    => $profile['unit_or_prodi'] ?? $user->prodi,
                            'phone'    => $profile['phone'] ?? $user->phone,
                            'password' => Hash::make($password), // sinkronkan hash sandi terbaru
                        ]);
                    } else {
                        $user = User::create([
                            'name'     => $profile['name'] ?? "Mahasiswa {$loginInput}",
                            'email'    => $email,
                            'nim'      => $loginInput,
                            'prodi'    => $profile['unit_or_prodi'] ?? 'Informatika',
                            'phone'    => $profile['phone'] ?? null,
                            'role'     => $profile['role'] ?? 'mahasiswa',
                            'password' => Hash::make($password),
                        ]);
                    }

                    RateLimiter::clear($throttleKey);
                    Auth::login($user, $remember);
                    $request->session()->regenerate();

                    $redirectUrl = $user->isAdmin() ? route('admin.dashboard') : route('mahasiswa.dashboard');

                    if ($request->expectsJson() || $request->ajax()) {
                        return response()->json([
                            'success'  => true,
                            'redirect' => $redirectUrl,
                            'message'  => 'Autentikasi SSO Portal Kampus berhasil! Mengalihkan...',
                        ]);
                    }

                    return redirect()->intended($redirectUrl)
                        ->with('success', "Selamat datang, {$user->name}! Akun portal akademik Anda berhasil terhubung.");
                }

                // Simpan pesan error spesifik dari API kampus jika ada
                $ssoErrorMessage = $ssoResult['message'] ?? null;
            }

            // Fallback: Jika SSO gagal / offline atau akun ada di database lokal
            if (Auth::attempt(['nim' => $loginInput, 'password' => $password], $remember)) {
                RateLimiter::clear($throttleKey);
                $request->session()->regenerate();

                $user = Auth::user();
                $redirectUrl = $user->isAdmin() ? route('admin.dashboard') : route('mahasiswa.dashboard');

                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success'  => true,
                        'redirect' => $redirectUrl,
                        'message'  => 'Login berhasil, mengalihkan...',
                    ]);
                }

                return redirect()->intended(route('mahasiswa.dashboard'))
                    ->with('success', "Selamat datang kembali, {$user->name}!");
            }
        }

        // ==========================================
        // GAGAL LOGIN: Tambah Hit Rate Limiter (Kunci 4 menit jika 3x)
        // ==========================================
        RateLimiter::hit($throttleKey, 240);

        $attempts  = RateLimiter::attempts($throttleKey);
        $remaining = max(0, 3 - $attempts);

        if ($remaining <= 0) {
            $seconds  = RateLimiter::availableIn($throttleKey) ?: 240;
            $menit    = ceil($seconds / 60);
            $errorMsg = "Kata sandi salah sebanyak 3 kali! Akun Anda dikunci sementara. Silakan tunggu {$menit} menit ({$seconds} detik).";

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success'     => false,
                    'locked'      => true,
                    'retry_after' => $seconds,
                    'message'     => $errorMsg,
                ], 429);
            }

            return back()->withErrors([
                'login'    => $errorMsg,
                'password' => $errorMsg,
            ])->withInput($request->only('login', 'email', 'remember'))
              ->with('lockout_seconds', $seconds)
              ->with('auto_open_modal', 'login');
        }

        $defaultMsg = "Kata sandi akun yang Anda masukkan salah! (Percobaan gagal {$attempts} dari 3, sisa {$remaining}x lagi).";
        $errorMsg = $ssoErrorMessage ?: $defaultMsg;

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success'   => false,
                'locked'    => false,
                'remaining' => $remaining,
                'message'   => $errorMsg,
            ], 422);
        }

        return back()->withErrors([
            'login'    => $errorMsg,
            'password' => $errorMsg,
        ])->withInput($request->only('login', 'email', 'remember'))
          ->with('auto_open_modal', 'login');
    }

    /**
     * Tampilkan Halaman Registrasi Mahasiswa
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin() 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('mahasiswa.dashboard');
        }
        return view('auth.register');
    }

    /**
     * Proses Registrasi Akun Mahasiswa dengan Validasi NIM & Email Ketat
     */
    public function register(Request $request)
    {
        // Normalisasi input
        $request->merge([
            'name' => trim($request->input('name', '')),
            'nim' => strtoupper(trim(preg_replace('/\s+/', '', $request->input('nim', '')))),
            'email' => strtolower(trim($request->input('email', ''))),
            'prodi' => trim($request->input('prodi_custom') ?: $request->input('prodi', '')),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'nim' => [
                'required',
                'string',
                'min:5',
                'max:25',
                'regex:/^[A-Z0-9\-]+$/',
                'unique:users,nim',
            ],
            'prodi' => 'required|string|min:3|max:100',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap mahasiswa wajib diisi.',
            'name.min' => 'Nama lengkap minimal 3 karakter.',
            'nim.required' => 'Nomor Induk Mahasiswa (NIM) wajib diisi.',
            'nim.min' => 'NIM minimal terdiri dari 5 karakter.',
            'nim.max' => 'NIM maksimal 25 karakter.',
            'nim.regex' => 'Format NIM hanya boleh berupa kombinasi angka, huruf, dan tanda strip (-).',
            'nim.unique' => 'NIM ini sudah terdaftar. Silakan login atau periksa kembali NIM Anda.',
            'prodi.required' => 'Program studi wajib dipilih atau diisi.',
            'prodi.min' => 'Nama program studi minimal 3 karakter.',
            'email.required' => 'Alamat email aktif wajib diisi.',
            'email.email' => 'Format email yang dimasukkan tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain atau masuk ke akun Anda.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 angka/huruf demi keamanan akun Anda.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi yang Anda masukkan.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'prodi' => $validated['prodi'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa', // Registrasi portal publik selalu akun kreator Mahasiswa
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('mahasiswa.dashboard')->with('success', "Selamat datang {$user->name}! Akun Mahasiswa Anda dengan NIM {$user->nim} berhasil terdaftar. Silakan mulai unggah portofolio karya terbaik Anda.");
    }

    /**
     * Proses Logout Aman dengan Invalidate Session
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('info', 'Anda telah berhasil keluar dari sistem.');
    }
}
