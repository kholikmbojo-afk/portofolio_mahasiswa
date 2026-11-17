<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil — {{ $user->name }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #064e3b;         /* Hijau Daun Gelap Kontras */
            --sidebar-hover: #047857;      /* Hijau Sedang Hover */
            --sidebar-active: #f0dc9e;     /* Gold Lembut Agak ke Putih */
            --body-bg: #f8fdfa;            /* Putih Bersih Segar */
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-main: #064e3b;
            --text-muted: #4b6b5e;
            --hero-red: #f0dc9e;
            --hero-red-hover: #e0c67e;
            --accent-gold: #f0dc9e;
            --accent-gold-hover: #e0c67e;
            --accent-green: #10b981;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        aside.mhs-sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            z-index: 100;
            border-right: 1px solid rgba(255,255,255,0.06);
        }

        .sidebar-brand-box {
            padding: 26px 22px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #ffffff;
        }

        .brand-icon-crown {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff;
            width: 38px; height: 38px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.15rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .brand-title-text { font-size: 1.25rem; font-weight: 800; letter-spacing: -0.02em; }

        .sidebar-nav-menu {
            list-style: none;
            padding: 18px 14px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex-grow: 1;
        }

        .nav-menu-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            color: rgba(255,255,255,0.7);
            background: transparent;
            border: none;
            cursor: pointer;
            width: 100%;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-menu-link:hover { background: var(--sidebar-hover); color: #ffffff; }
        .nav-menu-link.active { background: var(--sidebar-active); color: #064e3b; font-weight: 700; box-shadow: 0 4px 14px rgba(240,220,158,0.35); }

        .sidebar-bottom-action {
            padding: 14px;
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .btn-sidebar-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 14px;
            background: transparent;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 600;
            color: rgba(255,255,255,0.6);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-sidebar-logout:hover { background: rgba(240,220,158,0.15); border-color: var(--accent-gold); color: #ffffff; }

        /* ===== MAIN WORKSPACE ===== */
        main.mhs-workspace {
            margin-left: 250px;
            flex: 1;
            padding: 24px 32px 60px;
            overflow-y: auto;
        }

        .workspace-topbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .btn-topbar-web {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: #ffffff;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-main);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-topbar-web:hover { border-color: var(--accent-gold); color: var(--text-main); }

        .user-profile-capsule {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar-circle {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-gold-hover));
            color: #064e3b;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem;
            font-weight: 800;
            overflow: hidden;
        }

        .avatar-circle img { width: 100%; height: 100%; object-fit: cover; }

        .user-text-info { display: flex; flex-direction: column; line-height: 1.25; }
        .user-name-title { font-size: 0.9rem; font-weight: 700; color: var(--text-main); }
        .user-role-sub { font-size: 0.75rem; color: var(--text-muted); }

        /* ===== ALERT BOX ===== */
        .alert-box {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 18px; border-radius: 12px;
            font-size: 0.9rem; font-weight: 600; margin-bottom: 20px;
        }
        .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .alert-error   { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

        /* ===== PAGE HEADER ===== */
        .page-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
        }

        .page-header-title { font-size: 1.55rem; font-weight: 800; color: var(--text-main); margin-bottom: 4px; letter-spacing: -0.02em; }
        .page-header-desc { font-size: 0.88rem; color: var(--text-muted); }

        .btn-back-dashboard {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 10px;
            border: 1.5px solid var(--border-color);
            background: #ffffff;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-main);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-back-dashboard:hover { border-color: var(--accent-gold); color: var(--text-main); }

        /* ===== PROFILE GRID ===== */
        .profile-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* ===== SIDEBAR PREVIEW CARD ===== */
        .profile-card-sidebar {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 28px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            text-align: center;
            position: sticky;
            top: 24px;
        }

        /* Avatar Uploader Zone */
        .avatar-uploader-zone {
            position: relative;
            width: 110px;
            height: 110px;
            margin: 0 auto 12px;
            cursor: pointer;
        }

        .avatar-preview-ring {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-gold-hover));
            color: #064e3b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            font-weight: 800;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(240,220,158,0.35);
            border: 3px solid #ffffff;
            outline: 3px solid rgba(240,220,158,0.3);
            transition: outline-color 0.2s ease;
        }

        .avatar-preview-ring img { width: 100%; height: 100%; object-fit: cover; }

        .avatar-edit-overlay {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 32px;
            height: 32px;
            background: var(--accent-gold);
            color: #064e3b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            box-shadow: 0 3px 10px rgba(240,220,158,0.45);
            border: 2px solid #ffffff;
            transition: transform 0.2s ease;
        }

        .avatar-uploader-zone:hover .avatar-preview-ring { outline-color: var(--accent-gold); }
        .avatar-uploader-zone:hover .avatar-edit-overlay { transform: scale(1.1); }

        .avatar-upload-hint {
            font-size: 0.73rem;
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        .btn-change-avatar-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ecfdf5;
            color: #065f46;
            border: 1.5px solid #a7f3d0;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-change-avatar-pill:hover {
            background: #10b981;
            color: #ffffff;
            border-color: #10b981;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);
        }

        .profile-display-name {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .profile-display-prodi {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .profile-nim-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #334155;
            font-family: 'Space Mono', monospace;
            font-size: 0.78rem;
            padding: 4px 12px;
            border-radius: 50px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
        }

        .profile-stat-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 20px;
        }

        .profile-stat-box {
            background: #f8fafc;
            border-radius: 10px;
            padding: 12px 8px;
            border: 1px solid #e2e8f0;
        }

        .profile-stat-num {
            font-size: 1.4rem;
            font-weight: 800;
            color: #10b981;
        }

        .profile-stat-label {
            font-size: 0.7rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
        }

        .profile-social-links {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .profile-social-link {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.82rem;
            color: var(--text-muted);
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 8px;
            transition: all 0.2s ease;
            word-break: break-all;
        }

        .profile-social-link:hover { background: #f1f5f9; color: var(--text-main); }

        /* ===== FORM CARDS ===== */
        .form-section-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 28px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            margin-bottom: 20px;
        }

        .form-section-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-main);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 2px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section-title i { color: #10b981; }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group { margin-bottom: 16px; }
        .form-group:last-child { margin-bottom: 0; }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-main);
            margin-bottom: 6px;
            letter-spacing: 0.04em;
        }

        .form-input {
            width: 100%;
            padding: 11px 14px;
            border-radius: 10px;
            border: 1.5px solid var(--border-color);
            background: #ffffff;
            font-size: 0.9rem;
            font-family: inherit;
            color: var(--text-main);
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,0.2); }

        .form-input:read-only {
            background: #f8fafc;
            color: var(--text-muted);
            cursor: not-allowed;
        }

        .form-input-hint {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .form-textarea {
            width: 100%;
            padding: 11px 14px;
            border-radius: 10px;
            border: 1.5px solid var(--border-color);
            background: #ffffff;
            font-size: 0.9rem;
            font-family: inherit;
            color: var(--text-main);
            outline: none;
            resize: vertical;
            min-height: 90px;
            transition: all 0.2s ease;
        }

        .form-textarea:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,0.2); }

        /* ===== ACTION BUTTONS ===== */
        .btn-save-profile {
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-gold-hover));
            color: #064e3b;
            border: none;
            padding: 12px 28px;
            font-size: 0.92rem;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(240,220,158,0.4);
        }

        .btn-save-profile:hover { background: var(--accent-gold-hover); transform: translateY(-1px); box-shadow: 0 6px 18px rgba(240,220,158,0.5); }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 10px;
            border: 1.5px solid var(--border-color);
            background: #ffffff;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-main);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover { border-color: var(--accent-gold); color: var(--text-main); }

        /* Avatar file info banner */
        .avatar-file-info {
            display: none;
            align-items: center;
            gap: 10px;
            background: #ecfdf5;
            border: 1.5px solid #86efac;
            border-radius: 10px;
            padding: 10px 16px;
            margin-bottom: 20px;
        }

        .avatar-file-info.show { display: flex; }

        .avatar-file-info .file-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #065f46;
            flex: 1;
        }

        .avatar-file-info .btn-clear-file {
            background: none;
            border: none;
            color: #059669;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .avatar-file-info .btn-clear-file:hover { color: #047857; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .profile-grid { grid-template-columns: 1fr; }
            .profile-card-sidebar { position: static; }
            .form-grid-2 { grid-template-columns: 1fr; }
            .page-header-row { flex-direction: column; gap: 12px; }
        }

        @media (max-width: 768px) {
            aside.mhs-sidebar { width: 70px; }
            aside.mhs-sidebar .brand-title-text,
            aside.mhs-sidebar .nav-menu-link span,
            aside.mhs-sidebar .btn-sidebar-logout span { display: none; }
            main.mhs-workspace { margin-left: 70px; padding: 16px 20px; }
        }
    </style>
</head>
<body>
    @php
        $sicLogo = asset('images/sic-logo.jpg');
        $targetPath = public_path('images/sic-logo.jpg');
        $sicLocalPaths = [
            $targetPath,
            base_path('public/images/sic-logo.jpg'),
            base_path('images/sic-logo.jpg'),
            'C:/Users/USER/.gemini/antigravity/brain/a4f40950-5aeb-401c-b013-5a2b77d6f278/.user_uploaded/media_1793723755660_3b1e751a.jpg',
        ];
        foreach ($sicLocalPaths as $p) {
            if (file_exists($p)) {
                $raw = @file_get_contents($p);
                if ($raw) {
                    $sicLogo = 'data:image/jpeg;base64,' . base64_encode($raw);
                    if (!file_exists($targetPath)) {
                        @mkdir(dirname($targetPath), 0777, true);
                        @file_put_contents($targetPath, $raw);
                    }
                    break;
                }
            }
        }
    @endphp
    <!-- Left Sidebar -->
    <aside class="mhs-sidebar">
        <a href="{{ url('/') }}" class="sidebar-brand-box">
            <img src="{{ $sicLogo }}" alt="SIC" style="width:40px;height:40px;object-fit:contain;border-radius:8px;background:#ffffff;padding:2px;box-shadow:0 2px 8px rgba(0,0,0,0.15);flex-shrink:0;">
            <div style="display:flex;align-items:center;gap:8px;">
                <span class="brand-title-text" style="font-size:1.3rem;">SIC</span>
                <span style="width:2px;height:16px;background:rgba(255,255,255,0.3);border-radius:2px;"></span>
                <span style="font-size:0.72rem;font-weight:700;color:rgba(255,255,255,0.85);letter-spacing:0.04em;text-transform:uppercase;line-height:1.1;">Kreator</span>
            </div>
        </a>

        <ul class="sidebar-nav-menu">
            <li>
                <a href="{{ url('/mahasiswa/dashboard') }}" class="nav-menu-link">
                    <i class="fa-solid fa-folder-open"></i>
                    <span>Portofolio Saya</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/mahasiswa/profil') }}" class="nav-menu-link active">
                    <i class="fa-solid fa-user-pen"></i>
                    <span>Edit Profil</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/semua-karya') }}" target="_blank" class="nav-menu-link">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>Lihat Web Publik</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-bottom-action">
            <form action="{{ url('/logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-sidebar-logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Workspace -->
    <main class="mhs-workspace">
        <!-- Top Bar -->
        <div class="workspace-topbar">
            <a href="{{ url('/') }}" target="_blank" class="btn-topbar-web">
                <i class="fa-solid fa-globe"></i> Kunjungi Website
            </a>
            <div class="user-profile-capsule">
                <div class="avatar-circle">
                    @if($user->avatar_url)
                        <img src="{{ str_starts_with($user->avatar_url, 'http') ? $user->avatar_url : asset($user->avatar_url) }}" alt="Avatar">
                    @else
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    @endif
                </div>
                <div class="user-text-info">
                    <span class="user-name-title">{{ $user->name }}</span>
                    <span class="user-role-sub">{{ $user->nim ?? 'Mahasiswa Kreator' }}</span>
                </div>
            </div>
        </div>

        <!-- Alert Notifications -->
        @if(session('success'))
            <div class="alert-box alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-box alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header-row">
            <div>
                <h1 class="page-header-title">Edit Profil</h1>
                <p class="page-header-desc">Perbarui foto, informasi, tautan sosial, dan kontak akun Anda.</p>
            </div>
            <a href="{{ url('/mahasiswa/dashboard') }}" class="btn-back-dashboard">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Profile Grid -->
        <div class="profile-grid">
            <!-- Sidebar: Preview Profil -->
            <div class="profile-card-sidebar">
                <!-- Avatar Uploader Zone (klik untuk upload) -->
                <div class="avatar-uploader-zone" onclick="document.getElementById('avatarFileInput').click()" title="Klik untuk ganti foto profil">
                    <div class="avatar-preview-ring" id="previewAvatar">
                        @if($user->avatar_url)
                            <img src="{{ str_starts_with($user->avatar_url, 'http') ? $user->avatar_url : asset($user->avatar_url) }}" id="previewAvatarImg" alt="Avatar" onerror="this.onerror=null; this.parentElement.innerHTML='<span id=\'previewAvatarInitials\'>{{ strtoupper(substr($user->name, 0, 2)) }}</span>';">
                        @else
                            <span id="previewAvatarInitials">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        @endif
                    </div>
                    <div class="avatar-edit-overlay">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>
                
                <div style="margin-bottom: 12px;">
                    <button type="button" class="btn-change-avatar-pill" onclick="document.getElementById('avatarFileInput').click()">
                        <i class="fa-solid fa-camera"></i> Ganti Foto Profil
                    </button>
                </div>

                <!-- Banner info file terpilih di bawah foto -->
                <div class="avatar-file-info" id="avatarFileInfo" style="margin: 0 auto 14px; max-width: 230px;">
                    <i class="fa-solid fa-image" style="color:#10b981;font-size:0.95rem;"></i>
                    <span class="file-name" id="avatarFileName" style="font-size: 0.76rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"></span>
                    <button type="button" onclick="clearAvatarFile()" class="btn-clear-file" title="Batalkan pilihan foto">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="profile-display-name" id="previewName">{{ $user->name }}</div>
                <div class="profile-display-prodi" id="previewProdi">{{ $user->prodi ?? 'Prodi belum diatur' }}</div>
                <div class="profile-nim-badge">NIM: {{ $user->nim ?? '-' }}</div>

                <div class="profile-stat-row">
                    <div class="profile-stat-box">
                        <div class="profile-stat-num">{{ $user->projects()->count() }}</div>
                        <div class="profile-stat-label">Total Karya</div>
                    </div>
                    <div class="profile-stat-box">
                        <div class="profile-stat-num">{{ $user->projects()->where('status','approved')->count() }}</div>
                        <div class="profile-stat-label">Disetujui</div>
                    </div>
                </div>

                @if($user->bio)
                    <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 16px; font-style: italic; text-align: left; background: #f8fafc; padding: 10px 12px; border-radius: 10px; border: 1px solid var(--border-color);">
                        "{{ $user->bio }}"
                    </p>
                @endif

                <div class="profile-social-links">
                    @if($user->github_url)
                        <a href="{{ $user->github_url }}" target="_blank" class="profile-social-link">
                            <i class="fa-brands fa-github" style="font-size: 1rem; color: #1e293b;"></i>
                            GitHub Profile
                        </a>
                    @endif
                    @if($user->phone)
                        <span class="profile-social-link">
                            <i class="fa-solid fa-phone" style="color: #10b981;"></i>
                            {{ $user->phone }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Form Section -->
            <form action="{{ url('/mahasiswa/profil') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- File input tersembunyi untuk avatar (ditrigger dari tombol ganti foto di kiri) -->
                <input type="file" id="avatarFileInput" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp"
                       onchange="previewAvatarFile(this)" style="display:none;">

                <!-- Informasi Dasar -->
                <div class="form-section-card">
                    <div class="form-section-title">
                        <i class="fa-solid fa-user"></i> Informasi Dasar
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required
                                   oninput="document.getElementById('previewName').textContent = this.value || 'Nama Anda'">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                            <input type="text" class="form-input" value="{{ $user->nim ?? '-' }}" readonly>
                            <p class="form-input-hint">NIM tidak dapat diubah setelah registrasi.</p>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Program Studi / Jurusan</label>
                            <input type="text" name="prodi" class="form-input" value="{{ old('prodi', $user->prodi) }}"
                                   placeholder="Contoh: Teknik Informatika"
                                   oninput="document.getElementById('previewProdi').textContent = this.value || 'Prodi belum diatur'">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Angkatan / Tahun Masuk</label>
                            <input type="text" name="angkatan" class="form-input" value="{{ old('angkatan', $user->angkatan) }}"
                                   placeholder="Contoh: 2022">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bio / Deskripsi Singkat</label>
                        <textarea name="bio" class="form-textarea" placeholder="Ceritakan sedikit tentang diri Anda, keahlian, dan minat..." maxlength="500">{{ old('bio', $user->bio) }}</textarea>
                        <p class="form-input-hint">Maksimal 500 karakter. Ditampilkan di halaman profil publik Anda.</p>
                    </div>
                </div>

                <!-- Kontak & Sosial -->
                <div class="form-section-card">
                    <div class="form-section-title">
                        <i class="fa-solid fa-link"></i> Kontak & Tautan Sosial
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label"><i class="fa-brands fa-whatsapp" style="color:#25d366;"></i> Nomor HP / WhatsApp</label>
                            <input type="text" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}"
                                   placeholder="+62 812 3456 7890">
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fa-brands fa-github" style="color: #1e293b;"></i> GitHub URL / Portofolio Web</label>
                            <input type="url" name="github_url" class="form-input" value="{{ old('github_url', $user->github_url) }}"
                                   placeholder="https://github.com/username">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 14px;">
                        <label class="form-label"><i class="fa-solid fa-envelope" style="color:#6366f1;"></i> Email</label>
                        <input type="email" class="form-input" value="{{ $user->email }}" readonly>
                        <p class="form-input-hint">Email tidak dapat diubah.</p>
                    </div>
                </div>

                <!-- Ganti Password -->
                <div class="form-section-card">
                    <div class="form-section-title">
                        <i class="fa-solid fa-lock"></i> Ganti Password
                    </div>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 16px;">
                        Kosongkan jika tidak ingin mengubah password.
                    </p>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Password Baru</label>
                            <div style="position: relative;">
                                <input type="password" name="password" id="newPasswordInput" class="form-input"
                                       placeholder="Minimal 6 angka/huruf" minlength="6" style="padding-right: 42px;">
                                <button type="button" onclick="togglePassVis('newPasswordInput', this)"
                                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-muted);">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <div style="position: relative;">
                                <input type="password" name="password_confirmation" id="confirmPasswordInput" class="form-input"
                                       placeholder="Ulangi kata sandi" minlength="6" style="padding-right: 42px;">
                                <button type="button" onclick="togglePassVis('confirmPasswordInput', this)"
                                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-muted);">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <a href="{{ url('/mahasiswa/dashboard') }}" class="btn-cancel">
                        <i class="fa-solid fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn-save-profile">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Toggle password visibility
        function togglePassVis(inputId, btn) {
            const input = document.getElementById(inputId);
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            btn.querySelector('i').className = isPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
        }

        // Preview avatar file upload
        function previewAvatarFile(input) {
            const file = input.files[0];
            if (!file) return;

            // Validate file size (max 4MB)
            if (file.size > 4 * 1024 * 1024) {
                alert('Ukuran file maksimal 4MB. Silakan pilih gambar yang lebih kecil.');
                input.value = '';
                return;
            }

            // Preview in sidebar
            const reader = new FileReader();
            reader.onload = function(e) {
                const avatarBox = document.getElementById('previewAvatar');
                avatarBox.innerHTML = `<img src="${e.target.result}" id="previewAvatarImg" style="width:100%;height:100%;object-fit:cover;" alt="Preview">`;
            };
            reader.readAsDataURL(file);

            // Show file info banner
            const infoBar = document.getElementById('avatarFileInfo');
            const nameEl  = document.getElementById('avatarFileName');
            infoBar.classList.add('show');
            nameEl.textContent = `📷 ${file.name} (${(file.size / 1024).toFixed(0)} KB)`;
        }

        // Preview avatar from URL input
        function previewAvatarFromUrl(url) {
            url = url.trim();
            if (!url) return;
            if (!url.startsWith('http://') && !url.startsWith('https://')) {
                url = 'https://' + url;
            }
            const avatarBox = document.getElementById('previewAvatar');
            avatarBox.innerHTML = `<img src="${url}" id="previewAvatarImg" style="width:100%;height:100%;object-fit:cover;" alt="Preview" onerror="this.onerror=null; this.parentElement.innerHTML='<span id=\'previewAvatarInitials\'>{{ strtoupper(substr($user->name, 0, 2)) }}</span>';">`;
        }

        // Clear avatar file selection
        function clearAvatarFile() {
            const input = document.getElementById('avatarFileInput');
            input.value = '';
            document.getElementById('avatarFileInfo').classList.remove('show');

            // Restore preview to initial state
            const avatarBox = document.getElementById('previewAvatar');
            const currentAvatarUrl = @json($user->avatar_url);

            if (currentAvatarUrl) {
                const isExternal = currentAvatarUrl.startsWith('http');
                const src = isExternal ? currentAvatarUrl : '{{ asset("") }}' + currentAvatarUrl;
                avatarBox.innerHTML = `<img src="${src}" id="previewAvatarImg" style="width:100%;height:100%;object-fit:cover;" alt="Avatar">`;
            } else {
                const name = document.getElementById('previewName').textContent;
                const initials = name.substring(0, 2).toUpperCase();
                avatarBox.innerHTML = `<span id="previewAvatarInitials">${initials}</span>`;
            }
        }
    </script>
</body>
</html>
