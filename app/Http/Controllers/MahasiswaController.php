<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Dashboard Portofolio Mahasiswa
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu untuk mengakses dashboard mahasiswa.');
        }

        if (!Auth::user()->isMahasiswa()) {
            return redirect()->route('admin.dashboard')->with('info', 'Anda diarahkan ke Dashboard Kurator Admin.');
        }

        $user = Auth::user();

        $stats = [
            'total_karya'    => Project::where('user_id', $user->id)->count(),
            'approved_karya' => Project::where('user_id', $user->id)->where('status', 'approved')->count(),
            'pending_karya'  => Project::where('user_id', $user->id)->where('status', 'pending')->count(),
            'rejected_karya' => Project::where('user_id', $user->id)->where('status', 'rejected')->count(),
            'total_likes'    => (int) Project::where('user_id', $user->id)->sum('likes_count'),
            'total_views'    => (int) Project::where('user_id', $user->id)->sum('views_count'),
        ];

        $myProjects = Project::where('user_id', $user->id)
            ->latest()
            ->get();

        $notifications = \App\Models\Notification::where('user_id', $user->id)
            ->latest()
            ->take(15)
            ->get();

        $isAutoReview = Setting::isAutoReviewEnabled();

        return view('mahasiswa.dashboard', compact('user', 'stats', 'myProjects', 'notifications', 'isAutoReview'));
    }

    /**
     * Mahasiswa Mengunggah Karya Baru
     */
    public function storeProject(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu untuk mengunggah karya.');
        }

        // Normalisasi URL otomatis (tambahkan https:// jika user mengetik tanpa protokol http/https)
        $urlFields = ['demo_url', 'github_url', 'youtube_url', 'drive_url', 'image_url'];
        $inputs = $request->all();
        foreach ($urlFields as $field) {
            if (!empty($inputs[$field])) {
                $val = trim($inputs[$field]);
                if (!preg_match('~^(?:f|ht)tps?://~i', $val)) {
                    $inputs[$field] = 'https://' . $val;
                }
            }
        }

        // Jika bukan kolaborasi, abaikan array collaborators agar tidak memicu validasi
        if (($inputs['project_type'] ?? 'individu') !== 'kolaborasi') {
            $inputs['collaborators'] = null;
        }

        $request->merge($inputs);

        $validated = $request->validate([
            'title'                      => 'required|string|max:255',
            'project_type'               => 'required|in:individu,kolaborasi',
            'category'                   => 'required|string|in:desain,website,seni,fotografi,iot,mobile,game,riset',
            'description'                => 'required|string|min:10',
            'tech_stack'                 => 'nullable|string|max:255',
            'demo_url'                   => 'nullable|url|max:255',
            'github_url'                 => 'nullable|url|max:255',
            'youtube_url'                => 'nullable|url|max:255',
            'drive_url'                  => 'nullable|url|max:500',
            'image'                      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'image_url'                  => 'nullable|url|max:500',
            // Kolaborator (hanya wajib kalau kolaborasi)
            'collaborators'              => 'nullable|array|max:10',
            'collaborators.*.name'       => 'required_if:project_type,kolaborasi|string|max:100',
            'collaborators.*.nim'        => 'nullable|string|max:20',
            'collaborators.*.jobdesk'    => 'required_if:project_type,kolaborasi|string|max:150',
        ], [
            'title.required'                      => 'Judul karya wajib diisi.',
            'category.required'                   => 'Rumpun kategori karya wajib dipilih.',
            'description.required'                => 'Deskripsi & konsep solusi karya wajib diisi.',
            'description.min'                     => 'Deskripsi karya minimal 10 karakter.',
            'image.image'                         => 'File banner karya harus berupa gambar (JPG, PNG, WebP).',
            'image.max'                           => 'Ukuran gambar maksimal 10 MB.',
            'demo_url.url'                        => 'Format tautan Demo Live tidak valid.',
            'github_url.url'                      => 'Format tautan GitHub tidak valid.',
            'youtube_url.url'                     => 'Format tautan YouTube tidak valid.',
            'drive_url.url'                       => 'Format tautan Google Drive tidak valid.',
            'image_url.url'                       => 'Format tautan gambar online tidak valid.',
            'collaborators.*.name.required_if'    => 'Nama anggota tim kolaborasi wajib diisi.',
            'collaborators.*.jobdesk.required_if' => 'Jobdesk/peran anggota tim kolaborasi wajib diisi.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $dest = public_path('uploads/projects');
            if (!file_exists($dest)) {
                @mkdir($dest, 0777, true);
            }
            $file->move($dest, $filename);
            $imagePath = 'uploads/projects/' . $filename;

            // Mirror ke root folder agar cocok dengan routing Laragon / subfolder Apache
            $rootDest = base_path('uploads/projects');
            if (!file_exists($rootDest)) {
                @mkdir($rootDest, 0777, true);
            }
            @copy($dest . '/' . $filename, $rootDest . '/' . $filename);
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->input('image_url');
        }

        $categoryLabels = [
            'desain'    => 'Desain & UI/UX',
            'website'   => 'Website & Web App',
            'seni'      => 'Seni & Ilustrasi',
            'fotografi' => 'Fotografis & Sinema',
            'iot'       => 'IoT & Robotika',
            'mobile'    => 'Aplikasi Mobile',
            'game'      => 'Game & Animasi',
            'riset'     => 'Riset & Sains Terapan',
        ];

        $isAutoReview = Setting::isAutoReviewEnabled();

        $newProject = \App\Models\Project::create([
            'user_id'        => Auth::id(),
            'title'          => $validated['title'],
            'category'       => $validated['category'],
            'category_label' => $categoryLabels[$validated['category']] ?? 'Karya Kreatif',
            'project_type'   => $validated['project_type'],
            'description'    => $validated['description'],
            'tech_stack'     => $validated['tech_stack'] ?? null,
            'demo_url'       => $validated['demo_url'] ?? null,
            'github_url'     => $validated['github_url'] ?? null,
            'youtube_url'    => $validated['youtube_url'] ?? null,
            'drive_url'      => $validated['drive_url'] ?? null,
            'image_path'     => $imagePath,
            'status'         => $isAutoReview ? 'approved' : 'pending',
            'admin_notes'    => $isAutoReview ? 'Disetujui secara instan oleh sistem (Mode Review Otomatis aktif).' : null,
            'likes_count'    => 0,
            'views_count'    => 0,
            'is_featured'    => false,
        ]);

        // Simpan data kolaborator jika tipe kolaborasi
        if ($validated['project_type'] === 'kolaborasi' && !empty($validated['collaborators'])) {
            foreach ($validated['collaborators'] as $i => $col) {
                if (!empty(trim($col['name'])) && !empty(trim($col['jobdesk']))) {
                    \App\Models\ProjectCollaborator::create([
                        'project_id' => $newProject->id,
                        'name'       => trim($col['name']),
                        'nim'        => trim($col['nim'] ?? ''),
                        'jobdesk'    => trim($col['jobdesk']),
                        'order'      => $i,
                    ]);
                }
            }
        }

        if ($isAutoReview) {
            \App\Models\Notification::create([
                'user_id' => Auth::id(),
                'type'    => 'status_approved',
                'title'   => 'Karya Langsung Terbit! ⚡',
                'message' => "Selamat! Karya Anda \"{$newProject->title}\" langsung disetujui melalui sistem Review Otomatis dan sudah tayang di katalog publik.",
                'icon'    => 'fa-circle-check',
                'color'   => '#10b981',
            ]);

            $admins = \App\Models\User::where('role', 'admin')->get();
            foreach ($admins as $adm) {
                \App\Models\Notification::create([
                    'user_id' => $adm->id,
                    'type'    => 'submission_auto_approved',
                    'title'   => 'Karya Terbit Otomatis ⚡',
                    'message' => "Karya \"{$newProject->title}\" dari " . Auth::user()->name . " langsung disetujui & dipublikasikan (Mode Review Otomatis Aktif).",
                    'icon'    => 'fa-bolt',
                    'color'   => '#10b981',
                ]);
            }

            return back()->with('success', "Karya \"{$newProject->title}\" berhasil diunggah dan LANGSUNG DISETUJUI secara otomatis! Karya Anda kini sudah tayang di katalog publik.");
        } else {
            $admins = \App\Models\User::where('role', 'admin')->get();
            foreach ($admins as $adm) {
                \App\Models\Notification::create([
                    'user_id' => $adm->id,
                    'type'    => 'submission',
                    'title'   => 'Pengajuan Karya Baru 📥',
                    'message' => "Mahasiswa " . Auth::user()->name . " mengajukan karya: \"{$newProject->title}\".",
                    'icon'    => 'fa-cloud-arrow-up',
                    'color'   => '#3b82f6',
                ]);
            }

            return back()->with('success', 'Karya berhasil diajukan! Dewan kurator admin kampus akan segera mereview karya Anda.');
        }
    }




    /**
     * Mahasiswa Menghapus Karya Miliknya
     */
    public function destroyProject($id)
    {
        $project = Project::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $title = $project->title;
        $project->delete();

        return back()->with('info', "Karya \"{$title}\" berhasil ditarik dan dihapus dari portofolio Anda.");
    }

    /**
     * Tampilkan halaman edit profil mahasiswa
     */
    public function editProfile()
    {
        if (!Auth::check() || !Auth::user()->isMahasiswa()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        return view('mahasiswa.profile', compact('user'));
    }

    /**
     * Simpan perubahan profil mahasiswa
     */
    public function updateProfile(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isMahasiswa()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Normalisasi URL otomatis (tambahkan https:// jika user mengetik tanpa protokol http/https)
        $urlFields = ['linkedin_url', 'github_url', 'avatar_url_input'];
        $inputs = $request->all();
        foreach ($urlFields as $field) {
            if (!empty($inputs[$field])) {
                $val = trim($inputs[$field]);
                if (!preg_match('~^(?:f|ht)tps?://~i', $val)) {
                    $inputs[$field] = 'https://' . $val;
                }
            }
        }
        $request->merge($inputs);

        $validated = $request->validate([
            'name'             => 'nullable|string|max:255',
            'prodi'            => 'nullable|string|max:255',
            'angkatan'         => 'nullable|string|max:10',
            'bio'              => 'nullable|string|max:500',
            'phone'            => 'nullable|string|max:20',
            'avatar'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'avatar_url_input' => 'nullable|url|max:500',
            'linkedin_url'     => 'nullable|url|max:500',
            'github_url'       => 'nullable|url|max:500',
            'password'         => 'nullable|string|min:6|confirmed',
        ], [
            'avatar.image'       => 'File foto harus berupa gambar (JPEG, PNG, JPG, WebP).',
            'avatar.max'         => 'Ukuran foto maksimal 10MB.',
            'avatar_url_input.url' => 'URL foto online tidak valid.',
            'linkedin_url.url'   => 'URL LinkedIn tidak valid.',
            'github_url.url'     => 'URL GitHub tidak valid.',
            'password.min'       => 'Password minimal 6 angka/huruf.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $updateData = [
            'name'         => $validated['name'] ?? $user->name,
            'prodi'        => $validated['prodi'] ?? $user->prodi,
            'angkatan'     => $validated['angkatan'] ?? $user->angkatan,
            'bio'          => $validated['bio'] ?? $user->bio,
            'phone'        => $validated['phone'] ?? $user->phone,
            'linkedin_url' => $request->has('linkedin_url') ? ($validated['linkedin_url'] ?? null) : $user->linkedin_url,
            'github_url'   => $request->has('github_url') ? ($validated['github_url'] ?? null) : $user->github_url,
        ];

        // Handle upload foto profil dari komputer
        if ($request->hasFile('avatar')) {
            $file       = $request->file('avatar');
            $filename   = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destPublic = public_path('uploads/avatars');
            $destRoot   = base_path('uploads/avatars');

            if (!file_exists($destPublic)) {
                @mkdir($destPublic, 0777, true);
            }
            if (!file_exists($destRoot)) {
                @mkdir($destRoot, 0777, true);
            }

            // Hapus foto lama jika bukan URL eksternal
            if ($user->avatar_url && !str_starts_with($user->avatar_url, 'http')) {
                $oldPathPublic = public_path($user->avatar_url);
                $oldPathRoot   = base_path($user->avatar_url);
                if (file_exists($oldPathPublic)) @unlink($oldPathPublic);
                if (file_exists($oldPathRoot)) @unlink($oldPathRoot);
            }

            $file->move($destPublic, $filename);

            // Duplikasi ke base_path agar kompatibel dengan seluruh virtual host / alias Laragon
            if (file_exists($destPublic . DIRECTORY_SEPARATOR . $filename)) {
                @copy($destPublic . DIRECTORY_SEPARATOR . $filename, $destRoot . DIRECTORY_SEPARATOR . $filename);
            }

            $updateData['avatar_url'] = 'uploads/avatars/' . $filename;
        } elseif (!empty($validated['avatar_url_input'])) {
            $updateData['avatar_url'] = $validated['avatar_url_input'];
        }

        // Handle ganti password (opsional)
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return back()->with('success', 'Profil dan foto berhasil diperbarui!');
    }


    /**
     * Endpoint API status review otomatis untuk sinkronisasi real-time mahasiswa
     */
    public function getReviewStatus()
    {
        $isAutoReview = Setting::isAutoReviewEnabled();
        $unreadCount = Auth::check() 
            ? \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count() 
            : 0;

        return response()->json([
            'auto_review' => $isAutoReview,
            'unread_notifications' => $unreadCount,
            'title' => $isAutoReview ? 'Pemberitahuan: Mode Review Otomatis Aktif ⚡' : 'Pemberitahuan: Mode Kurasi Manual Aktif 🛡️',
            'desc'  => $isAutoReview 
                ? 'Admin kampus sedang mengaktifkan Review Otomatis. Setiap karya baru yang Anda unggah akan langsung disetujui (Approved) secara instan dan langsung terbit di katalog publik tanpa masa tunggu antrean kurasi!'
                : 'Admin kampus sedang menerapkan Kurasi Manual. Setiap karya baru yang Anda ajukan akan masuk ke antrean kurasi dan diperiksa terlebih dahulu oleh kurator kampus sebelum diterbitkan ke katalog publik.',
        ]);
    }
}
