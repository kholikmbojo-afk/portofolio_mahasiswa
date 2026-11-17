@extends('layouts.app')

@section('title', $user->name . ' — Profil & Portofolio Mahasiswa · KaryaMahasiswa')

@section('extra_css')
<style>
    /* ===== Profile Page Styling ===== */
    .profile-page-section {
        padding: 40px 0 70px;
    }

    /* Back Link */
    .profile-back-nav {
        margin-bottom: 24px;
    }

    .profile-back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #ffffff;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.92rem;
        background: rgba(25, 25, 23, 0.25);
        padding: 8px 18px;
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        transition: all 0.2s ease;
    }

    .profile-back-link:hover {
        background: var(--accent-gold);
        color: #ffffff;
        border-color: var(--accent-gold);
        transform: translateX(-4px);
    }

    /* Profile Hero Card */
    .profile-hero-card {
        background: #ffffff;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: 0 14px 40px rgba(4, 120, 87, 0.12);
        margin-bottom: 36px;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .profile-hero-cover {
        height: 140px;
        background: linear-gradient(135deg, #059669 0%, #10b981 50%, #f0dc9e 100%);
        position: relative;
    }

    .profile-hero-cover::after {
        content: "";
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.15) 1px, transparent 1px);
        background-size: 24px 24px;
        opacity: 0.7;
    }

    .profile-hero-content {
        padding: 0 36px 36px;
        position: relative;
    }

    .profile-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-top: -60px;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .profile-avatar-wrap {
        position: relative;
    }

    .profile-avatar-img, .profile-avatar-fallback {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid #ffffff;
        box-shadow: 0 8px 24px rgba(25, 25, 23, 0.18);
        object-fit: cover;
        background: #ffffff;
    }

    .profile-avatar-fallback {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0dc9e, #059669);
        color: var(--text-dark);
        font-family: var(--font-headline);
        font-size: 2.8rem;
        letter-spacing: 1px;
    }

    .profile-action-links {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .profile-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 18px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid var(--border-soft);
        background: var(--card-subtle);
        color: var(--text-dark);
    }

    .profile-btn:hover {
        background: var(--text-dark);
        color: #ffffff;
        transform: translateY(-2px);
    }

    .profile-btn.primary {
        background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
        color: var(--text-dark);
        border-color: var(--accent-gold);
    }

    .profile-btn.primary:hover {
        background: #ffffff;
        color: var(--text-dark);
        box-shadow: 0 4px 14px rgba(240, 220, 158, 0.35);
    }

    .profile-btn.github:hover {
        background: #24292e;
        color: #ffffff;
    }

    .profile-btn.linkedin:hover {
        background: #0077b5;
        color: #ffffff;
    }

    .profile-btn.wa:hover {
        background: #25d366;
        color: #ffffff;
    }

    /* Name & Academics */
    .profile-name-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.2;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .verified-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(16, 185, 129, 0.12);
        color: #059669;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 50px;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .profile-academic-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        color: var(--text-muted);
        font-size: 0.94rem;
        margin-bottom: 16px;
        font-weight: 600;
    }

    .academic-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .academic-tag {
        background: var(--card-subtle);
        border: 1px solid var(--border-soft);
        padding: 3px 12px;
        border-radius: 50px;
        font-family: var(--font-mono);
        font-size: 0.82rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .profile-bio-box {
        background: #fbfcfd;
        border-left: 4px solid var(--accent-gold);
        padding: 14px 20px;
        border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        margin-top: 14px;
        font-size: 0.94rem;
        color: var(--text-dark);
        line-height: 1.6;
        border: 1px solid var(--border-soft);
        border-left-width: 4px;
        border-left-color: var(--accent-gold);
    }

    /* Stats Grid */
    .profile-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 40px;
    }

    .profile-stat-box {
        background: #ffffff;
        border-radius: var(--radius-md);
        padding: 22px 24px;
        box-shadow: 0 8px 24px rgba(25, 25, 23, 0.08);
        display: flex;
        align-items: center;
        gap: 18px;
        border: 1px solid rgba(25, 25, 23, 0.06);
        transition: transform 0.2s ease;
    }

    .profile-stat-box:hover {
        transform: translateY(-3px);
    }

    .stat-icon-wrap {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .stat-icon-wrap.projects {
        background: rgba(240, 220, 158, 0.25);
        color: var(--accent-gold-hover);
    }

    .stat-icon-wrap.likes {
        background: rgba(244, 63, 94, 0.12);
        color: #e11d48;
    }

    .stat-icon-wrap.views {
        background: rgba(59, 130, 246, 0.12);
        color: #2563eb;
    }

    .stat-number-val {
        font-family: var(--font-headline);
        font-size: 2rem;
        line-height: 1;
        color: var(--text-dark);
        margin-bottom: 4px;
    }

    .stat-label-text {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Section Title */
    .profile-works-header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 24px;
        color: #ffffff;
        text-shadow: 0 1px 3px rgba(25, 25, 23, 0.3);
    }

    .profile-works-title {
        font-family: var(--font-headline);
        font-size: 2.2rem;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile-works-count {
        background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
        color: var(--text-dark);
        font-family: var(--font-mono);
        font-size: 0.9rem;
        font-weight: 700;
        padding: 3px 12px;
        border-radius: 50px;
        text-shadow: none;
    }

    /* Cards Grid */
    .profile-works-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .project-card-clean {
        background: #ffffff;
        border-radius: var(--radius-md);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 10px 25px rgba(25, 25, 23, 0.08);
        transition: all 0.25s ease;
        position: relative;
    }

    .project-card-clean:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 35px rgba(25, 25, 23, 0.15);
    }

    .project-preview-banner {
        height: 190px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .project-img-cover {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease;
    }

    .project-card-clean:hover .project-img-cover {
        transform: scale(1.05);
    }

    .project-banner-fallback {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .project-banner-fallback i {
        font-size: 3.5rem;
        color: rgba(255, 255, 255, 0.25);
    }

    .project-cat-chip {
        position: absolute;
        top: 14px;
        left: 14px;
        background: rgba(25, 25, 23, 0.85);
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 50px;
        letter-spacing: 0.5px;
        backdrop-filter: blur(4px);
        z-index: 2;
    }

    .project-like-chip {
        position: absolute;
        top: 14px;
        right: 14px;
        background: rgba(255, 255, 255, 0.92);
        color: #e11d48;
        font-size: 0.82rem;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 50px;
        cursor: pointer;
        backdrop-filter: blur(4px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        transition: all 0.2s ease;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .project-like-chip:hover {
        background: #ffffff;
        transform: scale(1.08);
    }

    .project-card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .project-title-link {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.35;
        margin-bottom: 8px;
        cursor: pointer;
        transition: color 0.2s;
    }

    .project-title-link:hover {
        color: var(--accent-gold);
    }

    .project-desc-snippet {
        font-size: 0.86rem;
        color: var(--text-muted);
        line-height: 1.55;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .project-tech-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 16px;
    }

    .tech-pill {
        background: var(--card-subtle);
        border: 1px solid var(--border-soft);
        color: var(--text-dark);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 50px;
    }

    .project-card-footer {
        padding-top: 14px;
        border-top: 1px solid rgba(25, 25, 23, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
    }

    .project-meta-views {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .profile-footer-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-detail-small {
        background: var(--text-dark);
        color: #ffffff;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-detail-small:hover {
        background: var(--accent-gold);
        transform: translateY(-2px);
    }

    .btn-icon-ext {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--card-subtle);
        color: var(--text-dark);
        text-decoration: none;
        font-size: 0.78rem;
        border: 1px solid var(--border-soft);
        transition: all 0.2s;
    }

    .btn-icon-ext:hover {
        background: var(--accent-gold);
        color: #ffffff;
        border-color: var(--accent-gold);
    }

    /* Empty State */
    .profile-empty-state {
        background: #ffffff;
        border-radius: var(--radius-md);
        padding: 60px 30px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(25, 25, 23, 0.08);
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(237, 217, 163, 0.25);
        color: var(--accent-gold-hover);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        margin: 0 auto 20px;
    }

    .empty-state-title {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .empty-state-desc {
        color: var(--text-muted);
        font-size: 0.94rem;
        max-width: 460px;
        margin: 0 auto 24px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .profile-works-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .profile-stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .profile-header-flex {
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: -50px;
        }
        .profile-name-title {
            justify-content: center;
            font-size: 1.6rem;
        }
        .profile-academic-meta {
            justify-content: center;
        }
        .profile-action-links {
            justify-content: center;
        }
        .profile-stats-grid {
            grid-template-columns: 1fr;
        }
        .profile-works-grid {
            grid-template-columns: 1fr;
        }
        .profile-hero-content {
            padding: 0 20px 24px;
        }
    }
</style>
@endsection

@section('content')
<section class="profile-page-section">
    <div class="container">

        <!-- Back Button -->
        <div class="profile-back-nav">
            <a href="{{ route('semua-karya') }}" class="profile-back-link">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Galeri Karya
            </a>
        </div>

        <!-- Student Profile Card -->
        <div class="profile-hero-card">
            <div class="profile-hero-cover"></div>
            
            <div class="profile-hero-content">
                <div class="profile-header-flex">
                    <!-- Avatar -->
                    <div class="profile-avatar-wrap">
                        @php
                            $pubAvatar = null;
                            if (!empty($user->avatar_url)) {
                                $pubAvatar = str_starts_with($user->avatar_url, 'http') ? $user->avatar_url : asset($user->avatar_url);
                            }
                        @endphp
                        @if($pubAvatar)
                            <img src="{{ $pubAvatar }}" alt="{{ $user->name }}" class="profile-avatar-img" onerror="if(!this.dataset.retried){this.dataset.retried=1; if(this.src.indexOf('/public/')===-1){this.src=this.src.replace('/uploads/','/public/uploads/');}else{this.src=this.src.replace('/public/uploads/','/uploads/');}}else{this.style.display='none'; if(this.nextElementSibling){this.nextElementSibling.style.display='flex';}}">
                            <div class="profile-avatar-fallback" style="display: none;">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                        @else
                            <div class="profile-avatar-fallback">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    <!-- Contact & Social Links -->
                    <div class="profile-action-links">
                        @if(!empty($user->github_url))
                            <a href="{{ $user->github_url }}" target="_blank" rel="noopener noreferrer" class="profile-btn github" title="GitHub">
                                <i class="fa-brands fa-github"></i> GitHub
                            </a>
                        @endif

                        @if(!empty($user->linkedin_url))
                            <a href="{{ $user->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="profile-btn linkedin" title="LinkedIn">
                                <i class="fa-brands fa-linkedin"></i> LinkedIn
                            </a>
                        @endif

                        @if(!empty($user->phone))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" target="_blank" rel="noopener noreferrer" class="profile-btn wa" title="WhatsApp">
                                <i class="fa-brands fa-whatsapp"></i> Hubungi WA
                            </a>
                        @endif

                        @if(!empty($user->email))
                            <a href="mailto:{{ $user->email }}" class="profile-btn primary" title="Kirim Email">
                                <i class="fa-solid fa-envelope"></i> Hubungi Mahasiswa
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Identity & Info -->
                <h1 class="profile-name-title">
                    {{ $user->name }}
                    <span class="verified-pill">
                        <i class="fa-solid fa-circle-check"></i> Mahasiswa Aktif
                    </span>
                </h1>

                <div class="profile-academic-meta">
                    <span class="academic-item">
                        <i class="fa-solid fa-graduation-cap" style="color: var(--accent-gold);"></i>
                        <strong>{{ $user->prodi ?? 'Karya Mahasiswa' }}</strong>
                    </span>

                    @if(!empty($user->angkatan))
                        <span class="academic-item">
                            <i class="fa-regular fa-calendar-days"></i>
                            Angkatan {{ $user->angkatan }}
                        </span>
                    @endif

                    @if(!empty($user->nim))
                        <span class="academic-tag">
                            NIM: {{ $user->nim }}
                        </span>
                    @endif
                </div>

                <!-- Bio -->
                <div class="profile-bio-box">
                    <i class="fa-solid fa-quote-left" style="color: var(--accent-gold); margin-right: 6px; opacity: 0.6;"></i>
                    @if(!empty($user->bio))
                        {{ $user->bio }}
                    @else
                        Mahasiswa berdedikasi yang aktif berinovasi dan berkarya di bidang teknologi dan industri kreatif.
                    @endif
                </div>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="profile-stats-grid">
            <div class="profile-stat-box">
                <div class="stat-icon-wrap projects">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <div>
                    <div class="stat-number-val">{{ $stats['total_approved'] ?? $projects->count() }}</div>
                    <div class="stat-label-text">Karya Dipublikasikan</div>
                </div>
            </div>

            <div class="profile-stat-box">
                <div class="stat-icon-wrap likes">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <div>
                    <div class="stat-number-val">{{ $stats['total_likes'] ?? $projects->sum('likes_count') }}</div>
                    <div class="stat-label-text">Apresiasi & Like</div>
                </div>
            </div>

            <div class="profile-stat-box">
                <div class="stat-icon-wrap views">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div>
                    <div class="stat-number-val">{{ $stats['total_views'] ?? $projects->sum('views_count') }}</div>
                    <div class="stat-label-text">Total Dilihat</div>
                </div>
            </div>
        </div>

        <!-- Works Gallery Section -->
        <div class="profile-works-header">
            <h2 class="profile-works-title">
                <i class="fa-solid fa-layer-group" style="color: var(--accent-gold);"></i> Portofolio & Karya
            </h2>
            <span class="profile-works-count">{{ $projects->count() }} KARYA</span>
        </div>

        @if($projects->isEmpty())
            <div class="profile-empty-state">
                <div class="empty-state-icon">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 class="empty-state-title">Belum Ada Karya yang Dipublikasikan</h3>
                <p class="empty-state-desc">
                    Mahasiswa ini belum memiliki karya yang disetujui kurator atau karya sedang dalam tahap kurasi dewan admin.
                </p>
                <a href="{{ route('semua-karya') }}" class="profile-btn primary">
                    <i class="fa-solid fa-magnifying-glass"></i> Jelajahi Karya Mahasiswa Lainnya
                </a>
            </div>
        @else
            <div class="profile-works-grid">
                @foreach($projects as $proj)
                    <div class="project-card-clean">
                        <!-- Card Banner Preview -->
                        <div class="project-preview-banner" 
                             style="background: {{ $proj->category_gradient }};"
                             onclick="viewDetailModal({{ $proj->id }})">
                            
                            @if(!empty($proj->image_path))
                                <img src="{{ $proj->image_url ?? asset($proj->image_path) }}" 
                                     alt="{{ $proj->title }}" 
                                     class="project-img-cover"
                                     loading="lazy"
                                     onerror="if(!this.dataset.tried){this.dataset.tried=1; if(this.src.indexOf('/public/')===-1){this.src=this.src.replace('/uploads/','/public/uploads/');}else{this.src=this.src.replace('/public/uploads/','/uploads/');}}else{this.style.display='none'; if(this.nextElementSibling){this.nextElementSibling.style.display='flex';}}">
                                <div class="project-banner-fallback" style="display: none;">
                                    <i class="fa-solid {{ $proj->category_icon }}"></i>
                                </div>
                            @else
                                <div class="project-banner-fallback">
                                    <i class="fa-solid {{ $proj->category_icon }}"></i>
                                </div>
                            @endif

                            <span class="project-cat-chip">
                                {{ strtoupper($proj->category_label ?? $proj->category) }}
                            </span>

                            <div class="project-like-chip" onclick="event.stopPropagation(); toggleProjectLike(this, {{ $proj->id }});">
                                <i class="fa-solid fa-heart"></i>
                                <span class="like-number">{{ $proj->likes_count }}</span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="project-card-body">
                            <h3 class="project-title-link" onclick="viewDetailModal({{ $proj->id }})">
                                {{ $proj->title }}
                            </h3>

                            <p class="project-desc-snippet">
                                {{ $proj->description }}
                            </p>

                            <!-- Tech Stack Pills -->
                            @if(!empty($proj->tech_array))
                                <div class="project-tech-tags">
                                    @foreach(array_slice($proj->tech_array, 0, 3) as $tech)
                                        <span class="tech-pill">{{ $tech }}</span>
                                    @endforeach
                                    @if(count($proj->tech_array) > 3)
                                        <span class="tech-pill">+{{ count($proj->tech_array) - 3 }}</span>
                                    @endif
                                </div>
                            @endif

                            <!-- Footer -->
                            <div class="project-card-footer">
                                <span class="project-meta-views">
                                    <i class="fa-regular fa-eye"></i> {{ $proj->views_count ?? 0 }} views
                                </span>

                                <div class="profile-footer-actions">
                                    @if(!empty($proj->demo_url))
                                        <a href="{{ $proj->demo_url }}" target="_blank" rel="noopener noreferrer" class="btn-icon-ext" title="Demo Live">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    @endif

                                    @if(!empty($proj->github_url))
                                        <a href="{{ $proj->github_url }}" target="_blank" rel="noopener noreferrer" class="btn-icon-ext" title="GitHub">
                                            <i class="fa-brands fa-github"></i>
                                        </a>
                                    @endif

                                    <button type="button" class="btn-detail-small" onclick="viewDetailModal({{ $proj->id }})">
                                        <i class="fa-solid fa-circle-info"></i> Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
@endsection
