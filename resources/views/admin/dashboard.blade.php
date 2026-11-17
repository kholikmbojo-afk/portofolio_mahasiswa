<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel — Kurasi Karya &amp; Manajemen Mahasiswa</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #064e3b;
            --sidebar-hover: #047857;
            --sidebar-active: #f0dc9e;
            --body-bg: #d7e3dc;
            --card-bg: #ffffff;
            --border-color: #b2c5b9;
            --text-main: #064e3b;
            --text-muted: #3a5b4e;
            --accent-gold: #f0dc9e;
            --accent-gold-hover: #e0c67e;
            --accent-gold-light: #faf4e1;
            --accent-gold-soft: #fcf9f0;
            --accent-blue: #0284c7;
            --accent-green: #10b981;
            --accent-amber: #f59e0b;
            --accent-purple: #6366f1;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        aside.admin-sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            border-right: 2px solid rgba(255, 255, 255, 0.12);
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
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .brand-title-text {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

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
            gap: 12px;
            padding: 11px 16px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }

        .nav-menu-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .nav-menu-link:hover {
            color: #ffffff;
            background: var(--sidebar-hover);
        }

        .nav-menu-link.active {
            color: var(--sidebar-bg);
            background: var(--sidebar-active);
            box-shadow: 0 4px 14px rgba(240, 220, 158, 0.4);
        }

        .nav-menu-link .badge-counter {
            margin-left: auto;
            background: #ffffff;
            color: var(--accent-gold);
            font-size: 0.72rem;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 50px;
        }

        .sidebar-bottom-action {
            padding: 16px 14px;
            border-top: 2px solid rgba(255, 255, 255, 0.14);
        }

        .btn-sidebar-logout {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 10px 16px;
            background: transparent;
            border: none;
            color: #94a3b8;
            font-size: 0.92rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-sidebar-logout:hover {
            background: rgba(240, 220, 158, 0.2);
            color: #f87171;
        }

        /* Main Workspace */
        main.admin-workspace {
            margin-left: 250px;
            flex: 1;
            padding: 28px 40px 60px;
            min-width: 0;
            border-left: 2px solid var(--border-color);
        }

        /* Top Bar — Sejajar: Judul kiri, Aksi kanan pojok */
        .workspace-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
            flex-wrap: nowrap;
        }

        .workspace-header-left {
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 0;
            flex-shrink: 1;
        }

        .page-header-title {
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.02em;
            line-height: 1.2;
            margin: 0;
            white-space: nowrap;
        }

        .page-header-desc {
            font-size: 0.84rem;
            color: var(--text-muted);
            font-weight: 500;
            line-height: 1.4;
            margin: 0;
        }

        .workspace-topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: nowrap;
            flex-shrink: 0;
            margin-left: auto;
        }

        .btn-topbar-web {
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            color: var(--text-main);
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .btn-topbar-web:hover {
            border-color: var(--accent-gold);
            color: var(--accent-gold);
        }

        .topbar-notification-btn {
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
            justify-content: center;
            color: var(--text-muted);
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }

        .topbar-notification-btn:hover {
            color: var(--text-main);
            background: #f1f5f9;
            border-color: #a0a8b4;
        }

        .notification-pulse-dot {
            position: absolute;
            top: -2px;
            right: -2px;
            min-width: 18px;
            height: 18px;
            background: #ef4444;
            color: #ffffff;
            border-radius: 50px;
            font-size: 0.68rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ffffff;
            padding: 0 4px;
        }

        .notification-dropdown-wrap {
            position: relative;
        }

        .notification-dropdown-panel {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            width: 350px;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(25, 25, 23, 0.18);
            border: 1.5px solid #c4cad4;
            z-index: 100;
            overflow: hidden;
            animation: fadeInDrop 0.2s ease;
        }

        .notification-dropdown-panel.show {
            display: block;
        }

        @keyframes fadeInDrop {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .notif-header {
            padding: 14px 18px;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f4f6f9;
        }

        .notif-badge-pill {
            background: rgba(239, 68, 68, 0.12);
            color: #ef4444;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 50px;
            margin-left: 6px;
        }

        .btn-mark-read {
            background: none;
            border: none;
            color: var(--accent-gold);
            font-size: 0.76rem;
            font-weight: 700;
            cursor: pointer;
            padding: 0;
        }

        .btn-mark-read:hover {
            text-decoration: underline;
        }

        .notif-list-body {
            max-height: 360px;
            overflow-y: auto;
        }

        .notif-item {
            padding: 12px 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-bottom: 1.5px solid var(--border-color);
            transition: background 0.2s ease;
        }

        .notif-item:hover {
            background: #f8fafc;
        }

        .notif-item.unread {
            background: rgba(237, 217, 163, 0.12);
        }

        .notif-icon-box {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .notif-text-wrap {
            flex-grow: 1;
            min-width: 0;
        }

        .notif-title-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 3px;
        }

        .notif-item-title {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--text-dark);
        }

        .notif-time-ago {
            font-size: 0.72rem;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .notif-item-msg {
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.4;
            margin: 0;
            word-break: break-word;
        }

        .notif-empty-state {
            padding: 35px 20px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.88rem;
        }

        .user-profile-capsule {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.88rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
            border: 2px solid rgba(255,255,255,0.35);
            flex-shrink: 0;
        }

        .user-text-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .user-name-title {
            font-weight: 800;
            font-size: 0.88rem;
            color: var(--text-main);
            white-space: nowrap;
        }

        .user-role-sub {
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 600;
            white-space: nowrap;
        }

        /* Page Title Row (Compatibility) */
        .page-header-row {
            display: none;
        }

        .btn-primary-action {
            background: linear-gradient(135deg, var(--accent-gold-light), var(--accent-gold));
            color: var(--text-main);
            border: 1.5px solid rgba(224, 198, 126, 0.6);
            padding: 7px 16px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(237, 217, 163, 0.35);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .btn-primary-action:hover {
            background: var(--accent-gold-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(237, 217, 163, 0.5);
        }

        /* Alerts */
        .alert-box {
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1.5px solid #a7f3d0;
        }

        .alert-info {
            background: #eff6ff;
            color: #1e40af;
            border: 1.5px solid #bfdbfe;
        }

        /* Stat Cards Grid — 2 Baris × 3 Kolom (Sesuai Mahasiswa Dashboard) */
        .stat-cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }

        .stat-card-box {
            background: #ffffff;
            border-radius: 14px;
            padding: 16px 20px 14px;
            border: 1.5px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(6, 78, 59, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 116px;
            position: relative;
            overflow: hidden;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .stat-card-box:hover {
            box-shadow: 0 8px 22px rgba(6, 78, 59, 0.12), 0 2px 6px rgba(0, 0, 0, 0.04);
            border-color: #10b981;
            transform: translateY(-2px);
        }

        .stat-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .stat-icon-circle {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        .stat-card-box:hover .stat-icon-circle {
            transform: scale(1.08);
        }

        /* Icon color variants */
        .stat-icon-blue {
            background: linear-gradient(135deg, #fde8e7, #fecaca);
            color: #c0352c;
            border: 1px solid #f5b8b5;
        }

        .stat-icon-green {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .stat-icon-amber {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .stat-icon-purple {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .stat-icon-rose {
            background: linear-gradient(135deg, #fff1f2, #ffe4e6);
            color: #e11d48;
            border: 1px solid #fecdd3;
        }

        .stat-label-text {
            font-size: 0.71rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-value-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1;
            letter-spacing: -0.03em;
            margin: 6px 0 8px;
        }

        .stat-card-footer {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .stat-subtext {
            font-size: 0.72rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 9px;
            border-radius: 6px;
        }

        .stat-subtext.text-emerald {
            color: #059669;
            background: #ecfdf5;
            border: 1px solid #d1fae5;
        }

        .stat-subtext.text-rose {
            color: #e11d48;
            background: #fff1f2;
            border: 1px solid #ffe4e6;
        }

        .stat-subtext.text-amber {
            color: #d97706;
            background: #fffbeb;
            border: 1px solid #fef3c7;
        }

        .stat-subtext.text-danger {
            color: #dc2626;
            background: #fef2f2;
            border: 1px solid #fee2e2;
        }

        .stat-subtext.text-muted {
            color: #64748b;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        /* Legacy compat - old classes still referenced in existing stat info group */
        .stat-info-group {
            display: flex;
            flex-direction: column;
        }

        .stat-trend-indicator {
            font-size: 0.76rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .trend-up { color: #16a34a; }
        .trend-down { color: #dc2626; }

        /* Filter Toolbar (Sesuai Gambar Referensi) */
        .table-filter-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 20px;
            padding-top: 4px;
            flex-wrap: wrap;
        }

        .search-input-wrapper {
            position: relative;
            flex: 1;
            min-width: 260px;
            max-width: 380px;
        }

        .search-input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .search-input-field {
            width: 100%;
            padding: 9px 14px 9px 38px;
            border-radius: 10px;
            border: 1.5px solid var(--border-color);
            background: var(--card-bg);
            font-size: 0.9rem;
            font-family: inherit;
            color: var(--text-main);
            outline: none;
            transition: all 0.2s ease;
        }

        .search-input-field:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 3px rgba(237, 217, 163, 0.25);
        }

        .filter-controls-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-filter-select {
            padding: 9px 14px;
            border-radius: 10px;
            border: 1.5px solid var(--border-color);
            background: var(--card-bg);
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-main);
            outline: none;
            cursor: pointer;
        }

        .btn-filter-icon {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: 10px;
            border: 1.5px solid var(--border-color);
            background: var(--card-bg);
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-main);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-filter-icon:hover {
            background: #f1f5f9;
        }

        /* Modern Table Card (Sesuai Gambar Referensi) */
        .modern-table-card {
            background: var(--card-bg);
            border-radius: 14px;
            border: 1.5px solid var(--border-color);
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(6, 78, 59, 0.08), 0 1px 3px rgba(0, 0, 0, 0.04);
            margin-bottom: 24px;
        }

        table.modern-datatable {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        table.modern-datatable th {
            padding: 13px 18px;
            background: #f1f5f3;
            color: #334155;
            font-size: 0.76rem;
            font-weight: 800;
            border-bottom: 2px solid var(--border-color);
            white-space: nowrap;
            letter-spacing: 0.04em;
        }

        table.modern-datatable th i.sort-caret {
            font-size: 0.7rem;
            margin-left: 4px;
            opacity: 0.5;
        }

        table.modern-datatable td {
            padding: 15px 18px;
            border-bottom: 1.5px solid var(--border-color);
            font-size: 0.9rem;
            vertical-align: middle;
        }

        table.modern-datatable tbody tr:hover {
            background: #f8fafc;
        }

        table.modern-datatable tr:last-child td {
            border-bottom: none;
        }

        /* Table Components */
        .item-identity-cell {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .table-thumb-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            color: #ffffff;
            flex-shrink: 0;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        /* Avatar khusus mahasiswa (bulat, lebih besar) */
        .mhs-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            font-weight: 800;
            color: #ffffff;
            flex-shrink: 0;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.18);
            letter-spacing: 0.5px;
            border: 2px solid rgba(255,255,255,0.4);
        }

        .item-text-block {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
            gap: 3px;
        }

        .item-primary-name {
            font-weight: 700;
            font-size: 0.93rem;
            color: var(--text-main);
            letter-spacing: -0.01em;
        }

        .item-secondary-sub {
            font-size: 0.78rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Badge NIM kecil */
        .nim-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #f1f5f9;
            color: #475569;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            width: fit-content;
        }

        /* Status Pills (Sesuai Gambar: bulat ● Active / Pending / Inactive) */
        .status-dot-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-dot-pill.active, .status-dot-pill.approved {
            background: #dcfce7;
            color: #15803d;
        }

        .status-dot-pill.pending {
            background: #fef3c7;
            color: #b45309;
        }

        .status-dot-pill.inactive, .status-dot-pill.rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        .dot-circle {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        /* Role / Category Badge Pills */
        .role-pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .badge-purple {
            background: #ede9fe;
            color: #6d28d9;
        }

        .badge-blue {
            background: #e0f2fe;
            color: #0369a1;
        }

        .badge-amber {
            background: #fef3c7;
            color: #b45309;
        }

        .badge-slate {
            background: #f1f5f9;
            color: #334155;
        }

        /* Action Buttons */
        .btn-table-action-dots {
            background: transparent;
            border: 1px solid transparent;
            color: var(--text-muted);
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-table-action-dots:hover {
            background: #f1f5f9;
            color: var(--text-main);
            border-color: var(--border-color);
        }

        .btn-quick-acc {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-quick-acc:hover {
            background: #bbf7d0;
            color: #14532d;
        }

        .btn-quick-reject {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-quick-reject:hover {
            background: #fecaca;
        }

        /* Table Pagination Footer (Sesuai Gambar) */
        .table-pagination-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: #f4f6f9;
            border-top: 2px solid var(--border-color);
            font-size: 0.88rem;
            color: var(--text-muted);
        }

        .pagination-pages-group {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-page-nav {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1.5px solid var(--border-color);
            background: #ffffff;
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .btn-page-nav:hover {
            background: #f1f5f9;
        }

        .btn-page-nav.active {
            background: var(--accent-gold);
            color: #ffffff;
            border-color: var(--accent-gold);
        }

        /* Reject Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-card {
            background: #ffffff;
            border-radius: 16px;
            width: 100%;
            max-width: 520px;
            padding: 28px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.22);
            border: 1.5px solid var(--border-color);
        }

        @media (max-width: 1024px) {
            .stat-cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            aside.admin-sidebar {
                width: 70px;
            }
            aside.admin-sidebar .brand-title-text,
            aside.admin-sidebar .nav-menu-link span,
            aside.admin-sidebar .btn-sidebar-logout span,
            aside.admin-sidebar .badge-counter {
                display: none;
            }
            main.admin-workspace {
                margin-left: 70px;
                padding: 16px 20px;
            }
            .stat-cards-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Compact Header Toggle Capsule — Pill Style (Topbar) */
        .header-toggle-capsule {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 12px;
            border-radius: 50px;
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            cursor: pointer;
            user-select: none;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-main);
            white-space: nowrap;
            flex-shrink: 0;
        }

        .header-toggle-capsule:hover {
            border-color: #94a3b8;
            background: #f8fafc;
        }

        .header-toggle-capsule.active {
            border-color: #86efac;
            background: #f0fdf4;
            color: #065f46;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.12);
        }

        .header-toggle-capsule .capsule-label {
            font-size: 0.82rem;
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .switch-toggle-btn {
            position: relative;
            width: 36px;
            height: 20px;
            background-color: #cbd5e1;
            border-radius: 50px;
            transition: background-color 0.25s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 2px solid transparent;
            flex-shrink: 0;
        }

        .switch-toggle-btn.checked {
            background-color: #10b981;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1), 0 2px 8px rgba(16, 185, 129, 0.35);
        }

        .switch-knob {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 12px;
            height: 12px;
            background-color: #ffffff;
            border-radius: 50%;
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.45rem;
            color: #cbd5e1;
        }

        .switch-toggle-btn.checked .switch-knob {
            transform: translateX(16px);
            color: #10b981;
        }

        @keyframes pulseEmerald {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        /* Floating Toast Notification */
        .toast-popup {
            position: fixed;
            top: 28px;
            left: 50%;
            transform: translateX(-50%) translateY(-70px);
            background: #0f172a;
            color: #ffffff;
            padding: 13px 24px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
            z-index: 9999;
            font-size: 0.9rem;
            font-weight: 700;
            opacity: 0;
            pointer-events: none;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            max-width: 90vw;
        }

        .toast-popup.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .toast-popup.toast-success {
            background: linear-gradient(135deg, #065f46, #047857);
            border: 1px solid #34d399;
            box-shadow: 0 15px 35px rgba(5, 150, 105, 0.3);
        }

        .toast-popup.toast-warn {
            background: linear-gradient(135deg, #78350f, #9a3412);
            border: 1px solid #fbbf24;
            box-shadow: 0 15px 35px rgba(180, 83, 9, 0.3);
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
    <!-- Left Sidebar (Sesuai Layout Gambar Referensi) -->
    <aside class="admin-sidebar">
        <a href="{{ url('/') }}" class="sidebar-brand-box">
            <img src="{{ $sicLogo }}" alt="SIC" style="width:40px;height:40px;object-fit:contain;border-radius:8px;background:#ffffff;padding:2px;box-shadow:0 2px 8px rgba(0,0,0,0.15);flex-shrink:0;">
            <div style="display:flex;align-items:center;gap:8px;">
                <span class="brand-title-text" style="font-size:1.3rem;">SIC</span>
                <span style="width:2px;height:16px;background:rgba(255,255,255,0.3);border-radius:2px;"></span>
                <span style="font-size:0.75rem;font-weight:700;color:rgba(255,255,255,0.85);letter-spacing:0.04em;text-transform:uppercase;line-height:1.1;">Admin</span>
            </div>
        </a>

        <ul class="sidebar-nav-menu">
            <li>
                <button type="button" class="nav-menu-link active" id="menuBtnKurasi" onclick="switchView('kurasi')">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                    @if($pendingProjects->count() > 0)
                        <span class="badge-counter">{{ $pendingProjects->count() }}</span>
                    @endif
                </button>
            </li>
            <li>
                <button type="button" class="nav-menu-link" id="menuBtnKarya" onclick="switchView('karya')">
                    <i class="fa-solid fa-box-archive"></i>
                    <span>Katalog Karya</span>
                </button>
            </li>
            <li>
                <button type="button" class="nav-menu-link" id="menuBtnMahasiswa" onclick="switchView('mahasiswa')">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span>Data Mahasiswa</span>
                </button>
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

    <!-- Main Workspace (Sesuai Layout Dashboard Mahasiswa) -->
    <main class="admin-workspace">
        <!-- Top Bar & Page Header (Sejajar & Mentok ke Atas seperti Mahasiswa) -->
        <div class="workspace-topbar">
            <div class="workspace-header-left">
                <h1 class="page-header-title" id="pageTitleText">Dashboard Kurasi</h1>
                <p class="page-header-desc" id="pageDescText">Kelola pengajuan karya mahasiswa, kurasi orisinalitas, dan verifikasi akun.</p>
            </div>

            <div class="workspace-topbar-actions">
                <!-- Buka Katalog Publik -->
                <a href="{{ url('/semua-karya') }}" target="_blank" class="btn-primary-action">
                    <i class="fa-solid fa-compass"></i> Buka Katalog Publik
                </a>

                <!-- Review Otomatis Switch Capsule -->
                <div class="header-toggle-capsule {{ $isAutoReview ? 'active' : '' }}" id="autoReviewHeaderCapsule" onclick="toggleAutoReviewAction(event)" title="Klik untuk On / Off Review Otomatis">
                    <i class="fa-solid {{ $isAutoReview ? 'fa-bolt' : 'fa-shield-halved' }}" id="capsuleIcon" style="font-size: 0.95rem; color: {{ $isAutoReview ? '#10b981' : '#64748b' }};"></i>
                    <span class="capsule-label">Review Otomatis</span>
                    <div class="switch-toggle-btn {{ $isAutoReview ? 'checked' : '' }}" id="autoReviewSwitchBtn" role="switch" aria-checked="{{ $isAutoReview ? 'true' : 'false' }}">
                        <div class="switch-knob">
                            <i class="fa-solid {{ $isAutoReview ? 'fa-check' : 'fa-power-off' }}" id="autoReviewKnobIcon"></i>
                        </div>
                    </div>
                </div>

                <!-- Kunjungi Website -->
                <a href="{{ url('/') }}" target="_blank" class="btn-topbar-web">
                    <i class="fa-solid fa-globe"></i> Kunjungi Website
                </a>

                <!-- Notifikasi Lonceng Admin (Didekatkan ke profil) -->
                <div class="notification-dropdown-wrap">
                    <button type="button" class="topbar-notification-btn" id="adminNotifToggle" onclick="toggleNotifDropdown(event)" title="Notifikasi Antrean">
                        <i class="fa-solid fa-bell"></i>
                        @php
                            $unreadCount = $notifications->where('is_read', false)->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="notification-pulse-dot">{{ $unreadCount }}</span>
                        @endif
                    </button>

                    <div class="notification-dropdown-panel" id="notifDropdownMenu">
                        <div class="notif-header">
                            <div style="font-weight: 800; font-size: 0.95rem; color: var(--text-dark);">
                                <i class="fa-solid fa-bell" style="color: var(--accent-gold);"></i> Notifikasi Admin
                                @if($unreadCount > 0)
                                    <span class="notif-badge-pill">{{ $unreadCount }} Baru</span>
                                @endif
                            </div>
                            @if($unreadCount > 0)
                                <button type="button" class="btn-mark-read" onclick="markAllNotificationsRead(event)">
                                    Tandai dibaca
                                </button>
                            @endif
                        </div>
                        <div class="notif-list-body">
                            @forelse($notifications as $notif)
                                <div class="notif-item {{ $notif->is_read ? 'read' : 'unread' }}">
                                    <div class="notif-icon-box" style="background: {{ $notif->color }}1a; color: {{ $notif->color }};">
                                        <i class="fa-solid {{ $notif->icon }}"></i>
                                    </div>
                                    <div class="notif-text-wrap">
                                        <div class="notif-title-row">
                                            <span class="notif-item-title">{{ $notif->title }}</span>
                                            <span class="notif-time-ago">{{ $notif->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="notif-item-msg">{{ $notif->message }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="notif-empty-state">
                                    <i class="fa-solid fa-bell-slash" style="font-size: 1.8rem; color: #cbd5e1; margin-bottom: 8px;"></i>
                                    <div>Belum ada notifikasi baru</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Profil Admin -->
                <div class="user-profile-capsule">
                    <div class="avatar-circle">AD</div>
                    <div class="user-text-info">
                        <span class="user-name-title">Administrator</span>
                        <span class="user-role-sub">Super Admin Kurator</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Alerts -->
        @if(session('success'))
            <div class="alert-box alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="alert-box alert-info">
                <i class="fa-solid fa-circle-info"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Stat Cards Row - 2 Baris Simpel & Elegan (3 Atas, 3 Bawah - Sesuai Mahasiswa) -->
        <div class="stat-cards-grid">
            <!-- 1. Total Seluruh Karya -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Total Seluruh Karya</span>
                    <div class="stat-icon-circle stat-icon-blue">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['total_karya'] }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext text-emerald">
                        <i class="fa-solid fa-arrow-trend-up"></i> +12% dari bulan lalu
                    </span>
                </div>
            </div>

            <!-- 2. Karya Disetujui (ACC) -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Karya Disetujui (ACC)</span>
                    <div class="stat-icon-circle stat-icon-green">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['approved_karya'] }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext text-emerald">
                        <i class="fa-solid fa-arrow-trend-up"></i> +8% aktif di katalog
                    </span>
                </div>
            </div>

            <!-- 3. Menunggu Review (Kurasi) -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Menunggu Review</span>
                    <div class="stat-icon-circle stat-icon-amber">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['pending_karya'] }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext {{ $stats['pending_karya'] > 0 ? 'text-amber' : 'text-emerald' }}">
                        <i class="fa-solid {{ $stats['pending_karya'] > 0 ? 'fa-clock' : 'fa-circle-check' }}"></i> {{ $stats['pending_karya'] > 0 ? 'Perlu tindakan kurator' : 'Semua telah ditinjau' }}
                    </span>
                </div>
            </div>

            <!-- 4. Mahasiswa Terdaftar -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Mahasiswa Terdaftar</span>
                    <div class="stat-icon-circle stat-icon-purple">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['total_mahasiswa'] }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext text-emerald">
                        <i class="fa-solid fa-user-check"></i> Akun kreator aktif
                    </span>
                </div>
            </div>

            <!-- 5. Total Apresiasi (Likes) -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Total Apresiasi (Suka)</span>
                    <div class="stat-icon-circle stat-icon-rose">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ \App\Models\Project::sum('likes_count') }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext text-rose">
                        <i class="fa-solid fa-heart"></i> Dari pengunjung
                    </span>
                </div>
            </div>

            <!-- 6. Perlu Perbaikan / Ditolak -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Perlu Perbaikan / Ditolak</span>
                    <div class="stat-icon-circle stat-icon-purple">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['rejected_karya'] }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext {{ $stats['rejected_karya'] > 0 ? 'text-danger' : 'text-muted' }}">
                        <i class="fa-solid {{ $stats['rejected_karya'] > 0 ? 'fa-triangle-exclamation' : 'fa-circle-info' }}"></i> {{ $stats['rejected_karya'] > 0 ? 'Karya dengan revisi' : 'Tidak ada revisi' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Floating Toast Popup -->
        <div id="floatingToast" class="toast-popup">
            <i class="fa-solid fa-circle-check" id="toastIcon" style="font-size: 1.2rem;"></i>
            <span id="toastMsg">Pengaturan berhasil diperbarui</span>
        </div>

        <!-- Filter Toolbar (Sesuai Gambar Referensi) -->
        <div class="table-filter-toolbar">
            <div class="search-input-wrapper">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="adminTableSearchInput" class="search-input-field" placeholder="Search by title, student, email..." oninput="filterAdminTable()">
            </div>

            <div class="filter-controls-group">
                <select id="categoryFilterSelect" class="dropdown-filter-select" onchange="filterAdminTable()">
                    <option value="all">All Categories</option>
                    <option value="desain">Desain &amp; UI/UX</option>
                    <option value="website">Website &amp; Web App</option>
                    <option value="seni">Seni &amp; Ilustrasi</option>
                    <option value="fotografi">Fotografis &amp; Sinema</option>
                    <option value="iot">IoT &amp; Robotika</option>
                    <option value="mobile">Aplikasi Mobile</option>
                    <option value="game">Game &amp; Animasi</option>
                    <option value="riset">Riset &amp; Sains</option>
                </select>

                <select id="statusFilterSelect" class="dropdown-filter-select" onchange="filterAdminTable()">
                    <option value="all">All Statuses</option>
                    <option value="approved">Active / Approved</option>
                    <option value="pending">Pending Review</option>
                    <option value="rejected">Rejected</option>
                </select>

                <button type="button" class="btn-filter-icon" onclick="resetFilters()">
                    <i class="fa-solid fa-sliders"></i>
                    <span>Reset</span>
                </button>
            </div>
        </div>

        <!-- SECTION 1: Antrean Kurasi Masuk (Pending Review) -->
        <div id="sectionKurasi" class="admin-content-section">
            <div class="modern-table-card">
                <table class="modern-datatable">
                    <thead>
                        <tr>
                            <th style="width: 40px;"><input type="checkbox"></th>
                            <th>KARYA / MAHASISWA <i class="fa-solid fa-arrow-down-short-wide sort-caret"></i></th>
                            <th>EMAIL &amp; PRODI <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>KATEGORI <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>STATUS <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>TANGGAL <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th style="text-align: right;">AKSI TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody id="pendingTableBody">
                        @forelse($pendingProjects as $item)
                            <tr data-title="{{ strtolower($item->title) }}" data-student="{{ strtolower($item->user->name ?? '') }}" data-cat="{{ $item->category }}" data-status="pending">
                                <td><input type="checkbox"></td>
                                <td>
                                    <div class="item-identity-cell">
                                        <div class="table-thumb-box" style="background: {{ $item->category_gradient }}; overflow: hidden;">
                                            @if($item->image_path)
                                                <img src="{{ $item->image_url ?? (str_starts_with($item->image_path, 'http') ? $item->image_path : asset($item->image_path)) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;" onerror="if(!this.dataset.tried){this.dataset.tried=1; if(this.src.indexOf('/public/')===-1){this.src=this.src.replace('/uploads/','/public/uploads/');}else{this.src=this.src.replace('/public/uploads/','/uploads/');}}else{this.style.display='none';}">
                                            @else
                                                <i class="fa-solid {{ $item->category_icon }}"></i>
                                            @endif
                                        </div>
                                        <div class="item-text-block">
                                            <span class="item-primary-name">{{ $item->title }}</span>
                                            <span class="item-secondary-sub">Kreator: <strong>{{ $item->user->name ?? 'Mahasiswa' }}</strong> (NIM: {{ $item->user->nim ?? '-' }})</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="item-text-block">
                                        <span style="font-weight: 600;">{{ $item->user->email ?? '-' }}</span>
                                        <span class="item-secondary-sub">{{ $item->user->prodi ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-pill-badge badge-purple">{{ $item->category_label }}</span>
                                </td>
                                <td>
                                    <span class="status-dot-pill pending">
                                        <span class="dot-circle"></span> Pending Review
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format('M d, Y') }}</td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 8px;">
                                        <form action="{{ url('/admin/karya/' . $item->id . '/approve') }}" method="POST" style="margin: 0;">
                                            @csrf
                                            <button type="submit" class="btn-quick-acc" title="ACC & Terbitkan">
                                                <i class="fa-solid fa-check"></i> ACC
                                            </button>
                                        </form>

                                        <button type="button" class="btn-quick-reject" onclick="openRejectModal({{ $item->id }}, '{{ addslashes($item->title) }}')">
                                            <i class="fa-solid fa-xmark"></i> Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                    <i class="fa-solid fa-circle-check text-green-500 text-2xl" style="margin-bottom: 8px; display: block;"></i>
                                    Tidak ada karya yang menunggu review saat ini. Semua antrean kurasi telah selesai ditinjau!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="table-pagination-footer">
                    <span>Menampilkan {{ $pendingProjects->count() }} antrean kurasi karya</span>
                    <div class="pagination-pages-group">
                        <button type="button" class="btn-page-nav"><i class="fa-solid fa-chevron-left"></i></button>
                        <button type="button" class="btn-page-nav active">1</button>
                        <button type="button" class="btn-page-nav"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Seluruh Katalog Karya (Approved / Rejected) -->
        <div id="sectionKarya" class="admin-content-section" style="display: none;">
            <div class="modern-table-card">
                <table class="modern-datatable">
                    <thead>
                        <tr>
                            <th style="width: 40px;"><input type="checkbox"></th>
                            <th>KARYA <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>KREATOR MAHASISWA <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>KATEGORI <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>STATUS <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>LIKES <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>TANGGAL <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th style="text-align: right;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="allKaryaTableBody">
                        @foreach($allProjects as $proj)
                            <tr data-title="{{ strtolower($proj->title) }}" data-student="{{ strtolower($proj->user->name ?? '') }}" data-cat="{{ $proj->category }}" data-status="{{ $proj->status }}">
                                <td><input type="checkbox"></td>
                                <td>
                                    <div class="item-identity-cell">
                                        <div class="table-thumb-box" style="background: {{ $proj->category_gradient }}; overflow: hidden;">
                                            @if($proj->image_path)
                                                <img src="{{ $proj->image_url ?? (str_starts_with($proj->image_path, 'http') ? $proj->image_path : asset($proj->image_path)) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;" onerror="if(!this.dataset.tried){this.dataset.tried=1; if(this.src.indexOf('/public/')===-1){this.src=this.src.replace('/uploads/','/public/uploads/');}else{this.src=this.src.replace('/public/uploads/','/uploads/');}}else{this.style.display='none';}">
                                            @else
                                                <i class="fa-solid {{ $proj->category_icon }}"></i>
                                            @endif
                                        </div>
                                        <div class="item-text-block">
                                            <span class="item-primary-name">{{ $proj->title }}</span>
                                            @if($proj->admin_notes)
                                                <span class="item-secondary-sub" style="color: var(--accent-gold);">Catatan: {{ $proj->admin_notes }}</span>
                                            @else
                                                <span class="item-secondary-sub">{{ Str::limit($proj->description, 50) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="item-text-block">
                                        <span style="font-weight: 700;">{{ $proj->user->name ?? 'Mahasiswa' }}</span>
                                        <span class="item-secondary-sub">{{ $proj->user->nim ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-pill-badge badge-blue">{{ $proj->category_label }}</span>
                                </td>
                                <td>
                                    @if($proj->status === 'approved')
                                        <span class="status-dot-pill active">
                                            <span class="dot-circle"></span> Active / ACC
                                        </span>
                                    @elseif($proj->status === 'pending')
                                        <span class="status-dot-pill pending">
                                            <span class="dot-circle"></span> Pending
                                        </span>
                                    @else
                                        <span class="status-dot-pill inactive">
                                            <span class="dot-circle"></span> Rejected
                                        </span>
                                    @endif
                                </td>
                                <td style="font-family: 'Space Mono', monospace; font-weight: 700;">{{ $proj->likes_count }}</td>
                                <td>{{ $proj->created_at->format('M d, Y') }}</td>
                                <td style="text-align: right;">
                                    <form action="{{ url('/admin/karya/' . $proj->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus karya ini dari sistem?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-action-dots" title="Hapus Karya">
                                            <i class="fa-solid fa-trash" style="color: #ef4444;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="table-pagination-footer">
                    <span>Menampilkan {{ $allProjects->count() }} karya mahasiswa</span>
                    <div class="pagination-pages-group">
                        <button type="button" class="btn-page-nav"><i class="fa-solid fa-chevron-left"></i></button>
                        <button type="button" class="btn-page-nav active">1</button>
                        <button type="button" class="btn-page-nav"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: Daftar Mahasiswa Terdaftar (User Management Sesuai Gambar) -->
        <div id="sectionMahasiswa" class="admin-content-section" style="display: none;">
            <div class="modern-table-card">
                <table class="modern-datatable">
                    <thead>
                        <tr>
                            <th style="width: 40px;"><input type="checkbox"></th>
                            <th>USER / MAHASISWA <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>EMAIL KAMPUS <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>PROGRAM STUDI <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>STATUS <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>TOTAL KARYA <i class="fa-solid fa-sort sort-caret"></i></th>
                            <th>JOINED <i class="fa-solid fa-sort sort-caret"></i></th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        @forelse($mahasiswaList as $mhs)
                            <tr data-student="{{ strtolower($mhs->name) }}" data-email="{{ strtolower($mhs->email) }}">
                                <td><input type="checkbox"></td>
                                <td>
                                    <div class="item-identity-cell">
                                        @php
                                            $initials = strtoupper(substr($mhs->name, 0, 1)) . (strpos($mhs->name, ' ') !== false ? strtoupper(substr($mhs->name, strpos($mhs->name, ' ') + 1, 1)) : strtoupper(substr($mhs->name, 1, 1)));
                                            $avatarColors = [
                                                'linear-gradient(135deg, #6366f1, #4f46e5)',
                                                'linear-gradient(135deg, #0ea5e9, #0284c7)',
                                                'linear-gradient(135deg, #10b981, #047857)',
                                                'linear-gradient(135deg, #f59e0b, #d97706)',
                                                'linear-gradient(135deg, #ec4899, #db2777)',
                                                'linear-gradient(135deg, #10b981, #059669)',
                                                'linear-gradient(135deg, #8b5cf6, #7c3aed)',
                                                'linear-gradient(135deg, #14b8a6, #0d9488)',
                                            ];
                                            $colorIndex = ord($mhs->name[0]) % count($avatarColors);
                                        @endphp
                                        <div class="mhs-avatar" style="background: {{ $avatarColors[$colorIndex] }};">
                                            {{ $initials }}
                                        </div>
                                        <div class="item-text-block">
                                            <span class="item-primary-name">{{ $mhs->name }}</span>
                                            <span class="nim-badge"><i class="fa-solid fa-id-card" style="font-size:0.65rem;"></i> {{ $mhs->nim ?? 'NIM belum diisi' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $mhs->email }}</td>
                                <td>
                                    <span class="role-pill-badge badge-slate">{{ $mhs->prodi ?? 'Umum' }}</span>
                                </td>
                                <td>
                                    <span class="status-dot-pill active">
                                        <span class="dot-circle"></span> Active
                                    </span>
                                </td>
                                <td style="font-family: 'Space Mono', monospace; font-weight: 700;">
                                    {{ $mhs->projects_count }} Karya
                                </td>
                                <td>{{ $mhs->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                    Belum ada mahasiswa yang mendaftarkan akun secara mandiri.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="table-pagination-footer">
                    <span>Menampilkan {{ $mahasiswaList->count() }} mahasiswa terdaftar</span>
                    <div class="pagination-pages-group">
                        <button type="button" class="btn-page-nav"><i class="fa-solid fa-chevron-left"></i></button>
                        <button type="button" class="btn-page-nav active">1</button>
                        <button type="button" class="btn-page-nav"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Reject Reason Modal -->
    <div class="modal-overlay" id="rejectModal">
        <div class="modal-card">
            <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--accent-gold); margin-bottom: 6px;">
                Tolak Karya &amp; Beri Catatan Revisi
            </h3>
            <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 18px;" id="rejectModalTitleText"></p>

            <form id="rejectFormAction" method="POST">
                @csrf
                <div style="margin-bottom: 18px;">
                    <label style="display: block; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; color: var(--text-main); margin-bottom: 6px;">
                        Catatan Perbaikan untuk Mahasiswa *
                    </label>
                    <textarea name="admin_notes" rows="4" class="search-input-field" style="padding: 10px; border-radius: 10px; width: 100%;" placeholder="Jelaskan alasan penolakan dan panduan yang harus diperbaiki oleh mahasiswa..." required></textarea>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-topbar-web" onclick="closeRejectModal()">Batal</button>
                    <button type="submit" class="btn-primary-action">
                        Kirim Penolakan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Client Scripts -->
    <script>
        function switchView(viewName) {
            document.querySelectorAll('.admin-content-section').forEach(sec => sec.style.display = 'none');
            document.querySelectorAll('.nav-menu-link').forEach(btn => btn.classList.remove('active'));

            const titleEl = document.getElementById('pageTitleText');
            const descEl = document.getElementById('pageDescText');

            if (viewName === 'kurasi') {
                document.getElementById('sectionKurasi').style.display = 'block';
                document.getElementById('menuBtnKurasi').classList.add('active');
                titleEl.textContent = 'Dashboard Kurasi';
                descEl.textContent = 'Kelola pengajuan karya mahasiswa, kurasi orisinalitas, dan verifikasi akun.';
            } else if (viewName === 'karya') {
                document.getElementById('sectionKarya').style.display = 'block';
                document.getElementById('menuBtnKarya').classList.add('active');
                titleEl.textContent = 'Katalog Seluruh Karya';
                descEl.textContent = 'Daftar seluruh karya mahasiswa baik yang sudah disetujui maupun ditolak.';
            } else if (viewName === 'mahasiswa') {
                document.getElementById('sectionMahasiswa').style.display = 'block';
                document.getElementById('menuBtnMahasiswa').classList.add('active');
                titleEl.textContent = 'Data Mahasiswa';
                descEl.textContent = 'Kelola seluruh akun mahasiswa yang terdaftar secara mandiri.';
            }
        }

        function filterAdminTable() {
            const query = document.getElementById('adminTableSearchInput').value.toLowerCase().trim();
            const cat = document.getElementById('categoryFilterSelect').value;
            const status = document.getElementById('statusFilterSelect').value;

            // Filter on pending and all rows
            document.querySelectorAll('tbody tr[data-title]').forEach(row => {
                const title = row.getAttribute('data-title') || '';
                const student = row.getAttribute('data-student') || '';
                const rowCat = row.getAttribute('data-cat') || '';
                const rowStatus = row.getAttribute('data-status') || '';

                const matchQuery = !query || title.includes(query) || student.includes(query);
                const matchCat = cat === 'all' || rowCat === cat;
                const matchStatus = status === 'all' || rowStatus === status;

                if (matchQuery && matchCat && matchStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function resetFilters() {
            document.getElementById('adminTableSearchInput').value = '';
            document.getElementById('categoryFilterSelect').value = 'all';
            document.getElementById('statusFilterSelect').value = 'all';
            filterAdminTable();
        }

        function openRejectModal(id, title) {
            const form = document.getElementById('rejectFormAction');
            form.action = "{{ url('/admin/karya') }}/" + id + "/reject";
            document.getElementById('rejectModalTitleText').textContent = 'Karya: ' + title;
            document.getElementById('rejectModal').classList.add('active');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.remove('active');
        }

        // Dropdown Notifikasi Admin
        function toggleNotifDropdown(e) {
            e.stopPropagation();
            const panel = document.getElementById('notifDropdownMenu');
            if (panel) {
                panel.classList.toggle('show');
            }
        }

        document.addEventListener('click', function(e) {
            const panel = document.getElementById('notifDropdownMenu');
            const wrap = document.querySelector('.notification-dropdown-wrap');
            if (panel && wrap && !wrap.contains(e.target)) {
                panel.classList.remove('show');
            }
        });

        function markAllNotificationsRead(e) {
            if (e) e.stopPropagation();
            fetch('{{ route("notifikasi.read-all") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    const dot = document.querySelector('.notification-pulse-dot');
                    if (dot) dot.style.display = 'none';
                    const badge = document.querySelector('.notif-badge-pill');
                    if (badge) badge.style.display = 'none';
                    const markBtn = document.querySelector('.btn-mark-read');
                    if (markBtn) markBtn.style.display = 'none';
                    document.querySelectorAll('.notif-item.unread').forEach(el => el.classList.remove('unread'));
                }
            });
        }

        let isAutoReviewActive = {{ $isAutoReview ? 'true' : 'false' }};
        let isTogglingAutoReview = false;

        function toggleAutoReviewAction(e) {
            if (e) e.preventDefault();
            if (isTogglingAutoReview) return;
            isTogglingAutoReview = true;

            const targetState = !isAutoReviewActive;

            // Optimistic UI updates
            updateAutoReviewUI(targetState);

            fetch('{{ route("admin.settings.toggle-auto-review") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ enabled: targetState })
            })
            .then(res => res.json())
            .then(data => {
                isTogglingAutoReview = false;
                if (data.success) {
                    isAutoReviewActive = data.auto_review;
                    updateAutoReviewUI(isAutoReviewActive);
                    showToast(data.message, isAutoReviewActive ? 'success' : 'warn');
                } else {
                    // Revert UI on failure
                    updateAutoReviewUI(isAutoReviewActive);
                    showToast('Gagal mengubah pengaturan review otomatis.', 'warn');
                }
            })
            .catch(err => {
                isTogglingAutoReview = false;
                updateAutoReviewUI(isAutoReviewActive);
                showToast('Terjadi kesalahan koneksi server.', 'warn');
            });
        }

        function updateAutoReviewUI(active) {
            const capsule = document.getElementById('autoReviewHeaderCapsule');
            const icon = document.getElementById('capsuleIcon');
            const switchBtn = document.getElementById('autoReviewSwitchBtn');
            const knobIcon = document.getElementById('autoReviewKnobIcon');

            if (active) {
                if (capsule) capsule.classList.add('active');
                if (icon) {
                    icon.className = 'fa-solid fa-bolt';
                    icon.style.color = '#10b981';
                }
                if (switchBtn) {
                    switchBtn.classList.add('checked');
                    switchBtn.setAttribute('aria-checked', 'true');
                }
                if (knobIcon) knobIcon.className = 'fa-solid fa-check';
            } else {
                if (capsule) capsule.classList.remove('active');
                if (icon) {
                    icon.className = 'fa-solid fa-shield-halved';
                    icon.style.color = '#64748b';
                }
                if (switchBtn) {
                    switchBtn.classList.remove('checked');
                    switchBtn.setAttribute('aria-checked', 'false');
                }
                if (knobIcon) knobIcon.className = 'fa-solid fa-power-off';
            }
        }

        let toastTimeout = null;
        function showToast(msg, type = 'success') {
            const toast = document.getElementById('floatingToast');
            const toastMsg = document.getElementById('toastMsg');
            const toastIcon = document.getElementById('toastIcon');

            if (!toast) return;

            toast.className = 'toast-popup show ' + (type === 'success' ? 'toast-success' : 'toast-warn');
            if (toastMsg) toastMsg.textContent = msg;
            if (toastIcon) {
                toastIcon.className = 'fa-solid ' + (type === 'success' ? 'fa-circle-check' : 'fa-bell');
            }

            if (toastTimeout) clearTimeout(toastTimeout);
            toastTimeout = setTimeout(() => {
                toast.classList.remove('show');
            }, 4000);
        }
    </script>
</body>
</html>
