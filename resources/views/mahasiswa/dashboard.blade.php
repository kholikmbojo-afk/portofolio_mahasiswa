<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creator Panel — Dashboard Mahasiswa</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #064e3b;         /* Hijau Daun Kontras */
            --sidebar-hover: #047857;      /* Hijau Hover */
            --sidebar-active: #f0dc9e;      /* Gold Lembut Agak ke Putih */
            --body-bg: #d7e3dc;            /* Background dengan kontras tegas agar kartu putih #ffffff terlihat jelas */
            --card-bg: #ffffff;
            --border-color: #b2c5b9;
            --text-main: #064e3b;
            --text-muted: #3a5b4e;
            --accent-gold: #f0dc9e;
            --accent-gold-hover: #e0c67e;
            --accent-gold-light: #faf4e1;
            --hero-red: #f0dc9e;
            --hero-red-hover: #e0c67e;
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

        /* Sidebar (Sesuai Desain Panel Referensi) */
        aside.mhs-sidebar {
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
            color: var(--accent-gold);
        }

        /* Main Workspace */
        main.mhs-workspace {
            margin-left: 250px;
            flex: 1;
            padding: 28px 40px 60px;
            min-width: 0;
            border-left: 2px solid var(--border-color);
        }

        /* Top Bar & Page Header (Sejajar & Mentok ke Atas Pojok Kanan) */
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

        /* ===== Notification Dropdown Styling ===== */
        .notification-dropdown-wrap {
            position: relative;
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

        .notification-dropdown-panel {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            width: 340px;
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
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.88rem;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25);
            border: 2px solid rgba(255,255,255,0.4);
            flex-shrink: 0;
            overflow: hidden;
            position: relative;
        }

        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
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
            margin-bottom: 22px;
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

        /* Stat Cards Grid - 2 Baris Simpel, Dipoles & Elegan (3 Atas, 3 Bawah) */
        .stat-cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card-box {
            background: #ffffff;
            border-radius: 14px;
            padding: 16px 18px 14px;
            border: 1.5px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(6, 78, 59, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 115px;
            position: relative;
            overflow: hidden;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .stat-card-box:hover {
            box-shadow: 0 10px 24px rgba(6, 78, 59, 0.14), 0 2px 6px rgba(0, 0, 0, 0.05);
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
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.82rem;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        .stat-card-box:hover .stat-icon-circle {
            transform: scale(1.08);
        }

        .stat-icon-circle.icon-emerald {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .stat-icon-circle.icon-neutral {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .stat-icon-circle.icon-rose {
            background: linear-gradient(135deg, #fff1f2, #ffe4e6);
            color: #e11d48;
            border: 1px solid #fecdd3;
        }

        .stat-icon-circle.icon-amber {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .stat-label-text {
            font-size: 0.71rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-value-number {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1;
            letter-spacing: -0.03em;
            margin: 4px 0 6px;
        }

        .stat-card-footer {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .stat-subtext {
            font-size: 0.7rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 2px 8px;
            border-radius: 6px;
        }

        .stat-subtext.text-emerald {
            color: #065f46;
            background: #ecfdf5;
            border: 1px solid #d1fae5;
        }

        .stat-subtext.text-rose {
            color: #be123c;
            background: #fff1f2;
            border: 1px solid #ffe4e6;
        }

        .stat-subtext.text-amber {
            color: #92400e;
            background: #fffbeb;
            border: 1px solid #fef3c7;
        }

        .stat-subtext.text-danger {
            color: #991b1b;
            background: #fef2f2;
            border: 1px solid #fee2e2;
        }

        .stat-subtext.text-muted {
            color: #475569;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .stat-subtext.text-emerald {
            color: #059669;
        }

        .stat-subtext.text-rose {
            color: #e11d48;
        }

        .stat-subtext.text-amber {
            color: #d97706;
        }

        .stat-subtext.text-danger {
            color: #dc2626;
        }

        .stat-subtext.text-muted {
            color: #64748b;
        }

        /* Filter Toolbar (Sesuai Gambar Referensi) */
        .table-filter-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 16px;
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
            background: #ffffff;
            font-size: 0.9rem;
            font-family: inherit;
            color: var(--text-main);
            outline: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: all 0.2s ease;
        }

        .search-input-field:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.18);
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
            background: #ffffff;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-main);
            outline: none;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        /* Modern Table Card */
        .modern-table-card {
            background: #ffffff;
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
            gap: 12px;
        }

        .table-thumb-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            color: #ffffff;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1.5px solid #e2e8f0;
            overflow: hidden;
        }

        .item-text-block {
            display: flex;
            flex-direction: column;
            line-height: 1.25;
        }

        .item-primary-name {
            font-weight: 700;
            color: var(--text-main);
        }

        .item-secondary-sub {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* Status Dot Pills */
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

        .status-dot-pill.approved {
            background: #dcfce7;
            color: #15803d;
        }

        .status-dot-pill.pending {
            background: #fef3c7;
            color: #b45309;
        }

        .status-dot-pill.rejected {
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

        .btn-table-action-dots {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: var(--text-muted);
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-table-action-dots:hover {
            background: #ffffff;
            color: var(--text-main);
            border-color: #cbd5e1;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

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
            border: 1px solid var(--border-color);
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

        .btn-page-nav.active {
            background: var(--accent-gold);
            color: #ffffff;
            border-color: var(--accent-gold);
        }

        /* Modal Upload Form */
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
            border-radius: 18px;
            width: 100%;
            max-width: 620px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 30px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
        }

        .form-group-item {
            margin-bottom: 16px;
        }

        .form-label-title {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        @media (max-width: 1024px) {
            .stat-cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            aside.mhs-sidebar {
                width: 70px;
            }
            aside.mhs-sidebar .brand-title-text,
            aside.mhs-sidebar .nav-menu-link span,
            aside.mhs-sidebar .btn-sidebar-logout span {
                display: none;
            }
            main.mhs-workspace {
                margin-left: 70px;
                padding: 16px 20px;
            }
            .stat-cards-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Topbar Review Status Pill Indicator */
        .mhs-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            user-select: none;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .mhs-status-pill.active {
            background: #dcfce7;
            color: #065f46;
            border: 1.5px solid #86efac;
        }

        .mhs-status-pill.manual {
            background: #fef3c7;
            color: #92400e;
            border: 1.5px solid #fde68a;
        }

        .mhs-status-pill .pill-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .mhs-status-pill.active .pill-dot {
            background: #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
            animation: pulseEmerald 1.8s infinite;
        }

        .mhs-status-pill.manual .pill-dot {
            background: #f59e0b;
        }

        /* Pinned Status Card in Notification Dropdown */
        .notif-system-card {
            padding: 12px 14px;
            margin: 10px 14px 6px;
            border-radius: 10px;
            font-size: 0.82rem;
            line-height: 1.45;
            transition: all 0.3s ease;
        }

        .notif-system-card.active {
            background: #ecfdf5;
            border: 1.5px solid #a7f3d0;
            color: #065f46;
        }

        .notif-system-card.manual {
            background: #fffbeb;
            border: 1.5px solid #fde68a;
            color: #92400e;
        }

        .notif-system-badge {
            display: flex;
            align-items: center;
            gap: 7px;
            font-weight: 800;
            margin-bottom: 4px;
            font-size: 0.84rem;
        }

        .notif-system-desc {
            font-size: 0.78rem;
            opacity: 0.92;
        }

        /* Mahasiswa Review Status Notice Banner (Pemberitahuan Otomatis / Manual) - Ultra Slim */
        .mhs-review-status-notice {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .mhs-review-status-notice.active {
            background: #f0fdf4;
            border: 1px solid #86efac;
            box-shadow: 0 1px 4px rgba(16, 185, 129, 0.06);
        }

        .mhs-review-status-notice.manual {
            background: #fffdf5;
            border: 1px solid #fde68a;
            box-shadow: 0 1px 4px rgba(245, 158, 11, 0.05);
        }

        .notice-icon-box {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }

        .mhs-review-status-notice.active .notice-icon-box {
            background: #10b981;
            color: #ffffff;
        }

        .mhs-review-status-notice.manual .notice-icon-box {
            background: #fef3c7;
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .notice-text-content {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            min-width: 0;
        }

        .notice-title-row {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .notice-title {
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            white-space: nowrap;
        }

        .mhs-review-status-notice.active .notice-title {
            color: #065f46;
        }

        .mhs-review-status-notice.manual .notice-title {
            color: #78350f;
        }

        .notice-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .notice-status-dot.dot-active {
            background: #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.25);
            animation: pulseEmerald 1.8s infinite;
        }

        .notice-status-dot.dot-manual {
            background: #f59e0b;
        }

        @keyframes pulseEmerald {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .notice-tag-badge {
            font-size: 0.64rem;
            font-weight: 800;
            padding: 1px 7px;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            white-space: nowrap;
        }

        .notice-tag-badge.tag-active {
            background: #10b981;
            color: #ffffff;
        }

        .notice-tag-badge.tag-manual {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .notice-desc {
            font-size: 0.78rem;
            line-height: 1.3;
            margin: 0;
        }

        .mhs-review-status-notice.active .notice-desc {
            color: #047857;
        }

        .mhs-review-status-notice.manual .notice-desc {
            color: #92400e;
        }

        .btn-notice-action {
            background: #10b981;
            color: #ffffff;
            border: none;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.74rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .btn-notice-action:hover {
            background: #059669;
        }

        .btn-notice-action:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        /* Floating Toast Notification in Mahasiswa */
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
        /* Project Type Radio Cards */
        .project-type-radio {
            flex: 1;
            cursor: pointer;
        }

        .project-type-radio input[type="radio"] {
            display: none;
        }

        .type-radio-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 16px 12px;
            border-radius: 12px;
            border: 1.5px solid var(--border-color);
            background: #ffffff;
            text-align: center;
            transition: all 0.2s ease;
        }

        .type-radio-card:hover {
            border-color: #94a3b8;
            background: #f8fafc;
        }

        .project-type-radio input[type="radio"]:checked + .type-radio-card {
            border-color: var(--accent-gold);
            background: rgba(237, 217, 163, 0.15);
            box-shadow: 0 0 0 3px rgba(237, 217, 163, 0.25);
        }

        .project-type-radio input[type="radio"]:checked + .type-radio-card i {
            color: var(--accent-gold);
        }

        /* Collaborator Row */
        .collab-row {
            display: grid;
            grid-template-columns: 1fr 100px 1fr 36px;
            gap: 8px;
            margin-bottom: 8px;
            align-items: center;
        }

        .collab-row input {
            padding: 8px 10px;
            border-radius: 8px;
            border: 1.5px solid var(--border-color);
            font-size: 0.82rem;
            font-family: inherit;
            outline: none;
            background: #ffffff;
            transition: border-color 0.2s ease;
        }

        .collab-row input:focus {
            border-color: var(--accent-gold);
        }

        .btn-remove-collab {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1.5px solid #fecaca;
            background: #fff5f5;
            color: #ef4444;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .btn-remove-collab:hover {
            background: #fee2e2;
            border-color: #ef4444;
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
                <button type="button" class="nav-menu-link active">
                    <i class="fa-solid fa-folder-open"></i>
                    <span>Portofolio Saya</span>
                </button>
            </li>
            <li>
                <button type="button" class="nav-menu-link" onclick="openUploadModal()">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span>Unggah Karya Baru</span>
                </button>
            </li>
            <li>
                <a href="{{ url('/mahasiswa/profil') }}" class="nav-menu-link">
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

    <!-- Main Workspace (Sesuai Layout Gambar Referensi) -->
    <main class="mhs-workspace">
        <!-- Top Bar & Page Header (Sejajar & Mentok ke Atas) -->
        <div class="workspace-topbar">
            <div class="workspace-header-left">
                <h1 class="page-header-title">Portofolio &amp; Pengajuan Karya</h1>
                <p class="page-header-desc">
                    Selamat datang, <strong>{{ $user->name }}</strong> ({{ $user->prodi ?? 'Mahasiswa' }}). Kelola karya Anda di sini.
                </p>
            </div>

            <div class="workspace-topbar-actions">
                <button type="button" class="btn-primary-action" onclick="openUploadModal()">
                    <i class="fa-solid fa-plus"></i> Unggah Karya Baru
                </button>

                <!-- Review Status Pill in Topbar -->
                <div class="mhs-status-pill {{ $isAutoReview ? 'active' : 'manual' }}" id="mhsTopbarStatusPill" title="Status Review Karya Saat Ini">
                    <span class="pill-dot"></span>
                    <i class="fa-solid {{ $isAutoReview ? 'fa-bolt' : 'fa-shield-halved' }}" id="topbarPillIcon"></i>
                    <span class="pill-text" id="topbarPillText">{{ $isAutoReview ? 'Review Otomatis: AKTIF' : 'Kurasi Manual: AKTIF' }}</span>
                </div>

                <a href="{{ url('/') }}" target="_blank" class="btn-topbar-web">
                    <i class="fa-solid fa-globe"></i> Kunjungi Website
                </a>

                <!-- Notifikasi Lonceng Mahasiswa -->
                <div class="notification-dropdown-wrap">
                    <button type="button" class="topbar-notification-btn" id="mhsNotifToggle" onclick="toggleNotifDropdown(event)" title="Notifikasi Saya">
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
                                <i class="fa-solid fa-bell" style="color: var(--hero-red);"></i> Notifikasi
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

                        <!-- Pinned System Status Card in Notification Dropdown -->
                        <div class="notif-system-card {{ $isAutoReview ? 'active' : 'manual' }}" id="notifDropdownStatusCard">
                            <div class="notif-system-badge">
                                <i class="fa-solid {{ $isAutoReview ? 'fa-bolt' : 'fa-shield-halved' }}" id="notifCardIcon"></i>
                                <span id="notifCardTitle">{{ $isAutoReview ? 'Mode Review Otomatis Sedang Aktif ⚡' : 'Mode Kurasi Manual Sedang Aktif 🛡️' }}</span>
                            </div>
                            <div class="notif-system-desc" id="notifCardDesc">
                                {{ $isAutoReview ? 'Admin mengaktifkan review otomatis. Setiap karya baru yang Anda unggah langsung disetujui & tayang otomatis!' : 'Admin mengaktifkan kurasi manual. Karya baru yang diajukan akan ditinjau & diverifikasi kurator terlebih dahulu.' }}
                            </div>
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

                <a href="{{ url('/mahasiswa/profil') }}" class="user-profile-capsule" style="text-decoration: none; cursor: pointer;" title="Klik untuk edit profil & ganti foto">
                    <div class="avatar-circle">
                        @if($user->avatar_url)
                            <img src="{{ str_starts_with($user->avatar_url, 'http') ? $user->avatar_url : asset($user->avatar_url) }}" alt="{{ $user->name }}" onerror="if(!this.dataset.tried){this.dataset.tried=1; if(this.src.indexOf('/public/')===-1){this.src=this.src.replace('/uploads/','/public/uploads/');}else{this.src=this.src.replace('/public/uploads/','/uploads/');}}else{this.parentElement.innerHTML='{{ strtoupper(substr($user->name, 0, 2)) }}';}">
                        @else
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        @endif
                    </div>
                    <div class="user-text-info">
                        <span class="user-name-title">{{ $user->name }} <i class="fa-solid fa-pen-to-square" style="font-size: 0.65rem; color: var(--accent-gold); margin-left: 3px;" title="Edit Profil"></i></span>
                        <span class="user-role-sub">{{ $user->nim ?? 'Mahasiswa Kreator' }}</span>
                    </div>
                </a>
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

        @if($errors->any())
            <div class="alert-box alert-danger" style="background: #fef2f2; border: 1.5px solid #fecaca; color: #991b1b; padding: 14px 18px; border-radius: 12px; margin-bottom: 22px; display: flex; align-items: flex-start; gap: 12px;">
                <i class="fa-solid fa-circle-exclamation" style="font-size: 1.25rem; margin-top: 2px; color: #dc2626; flex-shrink: 0;"></i>
                <div>
                    <div style="font-weight: 800; margin-bottom: 4px;">Pengajuan Karya Belum Berhasil Disimpan:</div>
                    <ul style="margin: 0 0 0 18px; font-size: 0.88rem; line-height: 1.5;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Pemberitahuan Status Review Otomatis / Kurasi Manual untuk Mahasiswa - Ultra Slim -->
        <div class="mhs-review-status-notice {{ $isAutoReview ? 'active' : 'manual' }}" id="mhsReviewStatusNotice">
            <div class="notice-icon-box" id="noticeIconBox">
                <i class="fa-solid {{ $isAutoReview ? 'fa-bolt' : 'fa-shield-halved' }}" id="noticeMainIcon"></i>
            </div>
            <div class="notice-text-content">
                <div class="notice-title-row">
                    <span class="notice-status-dot {{ $isAutoReview ? 'dot-active' : 'dot-manual' }}" id="noticeStatusDot"></span>
                    <span class="notice-title" id="noticeTitleText">
                        {{ $isAutoReview ? 'Sistem Review Otomatis Aktif' : 'Sistem Kurasi Manual Aktif' }}
                    </span>
                    <span class="notice-tag-badge {{ $isAutoReview ? 'tag-active' : 'tag-manual' }}" id="noticeTagBadge">
                        {{ $isAutoReview ? 'Instant ACC' : 'Antrean Kurasi' }}
                    </span>
                </div>
                <span class="notice-desc" id="noticeDescText">
                    @if($isAutoReview)
                        Karya baru langsung disetujui &amp; tayang otomatis di katalog tanpa masa tunggu antrean kurasi.
                    @else
                        Karya baru yang Anda ajukan akan ditinjau &amp; diverifikasi kurator terlebih dahulu sebelum diterbitkan.
                    @endif
                </span>
            </div>
            @if($isAutoReview)
                <button type="button" class="btn-notice-action" id="noticeActionBtn" onclick="openUploadModal()">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Unggah Instan
                </button>
            @endif
        </div>

        <!-- Floating Toast Popup for Real-time Notification -->
        <div id="mhsLiveToast" class="toast-popup">
            <i class="fa-solid fa-circle-check" id="mhsToastIcon" style="font-size: 1.2rem;"></i>
            <span id="mhsToastMsg">Pemberitahuan sistem terbaru</span>
        </div>

        <!-- Stat Cards Row - 2 Baris Simpel & Elegan (3 Atas, 3 Bawah) -->
        <div class="stat-cards-grid">
            <!-- 1. Total Karya Saya -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Total Karya</span>
                    <div class="stat-icon-circle icon-neutral">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['total_karya'] }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext text-emerald">
                        <i class="fa-solid fa-circle-check"></i> Portofolio aktif
                    </span>
                </div>
            </div>

            <!-- 2. Disetujui (ACC) -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Disetujui &amp; Live</span>
                    <div class="stat-icon-circle icon-emerald">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['approved_karya'] }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext text-emerald">
                        <i class="fa-solid fa-arrow-trend-up"></i> Tampil di katalog
                    </span>
                </div>
            </div>

            <!-- 3. Total Suka (Likes) -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Total Suka</span>
                    <div class="stat-icon-circle icon-rose">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['total_likes'] ?? 0 }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext text-rose">
                        <i class="fa-solid fa-heart"></i> Dari pengunjung
                    </span>
                </div>
            </div>

            <!-- 4. Total Dilihat (Views) -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Total Dilihat</span>
                    <div class="stat-icon-circle icon-emerald">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['total_views'] ?? 0 }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext text-emerald">
                        <i class="fa-solid fa-eye"></i> Pembaca karya
                    </span>
                </div>
            </div>

            <!-- 5. Menunggu Review Kurator -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Menunggu Review</span>
                    <div class="stat-icon-circle icon-amber">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['pending_karya'] }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext text-amber">
                        <i class="fa-solid fa-clock"></i> Antrean kurator
                    </span>
                </div>
            </div>

            <!-- 6. Perlu Revisi / Ditolak -->
            <div class="stat-card-box">
                <div class="stat-card-header">
                    <span class="stat-label-text">Perlu Perbaikan</span>
                    <div class="stat-icon-circle icon-neutral">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                </div>
                <div class="stat-value-number">{{ $stats['rejected_karya'] }}</div>
                <div class="stat-card-footer">
                    <span class="stat-subtext {{ $stats['rejected_karya'] > 0 ? 'text-danger' : 'text-muted' }}">
                        <i class="fa-solid {{ $stats['rejected_karya'] > 0 ? 'fa-triangle-exclamation' : 'fa-circle-info' }}"></i> {{ $stats['rejected_karya'] > 0 ? 'Cek catatan revisi' : 'Tidak ada revisi' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Filter Toolbar -->
        <div class="table-filter-toolbar">
            <div class="search-input-wrapper">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="mhsTableSearchInput" class="search-input-field" placeholder="Search my projects by title, category..." oninput="filterMhsTable()">
            </div>

            <div class="filter-controls-group">
                <select id="mhsStatusFilterSelect" class="dropdown-filter-select" onchange="filterMhsTable()">
                    <option value="all">All Statuses</option>
                    <option value="approved">Approved &amp; Live</option>
                    <option value="pending">Pending Review</option>
                    <option value="rejected">Rejected / Revisi</option>
                </select>
            </div>
        </div>

        <!-- Modern Table Card (Sesuai Gambar Referensi) -->
        <div class="modern-table-card">
            <table class="modern-datatable">
                <thead>
                    <tr>
                        <th style="width: 40px;"><input type="checkbox"></th>
                        <th>JUDUL KARYA <i class="fa-solid fa-sort sort-caret"></i></th>
                        <th>KATEGORI <i class="fa-solid fa-sort sort-caret"></i></th>
                        <th>STATUS KURASI <i class="fa-solid fa-sort sort-caret"></i></th>
                        <th>APRESIASI (LIKES) <i class="fa-solid fa-sort sort-caret"></i></th>
                        <th>VIEWS <i class="fa-solid fa-sort sort-caret"></i></th>
                        <th>TANGGAL PENGAJUAN <i class="fa-solid fa-sort sort-caret"></i></th>
                        <th style="text-align: right;">AKSI</th>
                    </tr>
                </thead>
                <tbody id="mhsProjectTableBody">
                    @forelse($myProjects as $item)
                        <tr data-title="{{ strtolower($item->title) }}" data-cat="{{ $item->category }}" data-status="{{ $item->status }}">
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
                                        @if($item->status === 'rejected' && $item->admin_notes)
                                            <span class="item-secondary-sub" style="color: #b91c1c; font-weight: 700;">
                                                <i class="fa-solid fa-triangle-exclamation"></i> Catatan Kurator: {{ $item->admin_notes }}
                                            </span>
                                        @else
                                            <span class="item-secondary-sub">{{ Str::limit($item->description, 55) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="role-pill-badge badge-purple">{{ $item->category_label }}</span>
                            </td>
                            <td>
                                @if($item->status === 'approved')
                                    <span class="status-dot-pill approved">
                                        <span class="dot-circle"></span> Active / ACC
                                    </span>
                                @elseif($item->status === 'pending')
                                    <span class="status-dot-pill pending">
                                        <span class="dot-circle"></span> Pending Review
                                    </span>
                                @else
                                    <span class="status-dot-pill rejected">
                                        <span class="dot-circle"></span> Perlu Revisi
                                    </span>
                                @endif
                            </td>
                            <td style="font-family: 'Space Mono', monospace; font-weight: 700; color: #e11d48; white-space: nowrap;">
                                <i class="fa-solid fa-heart" style="margin-right: 4px;"></i> {{ $item->likes_count }}
                            </td>
                            <td style="font-family: 'Space Mono', monospace; font-weight: 700; color: #047857; font-size: 0.85rem; white-space: nowrap;">
                                <i class="fa-solid fa-eye" style="margin-right: 4px;"></i> {{ $item->views_count ?? 0 }}
                            </td>
                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; align-items: center; gap: 6px;">
                                    @if($item->youtube_url)
                                        <a href="{{ $item->youtube_url }}" target="_blank" class="btn-table-action-dots" title="Tonton di YouTube" style="color: #ef4444;">
                                            <i class="fa-brands fa-youtube"></i>
                                        </a>
                                    @endif

                                    @if($item->drive_url)
                                        <a href="{{ $item->drive_url }}" target="_blank" class="btn-table-action-dots" title="Buka Google Drive" style="color: #0284c7;">
                                            <i class="fa-brands fa-google-drive"></i>
                                        </a>
                                    @endif

                                    @if($item->demo_url)
                                        <a href="{{ $item->demo_url }}" target="_blank" class="btn-table-action-dots" title="Demo Live">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    @endif

                                    <form action="{{ url('/mahasiswa/karya/' . $item->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Hapus karya ini dari portofolio Anda?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-action-dots" title="Tarik / Hapus Karya">
                                            <i class="fa-solid fa-trash" style="color: #ef4444;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 50px 20px; color: var(--text-muted);">
                                <div style="font-size: 2.5rem; color: #10b981; margin-bottom: 12px;">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--text-main); margin-bottom: 6px;">
                                    Belum Ada Karya yang Diunggah
                                </h3>
                                <p style="max-width: 480px; margin: 0 auto 18px; font-size: 0.9rem;">
                                    Mulai bangun reputasi portofoliomu. Klik tombol di bawah untuk mengajukan karya pertamamu ke dewan kurator kampus.
                                </p>
                                <button type="button" class="btn-primary-action" onclick="openUploadModal()">
                                    <i class="fa-solid fa-cloud-arrow-up"></i> Unggah Karya Pertamamu
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="table-pagination-footer">
                <span>Showing {{ $myProjects->count() }} of {{ $myProjects->count() }} works</span>
                <div class="pagination-pages-group">
                    <button type="button" class="btn-page-nav"><i class="fa-solid fa-chevron-left"></i></button>
                    <button type="button" class="btn-page-nav active">1</button>
                    <button type="button" class="btn-page-nav"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </main>

    <!-- Upload Project Modal -->
    <div class="modal-overlay" id="uploadModal" onclick="closeUploadModal(event)">
        <div class="modal-card" onclick="event.stopPropagation()">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-size: 1.35rem; font-weight: 800; color: #064e3b; letter-spacing: -0.01em;">
                    UNGGAH KARYA MAHASISWA
                </h3>
                <button type="button" style="background: none; border: none; font-size: 1.3rem; cursor: pointer; color: var(--text-muted);" onclick="closeUploadModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            @if($errors->any())
                <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 0.88rem; color: #991b1b;">
                    <div style="display: flex; align-items: center; gap: 8px; font-weight: 700; margin-bottom: 6px;">
                        <i class="fa-solid fa-triangle-exclamation" style="color: #ef4444; font-size: 1.1rem;"></i>
                        Ada data pengajuan yang perlu diperbaiki:
                    </div>
                    <ul style="margin: 0 0 0 18px; padding: 0; line-height: 1.5;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="uploadProjectForm" action="{{ url('/mahasiswa/karya/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group-item">
                    <label class="form-label-title">Judul Karya / Inovasi *</label>
                    <input type="text" name="title" class="search-input-field" style="padding: 10px 14px;" placeholder="Contoh: FinTrack: Finansial Pintar Mahasiswa" value="{{ old('title') }}" required>
                </div>

                <div class="form-group-item">
                    <label class="form-label-title">Rumpun Kategori *</label>
                    <select name="category" class="dropdown-filter-select" style="width: 100%; padding: 10px 14px;" required>
                        <option value="">-- Pilih Kategori Karya --</option>
                        <option value="desain" {{ old('category') == 'desain' ? 'selected' : '' }}>Desain &amp; UI/UX</option>
                        <option value="website" {{ old('category') == 'website' ? 'selected' : '' }}>Website &amp; Web App</option>
                        <option value="seni" {{ old('category') == 'seni' ? 'selected' : '' }}>Seni &amp; Ilustrasi</option>
                        <option value="fotografi" {{ old('category') == 'fotografi' ? 'selected' : '' }}>Fotografis &amp; Sinema</option>
                        <option value="iot" {{ old('category') == 'iot' ? 'selected' : '' }}>IoT &amp; Robotika</option>
                        <option value="mobile" {{ old('category') == 'mobile' ? 'selected' : '' }}>Aplikasi Mobile</option>
                        <option value="game" {{ old('category') == 'game' ? 'selected' : '' }}>Game &amp; Animasi</option>
                        <option value="riset" {{ old('category') == 'riset' ? 'selected' : '' }}>Riset &amp; Sains Terapan</option>
                    </select>
                </div>

                <!-- ===== TIPE PROYEK ===== -->
                <div class="form-group-item">
                    <label class="form-label-title">Tipe Proyek *</label>
                    <div style="display: flex; gap: 14px; margin-top: 6px;">
                        <label class="project-type-radio" id="radioIndividu">
                            <input type="radio" name="project_type" value="individu" {{ old('project_type', 'individu') == 'individu' ? 'checked' : '' }} onchange="toggleCollabSection()">
                            <div class="type-radio-card">
                                <i class="fa-solid fa-user" style="font-size: 1.2rem; margin-bottom: 4px;"></i>
                                <span style="font-weight: 700; font-size: 0.88rem;">Proyek Individu</span>
                                <span style="font-size: 0.72rem; color: var(--text-muted);">Dikerjakan sendiri</span>
                            </div>
                        </label>
                        <label class="project-type-radio" id="radioKolaborasi">
                            <input type="radio" name="project_type" value="kolaborasi" {{ old('project_type') == 'kolaborasi' ? 'checked' : '' }} onchange="toggleCollabSection()">
                            <div class="type-radio-card">
                                <i class="fa-solid fa-people-group" style="font-size: 1.2rem; margin-bottom: 4px;"></i>
                                <span style="font-weight: 700; font-size: 0.88rem;">Proyek Kolaborasi</span>
                                <span style="font-size: 0.72rem; color: var(--text-muted);">Tim beranggota</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- ===== SECTION KOLABORATOR (Muncul jika Kolaborasi) ===== -->
                <div id="collabSection" style="display: {{ old('project_type') == 'kolaborasi' ? 'block' : 'none' }}; margin-bottom: 16px;">
                    <div style="background: #f0f2f5; border: 1.5px solid var(--border-color); border-radius: 12px; padding: 16px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-users-gear" style="color: #10b981; font-size: 1rem;"></i>
                                <span style="font-weight: 800; font-size: 0.92rem; color: var(--text-main);">Anggota Tim Kolaborasi</span>
                            </div>
                            <button type="button" onclick="addCollaborator()" style="background: #10b981; color: #fff; border: none; padding: 6px 14px; border-radius: 8px; font-size: 0.78rem; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="fa-solid fa-plus"></i> Tambah Anggota
                            </button>
                        </div>
                        <div id="collabList">
                            <!-- Row kolaborator akan ditambah lewat JS -->
                        </div>
                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 8px;">
                            <i class="fa-solid fa-circle-info"></i> Tambahkan nama, NIM (opsional), dan peran/jobdesk setiap anggota tim. Maksimal 10 anggota.
                        </p>
                    </div>
                </div>

                <div class="form-group-item">
                    <label class="form-label-title">Deskripsi &amp; Konsep Solusi * <span style="font-size:0.75rem; font-weight:500; color:var(--text-muted);">(Minimal 10 karakter)</span></label>
                    <textarea name="description" rows="4" class="search-input-field" style="padding: 10px 14px; width: 100%;" placeholder="Jelaskan latar belakang masalah, inovasi karya, dan hasil pengujiannya..." required minlength="10">{{ old('description') }}</textarea>
                </div>

                <div class="form-group-item">
                    <label class="form-label-title">Medium &amp; Tech Stack (Pisahkan dengan koma)</label>
                    <input type="text" name="tech_stack" class="search-input-field" style="padding: 10px 14px;" placeholder="Contoh: Flutter, Firebase, WebRTC, Figma" value="{{ old('tech_stack') }}">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="form-group-item">
                        <label class="form-label-title">Unggah Foto / Banner Karya (JPG, PNG, WebP)</label>
                        <input type="file" name="image" class="search-input-field" style="padding: 8px 12px; background: #fff;" accept="image/*">
                    </div>

                    <div class="form-group-item">
                        <label class="form-label-title">Atau Tautan Gambar Online (URL)</label>
                        <input type="text" name="image_url" class="search-input-field" style="padding: 10px 14px;" placeholder="https://images.unsplash.com/..." value="{{ old('image_url') }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="form-group-item">
                        <label class="form-label-title">Tautan Demo Live (Opsional)</label>
                        <input type="text" name="demo_url" class="search-input-field" style="padding: 10px 14px;" placeholder="demo-proyek.com atau https://..." value="{{ old('demo_url') }}">
                    </div>

                    <div class="form-group-item">
                        <label class="form-label-title">Repositori GitHub / Dokumen</label>
                        <input type="text" name="github_url" class="search-input-field" style="padding: 10px 14px;" placeholder="github.com/akun/proyek" value="{{ old('github_url') }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="form-group-item">
                        <label class="form-label-title"><i class="fa-brands fa-youtube" style="color: #ef4444;"></i> Link YouTube (Video Karya)</label>
                        <input type="text" name="youtube_url" class="search-input-field" style="padding: 10px 14px;" placeholder="youtube.com/watch?v=..." value="{{ old('youtube_url') }}">
                    </div>

                    <div class="form-group-item">
                        <label class="form-label-title"><i class="fa-brands fa-google-drive" style="color: #0284c7;"></i> Link Google Drive (File/Dokumen)</label>
                        <input type="text" name="drive_url" class="search-input-field" style="padding: 10px 14px;" placeholder="drive.google.com/..." value="{{ old('drive_url') }}">
                    </div>
                </div>

                @if($isAutoReview)
                    <div style="background: linear-gradient(135deg, rgba(220, 252, 231, 0.7), rgba(240, 253, 244, 0.9)); border: 1px solid rgba(16, 185, 129, 0.35); padding: 14px 16px; border-radius: 10px; font-size: 0.84rem; color: #065f46; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
                        <div style="width: 34px; height: 34px; border-radius: 10px; background: #10b981; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.05rem; flex-shrink: 0; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; margin-bottom: 2px;">⚡ Mode Review Otomatis Sedang Aktif!</div>
                            <div>Karya Anda akan <strong>langsung disetujui (Approved)</strong> dan langsung tayang ke katalog publik seketika saat tombol ditekan.</div>
                        </div>
                    </div>
                @else
                    <div style="background: #f1f5f9; padding: 12px 14px; border-radius: 8px; font-size: 0.82rem; color: var(--text-muted); margin-bottom: 20px;">
                        <i class="fa-solid fa-shield-halved" style="color: #64748b; margin-right: 4px;"></i> Karya yang Anda unggah akan masuk ke antrean kurasi admin kampus sebelum dipublikasikan ke katalog publik.
                    </div>
                @endif

                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-topbar-web" onclick="closeUploadModal()">Batal</button>
                    <button type="submit" id="btnSubmitProject" class="btn-primary-action" style="{{ $isAutoReview ? 'background: #10b981; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);' : '' }}">
                        <i class="fa-solid {{ $isAutoReview ? 'fa-bolt' : 'fa-paper-plane' }}" id="submitBtnIcon"></i>
                        <span id="submitBtnText">{{ $isAutoReview ? 'Simpan & Terbitkan Otomatis' : 'Ajukan Karya ke Kurasi' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openUploadModal() {
            document.getElementById('uploadModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeUploadModal(e) {
            if (e && e.target !== e.currentTarget) return;
            document.getElementById('uploadModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // ===== Kolaborasi Toggle & Management =====
        let collabCounter = 0;

        function toggleCollabSection() {
            const isKolaborasi = document.querySelector('input[name="project_type"]:checked').value === 'kolaborasi';
            const section = document.getElementById('collabSection');
            if (!section) return;
            
            section.style.display = isKolaborasi ? 'block' : 'none';

            // Nonaktifkan input jika tersembunyi agar tidak memblokir submit HTML5
            section.querySelectorAll('input').forEach(inp => {
                inp.disabled = !isKolaborasi;
            });

            // Otomatis tambah 1 row pertama kalau belum ada
            if (isKolaborasi && document.getElementById('collabList').children.length === 0) {
                addCollaborator();
            }
        }

        // Buka kembali modal otomatis jika ada error validasi
        @if($errors->any() || session('auto_open_modal') === 'upload')
            document.addEventListener('DOMContentLoaded', function () {
                openUploadModal();
            });
        @endif

        // Loading feedback saat tombol diajukan ditekan
        document.addEventListener('DOMContentLoaded', function () {
            const uploadForm = document.getElementById('uploadProjectForm');
            if (uploadForm) {
                uploadForm.addEventListener('submit', function () {
                    const btn = document.getElementById('btnSubmitProject');
                    const icon = document.getElementById('submitBtnIcon');
                    const txt = document.getElementById('submitBtnText');
                    if (btn) {
                        btn.style.pointerEvents = 'none';
                        if (icon) icon.className = 'fa-solid fa-spinner fa-spin';
                        if (txt) txt.textContent = 'Sedang Mengajukan Karya...';
                        btn.style.opacity = '0.8';
                    }
                });
            }
        });

        function addCollaborator() {
            const list = document.getElementById('collabList');
            if (list.children.length >= 10) {
                alert('Maksimal 10 anggota kolaborasi.');
                return;
            }

            const idx = collabCounter++;
            const row = document.createElement('div');
            row.className = 'collab-row';
            row.id = 'collabRow' + idx;
            row.innerHTML = `
                <input type="text" name="collaborators[${idx}][name]" placeholder="Nama anggota" required>
                <input type="text" name="collaborators[${idx}][nim]" placeholder="NIM">
                <input type="text" name="collaborators[${idx}][jobdesk]" placeholder="Jobdesk / Peran (cth: UI Designer)" required>
                <button type="button" class="btn-remove-collab" onclick="removeCollaborator('collabRow${idx}')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;
            list.appendChild(row);
        }

        function removeCollaborator(rowId) {
            const row = document.getElementById(rowId);
            if (row) row.remove();
        }

        function filterMhsTable() {
            const query = document.getElementById('mhsTableSearchInput').value.toLowerCase().trim();
            const status = document.getElementById('mhsStatusFilterSelect').value;

            document.querySelectorAll('#mhsProjectTableBody tr[data-title]').forEach(row => {
                const title = row.getAttribute('data-title') || '';
                const cat = row.getAttribute('data-cat') || '';
                const rowStatus = row.getAttribute('data-status') || '';

                const matchQuery = !query || title.includes(query) || cat.includes(query);
                const matchStatus = status === 'all' || rowStatus === status;

                if (matchQuery && matchStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Dropdown Notifikasi
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

        // Real-time synchronization for Auto-Review status
        let currentAutoReviewState = {{ $isAutoReview ? 'true' : 'false' }};
        let mhsToastTimeout = null;

        function showMhsToast(msg, type = 'success') {
            const toast = document.getElementById('mhsLiveToast');
            const toastMsg = document.getElementById('mhsToastMsg');
            const toastIcon = document.getElementById('mhsToastIcon');
            if (!toast) return;

            toast.className = 'toast-popup show ' + (type === 'success' ? 'toast-success' : 'toast-warn');
            if (toastMsg) toastMsg.textContent = msg;
            if (toastIcon) {
                toastIcon.className = 'fa-solid ' + (type === 'success' ? 'fa-bolt' : 'fa-shield-halved');
            }

            if (mhsToastTimeout) clearTimeout(mhsToastTimeout);
            mhsToastTimeout = setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }

        function checkLiveReviewStatus() {
            fetch('{{ route("mahasiswa.review-status") }}', {
                headers: { 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                if (data.auto_review !== currentAutoReviewState) {
                    currentAutoReviewState = data.auto_review;
                    updateMhsReviewNotice(currentAutoReviewState, data.title, data.desc);
                    
                    // Show immediate toast notification
                    if (currentAutoReviewState) {
                        showMhsToast('⚡ Pemberitahuan: Admin kampus baru saja mengaktifkan Mode Review Otomatis! Karya Anda akan langsung disetujui.', 'success');
                    } else {
                        showMhsToast('🛡️ Pemberitahuan: Admin kampus baru saja mengaktifkan Kurasi Manual.', 'warn');
                    }
                }

                // Update unread notification pulse dot if changed
                if (data.unread_notifications > 0) {
                    let dot = document.querySelector('.notification-pulse-dot');
                    if (dot) {
                        dot.textContent = data.unread_notifications;
                        dot.style.display = 'flex';
                    }
                }
            })
            .catch(() => {});
        }

        function updateMhsReviewNotice(isAuto, title, desc) {
            const noticeBox = document.getElementById('mhsReviewStatusNotice');
            const mainIcon = document.getElementById('noticeMainIcon');
            const statusDot = document.getElementById('noticeStatusDot');
            const titleEl = document.getElementById('noticeTitleText');
            const tagBadge = document.getElementById('noticeTagBadge');
            const descEl = document.getElementById('noticeDescText');
            let actionBtn = document.getElementById('noticeActionBtn');

            // Topbar Pill Elements
            const topbarPill = document.getElementById('mhsTopbarStatusPill');
            const topbarIcon = document.getElementById('topbarPillIcon');
            const topbarText = document.getElementById('topbarPillText');

            // Notification Dropdown Pinned Card Elements
            const notifCard = document.getElementById('notifDropdownStatusCard');
            const notifCardIcon = document.getElementById('notifCardIcon');
            const notifCardTitle = document.getElementById('notifCardTitle');
            const notifCardDesc = document.getElementById('notifCardDesc');

            if (isAuto) {
                // Update Main Banner
                if (noticeBox) noticeBox.className = 'mhs-review-status-notice active';
                if (mainIcon) mainIcon.className = 'fa-solid fa-bolt';
                if (statusDot) statusDot.className = 'notice-status-dot dot-active';
                if (titleEl) titleEl.textContent = title || 'Pemberitahuan: Sistem Review Otomatis Sedang Aktif ⚡';
                if (tagBadge) {
                    tagBadge.className = 'notice-tag-badge tag-active';
                    tagBadge.textContent = 'Instant ACC';
                }
                if (descEl) {
                    descEl.innerHTML = desc || 'Admin kampus sedang mengaktifkan <strong>Review Otomatis</strong>. Setiap karya baru yang Anda unggah akan <strong>langsung disetujui (Approved)</strong> dan seketika tampil di katalog publik tanpa masa tunggu antrean kurasi!';
                }
                if (!actionBtn && noticeBox) {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.id = 'noticeActionBtn';
                    btn.className = 'btn-notice-action';
                    btn.onclick = openUploadModal;
                    btn.innerHTML = '<i class="fa-solid fa-cloud-arrow-up"></i> Unggah &amp; Terbit Instan';
                    noticeBox.appendChild(btn);
                }

                // Update Topbar Pill
                if (topbarPill) topbarPill.className = 'mhs-status-pill active';
                if (topbarIcon) topbarIcon.className = 'fa-solid fa-bolt';
                if (topbarText) topbarText.textContent = 'Review Otomatis: AKTIF';

                // Update Notification Dropdown Card
                if (notifCard) notifCard.className = 'notif-system-card active';
                if (notifCardIcon) notifCardIcon.className = 'fa-solid fa-bolt';
                if (notifCardTitle) notifCardTitle.textContent = 'Mode Review Otomatis Sedang Aktif ⚡';
                if (notifCardDesc) notifCardDesc.textContent = 'Admin mengaktifkan review otomatis. Setiap karya baru yang Anda unggah langsung disetujui & tayang otomatis!';
            } else {
                // Update Main Banner
                if (noticeBox) noticeBox.className = 'mhs-review-status-notice manual';
                if (mainIcon) mainIcon.className = 'fa-solid fa-shield-halved';
                if (statusDot) statusDot.className = 'notice-status-dot dot-manual';
                if (titleEl) titleEl.textContent = title || 'Pemberitahuan: Sistem Kurasi Manual Sedang Aktif 🛡️';
                if (tagBadge) {
                    tagBadge.className = 'notice-tag-badge tag-manual';
                    tagBadge.textContent = 'Antrean Kurasi';
                }
                if (descEl) {
                    descEl.innerHTML = desc || 'Admin kampus sedang menerapkan <strong>Kurasi Manual</strong>. Karya baru yang Anda ajukan akan masuk ke antrean kurasi dan diverifikasi terlebih dahulu oleh kurator kampus sebelum diterbitkan ke katalog publik.';
                }
                if (actionBtn) {
                    actionBtn.remove();
                }

                // Update Topbar Pill
                if (topbarPill) topbarPill.className = 'mhs-status-pill manual';
                if (topbarIcon) topbarIcon.className = 'fa-solid fa-shield-halved';
                if (topbarText) topbarText.textContent = 'Kurasi Manual: AKTIF';

                // Update Notification Dropdown Card
                if (notifCard) notifCard.className = 'notif-system-card manual';
                if (notifCardIcon) notifCardIcon.className = 'fa-solid fa-shield-halved';
                if (notifCardTitle) notifCardTitle.textContent = 'Mode Kurasi Manual Sedang Aktif 🛡️';
                if (notifCardDesc) notifCardDesc.textContent = 'Admin mengaktifkan kurasi manual. Karya baru yang diajukan akan ditinjau & diverifikasi kurator terlebih dahulu.';
            }
        }

        // Poll every 3 seconds for live changes
        setInterval(checkLiveReviewStatus, 3000);
    </script>
</body>
</html>
