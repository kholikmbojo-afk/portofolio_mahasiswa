<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portofolio Mahasiswa â€” Showcase Karya & Inovasi')</title>

    <!-- Google Fonts: Anton (Bold Display) + Caveat (Signature Script) + Plus Jakarta Sans + Space Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Caveat:wght@600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            /* Hijau Muda Segar & Elegan */
            --bg-green: #10b981;           /* Hijau Muda Segar (Emerald Light) */
            --bg-green-dark: #059669;      /* Hijau Sedang */
            --bg-green-light: #34d399;     /* Hijau Terang Luminous */
            --bg-green-surface: #047857;   /* Hijau Permukaan Transparan */
            --bg-green-subtle: #ecfdf5;    /* Tint Hijau Lembut */

            /* Gold Agak ke Putih (Soft Champagne / White Gold) - Elegan, Kalem & Tidak Jreng */
            --accent-gold: #f0dc9e;        /* Gold Lembut Agak ke Putihan */
            --accent-gold-hover: #e0c67e;  /* Gold Hover Natural */
            --accent-gold-light: #faf4e1;  /* Nuansa Emas Mendekati Putih */
            --accent-gold-soft: #fcf9f0;   /* Tint Emas Lembut Murni */
            --gold-accent: #f0dc9e;
            --hero-red: #f0dc9e;           /* Fallback kompatibilitas */
            --hero-red-hover: #e0c67e;

            /* Tipografi & Kontras Putih Bersih */
            --text-dark: #064e3b;          /* Teks gelap hijau pekat yang bersih */
            --text-muted: #3d6a56;         /* Muted yang sejuk & rapi */
            --text-white: #ffffff;         /* Putih Murni */
            --card-white: #ffffff;         /* Kartu Putih Bersih */
            --card-subtle: #f8fdfa;        /* Kartu Abu-Putih Bersih */
            --border-soft: rgba(5, 150, 105, 0.15);

            --font-headline: 'Anton', sans-serif;
            --font-script: 'Caveat', cursive;
            --font-body: 'Plus Jakarta Sans', sans-serif;
            --font-mono: 'Space Mono', monospace;
            --radius-sm: 6px;
            --radius-md: 12px;
            --radius-lg: 20px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        body {
            background: linear-gradient(180deg, #10b981 0%, #059669 45%, #047857 100%);
            background-attachment: fixed;
            color: var(--text-dark);
            font-family: var(--font-body);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
        }

        /* Subtle Retro Paper Texture Overlay */
        .retro-dust-overlay {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 1;
            background-image: 
                radial-gradient(circle at 12% 18%, rgba(255, 255, 255, 0.25) 1px, transparent 1px),
                radial-gradient(circle at 75% 25%, rgba(255, 255, 255, 0.2) 1.5px, transparent 1.5px),
                radial-gradient(circle at 45% 65%, rgba(4, 120, 87, 0.12) 1px, transparent 1px),
                radial-gradient(circle at 85% 80%, rgba(255, 255, 255, 0.22) 1.5px, transparent 1.5px);
            background-size: 200px 200px;
            opacity: 0.85;
        }

        .main-wrapper {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 100%;
            max-width: 1220px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Clean & Elegant Header */
        header {
            position: sticky;
            top: 0;
            z-index: 60;
            background: rgba(16, 185, 129, 0.94);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.28);
            transition: all 0.25s ease;
        }

        header .container {
            max-width: 1440px;
            padding: 0 32px;
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
            gap: 20px;
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: var(--text-dark);
            flex-shrink: 0;
        }

        .brand-badge {
            background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
            color: var(--text-dark);
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-headline);
            font-size: 1.3rem;
            border-radius: var(--radius-sm);
            box-shadow: 0 4px 14px rgba(240, 220, 158, 0.4);
        }

        .brand-text-block {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-name {
            font-family: var(--font-headline);
            font-size: 1.85rem;
            letter-spacing: 0.03em;
            color: #ffffff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            line-height: 1;
        }

        .brand-divider {
            width: 2px;
            height: 22px;
            background: rgba(255, 255, 255, 0.45);
            border-radius: 2px;
            flex-shrink: 0;
            margin: 0 2px;
        }

        .brand-sub {
            font-family: var(--font-body);
            font-size: 0.9rem;
            color: #ffffff;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            line-height: 1.2;
            white-space: nowrap;
        }

        @media (max-width: 1200px) {
            .brand-sub {
                font-size: 0.8rem;
                letter-spacing: 0.02em;
            }
            .brand-divider {
                height: 18px;
            }
        }

        @media (max-width: 880px) {
            .brand-sub {
                display: none;
            }
            .brand-divider {
                display: none;
            }
        }

        /* Nav Menu (Beranda, Tentang, Kategori, Semua Karya) */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
            list-style: none;
            margin-left: 45px; /* Memberi jarak lapang dari brand SIC di kiri */
        }

        .nav-links a {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.01em;
            position: relative;
            padding: 6px 0;
            transition: color 0.2s ease;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: var(--accent-gold);
            transition: width 0.2s ease;
            border-radius: 2px;
        }

        .nav-links a:hover, .nav-links a.active {
            color: #ffffff;
        }

        .nav-links a:hover::after, .nav-links a.active::after {
            width: 100%;
        }

        /* Right Actions: Search Icon + Masuk + Register */
        .nav-auth-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-nav-search-icon {
            background: #ffffff;
            color: var(--text-dark);
            border: 2px solid #ffffff;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
        }

        .btn-nav-search-icon:hover {
            background: var(--accent-gold);
            color: #ffffff;
            border-color: var(--accent-gold);
            transform: scale(1.05);
        }

        .btn-nav-login {
            background: #ffffff;
            color: var(--text-dark);
            border: 2px solid #ffffff;
            padding: 9px 22px;
            font-size: 0.88rem;
            font-weight: 800;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav-login:hover {
            background: var(--text-dark);
            color: #fff;
            border-color: var(--text-dark);
            transform: translateY(-1px);
        }

        .btn-nav-register {
            background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
            color: var(--text-dark);
            border: 2px solid var(--accent-gold);
            padding: 9px 24px;
            font-size: 0.88rem;
            font-weight: 800;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(240, 220, 158, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav-register:hover {
            background: #ffffff;
            border-color: #ffffff;
            color: var(--text-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(255, 255, 255, 0.5);
        }

        /* Generic Section Headers */
        .content-section {
            padding: 80px 0;
            position: relative;
        }

        .section-headline-box {
            text-align: center;
            max-width: 820px;
            margin: 0 auto 50px;
        }

        .section-pill-tag {
            display: inline-block;
            background: #ffffff;
            color: var(--accent-gold);
            font-family: var(--font-headline);
            font-size: 0.88rem;
            padding: 5px 18px;
            border-radius: 50px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .section-main-title {
            font-family: var(--font-headline);
            font-size: clamp(2.4rem, 5vw, 3.6rem);
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            line-height: 1.1;
            margin-bottom: 14px;
            text-shadow: 0 4px 12px rgba(25, 25, 23, 0.25);
        }

        .section-subtitle-text {
            font-size: 1.12rem;
            color: #ffffff;
            font-weight: 500;
            line-height: 1.6;
            text-shadow: 0 2px 6px rgba(25, 25, 23, 0.2);
        }

        /* Standard Cards */
        .content-card-white {
            background: #ffffff;
            border-radius: var(--radius-lg);
            padding: 50px 45px;
            box-shadow: 0 15px 35px rgba(25, 25, 23, 0.1);
        }

        /* CTA Banner */
        .submission-cta-banner {
            background: linear-gradient(135deg, var(--bg-green-dark), #034d35);
            color: #ffffff;
            border-radius: var(--radius-lg);
            padding: 50px 40px;
            text-align: center;
            margin: 60px 0 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(5, 150, 105, 0.3);
        }

        .submission-cta-title {
            font-family: var(--font-headline);
            font-size: 2.6rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            margin-bottom: 12px;
        }

        .submission-cta-desc {
            font-size: 1.15rem;
            max-width: 650px;
            margin: 0 auto 28px;
            opacity: 0.95;
            font-weight: 500;
        }

        .btn-cta-white {
            background: #ffffff;
            color: var(--text-dark);
            font-weight: 800;
            font-size: 0.95rem;
            padding: 13px 32px;
            border-radius: 50px;
            border: 2px solid var(--accent-gold);
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-cta-white:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
            color: var(--text-dark);
        }

        /* Footer */
        footer {
            background: #ffffff;
            border-top: 1px solid var(--border-soft);
            padding: 70px 0 30px;
            margin-top: auto;
        }

        .footer-grid-layout {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 50px;
        }

        .footer-brand-title {
            font-family: var(--font-headline);
            font-size: 1.8rem;
            color: var(--accent-gold);
            margin-bottom: 12px;
        }

        .footer-brand-desc {
            font-size: 0.92rem;
            color: var(--text-muted);
            max-width: 320px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .footer-col-title {
            font-family: var(--font-headline);
            font-size: 1.1rem;
            color: var(--text-dark);
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .footer-links-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-size: 0.92rem;
        }

        .footer-links-list a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .footer-links-list a:hover {
            color: var(--accent-gold);
        }

        .footer-bottom-copy {
            border-top: 1px solid var(--border-soft);
            padding-top: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--text-muted);
            flex-wrap: wrap;
            gap: 12px;
        }

        /* Modals */
        .modal-layer {
            position: fixed;
            inset: 0;
            background: rgba(25, 25, 23, 0.75);
            backdrop-filter: blur(6px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.25s ease;
        }

        .modal-layer.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-card-box {
            background: #ffffff;
            border-radius: var(--radius-md);
            width: 100%;
            max-width: 560px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
            transform: scale(0.96);
            transition: transform 0.25s ease;
        }

        .modal-layer.active .modal-card-box {
            transform: scale(1);
        }

        .modal-card-box.modal-detail-card {
            max-width: 740px;
            max-height: 88vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            padding: 0;
        }

        .modal-scroll-body {
            flex: 1;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .modal-scroll-body::-webkit-scrollbar {
            width: 8px;
        }

        .modal-scroll-body::-webkit-scrollbar-track {
            background: #f8fafc;
        }

        .modal-scroll-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .modal-scroll-body::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .modal-head-bar {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--card-subtle);
        }

        .modal-close-icon {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--text-dark);
            transition: transform 0.2s ease;
        }

        .modal-close-icon:hover {
            transform: scale(1.15);
            color: var(--accent-gold);
        }

        .modal-body-content {
            padding: 28px;
        }

        /* Form Inputs */
        .form-auth-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
            background: var(--card-subtle);
            padding: 4px;
            border-radius: 50px;
        }

        .auth-tab-switch {
            flex: 1;
            background: transparent;
            border: none;
            padding: 10px;
            font-family: var(--font-headline);
            font-size: 1.05rem;
            cursor: pointer;
            border-radius: 50px;
            color: var(--text-muted);
            transition: all 0.2s ease;
        }

        .auth-tab-switch.active {
            background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
            color: var(--text-dark);
            box-shadow: 0 4px 12px rgba(240, 220, 158, 0.4);
        }

        .input-group-row {
            margin-bottom: 16px;
        }

        .input-label-tag {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--text-dark);
            text-transform: uppercase;
        }

        .input-text-clean {
            width: 100%;
            padding: 11px 16px;
            border: 2px solid var(--border-soft);
            border-radius: var(--radius-sm);
            background: #ffffff;
            font-size: 0.95rem;
            font-family: var(--font-body);
            outline: none;
            transition: border-color 0.2s ease;
        }

        .input-text-clean:focus {
            border-color: var(--accent-gold);
        }

        .input-text-clean.is-invalid {
            border-color: #ef4444 !important;
            background-color: #fff5f5 !important;
        }

        .btn-submit-action {
            width: 100%;
            background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
            color: var(--text-dark);
            border: none;
            padding: 13px;
            border-radius: 50px;
            font-family: var(--font-headline);
            font-size: 1.15rem;
            letter-spacing: 0.05em;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 6px 16px rgba(240, 220, 158, 0.4);
            transition: all 0.2s ease;
        }

        .btn-submit-action:hover {
            background: var(--accent-gold-hover);
            transform: translateY(-1px);
        }

        /* Toast Alerts System */
        .alert-box-toast {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 20px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            font-size: 0.92rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            position: relative;
            animation: fadeInDown 0.3s ease;
        }

        .alert-toast-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            border-left: 5px solid #10b981;
        }

        .alert-toast-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-left: 5px solid #ef4444;
        }

        .alert-toast-info {
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
            border-left: 5px solid #3b82f6;
        }

        .alert-toast-warning {
            background: #fffbeb;
            color: #92400e;
            border: 1px solid #fde68a;
            border-left: 5px solid #f59e0b;
        }

        .alert-toast-close {
            margin-left: auto;
            background: transparent;
            border: none;
            font-size: 1.3rem;
            line-height: 1;
            cursor: pointer;
            color: inherit;
            opacity: 0.6;
            padding: 0 4px;
        }

        .alert-toast-close:hover {
            opacity: 1;
        }

        /* Demo Quick Login Chips */
        .btn-demo-chip {
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-demo-chip:hover {
            background: #e2e8f0;
            border-color: #94a3b8;
            color: var(--accent-gold);
            transform: translateY(-1px);
        }

        /* Password Wrapper with Toggle */
        .password-toggle-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-toggle-btn {
            position: absolute;
            right: 12px;
            background: transparent;
            border: none;
            color: #64748b;
            cursor: pointer;
            font-size: 0.95rem;
            padding: 6px;
        }

        .password-toggle-btn:hover {
            color: var(--accent-gold);
        }

        /* Search Overlay Modal */
        .search-modal-box {
            background: #ffffff;
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 650px;
            padding: 24px 28px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        .search-modal-input-wrap {
            display: flex;
            align-items: center;
            border: 2px solid var(--text-dark);
            border-radius: 50px;
            padding: 6px 8px 6px 18px;
            box-shadow: 3px 3px 0px var(--accent-gold);
        }

        .search-modal-input-wrap input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 1.05rem;
            font-family: var(--font-body);
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .footer-grid-layout {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            .footer-grid-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @yield('extra_css')
</head>
<body>
    @php
        // Auto-copy Poster SIC Final ke folder laptop user & public web
        $posterSourceFile = 'C:/Users/USER/.gemini/antigravity/brain/a4f40950-5aeb-401c-b013-5a2b77d6f278/poster_promosi_sic_uin_siber_cirebon_1794124272427.jpg';
        if (@file_exists($posterSourceFile)) {
            $destLocations = [
                base_path('POSTER-SIC-FINAL.jpg'),
                public_path('POSTER-SIC-FINAL.jpg'),
                'C:/Users/USER/Downloads/POSTER-SIC-FINAL.jpg',
                'C:/Users/USER/Desktop/POSTER-SIC-FINAL.jpg',
            ];
            foreach ($destLocations as $dstLoc) {
                if (!@file_exists($dstLoc) || @filesize($dstLoc) !== @filesize($posterSourceFile)) {
                    @copy($posterSourceFile, $dstLoc);
                }
            }
        }

        $sicLogo = asset('images/sic-logo.jpg');
        $targetPath = public_path('images/sic-logo.jpg');
        $rootImagesPath = base_path('images/sic-logo.jpg');
        $sicLocalPaths = [
            $targetPath,
            $rootImagesPath,
            base_path('public/images/sic-logo.jpg'),
            base_path('sic-logo.jpg'),
            public_path('sic-logo.jpg'),
            'C:/Users/USER/.gemini/antigravity/brain/a4f40950-5aeb-401c-b013-5a2b77d6f278/.user_uploaded/media_1793723755660_3b1e751a.jpg',
            'C:\\Users\\USER\\.gemini\\antigravity\\brain\\a4f40950-5aeb-401c-b013-5a2b77d6f278\\.user_uploaded\\media_1793723755660_3b1e751a.jpg',
        ];
        foreach ($sicLocalPaths as $p) {
            if (@file_exists($p)) {
                $raw = @file_get_contents($p);
                if ($raw && strlen($raw) > 100) {
                    $sicLogo = 'data:image/jpeg;base64,' . base64_encode($raw);
                    if (!@file_exists($targetPath)) {
                        @mkdir(dirname($targetPath), 0777, true);
                        @file_put_contents($targetPath, $raw);
                    }
                    if (!@file_exists($rootImagesPath)) {
                        @mkdir(dirname($rootImagesPath), 0777, true);
                        @file_put_contents($rootImagesPath, $raw);
                    }
                    break;
                }
            }
        }
    @endphp
    <!-- Subtle Retro Paper Texture Overlay -->
    <div class="retro-dust-overlay"></div>

    <div class="main-wrapper">
        <!-- Clean & Elegant Navigation Bar -->
        <header>
            <div class="container">
                <div class="nav-inner">
                    <!-- Brand -->
                    <a href="{{ url('/') }}" class="brand-link">
                        <img src="{{ $sicLogo }}" alt="SIC Logo" style="width:48px;height:48px;object-fit:contain;border-radius:8px;background:#ffffff;padding:2px;box-shadow:0 2px 8px rgba(0,0,0,0.12);flex-shrink:0;">
                        <div class="brand-text-block">
                            <span class="brand-name">SIC</span>
                            <span class="brand-divider"></span>
                            <span class="brand-sub">STUDENT INNOVATION AND CREATIVITY</span>
                        </div>
                    </a>

                    <!-- Nav Menu: Beranda, Tentang, Kategori, Semua Karya -->
                    <ul class="nav-links">
                        <li><a href="{{ url('/') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                        <li><a href="{{ url('/') }}#tentang">Tentang</a></li>
                        <li><a href="{{ url('/kategori') }}" class="{{ request()->routeIs('kategori') ? 'active' : '' }}">Kategori</a></li>
                        <li><a href="{{ url('/semua-karya') }}" class="{{ request()->routeIs('semua-karya') ? 'active' : '' }}">Semua Karya</a></li>
                    </ul>

                    <!-- Right Side: Icon Pencarian di Samping Masuk & Register / Dashboard -->
                    <div class="nav-auth-actions">
                        <button type="button" class="btn-nav-search-icon" onclick="openSearchModal()" title="Cari Karya...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                        @auth
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="btn-nav-register" style="background: var(--bg-green-dark); border-color: var(--bg-green-dark);">
                                    <i class="fa-solid fa-gauge-high"></i> Dashboard Admin
                                </a>
                            @else
                                <a href="{{ route('mahasiswa.dashboard') }}" class="btn-nav-register">
                                    <i class="fa-solid fa-user-graduate"></i> Dashboard Mahasiswa
                                </a>
                            @endif

                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-nav-login" style="padding: 9px 14px;" title="Keluar">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </button>
                            </form>
                        @else
                            <button type="button" class="btn-nav-login" onclick="openAuthModal('login')">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Masuk
                            </button>
                            <button type="button" class="btn-nav-register" onclick="openAuthModal('register')">
                                <i class="fa-solid fa-user-plus"></i> Register
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Body Content -->
        <main>
            @if(session('success') || session('error') || session('info') || session('warning'))
                <div class="container" style="padding-top: 24px;">
                    @if(session('success'))
                        <div class="alert-box-toast alert-toast-success">
                            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
                            <div style="flex: 1;">{{ session('success') }}</div>
                            <button type="button" class="alert-toast-close" onclick="this.parentElement.remove()" title="Tutup">&times;</button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert-box-toast alert-toast-error">
                            <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.2rem;"></i>
                            <div style="flex: 1;">{{ session('error') }}</div>
                            <button type="button" class="alert-toast-close" onclick="this.parentElement.remove()" title="Tutup">&times;</button>
                        </div>
                    @endif
                    @if(session('info'))
                        <div class="alert-box-toast alert-toast-info">
                            <i class="fa-solid fa-circle-info" style="font-size: 1.2rem;"></i>
                            <div style="flex: 1;">{{ session('info') }}</div>
                            <button type="button" class="alert-toast-close" onclick="this.parentElement.remove()" title="Tutup">&times;</button>
                        </div>
                    @endif
                    @if(session('warning'))
                        <div class="alert-box-toast alert-toast-warning">
                            <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.2rem;"></i>
                            <div style="flex: 1;">{{ session('warning') }}</div>
                            <button type="button" class="alert-toast-close" onclick="this.parentElement.remove()" title="Tutup">&times;</button>
                        </div>
                    @endif
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="footer-grid-layout">
                    <div>
                        <div class="footer-brand-title" style="display:flex;align-items:center;gap:10px;"><img src="{{ $sicLogo }}" alt="SIC" style="width:38px;height:38px;object-fit:contain;border-radius:6px;background:#ffffff;padding:2px;"> SIC <span style="font-size:0.95rem;font-weight:700;opacity:0.85;font-family:var(--font-body);letter-spacing:0.02em;">— Student Innovation and Creativity</span></div>
                        <p class="footer-brand-desc">
                            Platform kurasi resmi etalase digital karya, tugas akhir, inovasi riset, dan eksperimen kreatif mahasiswa dari berbagai kampus di Indonesia.
                        </p>
                        <div style="display: flex; gap: 12px; font-size: 1.2rem; color: var(--text-dark);">
                            <a href="#" style="color: inherit;"><i class="fa-brands fa-github"></i></a>
                            <a href="#" style="color: inherit;"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" style="color: inherit;"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="#" style="color: inherit;"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>

                    <div>
                        <h5 class="footer-col-title">Navigasi</h5>
                        <ul class="footer-links-list">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li><a href="{{ url('/') }}#tentang">Tentang Platform</a></li>
                            <li><a href="{{ url('/kategori') }}">Eksplorasi Kategori</a></li>
                            <li><a href="{{ url('/semua-karya') }}">Semua Karya</a></li>
                        </ul>
                    </div>

                    <div>
                        <h5 class="footer-col-title">Kategori Unggulan</h5>
                        <ul class="footer-links-list">
                            <li><a href="{{ url('/semua-karya?kategori=desain') }}">Desain &amp; UI/UX</a></li>
                            <li><a href="{{ url('/semua-karya?kategori=website') }}">Website &amp; Web App</a></li>
                            <li><a href="{{ url('/semua-karya?kategori=seni') }}">Seni &amp; Ilustrasi</a></li>
                            <li><a href="{{ url('/semua-karya?kategori=iot') }}">IoT &amp; Robotika</a></li>
                            <li><a href="{{ url('/semua-karya?kategori=fotografi') }}">Fotografis</a></li>
                        </ul>
                    </div>

                    <div>
                        <h5 class="footer-col-title">Akses &amp; Layanan</h5>
                        <ul class="footer-links-list">
                            <li><a href="javascript:void(0)" onclick="openAuthModal('login')">Masuk Mahasiswa / Admin</a></li>
                            <li><a href="javascript:void(0)" onclick="openAuthModal('register')">Registrasi Mahasiswa</a></li>
                            <li><a href="{{ url('/') }}#tentang">Panduan Kurasi Karya</a></li>
                            <li><a href="{{ url('/') }}#tentang">Hubungi Pengelola Kampus</a></li>
                        </ul>
                    </div>
                </div>

                <div class="footer-bottom-copy">
                    <div>&copy; {{ date('Y') }} <strong>SIC Platform</strong>. Seluruh Hak Cipta Dilindungi.</div>
                    <div>Dirancang dengan prinsip <em>Open Access</em> &bull; Bebas untuk Pengunjung Umum</div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Search Modal Overlay -->
    <div class="modal-layer" id="searchModal" onclick="closeSearchModal(event)">
        <div class="search-modal-box" onclick="event.stopPropagation()">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <span style="font-family: var(--font-headline); font-size: 1.15rem; color: var(--accent-gold); letter-spacing: 0.05em; text-transform: uppercase;">
                    <i class="fa-solid fa-magnifying-glass"></i> Pencarian Karya Mahasiswa
                </span>
                <button type="button" class="modal-close-icon" onclick="closeSearchModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ url('/semua-karya') }}" method="GET" class="search-modal-input-wrap">
                <i class="fa-solid fa-magnifying-glass" style="color: var(--accent-gold); margin-right: 12px; font-size: 1.1rem;"></i>
                <input type="text" name="q" id="popupSearchInput" placeholder="Ketik kata kunci (contoh: Desain, Website, IoT, Seni, nama mahasiswa)...">
                <button type="submit" class="btn-nav-register" style="padding: 7px 18px; font-size: 0.8rem; border-radius: 50px;">
                    Cari
                </button>
            </form>
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 10px;">
                Tekan Enter atau klik Cari untuk menuju halaman katalog lengkap.
            </p>
        </div>
    </div>

    <!-- Auth Modal (HANYA UNTUK MAHASISWA & ADMIN) -->
    <div class="modal-layer" id="authModal" onclick="closeAuthModal(event)">
        <div class="modal-card-box" onclick="event.stopPropagation()">
            <div class="modal-head-bar">
                <div style="font-family: var(--font-headline); font-size: 1.15rem; color: var(--accent-gold); text-transform: uppercase;">
                    PORTAL LOGIN // MAHASISWA &amp; ADMIN
                </div>
                <button type="button" class="modal-close-icon" onclick="closeAuthModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body-content">
                <div style="background: var(--accent-gold-soft); border-left: 3px solid var(--accent-gold); padding: 10px 14px; font-size: 0.82rem; margin-bottom: 20px; color: var(--text-dark);">
                    <i class="fa-solid fa-circle-info text-red-600"></i> <strong>Catatan:</strong> Pengunjung umum <strong>TIDAK PERLU</strong> login untuk melihat dan menikmati seluruh karya di website ini.
                </div>

                <!-- Tabs: Masuk vs Register -->
                <div class="form-auth-tabs">
                    <button type="button" class="auth-tab-switch active" id="tabBtnLogin" onclick="setAuthTab('login')">
                        MASUK
                    </button>
                    <button type="button" class="auth-tab-switch" id="tabBtnRegister" onclick="setAuthTab('register')">
                        REGISTER MAHASISWA
                    </button>
                </div>

                <!-- Role Selection -->
                <div class="input-group-row" id="roleSelectorRow">
                    <label class="input-label-tag">Pilih Peran Akun:</label>
                    <select id="authRoleInput" class="input-text-clean" style="font-weight: 700;" onchange="updateAuthRoleUI(this.value)">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- Login Form (Mahasiswa / Admin) -->
                <form id="loginFormContainer" action="{{ url('/login') }}" method="POST">
                    @csrf
                    <!-- Alert Error & Lockout Timer Notifikasi Merah -->
                    <div id="modalLoginError" style="display:{{ ($errors->has('login') || $errors->has('password') || session('lockout_seconds')) ? 'flex' : 'none' }}; background:#fef2f2; border-left:4px solid #ef4444; padding:12px 14px; border-radius:8px; margin-bottom:16px; font-size:0.86rem; color:#991b1b; align-items:flex-start; gap:10px;">
                        <i class="fa-solid fa-circle-xmark" id="modalLoginErrorIcon" style="flex-shrink:0; margin-top:2px; font-size:1.15rem; color:#dc2626;"></i>
                        <div style="flex:1;">
                            <div id="modalLoginErrorMsg" style="font-weight:600; line-height:1.45;">{{ $errors->first('login') ?: $errors->first('password') }}</div>
                            <div id="modalLockoutCountdownBox" style="display:{{ session('lockout_seconds') ? 'flex' : 'none' }}; align-items:center; gap:8px; margin-top:8px; background:#ffedd5; border:1px solid #fed7aa; padding:6px 10px; border-radius:6px; color:#9a3412; font-weight:700; font-size:0.82rem;">
                                <i class="fa-solid fa-clock" style="color:#ea580c;"></i>
                                <span>Waktu tunggu tersisa:</span>
                                <span id="modalCountdownTime" style="font-family:monospace; font-size:0.95rem; color:#c2410c;">{{ session('lockout_seconds') ? gmdate('i:s', session('lockout_seconds')) : '04:00' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group-row">
                        <label class="input-label-tag" id="modalLoginLabel">Email Mahasiswa atau NIM</label>
                        <input type="text" name="login" id="modalLoginInput" class="input-text-clean" value="{{ old('login', old('email')) }}" placeholder="nama@mahasiswa.kampus.ac.id atau 2201010045" required>
                    </div>
                    <div class="input-group-row">
                        <label class="input-label-tag">Kata Sandi Akun</label>
                        <div class="password-toggle-wrapper">
                            <input type="password" name="password" id="modalLoginPassword" class="input-text-clean" placeholder="Minimal 6 angka/huruf" minlength="6" required>
                            <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('modalLoginPassword', this)" title="Lihat kata sandi">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <div id="modalPasswordHint" style="font-size:0.76rem; color:#dc2626; margin-top:4px; font-weight:600; display:none;">
                            <i class="fa-solid fa-triangle-exclamation"></i> Sisa percobaan: <strong id="modalAttemptsLeft">3</strong>x sebelum dikunci 4 menit.
                        </div>
                    </div>
                    <button type="submit" class="btn-submit-action" id="modalLoginSubmitBtn" style="margin-top: 10px;">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> MASUK KE DASHBOARD
                    </button>
                </form>

                <!-- Register Form (Khusus Mahasiswa) -->
                <form id="registerFormContainer" action="{{ url('/register') }}" method="POST" style="display: none;">
                    @csrf
                    <div class="input-group-row">
                        <label class="input-label-tag">Nama Lengkap Mahasiswa *</label>
                        <input type="text" name="name" class="input-text-clean" placeholder="Contoh: Muhammad Reza Pratama" required>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div class="input-group-row">
                            <label class="input-label-tag">NIM Mahasiswa *</label>
                            <input type="text" name="nim" class="input-text-clean" placeholder="Contoh: 2201010045" required>
                        </div>
                        <div class="input-group-row">
                            <label class="input-label-tag">Jurusan / Program Studi *</label>
                            <input type="text" name="prodi" id="modalProdiInput" class="input-text-clean" placeholder="Contoh: Teknik Informatika" required>
                        </div>
                    </div>
                    <div class="input-group-row">
                        <label class="input-label-tag">Email Mahasiswa Aktif *</label>
                        <input type="email" name="email" class="input-text-clean" placeholder="nama@mahasiswa.kampus.ac.id" required>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div class="input-group-row">
                            <label class="input-label-tag">Buat Password *</label>
                            <div class="password-toggle-wrapper">
                                <input type="password" name="password" id="modalRegPassword" class="input-text-clean" placeholder="Minimal 6 angka/huruf" minlength="6" required>
                                <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('modalRegPassword', this)" title="Lihat kata sandi">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="input-group-row">
                            <label class="input-label-tag">Ulangi Password *</label>
                            <div class="password-toggle-wrapper">
                                <input type="password" name="password_confirmation" id="modalRegPasswordConf" class="input-text-clean" placeholder="Ulangi kata sandi" minlength="6" required>
                                <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('modalRegPasswordConf', this)" title="Lihat kata sandi">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit-action">
                        <i class="fa-solid fa-user-plus"></i> DAFTAR AKUN MAHASISWA
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Project Modal -->
    <div class="modal-layer" id="detailModal" onclick="closeDetailModal(event)">
        <div class="modal-card-box modal-detail-card" onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="modal-head-bar" style="padding: 16px 24px; border-bottom: 1.5px solid var(--border-soft); display: flex; align-items: center; justify-content: space-between; background: #ffffff;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="background: rgba(16, 185, 129, 0.12); color: #047857; font-family: var(--font-mono); font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 50px; border: 1px solid rgba(16, 185, 129, 0.25);">DETAIL KARYA</span>
                    <span id="modalCategoryBadge" style="font-family: var(--font-headline); font-size: 1.05rem; color: #064e3b; text-transform: uppercase; letter-spacing: 0.03em;"></span>
                </div>
                <button type="button" class="modal-close-icon" onclick="closeDetailModal()" title="Tutup Modal" style="font-size: 1.25rem; color: #64748b; padding: 4px; line-height: 1;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Scrollable Content Container -->
            <div class="modal-scroll-body">
                <!-- Project Image Banner -->
                <div id="modalImageBanner" style="width: 100%; height: 260px; background: linear-gradient(135deg, #1e293b, #0f172a); overflow: hidden; position: relative; flex-shrink: 0;">
                    <img id="modalProjectImage" src="" alt="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                    <div id="modalImageFallback" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                        <i id="modalFallbackIcon" class="fa-solid fa-folder-open" style="font-size: 4rem; color: rgba(255,255,255,0.35);"></i>
                    </div>
                </div>

                <div class="modal-body-content" style="padding: 26px 28px 36px;">
                    <h2 id="modalTitle" style="font-family: var(--font-headline); font-size: 1.85rem; line-height: 1.25; margin-bottom: 12px; color: var(--text-dark); letter-spacing: -0.01em;"></h2>

                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; padding-bottom: 16px; margin-bottom: 20px; border-bottom: 1.5px solid #f1f5f9;">
                        <div>
                            <a id="modalAuthorLink" href="#" style="font-weight: 800; font-size: 1rem; color: #059669; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;"></a>
                            <div id="modalProdi" style="font-family: var(--font-mono); font-size: 0.78rem; color: var(--text-muted); font-weight: 600; margin-top: 3px;"></div>
                        </div>
                        <div style="display: flex; gap: 8px; align-items: center;">
                            <span id="modalLikes" style="font-family: var(--font-mono); font-size: 0.84rem; background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; padding: 5px 12px; border-radius: 50px; font-weight: 800; display: inline-flex; align-items: center; gap: 5px; box-shadow: 0 1px 3px rgba(225, 29, 72, 0.08);"></span>
                            <span id="modalViews" style="font-family: var(--font-mono); font-size: 0.84rem; background: #f0fdf4; color: #047857; border: 1px solid #bbf7d0; padding: 5px 12px; border-radius: 50px; font-weight: 800; display: inline-flex; align-items: center; gap: 5px; box-shadow: 0 1px 3px rgba(4, 120, 87, 0.08);"></span>
                        </div>
                    </div>

                    <div style="font-size: 0.82rem; font-weight: 800; text-transform: uppercase; color: #064e3b; letter-spacing: 0.05em; margin-bottom: 8px; display: flex; align-items: center; gap: 7px;">
                        <i class="fa-solid fa-align-left" style="color: #10b981;"></i> Deskripsi &amp; Konsep Karya:
                    </div>
                    <p id="modalDesc" style="color: #334155; font-size: 0.96rem; line-height: 1.7; margin-bottom: 22px; white-space: pre-line; background: #f8fafc; padding: 16px 18px; border-radius: 12px; border: 1px solid #e2e8f0;"></p>

                    <div style="font-size: 0.82rem; font-weight: 800; text-transform: uppercase; color: #064e3b; letter-spacing: 0.05em; margin-bottom: 8px; display: flex; align-items: center; gap: 7px;">
                        <i class="fa-solid fa-screwdriver-wrench" style="color: #10b981;"></i> Medium &amp; Alat yang Digunakan:
                    </div>
                    <div id="modalTechContainer" style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px;"></div>

                    <!-- Collaborators Section (muncul jika kolaborasi) -->
                    <div id="modalCollabSection" style="display:none; margin-bottom: 24px;">
                        <div style="font-size: 0.82rem; font-weight: 800; text-transform: uppercase; color: #064e3b; letter-spacing: 0.05em; margin-bottom: 10px; display: flex; align-items: center; gap: 7px;">
                            <i class="fa-solid fa-people-group" style="color: #10b981;"></i> Tim Kolaborasi:
                        </div>
                        <div id="modalCollabList" style="display: flex; flex-direction: column; gap: 8px;"></div>
                    </div>

                    <!-- Link Buttons (dinamis) -->
                    <div style="margin-top: 10px; padding-top: 18px; border-top: 1.5px solid #f1f5f9;">
                        <div style="font-size: 0.82rem; font-weight: 800; text-transform: uppercase; color: #064e3b; letter-spacing: 0.05em; margin-bottom: 12px; display: flex; align-items: center; gap: 7px;">
                            <i class="fa-solid fa-link" style="color: #10b981;"></i> Tautan Proyek &amp; Portofolio:
                        </div>
                        <div id="modalLinksContainer" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $appApprovedProjects = \App\Models\Project::with(['user','collaborators'])->where('status', 'approved')->get()->map(function($p) {
            return [
                'id'            => $p->id,
                'title'         => $p->title,
                'category'      => $p->category,
                'categoryLabel' => $p->category_label,
                'projectType'   => $p->project_type ?? 'individu',
                'userId'        => $p->user->id ?? null,
                'author'        => $p->user->name ?? 'Mahasiswa',
                'authorAvatar'  => $p->user && $p->user->avatar_url ? (str_starts_with($p->user->avatar_url, 'http') ? $p->user->avatar_url : asset($p->user->avatar_url)) : null,
                'profileUrl'    => $p->user ? url('/profil/' . $p->user->id) : '#',
                'prodi'         => $p->user->prodi ?? 'Karya Mahasiswa',
                'angkatan'      => $p->user->angkatan ?? null,
                'desc'          => $p->description,
                'tech'          => $p->tech_array,
                'likes'         => $p->likes_count,
                'views'         => $p->views_count ?? 0,
                'isBest'        => (bool)$p->is_featured,
                'badge'         => $p->is_featured ? 'PILIHAN KURATOR' : '',
                'icon'          => $p->category_icon,
                'bgGradient'    => $p->category_gradient,
                'imagePath'     => $p->image_url ?? ($p->image_path ? (str_starts_with($p->image_path, 'http') ? $p->image_path : asset($p->image_path)) : null),
                'demoUrl'       => $p->demo_url,
                'githubUrl'     => $p->github_url,
                'youtubeUrl'    => $p->youtube_url,
                'driveUrl'      => $p->drive_url,
                'collaborators' => $p->collaborators->map(fn($c) => [
                    'name'    => $c->name,
                    'nim'     => $c->nim,
                    'jobdesk' => $c->jobdesk,
                ])->values()->toArray(),
            ];
        });
    @endphp

    <!-- Global Client Script -->
    <script>
        const APP_BASE_URL = "{{ url('/') }}";
        const globalProjectsDatabase = @json($appApprovedProjects);

        // Smart image fallback handler for uploaded covers
        function handleCardImgError(img) {
            if (!img.dataset.hasRetried) {
                img.dataset.hasRetried = '1';
                const currentSrc = img.src;
                // If missing /public/ in subfolder setup, try injecting it
                if (currentSrc.indexOf('/public/') === -1 && currentSrc.indexOf('uploads/') !== -1) {
                    img.src = currentSrc.replace('/uploads/', '/public/uploads/');
                    return;
                }
                // If /public/ was present but virtual host is used, try stripping /public/
                if (currentSrc.indexOf('/public/uploads/') !== -1) {
                    img.src = currentSrc.replace('/public/uploads/', '/uploads/');
                    return;
                }
            }
            img.style.display = 'none';
        }

        // Search Popup Modal
        function openSearchModal() {
            document.getElementById('searchModal').classList.add('active');
            setTimeout(() => {
                document.getElementById('popupSearchInput').focus();
            }, 100);
            document.body.style.overflow = 'hidden';
        }

        function closeSearchModal(e) {
            if (e && e.target !== e.currentTarget) return;
            document.getElementById('searchModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Update teks label & placeholder email dinamis sesuai peran yang dipilih
        function updateAuthRoleUI(role) {
            const labelEl = document.getElementById('modalLoginLabel');
            const inputEl = document.getElementById('modalLoginInput');
            if (!labelEl || !inputEl) return;

            if (role === 'admin') {
                labelEl.innerHTML = '<i class="fa-solid fa-user-shield" style="color:var(--accent-gold);margin-right:4px;"></i> Email Admin Kampus';
                inputEl.placeholder = 'admin@kampus.ac.id';
            } else {
                labelEl.innerHTML = '<i class="fa-solid fa-graduation-cap" style="color:#10b981;margin-right:4px;"></i> Email Mahasiswa atau NIM';
                inputEl.placeholder = 'nama@mahasiswa.kampus.ac.id atau 2201010045';
            }
        }

        // Auth Modal (Mahasiswa & Admin)
        function openAuthModal(tab = 'login', role = 'mahasiswa') {
            setAuthTab(tab);
            if (role) {
                const roleInput = document.getElementById('authRoleInput');
                if (roleInput) {
                    roleInput.value = role;
                    updateAuthRoleUI(role);
                }
            }
            document.getElementById('authModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeAuthModal(e) {
            if (e && e.target !== e.currentTarget) return;
            document.getElementById('authModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function setAuthTab(tab) {
            const btnLogin = document.getElementById('tabBtnLogin');
            const btnRegister = document.getElementById('tabBtnRegister');
            const loginSection = document.getElementById('loginFormContainer');
            const regSection = document.getElementById('registerFormContainer');
            const roleRow = document.getElementById('roleSelectorRow');

            if (tab === 'login') {
                btnLogin.classList.add('active');
                btnRegister.classList.remove('active');
                loginSection.style.display = 'block';
                regSection.style.display = 'none';
                roleRow.style.display = 'block';
            } else {
                btnRegister.classList.add('active');
                btnLogin.classList.remove('active');
                loginSection.style.display = 'none';
                regSection.style.display = 'block';
                roleRow.style.display = 'none';
            }
        }

        function fillQuickLogin(loginVal, passVal) {
            const loginInp = document.getElementById('modalLoginInput');
            const passInp = document.getElementById('modalLoginPassword');
            if (loginInp && passInp) {
                loginInp.value = loginVal;
                passInp.value = passVal;
                loginInp.focus();
            }
        }

        // ── Modal Login: Rate Limiter & Validasi Real-time (3x salah → kunci 4 menit) ──
        (function () {
            let countdownInterval = null;

            function showModalError(msg, isLockout = false, retrySeconds = 0) {
                const banner = document.getElementById('modalLoginError');
                const msgEl = document.getElementById('modalLoginErrorMsg');
                const icon = document.getElementById('modalLoginErrorIcon');
                const countBox = document.getElementById('modalLockoutCountdownBox');

                if (!banner || !msgEl) return;

                msgEl.innerHTML = msg;
                banner.style.display = 'flex';

                if (isLockout) {
                    banner.style.borderLeftColor = '#ea580c';
                    banner.style.background = '#fff7ed';
                    banner.style.color = '#7c2d12';
                    if (icon) {
                        icon.className = 'fa-solid fa-lock';
                        icon.style.color = '#ea580c';
                    }
                    if (countBox) countBox.style.display = 'flex';
                } else {
                    banner.style.borderLeftColor = '#ef4444';
                    banner.style.background = '#fef2f2';
                    banner.style.color = '#991b1b';
                    if (icon) {
                        icon.className = 'fa-solid fa-circle-xmark';
                        icon.style.color = '#dc2626';
                    }
                    if (countBox) countBox.style.display = 'none';
                }
            }

            function setFormLocked(locked) {
                const btn = document.getElementById('modalLoginSubmitBtn');
                const inputs = document.querySelectorAll('#loginFormContainer input');
                inputs.forEach(i => {
                    i.disabled = locked;
                    i.style.opacity = locked ? '0.6' : '1';
                });
                if (btn) {
                    btn.disabled = locked;
                    btn.style.opacity = locked ? '0.5' : '1';
                    btn.style.cursor = locked ? 'not-allowed' : 'pointer';
                }
            }

            function startCountdown(seconds) {
                setFormLocked(true);
                const countBox = document.getElementById('modalLockoutCountdownBox');
                const timeEl = document.getElementById('modalCountdownTime');
                const hint = document.getElementById('modalPasswordHint');
                if (hint) hint.style.display = 'none';
                if (countBox) countBox.style.display = 'flex';

                if (countdownInterval) clearInterval(countdownInterval);

                let remaining = seconds;
                const updateDisplay = () => {
                    const m = Math.floor(remaining / 60);
                    const s = remaining % 60;
                    if (timeEl) {
                        timeEl.textContent = String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
                    }
                };

                updateDisplay();

                countdownInterval = setInterval(() => {
                    remaining--;
                    if (remaining <= 0) {
                        clearInterval(countdownInterval);
                        countdownInterval = null;
                        setFormLocked(false);
                        const banner = document.getElementById('modalLoginError');
                        const msgEl = document.getElementById('modalLoginErrorMsg');
                        const icon = document.getElementById('modalLoginErrorIcon');
                        if (countBox) countBox.style.display = 'none';
                        if (banner) {
                            banner.style.borderLeftColor = '#10b981';
                            banner.style.background = '#f0fdf4';
                            banner.style.color = '#064e3b';
                        }
                        if (icon) {
                            icon.className = 'fa-solid fa-circle-check';
                            icon.style.color = '#10b981';
                        }
                        if (msgEl) {
                            msgEl.innerHTML = 'Waktu tunggu selesai. Anda dapat mencoba memasukkan kata sandi kembali.';
                        }
                    } else {
                        updateDisplay();
                    }
                }, 1000);
            }

            // Jika ada lockout dari session Laravel
            @if(session('lockout_seconds'))
                openAuthModal('login');
                showModalError("{{ $errors->first('login') ?: $errors->first('password') }}", true);
                startCountdown({{ session('lockout_seconds') }});
            @elseif($errors->has('login') || $errors->has('password') || session('auto_open_modal') === 'login')
                openAuthModal('login');
            @endif

            // Intercept submit form modal
            const form = document.getElementById('loginFormContainer');
            if (!form) return;

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const btn = document.getElementById('modalLoginSubmitBtn');
                const origBtnHtml = btn ? btn.innerHTML : '';
                if (btn) {
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memeriksa...';
                }

                const formData = new FormData(form);

                try {
                    const res = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                    });

                    const data = await res.json().catch(() => ({}));

                    if (res.status === 200 && data.success) {
                        if (btn) {
                            btn.innerHTML = '<i class="fa-solid fa-circle-check"></i> Berhasil Masuk!';
                            btn.style.background = '#10b981';
                        }
                        window.location.href = data.redirect || "{{ url('/') }}";
                        return;
                    }

                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = origBtnHtml;
                    }

                    if (res.status === 429 || data.locked) {
                        // Terkunci 4 menit
                        const secs = data.retry_after || 240;
                        showModalError(data.message || 'Akun dikunci sementara karena salah memasukkan sandi 3 kali.', true, secs);
                        startCountdown(secs);
                        return;
                    }

                    // Gagal biasa (sandi salah)
                    let errorText = data.message || 'Kombinasi Email/NIM atau kata sandi tidak sesuai.';
                    if (data.errors) {
                        const firstKey = Object.keys(data.errors)[0];
                        if (firstKey && data.errors[firstKey][0]) {
                            errorText = data.errors[firstKey][0];
                        }
                    }

                    showModalError(errorText, false);

                    const hint = document.getElementById('modalPasswordHint');
                    const leftEl = document.getElementById('modalAttemptsLeft');
                    if (data.remaining !== undefined && data.remaining > 0) {
                        if (hint) hint.style.display = 'block';
                        if (leftEl) leftEl.textContent = data.remaining;
                    } else if (hint) {
                        hint.style.display = 'none';
                    }

                    const passInput = document.getElementById('modalLoginPassword');
                    if (passInput) {
                        passInput.value = '';
                        passInput.focus();
                    }
                } catch (err) {
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = origBtnHtml;
                    }
                    showModalError('Terjadi kesalahan jaringan. Silakan coba kembali.', false);
                }
            });
        })();

        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                if (icon) {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            } else {
                input.type = 'password';
                if (icon) {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        }


        // Project Detail Modal
        function viewDetailModal(id) {
            const data = globalProjectsDatabase.find(p => p.id === id);
            if (!data) return;

            // Category badge
            document.getElementById('modalCategoryBadge').textContent = (data.categoryLabel || 'Karya Mahasiswa').toUpperCase();
            document.getElementById('modalTitle').textContent = data.title;

            // Author with profile link
            const authorLink = document.getElementById('modalAuthorLink');
            if (data.authorAvatar) {
                authorLink.innerHTML = `<img src="${data.authorAvatar}" alt="${data.author}" style="width:28px;height:28px;border-radius:50%;object-fit:cover;border:1.5px solid #10b981;box-shadow:0 1px 4px rgba(0,0,0,0.1);" onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(data.author)}&background=064e3b&color=f0dc9e';"> <span style="font-weight:800;">${data.author}</span> <span style="font-size:0.72rem;background:#ecfdf5;color:#047857;padding:3px 9px;border-radius:50px;border:1px solid #a7f3d0;font-weight:700;"><i class="fa-solid fa-arrow-up-right-from-square" style="font-size:0.62rem;margin-right:2px;"></i> Lihat Profil</span>`;
            } else {
                authorLink.innerHTML = `<i class="fa-solid fa-circle-user" style="color: #10b981; font-size: 1.15rem;"></i> <span style="font-weight:800;">${data.author}</span> <span style="font-size:0.72rem;background:#ecfdf5;color:#047857;padding:3px 9px;border-radius:50px;border:1px solid #a7f3d0;font-weight:700;"><i class="fa-solid fa-arrow-up-right-from-square" style="font-size:0.62rem;margin-right:2px;"></i> Lihat Profil</span>`;
            }
            authorLink.href = data.profileUrl || (data.userId ? `${APP_BASE_URL}/profil/${data.userId}` : '#');
            authorLink.title = `Kunjungi halaman profil publik ${data.author}`;

            // Prodi & angkatan
            let prodiText = data.prodi || 'Karya Mahasiswa';
            if (data.angkatan) prodiText += ' Â· Angkatan ' + data.angkatan;
            document.getElementById('modalProdi').textContent = prodiText;

            // Likes & views
            document.getElementById('modalLikes').innerHTML = `<i class="fa-solid fa-heart" style="color: #e11d48;"></i> ${data.likes} suka`;
            document.getElementById('modalViews').innerHTML = `<i class="fa-solid fa-eye" style="color: #047857;"></i> ${data.views || 0} views`;

            // Description
            document.getElementById('modalDesc').textContent = data.desc;

            // Image banner
            const imgEl = document.getElementById('modalProjectImage');
            const fallback = document.getElementById('modalImageFallback');
            const banner = document.getElementById('modalImageBanner');
            const fallbackIcon = document.getElementById('modalFallbackIcon');
            if (data.imagePath) {
                imgEl.src = data.imagePath;
                imgEl.alt = data.title;
                imgEl.style.display = 'block';
                fallback.style.display = 'none';
                imgEl.onerror = function() {
                    handleCardImgError(this);
                    if (this.style.display === 'none') {
                        fallback.style.display = 'flex';
                        banner.style.background = data.bgGradient;
                        fallbackIcon.className = `fa-solid ${data.icon}`;
                    }
                };
            } else {
                imgEl.style.display = 'none';
                fallback.style.display = 'flex';
                banner.style.background = data.bgGradient;
                fallbackIcon.className = `fa-solid ${data.icon}`;
            }

            // Tech badges
            const techBox = document.getElementById('modalTechContainer');
            techBox.innerHTML = '';
            (data.tech || []).forEach(t => {
                const span = document.createElement('span');
                span.style.cssText = 'background: #f1f5f9; color: #064e3b; font-size: 0.78rem; font-weight: 700; padding: 4px 12px; border-radius: 50px; border: 1px solid #cbd5e1;';
                span.textContent = t;
                techBox.appendChild(span);
            });

            // Collaborators Section
            const collabSection = document.getElementById('modalCollabSection');
            const collabList = document.getElementById('modalCollabList');
            collabList.innerHTML = '';
            if (data.projectType === 'kolaborasi' && data.collaborators && data.collaborators.length > 0) {
                collabSection.style.display = 'block';
                data.collaborators.forEach((col, i) => {
                    const initials = col.name.split(' ').map(w => w[0]).join('').slice(0, 2).toUpperCase();
                    const colors = ['#10b981','#0284c7','#047857','#8b5cf6','#f59e0b','#ec4899'];
                    const color = colors[i % colors.length];
                    const row = document.createElement('div');
                    row.style.cssText = 'display:flex;align-items:center;gap:12px;padding:10px 14px;background:#f8fafc;border-radius:10px;border:1.5px solid #e2e8f0;';
                    row.innerHTML = `
                        <div style="width:36px;height:36px;border-radius:10px;background:${color};color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.82rem;flex-shrink:0;">${initials}</div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-weight:700;font-size:0.88rem;color:#0f172a;">${col.name}${col.nim ? ` <span style="font-size:0.72rem;color:#64748b;font-weight:600;">(${col.nim})</span>` : ''}</div>
                            <div style="font-size:0.78rem;color:#64748b;margin-top:1px;"><i class="fa-solid fa-briefcase" style="margin-right:4px;color:${color};"></i>${col.jobdesk}</div>
                        </div>
                    `;
                    collabList.appendChild(row);
                });
            } else {
                collabSection.style.display = 'none';
            }

            // Link buttons
            const linksBox = document.getElementById('modalLinksContainer');
            linksBox.innerHTML = '';
            const makeLink = (href, icon, label, cls) => {
                const a = document.createElement('a');
                a.href = href;
                a.target = '_blank';
                a.rel = 'noopener noreferrer';
                a.className = cls;
                a.innerHTML = `<i class="${icon}"></i> ${label}`;
                a.style.cssText = 'display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:50px;font-size:0.85rem;font-weight:700;text-decoration:none;transition:all 0.2s;';
                return a;
            };
            if (data.demoUrl) {
                const a = makeLink(data.demoUrl, 'fa-solid fa-arrow-up-right-from-square', 'Demo Live', 'btn-nav-register');
                linksBox.appendChild(a);
            }
            if (data.githubUrl) {
                const a = makeLink(data.githubUrl, 'fa-brands fa-github', 'GitHub', 'btn-nav-login');
                linksBox.appendChild(a);
            }
            if (data.youtubeUrl) {
                const a = makeLink(data.youtubeUrl, 'fa-brands fa-youtube', 'YouTube', 'btn-nav-login');
                a.style.color = '#ef4444';
                linksBox.appendChild(a);
            }
            if (data.driveUrl) {
                const a = makeLink(data.driveUrl, 'fa-brands fa-google-drive', 'Google Drive', 'btn-nav-login');
                a.style.color = '#0284c7';
                linksBox.appendChild(a);
            }
            if (data.userId) {
                const profileHref = data.profileUrl || `${APP_BASE_URL}/profil/${data.userId}`;
                const a = makeLink(profileHref, 'fa-solid fa-user', 'Profil Mahasiswa', 'btn-nav-login');
                a.target = '_self';
                linksBox.appendChild(a);
            }
            if (linksBox.children.length === 0) {
                linksBox.innerHTML = '<span style="color: var(--text-muted); font-size: 0.85rem;"><i class="fa-solid fa-circle-info"></i> Tidak ada tautan eksternal yang disertakan.</span>';
            }

            document.getElementById('detailModal').classList.add('active');
            document.body.style.overflow = 'hidden';

            // Reset scroll position modal ke paling atas saat dibuka
            const modalScrollEl = document.querySelector('#detailModal .modal-scroll-body');
            if (modalScrollEl) {
                modalScrollEl.scrollTop = 0;
            }

            // Catat view ke database server
            fetch(`${APP_BASE_URL}/karya/${id}/view`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json())
            .then(res => {
                if (res.views !== undefined) {
                    data.views = res.views;
                    document.getElementById('modalViews').innerHTML = `<i class="fa-solid fa-eye"></i> ${res.views} views`;
                }
            })
            .catch(e => console.error(e));
        }

        function closeDetailModal(e) {
            if (e && e.target !== e.currentTarget) return;
            document.getElementById('detailModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Like Toggle with backend database synchronization
        function toggleProjectLike(btn, projectId) {
            const countEl = btn.querySelector('.like-number') || btn.querySelector('span');
            let count = countEl ? (parseInt(countEl.textContent) || 0) : 0;

            if (btn.classList.contains('liked')) {
                return; // Hindari spam klik jika sudah disukai
            }

            btn.classList.add('liked');
            if (countEl) countEl.textContent = count + 1;
            btn.style.background = '#ef4444';
            btn.style.color = '#ffffff';
            btn.style.borderColor = '#ef4444';

            if (projectId) {
                fetch(`${APP_BASE_URL}/karya/${projectId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(res => {
                    if (res.likes !== undefined && countEl) {
                        countEl.textContent = res.likes;
                    }
                })
                .catch(e => console.error(e));
            }
        }
    </script>
    @yield('extra_js')
</body>
</html>


