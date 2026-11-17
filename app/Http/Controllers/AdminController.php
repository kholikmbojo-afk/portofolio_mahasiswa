<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Pastikan hanya Admin yang dapat mengakses
     */
    public function __construct()
    {
        // Auth check will be applied via route middleware
    }

    /**
     * Halaman Utama Dashboard Admin
     */
    public function dashboard(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu untuk mengakses panel admin.');
        }

        if (!Auth::user()->isAdmin()) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Akses ditolak: Panel kurasi hanya dapat diakses oleh Administrator Kampus.');
        }

        $stats = [
            'total_karya' => Project::count(),
            'pending_karya' => Project::where('status', 'pending')->count(),
            'approved_karya' => Project::where('status', 'approved')->count(),
            'rejected_karya' => Project::where('status', 'rejected')->count(),
            'total_mahasiswa' => User::where('role', 'mahasiswa')->count(),
        ];

        // Antrean karya yang perlu di-review & ACC
        $pendingProjects = Project::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        // Seluruh karya terkurasi
        $allProjects = Project::with('user')
            ->latest()
            ->get();

        // Daftar mahasiswa terdaftar
        $mahasiswaList = User::where('role', 'mahasiswa')
            ->withCount('projects')
            ->latest()
            ->get();

        // Notifikasi Admin
        $notifications = \App\Models\Notification::where('user_id', Auth::id())->latest()->take(15)->get();

        // Status Mode Review Otomatis
        $isAutoReview = Setting::isAutoReviewEnabled();

        return view('admin.dashboard', compact('stats', 'pendingProjects', 'allProjects', 'mahasiswaList', 'notifications', 'isAutoReview'));
    }

    /**
     * Setujui (ACC) Karya Mahasiswa
     */
    public function approve($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $project = Project::findOrFail($id);
        $project->update([
            'status' => 'approved',
            'admin_notes' => null,
        ]);

        // Kirim notifikasi ke mahasiswa pemilik karya
        if ($project->user_id) {
            \App\Models\Notification::create([
                'user_id' => $project->user_id,
                'type'    => 'status_approved',
                'title'   => 'Karya Disetujui! 🎉',
                'message' => "Selamat! Karya Anda \"{$project->title}\" telah disetujui kurator dan resmi tampil di katalog publik.",
                'icon'    => 'fa-circle-check',
                'color'   => '#10b981',
            ]);
        }

        return back()->with('success', "Karya \"{$project->title}\" berhasil di-ACC dan langsung tampil di katalog publik!");
    }

    /**
     * Tolak Karya dengan Catatan Review
     */
    public function reject(Request $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        $project = Project::findOrFail($id);
        $project->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
        ]);

        // Kirim notifikasi ke mahasiswa pemilik karya
        if ($project->user_id) {
            \App\Models\Notification::create([
                'user_id' => $project->user_id,
                'type'    => 'status_rejected',
                'title'   => 'Karya Memerlukan Revisi ⚠️',
                'message' => "Karya Anda \"{$project->title}\" memerlukan revisi: {$request->admin_notes}",
                'icon'    => 'fa-triangle-exclamation',
                'color'   => '#f59e0b',
            ]);
        }

        return back()->with('info', "Karya \"{$project->title}\" ditolak dan catatan perbaikan telah dikirimkan ke mahasiswa.");
    }

    /**
     * Hapus Karya
     */
    public function deleteProject($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $project = Project::findOrFail($id);
        $title = $project->title;
        $project->delete();

        return back()->with('success', "Karya \"{$title}\" berhasil dihapus dari sistem.");
    }

    /**
     * Toggle Mode Review Otomatis (On / Off)
     */
    public function toggleAutoReview(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $current = Setting::isAutoReviewEnabled();
        // Jika ada input spesifik 'enabled', gunakan itu, jika tidak toggle nilai saat ini
        if ($request->has('enabled')) {
            $newState = filter_var($request->input('enabled'), FILTER_VALIDATE_BOOLEAN);
        } else {
            $newState = !$current;
        }

        Setting::set('auto_review', $newState ? '1' : '0');

        // Berikan notifikasi ke seluruh akun mahasiswa yang terdaftar
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        if ($newState) {
            $notifTitle = 'Mode Review Otomatis Aktif! ⚡';
            $notifMsg   = 'Kabar gembira! Admin kampus telah mengaktifkan Mode Review Otomatis. Karya baru yang Anda unggah akan langsung disetujui & tayang di katalog publik tanpa masa tunggu antrean kurasi.';
            $notifIcon  = 'fa-bolt';
            $notifColor = '#10b981';
            $statusText = 'Review Otomatis berhasil DIAKTIFKAN. Setiap karya baru akan langsung disetujui (ACC) otomatis!';
        } else {
            $notifTitle = 'Mode Kurasi Manual Diaktifkan 🛡️';
            $notifMsg   = 'Admin kampus mengaktifkan kembali verifikasi manual. Karya baru yang Anda unggah akan melalui proses kurasi dan peninjauan oleh dewan kurator sebelum dipublikasikan.';
            $notifIcon  = 'fa-shield-halved';
            $notifColor = '#f59e0b';
            $statusText = 'Review Otomatis telah DINONAKTIFKAN. Seluruh karya baru akan masuk ke antrean kurasi manual.';
        }

        foreach ($mahasiswas as $mhs) {
            \App\Models\Notification::create([
                'user_id' => $mhs->id,
                'type'    => $newState ? 'auto_review_on' : 'auto_review_off',
                'title'   => $notifTitle,
                'message' => $notifMsg,
                'icon'    => $notifIcon,
                'color'   => $notifColor,
            ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'     => true,
                'auto_review' => $newState,
                'message'     => $statusText,
            ]);
        }

        return back()->with('success', $statusText);
    }

    /**
     * Setujui Sekaligus Seluruh Karya yang Masih Pending
     */
    public function approveAllPending()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $pendingProjects = Project::where('status', 'pending')->get();
        $count = $pendingProjects->count();

        foreach ($pendingProjects as $proj) {
            $proj->update([
                'status' => 'approved',
                'admin_notes' => null,
            ]);

            if ($proj->user_id) {
                \App\Models\Notification::create([
                    'user_id' => $proj->user_id,
                    'type'    => 'status_approved',
                    'title'   => 'Karya Disetujui! 🎉',
                    'message' => "Selamat! Karya Anda \"{$proj->title}\" telah disetujui kurator dan resmi tampil di katalog publik.",
                    'icon'    => 'fa-circle-check',
                    'color'   => '#10b981',
                ]);
            }
        }

        return back()->with('success', "Sebanyak {$count} karya pending berhasil di-ACC sekaligus!");
    }
}

