@extends('layouts.app')

@section('title', 'Portofolio Mahasiswa — Showcase Karya & Inovasi Kampus')

@section('extra_css')
<style>
    /* Hero Poster Style */
    .hero-poster-canvas {
        padding: 95px 0 85px;
        position: relative;
        text-align: center;
    }

    .hero-title-box {
        position: relative;
        display: inline-block;
        margin: 0 auto;
        max-width: 100%;
    }

    .hero-giant-red-title {
        font-family: var(--font-headline);
        font-size: clamp(5.8rem, 18vw, 13.5rem);
        color: var(--accent-gold);
        line-height: 0.85;
        letter-spacing: 0.09em;
        transform: scaleX(1.08);
        display: inline-block;
        text-transform: uppercase;
        user-select: none;
        text-shadow: 0 8px 32px rgba(240, 220, 158, 0.45), 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .hero-script-overlay {
        position: absolute;
        top: 52%;
        left: 50%;
        transform: translate(-50%, -48%) rotate(-5deg);
        font-family: var(--font-script);
        font-size: clamp(3.8rem, 11vw, 8.8rem);
        color: #ffffff;
        font-weight: 700;
        white-space: nowrap;
        pointer-events: none;
        text-shadow: 0 4px 16px rgba(4, 120, 87, 0.7), 2px 2px 0px rgba(0, 0, 0, 0.25);
    }

    .hero-direct-caption {
        max-width: 1240px;
        margin: 32px auto 0;
        padding: 0 24px;
    }

    .hero-desc-text {
        font-size: 1.12rem;
        color: #ffffff;
        line-height: 1.8;
        font-weight: 600;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        margin-bottom: 32px;
    }

    .hero-line {
        display: block;
    }

    @media (max-width: 1100px) {
        .hero-desc-text {
            font-size: 1.02rem;
        }
    }

    @media (max-width: 768px) {
        .hero-line {
            display: inline;
        }
        .hero-desc-text {
            font-size: 0.95rem;
            line-height: 1.6;
        }
    }

    .hero-cta-quick {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .btn-hero-explore {
        background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
        color: var(--text-dark);
        font-family: var(--font-headline);
        font-size: 1.2rem;
        letter-spacing: 0.04em;
        text-decoration: none;
        padding: 15px 36px;
        border-radius: 50px;
        box-shadow: 0 8px 24px rgba(240, 220, 158, 0.35);
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }

    .btn-hero-explore:hover {
        background: #ffffff;
        color: var(--text-dark);
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(255, 255, 255, 0.5);
    }

    .btn-hero-submit {
        background: #ffffff;
        color: var(--text-dark);
        font-family: var(--font-headline);
        font-size: 1.2rem;
        letter-spacing: 0.04em;
        padding: 15px 32px;
        border-radius: 50px;
        border: 2px solid #ffffff;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-hero-submit:hover {
        background: var(--text-dark);
        color: #ffffff;
        border-color: var(--text-dark);
        transform: translateY(-2px);
    }

    /* Section: Karya Terbaik */
    .featured-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 45px;
    }

    .project-card-clean {
        background: #ffffff;
        border-radius: var(--radius-md);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 12px 28px rgba(25, 25, 23, 0.08);
        transition: all 0.25s ease;
        position: relative;
    }

    .project-card-clean:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(25, 25, 23, 0.16);
    }

    .project-preview-banner {
        height: 195px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .featured-ribbon-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: #f59e0b;
        color: #ffffff;
        font-family: var(--font-headline);
        font-size: 0.8rem;
        padding: 4px 12px;
        border-radius: 50px;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .project-like-trigger {
        position: absolute;
        top: 14px;
        right: 14px;
        background: #ffffff;
        color: #e11d48;
        font-family: var(--font-mono);
        font-size: 0.84rem;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 50px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.18);
        border: 1px solid rgba(225, 29, 72, 0.2);
        transition: all 0.2s ease;
        z-index: 5;
    }

    .project-like-trigger i {
        color: #ef4444;
        font-size: 0.88rem;
    }

    .project-like-trigger:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
    }

    .project-like-trigger.liked {
        background: #ef4444 !important;
        color: #ffffff !important;
        border-color: #ef4444 !important;
    }

    .project-like-trigger.liked i {
        color: #ffffff !important;
    }

    .project-banner-symbol {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.9);
        filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.4));
    }

    .project-card-content {
        padding: 26px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .project-item-title {
        font-family: var(--font-headline);
        font-size: 1.35rem;
        letter-spacing: 0.01em;
        color: var(--text-dark);
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .project-item-snippet {
        font-size: 0.92rem;
        color: var(--text-muted);
        margin-bottom: 18px;
        line-height: 1.55;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .project-tech-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 22px;
    }

    .tech-pill-badge {
        background: var(--card-subtle);
        color: var(--text-dark);
        font-size: 0.74rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 50px;
        border: 1px solid var(--border-soft);
    }

    .project-card-bottom {
        margin-top: auto;
        border-top: 1px solid var(--border-soft);
        padding-top: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .student-info-group {
        display: flex;
        flex-direction: column;
    }

    .student-name {
        font-size: 0.92rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.2;
    }

    .student-prodi {
        font-family: var(--font-mono);
        font-size: 0.72rem;
        color: var(--text-muted);
    }

    .btn-open-detail {
        background: var(--text-dark);
        color: #ffffff;
        border: none;
        padding: 8px 18px;
        font-size: 0.8rem;
        font-weight: 700;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-open-detail:hover {
        background: var(--accent-gold);
    }

    .featured-more-action {
        text-align: center;
        margin-top: 10px;
    }

    .btn-view-all-karya {
        background: #ffffff;
        color: var(--text-dark);
        border: 2px solid var(--text-dark);
        font-family: var(--font-headline);
        font-size: 1.15rem;
        letter-spacing: 0.04em;
        padding: 14px 38px;
        border-radius: 50px;
        text-decoration: none;
        box-shadow: 4px 4px 0px var(--accent-gold);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }

    .btn-view-all-karya:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px var(--accent-gold);
        color: var(--accent-gold);
    }

    /* Section: Tentang Platform Yang Dibuat Sangat Bagus */
    .about-stats-ribbon {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 40px;
    }

    .about-stat-item {
        background: #ffffff;
        border-radius: var(--radius-md);
        padding: 24px 20px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(25, 25, 23, 0.06);
        border-bottom: 4px solid var(--accent-gold);
    }

    .about-stat-number {
        font-family: var(--font-headline);
        font-size: 2.8rem;
        color: var(--accent-gold);
        line-height: 1;
        margin-bottom: 6px;
    }

    .about-stat-label {
        font-size: 0.88rem;
        font-weight: 800;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .about-lead-grid {
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        gap: 45px;
        align-items: center;
        margin-bottom: 50px;
    }

    .about-lead-title {
        font-family: var(--font-headline);
        font-size: 2.5rem;
        color: var(--text-dark);
        line-height: 1.18;
        margin-bottom: 18px;
    }

    .about-lead-text {
        font-size: 1.05rem;
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 16px;
    }

    .about-highlight-card {
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: #ffffff;
        border-radius: var(--radius-lg);
        padding: 38px 32px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .about-highlight-card::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 140px;
        height: 140px;
        background: rgba(240, 220, 158, 0.25);
        border-radius: 50%;
        filter: blur(25px);
    }

    .about-highlight-tag {
        background: var(--accent-gold);
        color: var(--text-dark);
        font-family: var(--font-headline);
        font-size: 0.8rem;
        padding: 4px 12px;
        border-radius: 50px;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        display: inline-block;
        margin-bottom: 16px;
    }

    .about-highlight-card h3 {
        font-family: var(--font-headline);
        font-size: 1.7rem;
        line-height: 1.25;
        margin-bottom: 14px;
        letter-spacing: 0.02em;
    }

    .about-highlight-card p {
        font-size: 0.95rem;
        color: #cbd5e1;
        line-height: 1.65;
        margin-bottom: 20px;
    }

    .about-highlight-features {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
        font-size: 0.88rem;
        font-weight: 700;
        color: #f1f5f9;
    }

    .about-highlight-features li {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .about-highlight-features i {
        color: var(--accent-gold-light);
    }

    /* 3 Pilar Ekosistem */
    .ecosystem-section-title {
        text-align: center;
        margin-bottom: 30px;
    }

    .ecosystem-section-title h3 {
        font-family: var(--font-headline);
        font-size: 2rem;
        text-transform: uppercase;
        color: var(--text-dark);
        letter-spacing: 0.02em;
    }

    .ecosystem-flow-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 45px;
    }

    .eco-card-box {
        background: var(--card-subtle);
        border: 2px solid var(--border-soft);
        border-radius: var(--radius-md);
        padding: 30px 24px;
        position: relative;
        transition: all 0.25s ease;
    }

    .eco-card-box:hover {
        background: #ffffff;
        border-color: var(--accent-gold);
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(240, 220, 158, 0.25);
    }

    .eco-step-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        font-family: var(--font-mono);
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--accent-gold);
        opacity: 0.6;
    }

    .eco-icon-wrap {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        background: #ffffff;
        border: 2px solid var(--border-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: var(--accent-gold);
        margin-bottom: 18px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
    }

    .eco-card-title {
        font-family: var(--font-headline);
        font-size: 1.35rem;
        margin-bottom: 10px;
        color: var(--text-dark);
        letter-spacing: 0.01em;
    }

    .eco-card-desc {
        font-size: 0.92rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* 4 Keunggulan Nilai Platform */
    .values-grid-box {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .value-item-bar {
        background: #ffffff;
        border-radius: var(--radius-sm);
        padding: 20px;
        display: flex;
        gap: 16px;
        align-items: flex-start;
        border-left: 4px solid var(--accent-gold);
        box-shadow: 0 4px 14px rgba(25, 25, 23, 0.05);
    }

    .value-icon {
        font-size: 1.5rem;
        color: var(--accent-gold);
        margin-top: 2px;
    }

    .value-item-bar h4 {
        font-family: var(--font-headline);
        font-size: 1.15rem;
        color: var(--text-dark);
        margin-bottom: 4px;
        letter-spacing: 0.02em;
    }

    .value-item-bar p {
        font-size: 0.88rem;
        color: var(--text-muted);
        line-height: 1.5;
    }

    @media (max-width: 1024px) {
        .featured-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .about-stats-ribbon {
            grid-template-columns: repeat(2, 1fr);
        }
        .about-lead-grid {
            grid-template-columns: 1fr;
        }
        .ecosystem-flow-cards {
            grid-template-columns: 1fr;
        }
        .values-grid-box {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .featured-grid {
            grid-template-columns: 1fr;
        }
        .about-stats-ribbon {
            grid-template-columns: 1fr;
        }
    }

    /* Section Dividers */
    .section-divider {
        position: relative;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .section-divider::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 280px;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--accent-gold), transparent);
    }

    .section-divider-icon {
        background: var(--bg-green);
        color: var(--accent-gold);
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        position: relative;
        z-index: 2;
        border: 2px solid var(--accent-gold);
        box-shadow: 0 4px 14px rgba(237, 217, 163, 0.4);
    }
</style>
@endsection

@section('content')
<!-- Hero Section (Bersih, Megah, Tulisan Portofolio Lebih Lebar) -->
<section class="hero-poster-canvas" id="beranda">
    <div class="container">
        <!-- Giant Red PORTOFOLIO with Signature Script "Mahasiswa" Overlay -->
        <div class="hero-title-box">
            <h1 class="hero-giant-red-title">PORTOFOLIO</h1>
            <div class="hero-script-overlay">Mahasiswa</div>
        </div>

        <!-- Keterangan Website yang Indah & Menyatu Tanpa Kotak Ngambang -->
        <div class="hero-direct-caption">
            <p class="hero-desc-text">
                <span class="hero-line">Eksplorasi ragam karya inovatif, riset terapan, dan ekspresi kreatif mahasiswa dari berbagai penjuru kampus.</span>
                <span class="hero-line">Wadah kurasi resmi bagi talenta muda untuk memamerkan dedikasi terbaik mereka.</span>
            </p>

            <div class="hero-cta-quick">
                <a href="#karya-terbaik" class="btn-hero-explore">
                    <i class="fa-solid fa-star"></i> Lihat Karya Terbaik
                </a>
                <button type="button" class="btn-hero-submit" onclick="openAuthModal('register', 'mahasiswa')">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Unggah Karyamu
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Divider: Beranda → Karya Terbaik -->
<div class="section-divider">
    <div class="section-divider-icon">
        <i class="fa-solid fa-star"></i>
    </div>
</div>

<!-- Section: Karya Terbaik (Curated Spotlight) -->
<section class="content-section" id="karya-terbaik">
    <div class="container">
        <div class="section-headline-box">
            <span class="section-pill-tag">CURATED SPOTLIGHT</span>
            <h2 class="section-main-title">Karya Terbaik Mahasiswa</h2>
            <p class="section-subtitle-text">
                Pilihan proyek unggulan dengan tingkat inovasi tinggi, rating apresiasi tertinggi, dan telah terverifikasi penuh oleh dewan kurator kampus.
            </p>
        </div>

        <!-- Dynamic Featured Projects from Database -->
        <div class="featured-grid">
            @forelse($featuredProjects as $proj)
                <div class="project-card-clean">
                    @if($proj->image_path)
                        <div class="project-preview-banner" style="background: {{ $proj->category_gradient }}; padding: 0; overflow: hidden; position: relative;">
                            <img src="{{ $proj->image_url ?? (str_starts_with($proj->image_path, 'http') ? $proj->image_path : asset($proj->image_path)) }}" alt="{{ $proj->title }}" style="width:100%;height:100%;object-fit:cover;display:block;" onerror="handleCardImgError(this)">
                            <span class="featured-ribbon-badge" style="position:absolute;top:14px;left:14px;">
                                <i class="fa-solid fa-award"></i> PILIHAN KURATOR
                            </span>
                            <div class="project-like-trigger" style="position:absolute;top:14px;right:14px;" onclick="toggleProjectLike(this, {{ $proj->id }})">
                                <i class="fa-solid fa-heart"></i> <span class="like-number">{{ $proj->likes_count }}</span>
                            </div>
                        </div>
                    @else
                        <div class="project-preview-banner" style="background: {{ $proj->category_gradient }};">
                            <span class="featured-ribbon-badge">
                                <i class="fa-solid fa-award"></i> PILIHAN KURATOR
                            </span>
                            <div class="project-like-trigger" onclick="toggleProjectLike(this, {{ $proj->id }})">
                                <i class="fa-solid fa-heart"></i> <span class="like-number">{{ $proj->likes_count }}</span>
                            </div>
                            <div class="project-banner-symbol"><i class="fa-solid {{ $proj->category_icon }}"></i></div>
                        </div>
                    @endif
                    <div class="project-card-content">
                        <div style="font-family: var(--font-mono); font-size: 0.75rem; color: var(--accent-gold); font-weight: 700; text-transform: uppercase; margin-bottom: 6px;">
                            {{ $proj->category_label }}
                        </div>
                        <h3 class="project-item-title">{{ $proj->title }}</h3>
                        <p class="project-item-snippet">
                            {{ $proj->description }}
                        </p>
                        <div class="project-tech-badges">
                            @foreach($proj->tech_array as $t)
                                <span class="tech-pill-badge">{{ $t }}</span>
                            @endforeach
                        </div>
                        <div class="project-card-bottom">
                            <div class="student-info-group" style="display: flex; align-items: center; gap: 10px;">
                                @php
                                    $authorAvatar = $proj->user->avatar_url ?? null;
                                    $authorAvatarSrc = $authorAvatar ? (str_starts_with($authorAvatar, 'http') ? $authorAvatar : asset($authorAvatar)) : null;
                                @endphp
                                <a href="{{ $proj->user ? url('/profil/' . $proj->user->id) : '#' }}" style="text-decoration: none; flex-shrink: 0;" title="Lihat Profil {{ $proj->user->name ?? 'Mahasiswa' }}">
                                    @if($authorAvatarSrc)
                                        <img src="{{ $authorAvatarSrc }}" alt="{{ $proj->user->name ?? 'Mahasiswa' }}" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid var(--accent-gold); box-shadow: 0 2px 8px rgba(0,0,0,0.12);" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($proj->user->name ?? 'M') }}&background=064e3b&color=f0dc9e';">
                                    @else
                                        <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-gold), #059669); color: var(--text-dark); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800; border: 2px solid var(--accent-gold);">
                                            {{ strtoupper(substr($proj->user->name ?? 'M', 0, 2)) }}
                                        </div>
                                    @endif
                                </a>
                                <div>
                                    <a href="{{ $proj->user ? url('/profil/' . $proj->user->id) : '#' }}" class="student-name" style="color:var(--text-dark);text-decoration:none;font-weight:800;display:block;line-height:1.2;">{{ $proj->user->name ?? 'Mahasiswa' }}</a>
                                    <span class="student-prodi">{{ $proj->user->prodi ?? 'Karya Mahasiswa' }}</span>
                                </div>
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;">
                                @if($proj->demo_url)
                                    <a href="{{ $proj->demo_url }}" target="_blank" title="Demo" style="color:var(--accent-gold);font-size:1rem;"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                @endif
                                @if($proj->github_url)
                                    <a href="{{ $proj->github_url }}" target="_blank" title="GitHub" style="color:var(--text-muted);font-size:1rem;"><i class="fa-brands fa-github"></i></a>
                                @endif
                                @if($proj->youtube_url)
                                    <a href="{{ $proj->youtube_url }}" target="_blank" title="YouTube" style="color:#ef4444;font-size:1rem;"><i class="fa-brands fa-youtube"></i></a>
                                @endif
                                <button type="button" class="btn-open-detail" onclick="viewDetailModal({{ $proj->id }})">
                                    Detail Karya
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p style="grid-column: 1 / -1; text-align: center; color: #ffffff;">Belum ada karya spotlight yang ditampilkan.</p>
            @endforelse
        </div>

        <!-- Call to Action ke Halaman Semua Karya -->
        <div class="featured-more-action">
            <a href="{{ url('/semua-karya') }}" class="btn-view-all-karya">
                <i class="fa-solid fa-layer-group"></i> Eksplorasi Seluruh Katalog Karya Mahasiswa ({{ $totalKarya ?? 0 }}{{ ($totalKarya ?? 0) > 0 ? '+' : '' }} Proyek) <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Divider: Karya Terbaik → Tentang -->
<div class="section-divider">
    <div class="section-divider-icon">
        <i class="fa-solid fa-landmark"></i>
    </div>
</div>

<!-- Section: Tentang Platform Yang Dibuat Sangat Bagus & Berkelas -->
<section class="content-section" id="tentang">
    <div class="container">
        <!-- Section Header -->
        <div class="section-headline-box">
            <span class="section-pill-tag">TENTANG KAMI</span>
            <h2 class="section-main-title">Etalase Digital Inovasi Mahasiswa</h2>
            <p class="section-subtitle-text">
                Membangun jembatan nyata antara kreativitas akademik kampus dengan kebutuhan nyata industri dan apresiasi masyarakat luas.
            </p>
        </div>

        <div class="content-card-white">
            <!-- 4 Angka Statistik Utama (Otomatis & Realtime Terupdate Dari Database) -->
            <div class="about-stats-ribbon">
                <div class="about-stat-item">
                    <div class="about-stat-number">{{ number_format($totalKarya ?? 0, 0, ',', '.') }}{{ ($totalKarya ?? 0) > 0 ? '+' : '' }}</div>
                    <div class="about-stat-label">Karya Terverifikasi</div>
                </div>
                <div class="about-stat-item">
                    <div class="about-stat-number">{{ number_format($totalMahasiswa ?? 0, 0, ',', '.') }}{{ ($totalMahasiswa ?? 0) > 0 ? '+' : '' }}</div>
                    <div class="about-stat-label">Mahasiswa Kreatif</div>
                </div>
                <div class="about-stat-item">
                    <div class="about-stat-number">{{ number_format($totalProdi ?? 1, 0, ',', '.') }}{{ ($totalProdi ?? 1) > 0 ? '+' : '' }}</div>
                    <div class="about-stat-label">Program Studi &amp; Jurusan</div>
                </div>
                <div class="about-stat-item">
                    <div class="about-stat-number">100%</div>
                    <div class="about-stat-label">Akses Terbuka Tanpa Login</div>
                </div>
            </div>

            <!-- Narrative / Story Split -->
            <div class="about-lead-grid">
                <div>
                    <span style="font-family: var(--font-headline); color: var(--accent-gold); font-size: 1rem; letter-spacing: 0.08em; text-transform: uppercase;">
                        MANIFESTO PLATFORM
                    </span>
                    <h3 class="about-lead-title">Karya Akademik Tidak Boleh Hanya Berakhir di Rak Arsip</h3>
                    <p class="about-lead-text">
                        Setiap semester, ribuan mahasiswa menghasilkan tugas akhir yang inovatif, rancangan desain estetis, aplikasi siap guna, serta riset solutif. Namun, sebagian besar inovasi tersebut seringkali berhenti di ruang sidang penguji atau tersimpan di harddisk tanpa pernah dilihat dunia luar.
                    </p>
                    <p class="about-lead-text">
                        <strong>KaryaMahasiswa</strong> hadir sebagai panggung digital resmi terkurasi. Kami mempertemukan dedikasi talenta muda dengan para profesional industri, rekruter pencari bakat, sesama akademisi, serta publik penikmat karya kreatif.
                    </p>
                </div>

                <!-- Highlight Card Open Access -->
                <div class="about-highlight-card">
                    <span class="about-highlight-tag">PRINSIP UTAMA KAMI</span>
                    <h3>Terbuka untuk Siapa Saja, Kapan Saja</h3>
                    <p>
                        Kami meyakini bahwa apresiasi terhadap karya tidak boleh terhalang oleh formulir pendaftaran. Pengunjung umum tidak perlu registrasi atau login untuk menikmati karya.
                    </p>
                    <ul class="about-highlight-features">
                        <li><i class="fa-solid fa-circle-check"></i> Pengunjung: Eksplorasi &amp; nikmati seluruh karya secara gratis</li>
                        <li><i class="fa-solid fa-circle-check"></i> Mahasiswa: Unggah proyek, bangun reputasi &amp; portofolio</li>
                        <li><i class="fa-solid fa-circle-check"></i> Admin Kampus: Review, kurasi, &amp; pastikan orisinalitas karya</li>
                    </ul>
                </div>
            </div>

            <!-- 3 Pilar Ekosistem -->
            <div class="ecosystem-section-title">
                <h3>Bagaimana Ekosistem Ini Bekerja?</h3>
                <p style="color: var(--text-muted); font-size: 1rem; max-width: 650px; margin: 6px auto 0;">
                    Alur kolaborasi yang transparan, aman, dan menjaga kualitas karya yang dipublikasikan.
                </p>
            </div>

            <div class="ecosystem-flow-cards">
                <!-- Step 1 -->
                <div class="eco-card-box">
                    <span class="eco-step-badge">01</span>
                    <div class="eco-icon-wrap"><i class="fa-solid fa-laptop-code"></i></div>
                    <h4 class="eco-card-title">Mahasiswa Mengunggah</h4>
                    <p class="eco-card-desc">
                        Mahasiswa mendaftarkan akun resmi kampus, lalu mengunggah deskripsi proyek, tangkapan layar, dokumentasi repositori, hingga tautan demo aplikasi langsung.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="eco-card-box">
                    <span class="eco-step-badge">02</span>
                    <div class="eco-icon-wrap"><i class="fa-solid fa-shield-halved"></i></div>
                    <h4 class="eco-card-title">Kurasi &amp; Review Admin</h4>
                    <p class="eco-card-desc">
                        Administrator kampus meninjau kelayakan teknis, etika akademik, dan orisinalitas proyek. Setelah di-ACC, karya langsung dipublikasikan ke katalog publik.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="eco-card-box">
                    <span class="eco-step-badge">03</span>
                    <div class="eco-icon-wrap"><i class="fa-solid fa-handshake-angle"></i></div>
                    <h4 class="eco-card-title">Apresiasi &amp; Kolaborasi</h4>
                    <p class="eco-card-desc">
                        Pengunjung, rekan industri, dan recruiter dapat mengeksplorasi karya, memberikan apresiasi suka, hingga menghubungi kreator langsung untuk peluang karier.
                    </p>
                </div>
            </div>

            <!-- 4 Keunggulan Nilai -->
            <div class="values-grid-box">
                <div class="value-item-bar">
                    <div class="value-icon"><i class="fa-solid fa-certificate"></i></div>
                    <div>
                        <h4>Karya Terverifikasi &amp; Terpercaya</h4>
                        <p>Setiap proyek dijamin keasliannya dan divalidasi oleh institusi melalui proses kurasi admin kampus yang ketat.</p>
                    </div>
                </div>

                <div class="value-item-bar">
                    <div class="value-icon"><i class="fa-solid fa-globe"></i></div>
                    <div>
                        <h4>Etalase Digital Tanpa Sekat</h4>
                        <p>Dapat diakses instan dari perangkat mana saja di seluruh dunia tanpa syarat login bagi pengunjung publik.</p>
                    </div>
                </div>

                <div class="value-item-bar">
                    <div class="value-icon"><i class="fa-solid fa-compass-drafting"></i></div>
                    <div>
                        <h4>Ragam Disiplin Lintas Keilmuan</h4>
                        <p>Dari software engineering, AI, hingga seni rupa murni, fotografi sinematik, dan rekayasa perangkat keras IoT.</p>
                    </div>
                </div>

                <div class="value-item-bar">
                    <div class="value-icon"><i class="fa-solid fa-briefcase"></i></div>
                    <div>
                        <h4>Pintu Peluang Karier &amp; Kerja Sama</h4>
                        <p>Menghubungkan langsung karya mahasiswa dengan para rekruter dan investor yang mencari talenta unggul masa depan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner Ajakan Unggah Karya Mahasiswa -->
        <div class="submission-cta-banner">
            <h3 class="submission-cta-title">Kamu Mahasiswa yang Punya Karya Keren?</h3>
            <p class="submission-cta-desc">
                Jangan biarkan tugas akhir dan proyek kreatifmu hanya tersimpan di laptop. Publikasikan sekarang, raih apresiasi, dan bangun reputasi profesionalmu sejak bangku kuliah!
            </p>
            <button type="button" class="btn-cta-white" onclick="openAuthModal('register', 'mahasiswa')">
                <i class="fa-solid fa-cloud-arrow-up"></i> Daftarkan Diri &amp; Unggah Karya Sekarang
            </button>
        </div>
    </div>
</section>
@endsection
