@extends('layouts.app')

@section('title', 'Semua Karya Mahasiswa — Katalog Terverifikasi Kampus')

@section('extra_css')
<style>
    /* Catalog Header */
    .catalog-page-hero {
        padding: 60px 0 35px;
        text-align: center;
    }

    .catalog-giant-title {
        font-family: var(--font-headline);
        font-size: clamp(3.2rem, 7vw, 5.5rem);
        color: var(--accent-gold);
        line-height: 0.95;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 12px;
        text-shadow: 0 4px 20px rgba(240, 220, 158, 0.4);
    }

    .catalog-hero-desc {
        max-width: 800px;
        margin: 0 auto;
        font-size: 1.15rem;
        color: #ffffff;
        font-weight: 500;
        line-height: 1.6;
        text-shadow: 0 2px 6px rgba(25, 25, 23, 0.2);
    }

    /* Filter & Search Control Panel */
    .catalog-control-panel {
        background: #ffffff;
        border-radius: var(--radius-lg);
        padding: 30px;
        margin-bottom: 40px;
        box-shadow: 0 12px 30px rgba(25, 25, 23, 0.08);
    }

    .catalog-search-row {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .catalog-search-input-wrap {
        flex: 1;
        min-width: 280px;
        display: flex;
        align-items: center;
        border: 2px solid var(--border-soft);
        border-radius: 50px;
        padding: 8px 20px;
        background: var(--card-subtle);
        transition: border-color 0.2s ease;
    }

    .catalog-search-input-wrap:focus-within {
        border-color: var(--accent-gold);
        background: #ffffff;
    }

    .catalog-search-input-wrap input {
        border: none;
        outline: none;
        background: transparent;
        width: 100%;
        font-size: 0.98rem;
        font-family: var(--font-body);
        font-weight: 600;
        color: var(--text-dark);
        margin-left: 10px;
    }

    .catalog-sort-select {
        border: 2px solid var(--border-soft);
        border-radius: 50px;
        padding: 8px 20px;
        font-family: var(--font-body);
        font-weight: 700;
        font-size: 0.92rem;
        color: var(--text-dark);
        background: var(--card-subtle);
        outline: none;
        cursor: pointer;
    }

    .catalog-sort-select:focus {
        border-color: var(--accent-gold);
    }

    /* Category Filter Pills */
    .filter-pills-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }

    .filter-pill-btn {
        background: var(--card-subtle);
        border: 1px solid var(--border-soft);
        color: var(--text-dark);
        font-size: 0.84rem;
        font-weight: 700;
        padding: 7px 18px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-pill-btn:hover, .filter-pill-btn.active {
        background: var(--accent-gold);
        color: #ffffff;
        border-color: var(--accent-gold);
        box-shadow: 0 4px 12px rgba(240, 220, 158, 0.35);
    }

    /* Result Info Bar */
    .result-info-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        font-size: 0.92rem;
        color: #ffffff;
        font-weight: 700;
        text-shadow: 0 1px 4px rgba(25, 25, 23, 0.3);
    }

    /* Project Cards Grid */
    .catalog-showcase-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        margin-bottom: 50px;
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
        height: 185px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .project-category-tag {
        position: absolute;
        top: 14px;
        left: 14px;
        background: rgba(255, 255, 255, 0.95);
        color: var(--accent-gold);
        font-family: var(--font-headline);
        font-size: 0.8rem;
        padding: 4px 12px;
        border-radius: 50px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
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
        font-size: 3.8rem;
        color: rgba(255, 255, 255, 0.9);
        filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.4));
    }

    .project-card-content {
        padding: 24px;
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
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-bottom: 18px;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .project-tech-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 20px;
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
        font-size: 0.9rem;
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

    /* Empty State */
    .empty-search-box {
        display: none;
        background: #ffffff;
        border-radius: var(--radius-lg);
        padding: 60px 30px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(25, 25, 23, 0.08);
    }

    .empty-icon {
        font-size: 3.5rem;
        color: var(--accent-gold);
        margin-bottom: 16px;
    }

    @media (max-width: 1024px) {
        .catalog-showcase-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .catalog-showcase-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Header Catalog Page -->
<section class="catalog-page-hero">
    <div class="container">
        <span class="section-pill-tag">KATALOG RESMI TERKURASI</span>
        <h1 class="catalog-giant-title">Semua Karya Mahasiswa</h1>
        <p class="catalog-hero-desc">
            Jelajahi seluruh karya, prototype, dan riset inovatif yang telah lolos verifikasi dewan kurator kampus. Temukan inspirasi teknologi dan seni terbaik di sini.
        </p>
    </div>
</section>

<section class="content-section" style="padding-top: 10px;">
    <div class="container">
        <!-- Control Panel: Pencarian & Filter Kategori -->
        <div class="catalog-control-panel">
            <div class="catalog-search-row">
                <div class="catalog-search-input-wrap">
                    <i class="fa-solid fa-magnifying-glass" style="color: var(--accent-gold); font-size: 1.1rem;"></i>
                    <input type="text" id="catalogSearchInput" placeholder="Cari berdasarkan judul karya, nama mahasiswa, jurusan, atau teknologi..." oninput="filterCatalog()">
                </div>
                <select id="catalogSortSelect" class="catalog-sort-select" onchange="sortCatalog()">
                    <option value="terbaru">&#128197; Terbaru — Terlama</option>
                    <option value="terlama">&#128336; Terlama — Terbaru</option>
                    <option value="populer">&#10084; Likes Tertinggi</option>
                    <option value="paling_dikunjungi">&#128065; Paling Banyak Dikunjungi</option>
                    <option value="paling_sedikit">&#128065; Paling Sedikit Dikunjungi</option>
                    <option value="az">&#128288; Judul (A — Z)</option>
                </select>
            </div>

            <!-- Filter Pills Kategori Lengkap -->
            <div class="filter-pills-wrap">
                <span style="font-size: 0.8rem; font-weight: 800; text-transform: uppercase; color: var(--text-muted); margin-right: 6px;">
                    Kategori:
                </span>
                <button type="button" class="filter-pill-btn active" data-cat="all" onclick="selectCategoryFilter('all', this)">
                    <i class="fa-solid fa-border-all"></i> Semua Karya
                </button>
                <button type="button" class="filter-pill-btn" data-cat="desain" onclick="selectCategoryFilter('desain', this)">
                    <i class="fa-solid fa-bezier-curve"></i> Desain &amp; UI/UX
                </button>
                <button type="button" class="filter-pill-btn" data-cat="website" onclick="selectCategoryFilter('website', this)">
                    <i class="fa-solid fa-globe"></i> Website &amp; Web App
                </button>
                <button type="button" class="filter-pill-btn" data-cat="seni" onclick="selectCategoryFilter('seni', this)">
                    <i class="fa-solid fa-palette"></i> Seni &amp; Ilustrasi
                </button>
                <button type="button" class="filter-pill-btn" data-cat="fotografi" onclick="selectCategoryFilter('fotografi', this)">
                    <i class="fa-solid fa-video"></i> Fotografis &amp; Sinema
                </button>
                <button type="button" class="filter-pill-btn" data-cat="iot" onclick="selectCategoryFilter('iot', this)">
                    <i class="fa-solid fa-microchip"></i> IoT &amp; Robotika
                </button>
                <button type="button" class="filter-pill-btn" data-cat="mobile" onclick="selectCategoryFilter('mobile', this)">
                    <i class="fa-solid fa-mobile-screen"></i> Aplikasi Mobile
                </button>
                <button type="button" class="filter-pill-btn" data-cat="game" onclick="selectCategoryFilter('game', this)">
                    <i class="fa-solid fa-gamepad"></i> Game &amp; Animasi
                </button>
                <button type="button" class="filter-pill-btn" data-cat="riset" onclick="selectCategoryFilter('riset', this)">
                    <i class="fa-solid fa-flask"></i> Riset &amp; Sains
                </button>
            </div>
        </div>

        <!-- Result Info Bar -->
        <div class="result-info-bar">
            <div>
                Menampilkan <span id="displayedCount" style="color: #ffffff; text-decoration: underline;">8</span> dari total 8 karya
            </div>
            <div>
                <i class="fa-solid fa-lock-open" style="color: #ffffff; margin-right: 6px;"></i> Akses Terbuka Tanpa Login
            </div>
        </div>

        <!-- Catalog Grid -->
        <div class="catalog-showcase-grid" id="catalogCardsContainer">
            <!-- Rendered by JavaScript for dynamic filtering, sorting, and URL parameters -->
        </div>

        <!-- Empty State -->
        <div class="empty-search-box" id="catalogEmptyState">
            <div class="empty-icon"><i class="fa-solid fa-magnifying-glass-arrow-right"></i></div>
            <h3 style="font-family: var(--font-headline); font-size: 1.8rem; margin-bottom: 8px;">Tidak Ada Karya Ditemukan</h3>
            <p style="color: var(--text-muted); font-size: 1rem; max-width: 500px; margin: 0 auto 20px;">
                Tidak ada karya yang sesuai dengan kata kunci atau filter kategori yang Anda pilih. Coba gunakan istilah pencarian yang lebih umum.
            </p>
            <button type="button" class="btn-nav-register" onclick="resetCatalogFilters()">
                Reset Semua Filter &amp; Tampilkan Semua Karya
            </button>
        </div>

        <!-- Banner Ajakan Mahasiswa -->
        <div class="submission-cta-banner">
            <h3 class="submission-cta-title">Ingin Karyamu Tampil di Katalog Ini?</h3>
            <p class="submission-cta-desc">
                Publikasikan karyamu sekarang dan peroleh apresiasi dari komunitas, rekan mahasiswa, dan para pencari bakat industri di seluruh Indonesia!
            </p>
            <button type="button" class="btn-cta-white" onclick="openAuthModal('register', 'mahasiswa')">
                <i class="fa-solid fa-cloud-arrow-up"></i> Daftarkan Diri &amp; Unggah Karya
            </button>
        </div>
    </div>
</section>
@endsection

@section('extra_js')
<script>
    let activeCategory = 'all';

    function renderCatalogCards(items) {
        const container = document.getElementById('catalogCardsContainer');
        const emptyState = document.getElementById('catalogEmptyState');
        const counterEl = document.getElementById('displayedCount');

        container.innerHTML = '';
        counterEl.textContent = items.length;

        if (items.length === 0) {
            emptyState.style.display = 'block';
            container.style.display = 'none';
            return;
        }

        emptyState.style.display = 'none';
        container.style.display = 'grid';

        items.forEach(item => {
            const card = document.createElement('div');
            card.className = 'project-card-clean';
            card.setAttribute('data-title', item.title.toLowerCase());
            card.setAttribute('data-cat', item.category);

            // Banner: foto asli jika ada, fallback ke gradient
            let bannerHTML;
            if (item.imagePath) {
                bannerHTML = `
                    <div class="project-preview-banner" style="background: ${item.bgGradient}; padding: 0; overflow: hidden; position: relative;">
                        <img src="${item.imagePath}" alt="${item.title}" style="width:100%;height:100%;object-fit:cover;display:block;" onerror="handleCardImgError(this)">
                        <span class="project-category-tag" style="position:absolute;top:14px;left:14px;">${item.categoryLabel}</span>
                        <div class="project-like-trigger" style="position:absolute;top:14px;right:14px;" onclick="toggleProjectLike(this, ${item.id})">
                            <i class="fa-solid fa-heart"></i> <span class="like-number">${item.likes}</span>
                        </div>
                    </div>`;
            } else {
                bannerHTML = `
                    <div class="project-preview-banner" style="background: ${item.bgGradient};">
                        <span class="project-category-tag">${item.categoryLabel}</span>
                        <div class="project-like-trigger" onclick="toggleProjectLike(this, ${item.id})">
                            <i class="fa-solid fa-heart"></i> <span class="like-number">${item.likes}</span>
                        </div>
                        <div class="project-banner-symbol"><i class="fa-solid ${item.icon}"></i></div>
                    </div>`;
            }

            // Link icons
            let linkIcons = '';
            if (item.demoUrl) linkIcons += `<a href="${item.demoUrl}" target="_blank" title="Demo Live" style="color:var(--accent-gold);"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>`;
            if (item.githubUrl) linkIcons += `<a href="${item.githubUrl}" target="_blank" title="GitHub" style="color:var(--text-muted);"><i class="fa-brands fa-github"></i></a>`;
            if (item.youtubeUrl) linkIcons += `<a href="${item.youtubeUrl}" target="_blank" title="YouTube" style="color:#ef4444;"><i class="fa-brands fa-youtube"></i></a>`;
            if (item.driveUrl) linkIcons += `<a href="${item.driveUrl}" target="_blank" title="Drive" style="color:#0284c7;"><i class="fa-brands fa-google-drive"></i></a>`;

            // Collab badge (jika kolaborasi)
            let collabBadge = '';
            if (item.projectType === 'kolaborasi' && item.collaborators && item.collaborators.length > 0) {
                collabBadge = `<span style="background:rgba(99,102,241,0.12);color:#4f46e5;font-size:0.68rem;font-weight:800;padding:2px 9px;border-radius:50px;border:1px solid rgba(99,102,241,0.25);display:inline-flex;align-items:center;gap:4px;margin-left:6px;"><i class="fa-solid fa-people-group"></i> ${item.collaborators.length} Anggota</span>`;
            }

            // Mini collab avatars strip
            let collabAvatarsHTML = '';
            if (item.projectType === 'kolaborasi' && item.collaborators && item.collaborators.length > 0) {
                const colors = ['#edd9a3','#0284c7','#10b981','#8b5cf6','#f59e0b'];
                const shown = item.collaborators.slice(0, 4);
                const avatars = shown.map((c, i) => {
                    const ini = c.name.split(' ').map(w => w[0]).join('').slice(0,2).toUpperCase();
                    return `<div title="${c.name} — ${c.jobdesk}" style="width:26px;height:26px;border-radius:50%;background:${colors[i%colors.length]};color:#fff;display:flex;align-items:center;justify-content:center;font-size:0.6rem;font-weight:800;border:2px solid #fff;margin-left:${i>0?'-7px':'0'};z-index:${10-i};position:relative;">${ini}</div>`;
                }).join('');
                const extra = item.collaborators.length > 4 ? `<div style="width:26px;height:26px;border-radius:50%;background:#e2e8f0;color:#475569;display:flex;align-items:center;justify-content:center;font-size:0.58rem;font-weight:800;border:2px solid #fff;margin-left:-7px;position:relative;">+${item.collaborators.length-4}</div>` : '';
                collabAvatarsHTML = `<div style="display:flex;align-items:center;gap:0;">${avatars}${extra}</div>`;
            }

            card.innerHTML = `
                ${bannerHTML}
                <div class="project-card-content">
                    <h3 class="project-item-title">${item.title}${collabBadge}</h3>
                    <p class="project-item-snippet">${item.desc}</p>
                    <div class="project-tech-badges">
                        ${item.tech.map(t => `<span class="tech-pill-badge">${t}</span>`).join('')}
                    </div>
                    <div class="project-card-bottom">
                        <div class="student-info-group" style="display:flex;align-items:center;gap:10px;">
                            <a href="${item.profileUrl || `${APP_BASE_URL}/profil/${item.userId}`}" style="text-decoration:none;flex-shrink:0;" title="Lihat Profil ${item.author}">
                                ${item.authorAvatar ? `<img src="${item.authorAvatar}" alt="${item.author}" style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid var(--accent-gold);box-shadow:0 2px 6px rgba(0,0,0,0.1);" onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(item.author)}&background=064e3b&color=f0dc9e';">` : `<div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,var(--accent-gold),#059669);color:var(--text-dark);display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:800;border:2px solid var(--accent-gold);">${item.author.slice(0,2).toUpperCase()}</div>`}
                            </a>
                            <div>
                                <a href="${item.profileUrl || `${APP_BASE_URL}/profil/${item.userId}`}" style="font-weight:800;font-size:0.88rem;color:var(--text-dark);text-decoration:none;display:block;line-height:1.2;" class="student-name">${item.author}</a>
                                <span class="student-prodi">${item.prodi}</span>
                                ${collabAvatarsHTML ? `<div style="margin-top:4px;">${collabAvatarsHTML}</div>` : ''}
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px;">
                            ${linkIcons ? `<div style="display:flex;gap:8px;font-size:1rem;">${linkIcons}</div>` : ''}
                            <button type="button" class="btn-open-detail" onclick="viewDetailModal(${item.id})">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });
    }

    function filterCatalog() {
        const query = document.getElementById('catalogSearchInput').value.toLowerCase().trim();
        const sortValue = document.getElementById('catalogSortSelect').value;

        let filtered = globalProjectsDatabase.filter(item => {
            const matchCat = (activeCategory === 'all' || item.category === activeCategory);
            const matchQuery = !query || 
                item.title.toLowerCase().includes(query) ||
                item.desc.toLowerCase().includes(query) ||
                item.author.toLowerCase().includes(query) ||
                item.prodi.toLowerCase().includes(query) ||
                item.tech.some(t => t.toLowerCase().includes(query));

            return matchCat && matchQuery;
        });

        // Sorting
        if (sortValue === 'populer') {
            filtered.sort((a, b) => b.likes - a.likes);
        } else if (sortValue === 'terbaru') {
            filtered.sort((a, b) => b.id - a.id);
        } else if (sortValue === 'terlama') {
            filtered.sort((a, b) => a.id - b.id);
        } else if (sortValue === 'paling_dikunjungi') {
            filtered.sort((a, b) => (b.views || 0) - (a.views || 0));
        } else if (sortValue === 'paling_sedikit') {
            filtered.sort((a, b) => (a.views || 0) - (b.views || 0));
        } else if (sortValue === 'az') {
            filtered.sort((a, b) => a.title.localeCompare(b.title));
        }

        renderCatalogCards(filtered);
    }

    function selectCategoryFilter(cat, btn) {
        activeCategory = cat;
        document.querySelectorAll('.filter-pill-btn').forEach(b => b.classList.remove('active'));
        if (btn) btn.classList.add('active');
        filterCatalog();
    }

    function sortCatalog() {
        filterCatalog();
    }

    function resetCatalogFilters() {
        activeCategory = 'all';
        document.getElementById('catalogSearchInput').value = '';
        document.getElementById('catalogSortSelect').value = 'terbaru';
        document.querySelectorAll('.filter-pill-btn').forEach(b => {
            b.classList.toggle('active', b.getAttribute('data-cat') === 'all');
        });
        filterCatalog();
    }

    // Check URL parameters (e.g. ?kategori=desain or ?q=IoT)
    window.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const catParam = urlParams.get('kategori');
        const searchParam = urlParams.get('q');

        if (catParam) {
            activeCategory = catParam;
            document.querySelectorAll('.filter-pill-btn').forEach(btn => {
                if (btn.getAttribute('data-cat') === catParam) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }

        if (searchParam) {
            document.getElementById('catalogSearchInput').value = searchParam;
        }

        filterCatalog();
    });
</script>
@endsection
