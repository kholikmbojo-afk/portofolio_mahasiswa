<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service untuk integrasi Single Sign-On (SSO) Portal Kampus
 * Bridge API v2 (eCampuz / UIN Siber Syekh Nurjati Cirebon).
 */
class BridgeSSOService
{
    protected bool $enabled;
    protected string $baseUrl;
    protected int $timeout;
    protected bool $simulate;

    public function __construct()
    {
        $config = config('services.bridge_sso', []);
        $this->enabled  = (bool) ($config['enabled'] ?? true);
        $this->baseUrl  = rtrim((string) ($config['base_url'] ?? 'https://bridge.uinssc.ac.id'), '/');
        $this->timeout  = (int) ($config['timeout'] ?? 8);
        $this->simulate = (bool) ($config['simulate'] ?? false);
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function isSimulate(): bool
    {
        return $this->simulate;
    }

    /**
     * Autentikasi Mahasiswa/Dosen ke Portal Kampus via Bridge API v2.
     * Endpoint: POST {BASE_URL}/api/v2/portal/login
     *
     * @param string $username NIM / NIP / NIK
     * @param string $password Sandi portal
     * @return array [success => bool, token => ?string, message => string, connection => bool]
     */
    public function login(string $username, string $password): array
    {
        // 1. Fallback mode simulasi lokal
        if ($this->simulate) {
            return $this->simulateLogin($username, $password);
        }

        try {
            $response = Http::asForm()
                ->acceptJson()
                ->timeout($this->timeout)
                ->post("{$this->baseUrl}/api/v2/portal/login", [
                    'username' => trim($username),
                    'password' => $password,
                ]);

            $json = $response->json() ?? [];

            if ($response->successful()) {
                // Berdasarkan spesifikasi Postman v2: data.token atau token
                $token = $json['data']['token'] ?? $json['token'] ?? null;

                if (!empty($token)) {
                    return [
                        'success'    => true,
                        'token'      => $token,
                        'message'    => $json['message'] ?? 'Login portal kampus berhasil.',
                        'connection' => true,
                        'raw'        => $json,
                    ];
                }
            }

            // Kredensial tidak valid atau error response (400, 401, 422)
            $errorMessage = $json['message'] ?? 'NIM atau kata sandi portal kampus yang Anda masukkan salah.';

            return [
                'success'    => false,
                'token'      => null,
                'message'    => $errorMessage,
                'connection' => true,
                'status'     => $response->status(),
            ];

        } catch (ConnectionException $e) {
            Log::warning("BridgeSSOService: Connection timeout to {$this->baseUrl}/api/v2/portal/login. " . $e->getMessage());

            // Jika server offline, fallback ke simulasi jika diizinkan
            if ($this->simulate) {
                return $this->simulateLogin($username, $password);
            }

            return [
                'success'    => false,
                'token'      => null,
                'message'    => "Gagal terhubung ke Server Portal Kampus (Koneksi timeout setelah {$this->timeout} detik). Silakan hubungi admin atau coba lagi sesaat lagi.",
                'connection' => false,
            ];
        } catch (\Exception $e) {
            Log::error("BridgeSSOService: Unexpected error during login: " . $e->getMessage());

            return [
                'success'    => false,
                'token'      => null,
                'message'    => "Terjadi kesalahan sistem saat menghubungi portal kampus: " . $e->getMessage(),
                'connection' => false,
            ];
        }
    }

    /**
     * Ambil data profil mahasiswa / dosen dari API Kampus.
     * Endpoint: GET {BASE_URL}/api/v2/profil
     *
     * @param string $token Bearer token dari hasil login
     * @param string $username NIM / NIP untuk fallback
     * @return array [name, unit_or_prodi, email, phone, role, nim]
     */
    public function getProfile(string $token, string $username = ''): array
    {
        if ($this->simulate) {
            return $this->simulateProfile($username);
        }

        try {
            // Coba endpoint resmi sesuai Postman: /api/v2/profil
            $response = Http::withToken($token)
                ->acceptJson()
                ->timeout($this->timeout)
                ->get("{$this->baseUrl}/api/v2/profil");

            // Jika 404, coba fallback ke /api/v2/portal/profile
            if ($response->status() === 404) {
                $response = Http::withToken($token)
                    ->acceptJson()
                    ->timeout($this->timeout)
                    ->get("{$this->baseUrl}/api/v2/portal/profile");
            }

            if ($response->successful()) {
                $json = $response->json() ?? [];
                $data = $json['data'] ?? $json;

                return $this->parseProfileData($data, $username);
            }

            Log::warning("BridgeSSOService: Failed to fetch profile. Status: {$response->status()}");
        } catch (\Exception $e) {
            Log::warning("BridgeSSOService: Exception while fetching profile: " . $e->getMessage());
        }

        // Fallback profil standar jika gagal fetch profil
        return $this->simulateProfile($username);
    }

    /**
     * Standarisasi format array data profil
     */
    protected function parseProfileData(array $data, string $username): array
    {
        $nim = $data['nim'] ?? $data['nip'] ?? $data['username'] ?? $username;
        $name = $data['nama'] ?? $data['name'] ?? $data['nama_lengkap'] ?? "Mahasiswa {$nim}";
        $prodi = $data['prodi'] ?? $data['unit'] ?? $data['program_studi'] ?? $data['nama_prodi'] ?? 'Informatika';
        $email = $data['email'] ?? "{$nim}@mahasiswa.uinssc.ac.id";
        $phone = $data['no_hp'] ?? $data['phone'] ?? $data['telepon'] ?? null;
        $role  = $data['role'] ?? 'mahasiswa';

        // Deteksi role jika dosen
        if (isset($data['nip']) && !empty($data['nip'])) {
            $role = 'dosen';
        }

        return [
            'success'       => true,
            'nim'           => (string) $nim,
            'name'          => (string) $name,
            'unit_or_prodi' => (string) $prodi,
            'email'         => (string) $email,
            'phone'         => $phone ? (string) $phone : null,
            'role'          => (string) $role,
            'raw'           => $data,
        ];
    }

    /**
     * Mock data login untuk development offline
     */
    public function simulateLogin(string $username, string $password): array
    {
        // Simulasi gagal jika password 'salah' atau terlalu pendek
        if ($password === 'salah' || strlen($password) < 6) {
            return [
                'success'    => false,
                'token'      => null,
                'message'    => 'Kata sandi portal kampus salah (Simulasi Mock).',
                'connection' => true,
            ];
        }

        return [
            'success'    => true,
            'token'      => 'mock-bridge-token-' . md5($username . time()),
            'message'    => 'Login portal kampus berhasil (Simulasi Mock Dev).',
            'connection' => true,
            'is_mock'    => true,
        ];
    }

    /**
     * Mock data profil untuk development offline
     */
    public function simulateProfile(string $username): array
    {
        return [
            'success'       => true,
            'nim'           => $username,
            'name'          => 'Mahasiswa ' . $username,
            'unit_or_prodi' => 'Teknik Informatika (S1)',
            'email'         => "{$username}@mahasiswa.uinssc.ac.id",
            'phone'         => '081234567890',
            'role'          => 'mahasiswa',
            'is_mock'       => true,
        ];
    }
}

