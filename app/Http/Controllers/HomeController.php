<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Halaman Beranda (Hero + Karya Terbaik Spotlight + Tentang)
     */
    public function index()
    {
        $featuredProjects = Project::with(['user', 'collaborators'])
            ->where('status', 'approved')
            ->where('is_featured', true)
            ->take(3)
            ->get();

        if ($featuredProjects->count() < 3) {
            $featuredProjects = Project::with(['user', 'collaborators'])
                ->where('status', 'approved')
                ->orderByDesc('likes_count')
                ->take(3)
                ->get();
        }

        // Data Statistik Real-time Beranda (Otomatis terupdate dari database)
        $totalKarya = Project::where('status', '!=', 'rejected')->count();
        if ($totalKarya === 0) {
            $totalKarya = Project::count();
        }

        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalProdi = User::whereNotNull('prodi')->where('prodi', '!=', '')->distinct('prodi')->count('prodi');
        if ($totalProdi === 0) {
            $totalProdi = 1;
        }

        return view('welcome', compact('featuredProjects', 'totalKarya', 'totalMahasiswa', 'totalProdi'));
    }

    /**
     * Halaman Kategori Mandiri
     */
    public function kategori()
    {
        $categoryCounts = [
            'desain' => Project::where('category', 'desain')->where('status', 'approved')->count(),
            'website' => Project::where('category', 'website')->where('status', 'approved')->count(),
            'seni' => Project::where('category', 'seni')->where('status', 'approved')->count(),
            'fotografi' => Project::where('category', 'fotografi')->where('status', 'approved')->count(),
            'iot' => Project::where('category', 'iot')->where('status', 'approved')->count(),
            'mobile' => Project::where('category', 'mobile')->where('status', 'approved')->count(),
            'game' => Project::where('category', 'game')->where('status', 'approved')->count(),
            'riset' => Project::where('category', 'riset')->where('status', 'approved')->count(),
        ];

        return view('kategori', compact('categoryCounts'));
    }

    /**
     * Halaman Semua Karya Mandiri
     */
    public function semuaKarya(Request $request)
    {
        $query = Project::with(['user', 'collaborators'])->where('status', 'approved');

        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('category', $request->kategori);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('tech_stack', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('prodi', 'like', "%{$search}%");
                  });
            });
        }

        $sort = $request->get('sort', 'populer');
        if ($sort === 'terbaru') {
            $query->latest();
        } elseif ($sort === 'az') {
            $query->orderBy('title', 'asc');
        } else {
            $query->orderByDesc('likes_count');
        }

        $projects = $query->get();

        return view('semua-karya', compact('projects'));
    }

    /**
     * Berikan Like ke Proyek
     */
    public function like($id)
    {
        $project = Project::findOrFail($id);
        $project->increment('likes_count');

        // Buat notifikasi ke mahasiswa pemilik karya
        if ($project->user_id) {
            \App\Models\Notification::create([
                'user_id' => $project->user_id,
                'type'    => 'like',
                'title'   => 'Apresiasi Suka Baru! ❤️',
                'message' => "Pengunjung baru saja menyukai karya Anda: \"{$project->title}\".",
                'icon'    => 'fa-heart',
                'color'   => '#e11d48',
            ]);
        }

        return response()->json([
            'success' => true,
            'likes'   => $project->likes_count,
        ]);
    }

    /**
     * Catat view / pengunjung melihat detail karya
     */
    public function recordView($id)
    {
        $project = Project::findOrFail($id);
        $project->increment('views_count');

        return response()->json([
            'success' => true,
            'views'   => $project->views_count,
        ]);
    }

    /**
     * Tandai semua notifikasi pengguna sebagai sudah dibaca
     */
    public function markNotificationsRead()
    {
        if (auth()->check()) {
            \App\Models\Notification::where('user_id', auth()->id())->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Profil Publik Mahasiswa — bisa diakses siapapun tanpa login
     */
    public function profilPublik($id)
    {
        $user = \App\Models\User::findOrFail($id);

        // Hanya profil mahasiswa yang bisa dilihat publik
        if (!$user->isMahasiswa()) {
            abort(404);
        }

        $projects = Project::with('collaborators')->where('user_id', $id)
            ->where('status', 'approved')
            ->latest()
            ->get();

        $stats = [
            'total_approved' => $projects->count(),
            'total_likes'    => $projects->sum('likes_count'),
            'total_views'    => $projects->sum('views_count'),
        ];

        return view('profil-publik', compact('user', 'projects', 'stats'));
    }
}
