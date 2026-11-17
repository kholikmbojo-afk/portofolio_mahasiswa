@extends('layouts.app')

@section('title', 'Eksplorasi Kategori Karya — Portofolio Mahasiswa')

@section('extra_css')
<style>
    /* Category Page Header */
    .category-page-hero {
        padding: 60px 0 40px;
        text-align: center;
    }

    .category-giant-title {
        font-family: var(--font-headline);
        font-size: clamp(3.2rem, 7vw, 5.5rem);
        color: var(--accent-gold);
        line-height: 0.95;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 12px;
        text-shadow: 0 4px 20px rgba(240, 220, 158, 0.4);
    }

    .category-hero-desc {
        max-width: 780px;
        margin: 0 auto;
        font-size: 1.15rem;
        color: #ffffff;
        font-weight: 500;
        line-height: 1.6;
        text-shadow: 0 2px 6px rgba(25, 25, 23, 0.2);
    }

    /* Categories Big Cards Grid */
    .categories-detailed-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        margin-bottom: 60px;
    }

    .category-detail-card {
        background: #ffffff;
        border-radius: var(--radius-lg);
        padding: 38px 34px;
        box-shadow: 0 12px 30px rgba(25, 25, 23, 0.08);
        border: 2px solid transparent;
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .category-detail-card:hover {
        border-color: var(--accent-gold);
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(240, 220, 158, 0.3);
    }

    .cat-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .cat-icon-sphere {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: var(--card-subtle);
        border: 2px solid var(--border-soft);
        color: var(--accent-gold-hover);
        font-size: 1.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
    }

    .category-detail-card:hover .cat-icon-sphere {
        background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
        color: var(--text-dark);
        border-color: var(--accent-gold);
        transform: scale(1.05);
    }

    .cat-counter-pill {
        font-family: var(--font-mono);
        font-size: 0.78rem;
        font-weight: 700;
        background: var(--card-subtle);
        color: var(--text-dark);
        padding: 6px 14px;
        border-radius: 50px;
        border: 1px solid var(--border-soft);
    }

    .cat-card-title {
        font-family: var(--font-headline);
        font-size: 1.75rem;
        color: var(--text-dark);
        margin-bottom: 10px;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }

    .cat-card-desc {
        font-size: 0.96rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 22px;
        flex-grow: 1;
    }

    .cat-subtopics-list {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 26px;
    }

    .cat-subtopic-tag {
        font-size: 0.74rem;
        font-weight: 700;
        background: #f1f5f9;
        color: #334155;
        padding: 3px 10px;
        border-radius: 4px;
    }

    .btn-explore-category {
        background: var(--text-dark);
        color: #ffffff;
        border: none;
        padding: 12px 24px;
        font-family: var(--font-headline);
        font-size: 1rem;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s ease;
    }

    .btn-explore-category:hover {
        background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
        color: var(--text-dark);
        transform: translateX(4px);
    }

    @media (max-width: 900px) {
        .categories-detailed-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<section class="category-page-hero">
    <div class="container">
        <span class="section-pill-tag">RUMPUN KEILMUAN</span>
        <h1 class="category-giant-title">Eksplorasi Kategori</h1>
        <p class="category-hero-desc">
            Temukan karya mahasiswa dari beragam disiplin ilmu mulai dari desain interaksi, rekayasa perangkat lunak, seni rupa kontemporer, sinematografi, hingga teknologi IoT dan robotika masa depan.
        </p>
    </div>
</section>

<section class="content-section" style="padding-top: 10px;">
    <div class="container">
        <div class="categories-detailed-grid">
            <!-- 1. Desain & UI/UX -->
            <div class="category-detail-card">
                <div class="cat-card-header">
                    <div class="cat-icon-sphere"><i class="fa-solid fa-bezier-curve"></i></div>
                    <span class="cat-counter-pill"><i class="fa-solid fa-folder-open"></i> 74 Proyek</span>
                </div>
                <h2 class="cat-card-title">Desain &amp; UI/UX</h2>
                <p class="cat-card-desc">
                    Rancangan antarmuka pengguna interaktif, pengalaman pengguna (UX) berbasis riset, design system terstruktur, visual branding, dan prototipe produk digital solutif.
                </p>
                <div class="cat-subtopics-list">
                    <span class="cat-subtopic-tag">Figma</span>
                    <span class="cat-subtopic-tag">Design System</span>
                    <span class="cat-subtopic-tag">Usability Testing</span>
                    <span class="cat-subtopic-tag">Wireframing</span>
                    <span class="cat-subtopic-tag">Visual Identity</span>
                </div>
                <a href="{{ url('/semua-karya?kategori=desain') }}" class="btn-explore-category">
                    <span>Jelajahi Karya Desain</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- 2. Website & Web App -->
            <div class="category-detail-card">
                <div class="cat-card-header">
                    <div class="cat-icon-sphere"><i class="fa-solid fa-globe"></i></div>
                    <span class="cat-counter-pill"><i class="fa-solid fa-folder-open"></i> 142 Proyek</span>
                </div>
                <h2 class="cat-card-title">Website &amp; Web App</h2>
                <p class="cat-card-desc">
                    Pengembangan aplikasi web end-to-end, platform SaaS, e-commerce, portal akademik, arsitektur RESTful API, dan antarmuka web modern yang responsif serta aman.
                </p>
                <div class="cat-subtopics-list">
                    <span class="cat-subtopic-tag">Laravel</span>
                    <span class="cat-subtopic-tag">Vue.js</span>
                    <span class="cat-subtopic-tag">React / Next.js</span>
                    <span class="cat-subtopic-tag">MySQL</span>
                    <span class="cat-subtopic-tag">Tailwind CSS</span>
                </div>
                <a href="{{ url('/semua-karya?kategori=website') }}" class="btn-explore-category">
                    <span>Jelajahi Karya Website</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- 3. Seni & Ilustrasi -->
            <div class="category-detail-card">
                <div class="cat-card-header">
                    <div class="cat-icon-sphere"><i class="fa-solid fa-palette"></i></div>
                    <span class="cat-counter-pill"><i class="fa-solid fa-folder-open"></i> 58 Proyek</span>
                </div>
                <h2 class="cat-card-title">Seni &amp; Ilustrasi</h2>
                <p class="cat-card-desc">
                    Eksplorasi estetika lewat lukisan digital beresolusi tinggi, seni rupa murni kontemporer, konsep karakter mitologi, buku komik cerita rakyat, dan instalasi seni eksperimental.
                </p>
                <div class="cat-subtopics-list">
                    <span class="cat-subtopic-tag">Digital Painting</span>
                    <span class="cat-subtopic-tag">Procreate</span>
                    <span class="cat-subtopic-tag">Adobe Photoshop</span>
                    <span class="cat-subtopic-tag">Character Design</span>
                    <span class="cat-subtopic-tag">Fine Art</span>
                </div>
                <a href="{{ url('/semua-karya?kategori=seni') }}" class="btn-explore-category">
                    <span>Jelajahi Karya Seni</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- 4. Fotografis & Sinema -->
            <div class="category-detail-card">
                <div class="cat-card-header">
                    <div class="cat-icon-sphere"><i class="fa-solid fa-camera-retro"></i></div>
                    <span class="cat-counter-pill"><i class="fa-solid fa-folder-open"></i> 62 Proyek</span>
                </div>
                <h2 class="cat-card-title">Fotografis &amp; Sinema</h2>
                <p class="cat-card-desc">
                    Narasi visual esai fotografi etnografi, film dokumenter sosial, film fiksi pendek mahasiswa, eksperimen sinematografi dramatik, dan teknik manipulasi pewarnaan sinematik.
                </p>
                <div class="cat-subtopics-list">
                    <span class="cat-subtopic-tag">Sinematografi</span>
                    <span class="cat-subtopic-tag">Photo Story</span>
                    <span class="cat-subtopic-tag">Color Grading</span>
                    <span class="cat-subtopic-tag">Film Pendek</span>
                    <span class="cat-subtopic-tag">Sony Alpha</span>
                </div>
                <a href="{{ url('/semua-karya?kategori=fotografi') }}" class="btn-explore-category">
                    <span>Jelajahi Karya Fotografis</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- 5. IoT & Robotika -->
            <div class="category-detail-card">
                <div class="cat-card-header">
                    <div class="cat-icon-sphere"><i class="fa-solid fa-microchip"></i></div>
                    <span class="cat-counter-pill"><i class="fa-solid fa-folder-open"></i> 85 Proyek</span>
                </div>
                <h2 class="cat-card-title">IoT &amp; Robotika</h2>
                <p class="cat-card-desc">
                    Integrasi mikrokontroler canggih, otomasi irigasi dan energi, sistem transmisi telemetri LoRaWAN jarak jauh, robot otonom penyortir barang, dan sensor lingkungan cerdas.
                </p>
                <div class="cat-subtopics-list">
                    <span class="cat-subtopic-tag">ESP32 / Arduino</span>
                    <span class="cat-subtopic-tag">LoRaWAN</span>
                    <span class="cat-subtopic-tag">MQTT Protocol</span>
                    <span class="cat-subtopic-tag">C++ Embedded</span>
                    <span class="cat-subtopic-tag">Smart Agriculture</span>
                </div>
                <a href="{{ url('/semua-karya?kategori=iot') }}" class="btn-explore-category">
                    <span>Jelajahi Karya IoT &amp; Robotika</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- 6. Aplikasi Mobile -->
            <div class="category-detail-card">
                <div class="cat-card-header">
                    <div class="cat-icon-sphere"><i class="fa-solid fa-mobile-screen"></i></div>
                    <span class="cat-counter-pill"><i class="fa-solid fa-folder-open"></i> 90 Proyek</span>
                </div>
                <h2 class="cat-card-title">Aplikasi Mobile</h2>
                <p class="cat-card-desc">
                    Aplikasi mobile multiplatform Android dan iOS untuk solusi kesehatan mental remaja, edukasi interaktif, tracker kebiasaan baik, dan integrasi cloud realtime.
                </p>
                <div class="cat-subtopics-list">
                    <span class="cat-subtopic-tag">Flutter</span>
                    <span class="cat-subtopic-tag">Dart</span>
                    <span class="cat-subtopic-tag">React Native</span>
                    <span class="cat-subtopic-tag">Firebase Cloud</span>
                    <span class="cat-subtopic-tag">Mobile UI</span>
                </div>
                <a href="{{ url('/semua-karya?kategori=mobile') }}" class="btn-explore-category">
                    <span>Jelajahi Karya Mobile</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- 7. Game & Animasi -->
            <div class="category-detail-card">
                <div class="cat-card-header">
                    <div class="cat-icon-sphere"><i class="fa-solid fa-gamepad"></i></div>
                    <span class="cat-counter-pill"><i class="fa-solid fa-folder-open"></i> 36 Proyek</span>
                </div>
                <h2 class="cat-card-title">Game &amp; Animasi</h2>
                <p class="cat-card-desc">
                    Video game edukasi dan teka-teki 3D berbasis Unreal Engine &amp; Unity, animasi pendek 2D bertema moral lokal, serta pemodelan aset 3D photorealistic.
                </p>
                <div class="cat-subtopics-list">
                    <span class="cat-subtopic-tag">Unreal Engine 5</span>
                    <span class="cat-subtopic-tag">Unity 3D</span>
                    <span class="cat-subtopic-tag">Blender</span>
                    <span class="cat-subtopic-tag">Substance Painter</span>
                    <span class="cat-subtopic-tag">Game Design</span>
                </div>
                <a href="{{ url('/semua-karya?kategori=game') }}" class="btn-explore-category">
                    <span>Jelajahi Karya Game &amp; Animasi</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- 8. Riset & Sains Terapan -->
            <div class="category-detail-card">
                <div class="cat-card-header">
                    <div class="cat-icon-sphere"><i class="fa-solid fa-flask"></i></div>
                    <span class="cat-counter-pill"><i class="fa-solid fa-folder-open"></i> 48 Proyek</span>
                </div>
                <h2 class="cat-card-title">Riset &amp; Sains Terapan</h2>
                <p class="cat-card-desc">
                    Karya ilmiah terapan, filtrasi limbah industri berbasis biomaterial alami, komputasi kecerdasan buatan (Machine Learning), dan inovasi energi terbarukan ramah lingkungan.
                </p>
                <div class="cat-subtopics-list">
                    <span class="cat-subtopic-tag">Machine Learning</span>
                    <span class="cat-subtopic-tag">Data Science</span>
                    <span class="cat-subtopic-tag">Biomaterial</span>
                    <span class="cat-subtopic-tag">Rekayasa Kimia</span>
                    <span class="cat-subtopic-tag">Karya Ilmiah</span>
                </div>
                <a href="{{ url('/semua-karya?kategori=riset') }}" class="btn-explore-category">
                    <span>Jelajahi Karya Riset Sains</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Call to Action Banner -->
        <div class="submission-cta-banner">
            <h3 class="submission-cta-title">Punya Karya di Luar Kategori di Atas?</h3>
            <p class="submission-cta-desc">
                Kami selalu terbuka untuk inovasi dan format karya baru mahasiswa. Daftarkan karyamu dan biarkan dewan kurator membantu mempublikasikannya.
            </p>
            <button type="button" class="btn-cta-white" onclick="openAuthModal('register', 'mahasiswa')">
                <i class="fa-solid fa-cloud-arrow-up"></i> Daftarkan Karya Baru
            </button>
        </div>
    </div>
</section>
@endsection
