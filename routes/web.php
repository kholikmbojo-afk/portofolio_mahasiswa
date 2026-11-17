<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;

// Auto-sync Poster Final ke folder public, root project, Downloads, dan Desktop
$posterSrc = 'C:/Users/USER/.gemini/antigravity/brain/a4f40950-5aeb-401c-b013-5a2b77d6f278/poster_promosi_sic_uin_siber_cirebon_1794124272427.jpg';
if (file_exists($posterSrc)) {
    $destinations = [
        public_path('POSTER-SIC-FINAL.jpg'),
        base_path('POSTER-SIC-FINAL.jpg'),
        'C:/Users/USER/Downloads/POSTER-SIC-FINAL.jpg',
        'C:/Users/USER/Desktop/POSTER-SIC-FINAL.jpg',
    ];
    foreach ($destinations as $dst) {
        if (!file_exists($dst) || @filesize($dst) !== @filesize($posterSrc)) {
            @copy($posterSrc, $dst);
        }
    }
}

// Public Routes (Bebas diakses oleh pengunjung umum tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/video', function () {
    return file_get_contents(public_path('video-demo.html'));
})->name('video.demo');
Route::get('/poster', function () {
    return file_get_contents(public_path('poster.html'));
})->name('poster');
Route::get('/download-poster', function () {
    $path = public_path('POSTER-SIC-FINAL.jpg');
    if (!file_exists($path)) {
        $path = 'C:/Users/USER/.gemini/antigravity/brain/a4f40950-5aeb-401c-b013-5a2b77d6f278/poster_promosi_sic_uin_siber_cirebon_1794124272427.jpg';
    }
    if (file_exists($path)) {
        return response()->download($path, 'POSTER-RESMI-SIC-UIN-SIBER.jpg', [
            'Content-Type' => 'image/jpeg',
            'Content-Disposition' => 'attachment; filename="POSTER-RESMI-SIC-UIN-SIBER.jpg"'
        ]);
    }
    abort(404, 'File poster tidak ditemukan.');
})->name('poster.download');
Route::get('/kategori', [HomeController::class, 'kategori'])->name('kategori');
Route::get('/semua-karya', [HomeController::class, 'semuaKarya'])->name('semua-karya');
Route::post('/karya/{id}/like', [HomeController::class, 'like'])->name('karya.like');
Route::post('/karya/{id}/view', [HomeController::class, 'recordView'])->name('karya.view');
Route::get('/profil/{id}', [HomeController::class, 'profilPublik'])->name('profil.publik');
Route::post('/notifikasi/read-all', [HomeController::class, 'markNotificationsRead'])->name('notifikasi.read-all');

// Auth Routes (Login, Register, Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Admin (Khusus Kurator & Verifikator Kampus)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/karya/{id}/approve', [AdminController::class, 'approve'])->name('karya.approve');
    Route::post('/karya/{id}/reject', [AdminController::class, 'reject'])->name('karya.reject');
    Route::delete('/karya/{id}', [AdminController::class, 'deleteProject'])->name('karya.delete');
    Route::post('/settings/toggle-auto-review', [AdminController::class, 'toggleAutoReview'])->name('settings.toggle-auto-review');
    Route::post('/karya/approve-all-pending', [AdminController::class, 'approveAllPending'])->name('karya.approve-all');
});

// Dashboard Mahasiswa (Khusus Kreator Mahasiswa)
Route::middleware(['auth'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
    Route::get('/review-status', [MahasiswaController::class, 'getReviewStatus'])->name('review-status');
    Route::post('/karya/store', [MahasiswaController::class, 'storeProject'])->name('karya.store');
    Route::delete('/karya/{id}', [MahasiswaController::class, 'destroyProject'])->name('karya.destroy');
    Route::get('/profil', [MahasiswaController::class, 'editProfile'])->name('profil');
    Route::post('/profil', [MahasiswaController::class, 'updateProfile'])->name('profil.update');
});
