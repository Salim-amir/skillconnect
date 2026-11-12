<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Kelola Pengguna - SkillConnect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --bg: #ffffff;
    --ink: #0a0a0a;
    --mute: #525252;
    --primary: #ff007f;
    --secondary: #7000ff;
    --tertiary: #00d4ff;
    box-sizing: border-box;
}

*{box-sizing:border-box;margin:0;padding:0;}

body {
    background: linear-gradient(180deg,#eef0ff,#f4f1ff 50%,#eaf1ff);
    color: var(--ink);
    font-family: 'Nunito', system-ui, sans-serif;
    line-height: 1.6;
    overflow-x: hidden;
    display: flex;
    min-height: 100vh;
}

a { color: inherit; text-decoration: none; }
a:focus-visible, button:focus-visible { outline: 2px solid var(--secondary); outline-offset: 3px; }

/* ===== SIDEBAR ===== */
.sidebar {
    width: 280px;
    background: #fff;
    border-right: 1.5px solid #e0e3fa;
    display: flex;
    flex-direction: column;
    position: fixed;
    height: 100vh;
    z-index: 100;
}

.sidebar-header {
    padding: 30px 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1.5px solid #f0f2ff;
}

.brand {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 19px;
    letter-spacing: .05em;
}
.brand svg { width: 44px; height: 22px; }
.brand span {
    background: linear-gradient(90deg,#1c2766,#7b6cf6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.sidebar-nav {
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.nav-item {
    padding: 14px 20px;
    border-radius: 12px;
    font-weight: 600;
    color: #4b5686;
    font-size: 15px;
    transition: all .2s;
    border: 1.5px solid transparent;
    display: flex;
    align-items: center;
    gap: 12px;
}

.nav-item svg {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
}

.nav-item:hover {
    background: #f4f6ff;
    color: #1c2766;
}

.nav-item.active {
    background: linear-gradient(90deg, rgba(43,58,143,0.1), rgba(123,108,246,0.1));
    color: #2b3a8f;
    border-color: #d6d9fb;
    font-weight: 700;
}

/* ===== MAIN CONTENT ===== */
.main-content {
    flex: 1;
    margin-left: 280px;
    padding: 30px 40px;
    display: flex;
    flex-direction: column;
}

.top-bar {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 30px;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
}
.user-info {
    text-align: right;
}
.user-info .name {
    font-weight: 700;
    color: #1c2766;
    font-size: 15px;
    line-height: 1.2;
}
.user-info .role {
    font-size: 12px;
    color: #7b6cf6;
    font-weight: 600;
}
.avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f5fe0, #7b6cf6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 18px;
    box-shadow: 0 4px 12px rgba(123,108,246,.4);
    border: 2px solid #fff;
    overflow: hidden;
}
.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ===== PAGE CONTENT ===== */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 28px;
    color: #1c2766;
}

.card {
    background: #fff;
    border: 1.5px solid #e0e3fa;
    border-radius: 18px;
    box-shadow: 0 10px 30px -20px rgba(80,70,200,.2);
    overflow: hidden;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
.data-table th, .data-table td {
    padding: 16px 24px;
    text-align: left;
    border-bottom: 1px solid #edf0ff;
}
.data-table th {
    background: #f8f9ff;
    color: #4b5686;
    font-weight: 700;
    font-family: 'Fredoka', sans-serif;
    border-bottom: 2px solid #e0e3fa;
}
.data-table tr:hover td {
    background: #fcfcff;
}
.data-table tr:last-child td {
    border-bottom: none;
}

.badge {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    display: inline-block;
}
.badge.admin { background: #e5ebff; color: #2b3a8f; }
.badge.member { background: #f4e5ff; color: #7b4fe8; }
.badge.creator { background: #e5ffe5; color: #008000; }

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    border: 1.5px solid transparent;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    transition: .2s;
}
.btn.pri {
    background: linear-gradient(90deg,#2b3a8f,#7b6cf6);
    color: #fff;
    box-shadow: 0 8px 20px -8px rgba(123,108,246,.7);
}
.btn.pri:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px -8px rgba(123,108,246,.8);
}
.btn.danger {
    background: linear-gradient(90deg, #e0244d, #d8000c);
    color: #fff;
    box-shadow: 0 8px 20px -8px rgba(216, 0, 12, 0.55);
}
.btn.danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px -8px rgba(216, 0, 12, 0.7);
}
.btn.ghost {
    background: #eef0ff;
    color: #2b3a8f;
}
.btn.ghost:hover {
    background: #e0e3fa;
}

/* ===== ALERT ===== */
.alert {
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 20px;
    font-weight: 700;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.alert.success { background: #e6f7ed; color: #127345; border: 1.5px solid #b7e4c7; }
.alert.error { background: #fdecec; color: #b00009; border: 1.5px solid #f5b5b5; }

/* ===== ACTION LINKS ===== */
.action-link {
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font-family: 'Nunito', sans-serif;
}
.action-link.view {
    background: linear-gradient(135deg, #4f6ef7, #38bdf8);
    color: #ffffff;
    padding: 4px 11px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .02em;
    line-height: 1.3;
    margin-right: 10px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    box-shadow: 0 3px 8px rgba(79, 110, 247, 0.25);
    transition: all .2s ease;
}
.action-link.view:hover {
    background: linear-gradient(135deg, #3b5bdb, #0ea5e9);
    color: #ffffff;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(79, 110, 247, 0.35);
}
.action-link.edit { color: #2b3a8f; margin-right: 12px; }
.action-link.edit:hover { text-decoration: underline; }
.action-link.delete { color: #d8000c; }
.action-link.delete:hover { text-decoration: underline; }

/* ===== PROFILE PREVIEW CARD IN MODAL ===== */
.profile-modal-wrapper {
    width: 100%;
    max-width: 520px;
    animation: pop .2s ease;
    position: relative;
}
.profile-modal-wrapper .card {
    padding: 32px;
    box-shadow: 0 30px 60px -20px rgba(80,70,200,.5);
}
.card-header-styled {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #f0f2ff;
    padding-bottom: 18px;
    margin-bottom: 24px;
    gap: 12px;
}
.card-header-styled h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 20px;
    color: #1c2766;
    display: flex;
    align-items: center;
    gap: 10px;
}
.role-pill {
    padding: 4px 12px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 800;
    background: #eef0ff;
    color: #4f5fe0;
    text-transform: uppercase;
    letter-spacing: .05em;
}
.profile-hero {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 20px 0;
    border-bottom: 1.5px dashed #e0e3fa;
    margin-bottom: 24px;
}
.big-avatar {
    width: 96px;
    height: 96px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f5fe0, #7b6cf6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 42px;
    box-shadow: 0 8px 25px rgba(123,108,246,.35);
    margin-bottom: 16px;
    border: 4px solid #fff;
    overflow: hidden;
}
.big-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.profile-hero h3 {
    font-family: 'Fredoka', sans-serif;
    font-size: 22px;
    color: #1c2766;
    margin-bottom: 4px;
}
.profile-hero .email-badge {
    font-size: 14px;
    color: #7b6cf6;
    background: #f4f6ff;
    padding: 4px 14px;
    border-radius: 99px;
    font-weight: 600;
    margin-top: 4px;
}
.info-row {
    margin-bottom: 18px;
}
.info-row label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: #8f9bd8;
    font-weight: 800;
    display: block;
    margin-bottom: 4px;
}
.info-row .val {
    font-size: 15px;
    color: #2b3a8f;
    font-weight: 600;
    word-break: break-all;
}
.link-portfolio {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #7b6cf6;
    background: #f4f1ff;
    padding: 8px 14px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    border: 1px solid #e2dcff;
    transition: .2s;
}
.link-portfolio:hover {
    background: #7b6cf6;
    color: #fff;
}
.skills-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 12px;
}
.skill-tag {
    display: inline-flex;
    align-items: center;
    background: #fff;
    border: 1.5px solid #d6d9fb;
    border-radius: 12px;
    padding: 8px 14px;
    gap: 10px;
    box-shadow: 0 4px 10px -6px rgba(80,70,200,.15);
}
.skill-tag .skill-name {
    font-weight: 700;
    color: #1c2766;
    font-size: 14px;
}
.skill-tag .level-badge {
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 6px;
    font-weight: 800;
    text-transform: uppercase;
}
.level-Beginner { background: #eef0ff; color: #5a6696; }
.level-Intermediate { background: #e5ffe5; color: #198754; }
.level-Advanced { background: #ffe5f1; color: #d63384; }

/* ===== MODAL ===== */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(28, 39, 102, .5);
    backdrop-filter: blur(3px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    padding: 20px;
}
.modal-overlay.active { display: flex; }
.modal {
    background: #fff;
    border-radius: 18px;
    width: 100%;
    max-width: 460px;
    box-shadow: 0 30px 60px -20px rgba(80,70,200,.5);
    overflow: hidden;
    animation: pop .2s ease;
}
@keyframes pop {
    from { transform: scale(.95); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
.modal-header {
    padding: 22px 26px;
    border-bottom: 1.5px solid #edf0ff;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.modal-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 20px;
    color: #1c2766;
}
.modal-close {
    background: none;
    border: none;
    font-size: 26px;
    line-height: 1;
    color: #8f9bd8;
    cursor: pointer;
}
.modal-close:hover { color: #1c2766; }
.modal-body {
    padding: 24px 26px;
}
.modal-footer {
    padding: 18px 26px;
    border-top: 1.5px solid #edf0ff;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* Delete Modal Icon Styling */
.delete-icon-box {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #fdecec;
    color: #d8000c;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    border: 2px solid #f5b5b5;
}
.delete-user-highlight {
    display: inline-block;
    background: #f4f6ff;
    color: #1c2766;
    font-weight: 800;
    padding: 2px 10px;
    border-radius: 8px;
    border: 1px solid #d6d9fb;
}

/* ===== FORM ===== */
.form-group {
    margin-bottom: 18px;
}
.form-group label {
    display: block;
    font-weight: 700;
    font-size: 13px;
    color: #4b5686;
    margin-bottom: 6px;
}
.form-group input,
.form-group select {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid #e0e3fa;
    border-radius: 10px;
    font-family: 'Nunito', sans-serif;
    font-size: 14px;
    color: #1c2766;
    transition: .2s;
}
.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: #7b6cf6;
    box-shadow: 0 0 0 3px rgba(123,108,246,.15);
}
.form-hint {
    font-size: 12px;
    color: #8f9bd8;
    font-weight: 600;
    margin-top: 4px;
    display: block;
}
.form-error {
    color: #d8000c;
    font-size: 12px;
    font-weight: 700;
    margin-top: 4px;
    display: block;
}

/* ===== LOGOUT ===== */
.sidebar-footer {
    margin-top: auto;
    padding: 16px;
    border-top: 1.5px solid #f0f2ff;
}
.nav-item.logout {
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    color: #d8000c;
}
.nav-item.logout svg { color: #d8000c; }
.nav-item.logout:hover {
    background: #fdecec;
    color: #b00009;
}
.nav-item.logout:hover svg { color: #b00009; }

/* ===== PAGINATION ===== */
.pagination-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    padding: 16px 24px;
    border-top: 1.5px solid #edf0ff;
}

.pagination-info {
    font-size: 13px;
    color: #8f9bd8;
    font-weight: 600;
}

.pagination-controls {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}

.page-btn {
    min-width: 36px;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #d6d9fb;
    background: #fff;
    color: #4b5686;
    font-size: 13px;
    font-weight: 700;
    text-align: center;
    transition: .2s;
}

a.page-btn:hover {
    background: #f4f6ff;
    color: #1c2766;
}

.page-btn.active {
    background: linear-gradient(90deg,#2b3a8f,#7b6cf6);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 6px 16px -8px rgba(123,108,246,.7);
}

.page-btn.disabled {
    opacity: .45;
    cursor: not-allowed;
}

/* ===== INJECTED RESPONSIVE CSS ===== */
.table-responsive {
    width: 100%;
    overflow-x: hidden;
}

.action-buttons {
    display: inline-flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.action-link.view,
.action-link.edit {
    margin-right: 0;
}

@media (max-width: 1150px) {
    .data-table th,
    .data-table td {
        padding: 13px 14px;
        font-size: 13.5px;
    }
    .data-table td[data-label="Alamat Email"] {
        word-break: break-all;
    }
}

@media (max-width: 992px) {
    .main-content {
        margin-left: 0 !important;
        padding: 16px !important;
        padding-top: 76px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        overflow-x: hidden !important;
    }
    .top-bar { display: none !important; }
    .page-header {
        margin-bottom: 16px;
    }
    .page-title {
        font-size: 22px;
    }
}

@media (max-width: 768px) {
    .main-content > .card {
        background: transparent;
        border: none;
        box-shadow: none;
        border-radius: 0;
        overflow: visible;
    }

    .data-table,
    .data-table tbody {
        display: block;
        width: 100%;
    }

    .data-table thead {
        display: none;
    }

    .data-table tbody tr {
        display: block;
        background: #ffffff;
        border: 1.5px solid #e0e3fa;
        border-radius: 16px;
        padding: 14px 16px;
        margin-bottom: 12px;
        box-shadow: 0 8px 20px -14px rgba(80, 70, 200, 0.2);
    }

    .data-table tbody tr:hover td {
        background: transparent;
    }

    .data-table tbody td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 9px 0;
        border-bottom: 1px dashed #edf0ff;
        text-align: right;
        font-size: 13.5px;
        word-break: break-word;
    }

    .data-table tbody td::before {
        content: attr(data-label);
        font-family: 'Fredoka', sans-serif;
        font-size: 12px;
        font-weight: 600;
        color: #8f9bd8;
        text-transform: uppercase;
        letter-spacing: .04em;
        text-align: left;
        flex-shrink: 0;
    }

    .data-table tbody td[data-label="Aksi"] {
        border-bottom: none;
        padding-top: 12px;
        padding-bottom: 2px;
    }

    .action-buttons {
        justify-content: flex-end;
        gap: 8px;
    }

    .action-link.view {
        padding: 6px 14px;
        font-size: 12px;
    }

    .action-link.edit,
    .action-link.delete {
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 12.5px;
    }

    .action-link.edit {
        background: #eef0ff;
    }

    .action-link.delete {
        background: #fdecec;
    }

    .pagination-bar {
        background: #ffffff;
        border: 1.5px solid #e0e3fa;
        border-radius: 14px;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 14px 12px;
        gap: 10px;
    }

    .pagination-controls {
        justify-content: center;
    }

    .page-btn {
        min-width: 32px;
        padding: 6px 10px;
        font-size: 12px;
    }

    .modal-overlay {
        padding: 12px;
    }

    .profile-modal-wrapper .card,
    .modal {
        max-height: 90vh;
        overflow-y: auto;
    }

    .profile-modal-wrapper .card {
        padding: 20px 18px;
    }

    .card-header-styled {
        padding-bottom: 14px;
        margin-bottom: 16px;
    }

    .card-header-styled h2 {
        font-size: 16px;
        gap: 6px;
    }

    .big-avatar {
        width: 72px;
        height: 72px;
        font-size: 30px;
        margin-bottom: 10px;
    }

    .profile-hero {
        padding: 12px 0;
        margin-bottom: 16px;
    }

    .profile-hero h3 {
        font-size: 18px;
    }

    .profile-hero .email-badge {
        font-size: 12.5px;
        word-break: break-all;
    }

    .modal-header,
    .modal-body,
    .modal-footer {
        padding: 16px 18px;
    }
}
</style>
</head>
<body>

    @include('shared.sidebar')

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- TOP BAR -->
        <header class="top-bar">
            <a href="{{ route('profile.skill') }}" class="user-profile" title="Kelola Profil">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Nama Pengguna' }}</div>
                    <div class="role">Administrator</div>
                </div>
                <div class="avatar">
                    @if(auth()->check() && auth()->user()->foto_profil)
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="{{ auth()->user()->name }}">
                    @else
                        {{ substr(auth()->check() ? auth()->user()->name : 'U', 0, 1) }}
                    @endif
                </div>
            </a>
        </header>

        <div class="page-header">
            <h1 class="page-title">Kelola Pengguna</h1>
            {{-- <button type="button" class="btn pri" onclick="openCreateModal()">+ Tambah Pengguna</button> --}}
        </div>

        @if(session('success'))
            <div class="alert success">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert error">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any() && !old('_edit_id') && old('_form') !== 'create')
            <div class="alert error">
                <ul style="margin-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat Email</th>
                            <th>Role</th>
                            <th>Tanggal Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $i => $user)
                        <tr>
                            <td data-label="ID" style="color: #8f9bd8; font-weight: 600;">#{{ $users->firstItem() + $i }}</td>
                            <td data-label="Nama Lengkap" style="font-weight: 700; color: #1c2766;">{{ $user->name }}</td>
                            <td data-label="Alamat Email">{{ $user->email }}</td>
                            <td data-label="Role">
                                @if($user->role === 'admin')
                                    <span class="badge admin">Admin</span>
                                @elseif($user->role === 'creator')
                                    <span class="badge creator">Creator</span>
                                @else
                                    <span class="badge member">Member</span>
                                @endif
                            </td>
                            <td data-label="Bergabung" style="color: #8f9bd8;">{{ $user->created_at->format('d M Y') }}</td>
                            <td data-label="Aksi">
                                @php
                                    $userSkillsData = $user->skills->map(function ($s) {
                                        return [
                                            'nama_skill' => $s->nama_skill,
                                            'tingkat_keahlian' => $s->pivot->tingkat_keahlian ?? 'Beginner',
                                        ];
                                    })->values();
                                @endphp
                                <div class="action-buttons">
                                    <button type="button" class="action-link view"
                                        onclick="openViewModal(this)"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-role="{{ $user->role }}"
                                        data-foto="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : '' }}"
                                        data-cv="{{ $user->cv_path ?? '' }}"
                                        data-portofolio="{{ $user->portofolio ?? '' }}"
                                        data-skills='@json($userSkillsData)'>View</button>
                                    <button type="button" class="action-link edit"
                                        onclick="openEditModal(this)"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-role="{{ $user->role }}">Edit Role</button>
                                    <button type="button" class="action-link delete"
                                        onclick="openDeleteModal(this)"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-url="{{ route('pengguna.destroy', $user->id) }}">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
            <div class="pagination-bar">
                <div class="pagination-info">
                    Menampilkan {{ $users->firstItem() }}&ndash;{{ $users->lastItem() }} dari {{ $users->total() }} pengguna
                </div>
                <div class="pagination-controls">
                    @if($users->onFirstPage())
                        <span class="page-btn disabled">&laquo; Sebelumnya</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="page-btn">&laquo; Sebelumnya</a>
                    @endif

                    @for($p = 1; $p <= $users->lastPage(); $p++)
                        @if($p == $users->currentPage())
                            <span class="page-btn active">{{ $p }}</span>
                        @else
                            <a href="{{ $users->url($p) }}" class="page-btn">{{ $p }}</a>
                        @endif
                    @endfor

                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="page-btn">Berikutnya &raquo;</a>
                    @else
                        <span class="page-btn disabled">Berikutnya &raquo;</span>
                    @endif
                </div>
            </div>
            @endif
        </div>

    </main>

    <!-- ===== MODAL VIEW PROFIL PENGGUNA ===== -->
    <div class="modal-overlay" id="viewModal" onclick="if(event.target === this) closeViewModal();">
        <div class="profile-modal-wrapper" role="dialog" aria-modal="true" aria-labelledby="viewModalTitle">
            <div class="card">
                <div class="card-header-styled">
                    <h2 id="viewModalTitle">
                        <svg width="22" height="22" fill="none" stroke="#7b6cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pratinjau Profil Pengguna
                    </h2>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span class="role-pill" id="view_role">member</span>
                        <button type="button" class="modal-close" onclick="closeViewModal()" aria-label="Tutup">&times;</button>
                    </div>
                </div>

                <div class="profile-hero">
                    <div class="big-avatar" id="view_avatar">U</div>
                    <h3 id="view_name">Nama Pengguna</h3>
                    <div class="email-badge" id="view_email">email@skillconnect.com</div>
                </div>

                <div class="info-row">
                    <label>Tautan CV</label>
                    <div id="view_cv_container">
                        <div class="val" style="color: #9aa2cc; font-style: italic; font-size: 14px;">
                            Belum ada tautan CV.
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <label>Tautan Bukti Portofolio</label>
                    <div id="view_portofolio_container">
                        <div class="val" style="color: #9aa2cc; font-style: italic;">Belum ada tautan portofolio.</div>
                    </div>
                </div>

                <div class="info-row" style="margin-top: 24px;">
                    <label id="view_skills_label">Skill Terverifikasi (0)</label>
                    <div class="skills-container" id="view_skills_container">
                        <p style="color: #9aa2cc; font-size: 14px; font-style: italic;">
                            Belum ada keahlian yang ditambahkan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL EDIT PENGGUNA ===== -->
    <div class="modal-overlay" id="editModal" onclick="if(event.target === this) closeEditModal();">
        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
            <div class="modal-header">
                <h2 class="modal-title" id="editModalTitle">Edit Pengguna</h2>
                <button type="button" class="modal-close" onclick="closeEditModal()" aria-label="Tutup">&times;</button>
            </div>
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="_edit_id" value="{{ old('_edit_id') }}">
                <input type="hidden" name="_form" value="edit">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_role">Role</label>
                        <select id="edit_role" name="role" required>
                            <option value="member">Member</option>
                            <option value="creator">Creator</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn pri">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL KONFIRMASI HAPUS PENGGUNA ===== -->
    <div class="modal-overlay" id="deleteModal" onclick="if(event.target === this) closeDeleteModal();">
        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">
            <div class="modal-header">
                <h2 class="modal-title" id="deleteModalTitle">Konfirmasi Hapus Pengguna</h2>
                <button type="button" class="modal-close" onclick="closeDeleteModal()" aria-label="Tutup">&times;</button>
            </div>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-body" style="text-align: center;">
                    <div class="delete-icon-box">
                        <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <p style="font-size: 15px; color: #1c2766; font-weight: 600; margin-bottom: 8px;">
                        Apakah Anda yakin ingin menghapus akun pengguna ini?
                    </p>
                    <div style="margin-bottom: 12px;">
                        <span class="delete-user-highlight" id="delete_user_name">Nama Pengguna</span>
                        <div style="font-size: 12.5px; color: #8f9bd8; font-weight: 600; margin-top: 4px;" id="delete_user_email">email@example.com</div>
                    </div>
                    <p style="font-size: 13px; color: #d8000c; font-weight: 600; background: #fdecec; padding: 10px 14px; border-radius: 10px; border: 1px solid #f5b5b5;">
                        Tindakan ini permanen dan seluruh data terkait pengguna tersebut tidak dapat dipulihkan.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="btn danger">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Ya, Hapus Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH PENGGUNA ===== -->
    <div class="modal-overlay" id="createModal" onclick="if(event.target === this) closeCreateModal();">
        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="createModalTitle">
            <div class="modal-header">
                <h2 class="modal-title" id="createModalTitle">Tambah Pengguna</h2>
                <button type="button" class="modal-close" onclick="closeCreateModal()" aria-label="Tutup">&times;</button>
            </div>
            <form id="createForm" method="POST" action="{{ route('pengguna.store') }}">
                @csrf
                <input type="hidden" name="_form" value="create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create_name">Nama Lengkap</label>
                        <input type="text" id="create_name" name="name" value="{{ old('name') }}" required>
                        @error('name') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="create_email">Alamat Email</label>
                        <input type="email" id="create_email" name="email" value="{{ old('email') }}" required>
                        @error('email') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="create_role">Role</label>
                        <select id="create_role" name="role" required>
                            <option value="member" {{ old('role') === 'member' ? 'selected' : '' }}>Member</option>
                            <option value="creator" {{ old('role') === 'creator' ? 'selected' : '' }}>Creator</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="create_password">Password</label>
                        <input type="password" id="create_password" name="password" autocomplete="new-password" required>
                        <span class="form-hint">Minimal 8 karakter.</span>
                        @error('password') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeCreateModal()">Batal</button>
                    <button type="submit" class="btn pri">Simpan Pengguna</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const viewModal   = document.getElementById('viewModal');
        const editModal   = document.getElementById('editModal');
        const editForm    = document.getElementById('editForm');
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm  = document.getElementById('deleteForm');
        const createModal = document.getElementById('createModal');
        const createForm  = document.getElementById('createForm');

        function escapeHtml(str) {
            return String(str ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        // ===== MODAL VIEW PROFIL =====
        function openViewModal(button) {
            const name       = button.getAttribute('data-name') || 'Pengguna';
            const email      = button.getAttribute('data-email') || '-';
            const role       = button.getAttribute('data-role') || 'member';
            const foto       = button.getAttribute('data-foto') || '';
            const cv         = button.getAttribute('data-cv') || '';
            const portofolio = button.getAttribute('data-portofolio') || '';
            let skills       = [];

            try {
                skills = JSON.parse(button.getAttribute('data-skills') || '[]');
            } catch (err) {
                skills = [];
            }

            document.getElementById('view_role').textContent = role;
            document.getElementById('view_name').textContent = name;
            document.getElementById('view_email').textContent = email;

            const avatarEl = document.getElementById('view_avatar');
            if (foto) {
                avatarEl.innerHTML = '<img src="' + escapeHtml(foto) + '" alt="' + escapeHtml(name) + '">';
            } else {
                avatarEl.textContent = name.charAt(0).toUpperCase();
            }

            const cvContainer = document.getElementById('view_cv_container');
            if (cv) {
                cvContainer.innerHTML = '<a href="' + escapeHtml(cv) + '" target="_blank" class="link-portfolio" style="background: #eef0ff; color: #2b3a8f; border-color: #d6d9fb;">' +
                    '<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>' +
                    'Lihat Dokumen CV</a>';
            } else {
                cvContainer.innerHTML = '<div class="val" style="color: #9aa2cc; font-style: italic; font-size: 14px;">Belum ada tautan CV.</div>';
            }

            const portofolioContainer = document.getElementById('view_portofolio_container');
            if (portofolio) {
                portofolioContainer.innerHTML = '<a href="' + escapeHtml(portofolio) + '" target="_blank" class="link-portfolio">' +
                    '<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>' +
                    'Buka Tautan Portofolio</a>';
            } else {
                portofolioContainer.innerHTML = '<div class="val" style="color: #9aa2cc; font-style: italic;">Belum ada tautan portofolio.</div>';
            }

            const skillsLabel = document.getElementById('view_skills_label');
            const skillsContainer = document.getElementById('view_skills_container');
            skillsLabel.textContent = 'Skill Terverifikasi (' + skills.length + ')';

            if (skills.length > 0) {
                skillsContainer.innerHTML = skills.map(function (skill) {
                    const level = skill.tingkat_keahlian || 'Beginner';
                    return '<div class="skill-tag">' +
                        '<span class="skill-name">' + escapeHtml(skill.nama_skill) + '</span>' +
                        '<span class="level-badge level-' + escapeHtml(level) + '">' + escapeHtml(level) + '</span>' +
                        '</div>';
                }).join('');
            } else {
                skillsContainer.innerHTML = '<p style="color: #9aa2cc; font-size: 14px; font-style: italic;">' +
                    'Belum ada keahlian yang ditambahkan.' +
                    '</p>';
            }

            viewModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeViewModal() {
            viewModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // ===== MODAL EDIT =====
        function openEditModal(button) {
            const id   = button.getAttribute('data-id');
            const role = button.getAttribute('data-role');

            editForm.action = '/pengguna/' + id;
            document.getElementById('edit_id').value = id;
            document.getElementById('editModalTitle').textContent = 'Edit Pengguna : user ID ' + id;
            document.getElementById('edit_role').value = role;

            document.querySelectorAll('#editForm .form-error').forEach(el => el.remove());

            editModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            editModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // ===== MODAL KONFIRMASI HAPUS =====
        function openDeleteModal(button) {
            const name  = button.getAttribute('data-name') || 'Pengguna';
            const email = button.getAttribute('data-email') || '';
            const url   = button.getAttribute('data-url');

            deleteForm.action = url;
            document.getElementById('delete_user_name').textContent = name;
            document.getElementById('delete_user_email').textContent = email;

            deleteModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            deleteModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // ===== MODAL TAMBAH =====
        function openCreateModal() {
            createForm.reset();
            document.querySelectorAll('#createForm .form-error').forEach(el => el.remove());

            createModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCreateModal() {
            createModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Tutup modal aktif dengan tombol ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                if (viewModal.classList.contains('active')) closeViewModal();
                if (editModal.classList.contains('active')) closeEditModal();
                if (deleteModal.classList.contains('active')) closeDeleteModal();
                if (createModal.classList.contains('active')) closeCreateModal();
            }
        });

        // Buka kembali modal jika terjadi error validasi
        @if($errors->any())
            @if(old('_form') === 'create')
                createModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            @elseif(old('_edit_id'))
                editForm.action = '/pengguna/' + document.getElementById('edit_id').value;
                editModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            @endif
        @endif
    </script>

</body>
</html>