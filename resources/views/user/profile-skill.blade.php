<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Profil & Skill - SkillConnect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --bg: #ffffff;
    --ink: #1c2766;
    --mute: #4b5686;
    --line: #e0e3fa;
    --primary: #ff007f;
    --secondary: #7000ff;
    --accent: #7b6cf6;
    box-sizing: border-box;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: linear-gradient(180deg, #eef0ff, #f4f1ff 50%, #eaf1ff);
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
    border-right: 1.5px solid var(--line);
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
    background: linear-gradient(90deg, #1c2766, #7b6cf6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.sidebar-nav {
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
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

.sidebar-footer {
    padding: 20px 16px;
    border-top: 1.5px solid #f0f2ff;
}

.btn-logout {
    width: 100%;
    padding: 12px;
    background: #fff;
    border: 1.5px solid #f0e0e5;
    color: #d80044;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s;
    font-family: 'Nunito', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.btn-logout:hover {
    background: #ffeef2;
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
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
}

.top-breadcrumb {
    font-size: 14px;
    color: var(--mute);
    font-weight: 600;
}
.top-breadcrumb span {
    color: var(--ink);
    font-weight: 700;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
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

/* Alerts */
.alert {
    padding: 14px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    font-size: 14.5px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
}
.alert-success {
    background: #e8f9ee;
    color: #0d8239;
    border: 1.5px solid #b6edc8;
}
.alert-danger {
    background: #ffe8ec;
    color: #cf113b;
    border: 1.5px solid #fec0cc;
}

/* Page Header & Grid Layout */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}
.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 30px;
    color: var(--ink);
}
.page-desc {
    color: var(--mute);
    font-size: 15px;
    margin-top: 2px;
}

.profile-grid {
    display: grid;
    grid-template-columns: 1fr 1.35fr;
    gap: 28px;
}

.card {
    background: #fff;
    border: 1.5px solid var(--line);
    border-radius: 20px;
    box-shadow: 0 10px 32px -16px rgba(80,70,200,.25);
    padding: 30px;
    position: relative;
}

.card-header-styled {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1.5px solid #f0f2ff;
}

.card-header-styled h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 21px;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Profile Badge & Overview */
.profile-hero {
    text-align: center;
    padding: 10px 0 24px;
    border-bottom: 1.5px solid #f0f2ff;
    margin-bottom: 24px;
}

.big-avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f5fe0, #7b6cf6 60%, #c26bf0);
    color: #fff;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    box-shadow: 0 10px 24px rgba(123,108,246,.35);
    border: 3px solid #fff;
}

.profile-hero h3 {
    font-family: 'Fredoka', sans-serif;
    font-size: 22px;
    color: var(--ink);
}
.profile-hero .email-badge {
    display: inline-block;
    color: #7b6cf6;
    font-weight: 600;
    font-size: 14px;
    margin-top: 2px;
}
.role-pill {
    display: inline-block;
    margin-top: 10px;
    padding: 4px 14px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 700;
    background: linear-gradient(90deg, rgba(43,58,143,0.1), rgba(123,108,246,0.1));
    color: #2b3a8f;
    border: 1px solid #d6d9fb;
    text-transform: uppercase;
    letter-spacing: .06em;
}

.info-row {
    margin-bottom: 16px;
}
.info-row label {
    display: block;
    font-size: 12.5px;
    font-weight: 700;
    color: #7b6cf6;
    text-transform: uppercase;
    letter-spacing: .04em;
    margin-bottom: 4px;
}
.info-row .val {
    color: var(--ink);
    font-size: 15px;
    font-weight: 600;
    line-height: 1.5;
}
.link-portfolio {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #2b3a8f;
    font-weight: 700;
    word-break: break-all;
    background: #f4f6ff;
    padding: 8px 14px;
    border-radius: 10px;
    border: 1px solid #e0e3fa;
    transition: .2s;
}
.link-portfolio:hover {
    border-color: #7b6cf6;
    background: #edf0ff;
    transform: translateY(-1px);
}

/* Skills Badges Container */
.skills-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.skill-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border-radius: 12px;
    background: #ffffff;
    border: 1.5px solid #e0e3fa;
    box-shadow: 0 4px 12px -4px rgba(80,70,200,.1);
    transition: transform .2s, border-color .2s;
}
.skill-tag:hover {
    transform: translateY(-2px);
    border-color: #7b6cf6;
}

.skill-name {
    font-weight: 700;
    color: var(--ink);
    font-size: 14px;
}

.level-badge {
    padding: 2px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
}
.level-Beginner { background: #e5f2ff; color: #0055cc; }
.level-Intermediate { background: #f3e8ff; color: #7000ff; }
.level-Advanced { background: #e5ffe8; color: #008736; }

.btn-remove-skill {
    background: transparent;
    border: none;
    color: #9aa2cc;
    cursor: pointer;
    display: flex;
    align-items: center;
    padding: 0;
    margin-left: 2px;
    transition: color .2s;
}
.btn-remove-skill:hover {
    color: #e0244d;
}

/* Form Styles */
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 8px;
}
.form-group label span.req {
    color: #e0244d;
}
.form-group .hint {
    font-size: 12.5px;
    color: var(--mute);
    margin-top: 4px;
}

/* CV Upload Styles */
.cv-upload-area {
    border: 2px dashed #c4c9f0;
    border-radius: 14px;
    background: #f8f9ff;
    padding: 28px 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color .2s, background .2s;
    position: relative;
}
.cv-upload-area:hover, .cv-upload-area.drag-over {
    border-color: #7b6cf6;
    background: #f0f1ff;
}
.cv-upload-area input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}
.cv-upload-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto 12px;
    background: linear-gradient(135deg, #e8e9ff, #d9d6ff);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.cv-upload-area h5 {
    font-weight: 700;
    color: var(--ink);
    font-size: 15px;
    margin-bottom: 4px;
}
.cv-upload-area p {
    font-size: 13px;
    color: var(--mute);
}
.cv-file-selected {
    display: none;
    align-items: center;
    gap: 12px;
    background: #eefaf2;
    border: 1.5px solid #a8e6be;
    border-radius: 12px;
    padding: 12px 16px;
    margin-top: 10px;
}
.cv-file-selected.show { display: flex; }
.cv-file-selected .file-icon {
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, #d0f0de, #b3e8c7);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.cv-file-selected .file-name {
    font-weight: 700;
    color: #0d6e36;
    font-size: 14px;
    flex: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.cv-file-selected .file-size {
    font-size: 12px;
    color: #4b9e6b;
}
.btn-remove-cv {
    background: none;
    border: none;
    color: #c0392b;
    cursor: pointer;
    padding: 4px;
    display: flex;
    align-items: center;
    transition: color .2s;
}
.btn-remove-cv:hover { color: #e74c3c; }

/* CV Preview Card (Pratinjau) */
.cv-preview-card {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #f4f1ff;
    border: 1.5px solid #d6d9fb;
    border-radius: 12px;
    padding: 12px 16px;
}
.cv-preview-card .cv-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #7b6cf6, #4f5fe0);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.cv-preview-card .cv-meta {
    flex: 1;
}
.cv-preview-card .cv-meta .cv-label {
    font-size: 11px;
    font-weight: 700;
    color: #7b6cf6;
    text-transform: uppercase;
    letter-spacing: .05em;
}
.cv-preview-card .cv-meta .cv-name {
    font-weight: 700;
    color: var(--ink);
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 160px;
}
.cv-preview-card .cv-actions {
    display: flex;
    gap: 8px;
    align-items: center;
}
.btn-cv-view {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    font-family: 'Nunito', sans-serif;
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    color: #fff;
    border: none;
    cursor: pointer;
    transition: .2s;
    text-decoration: none;
}
.btn-cv-view:hover { opacity: .88; transform: translateY(-1px); }
.btn-cv-change {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    font-family: 'Nunito', sans-serif;
    background: #fff;
    color: #2b3a8f;
    border: 1.5px solid #d6d9fb;
    cursor: pointer;
    transition: .2s;
    text-decoration: none;
}
.btn-cv-change:hover { border-color: #7b6cf6; background: #f4f0ff; }

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid var(--line);
    border-radius: 12px;
    font-family: 'Nunito', sans-serif;
    font-size: 15px;
    color: var(--ink);
    background: #fff;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
}
.form-control:focus {
    border-color: #7b6cf6;
    box-shadow: 0 0 0 3px rgba(123,108,246,.15);
}
textarea.form-control {
    resize: vertical;
    min-height: 95px;
}

/* Button */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 15px;
    border: 1.5px solid transparent;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    transition: .2s;
}
.btn.pri {
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    color: #fff;
    box-shadow: 0 8px 22px -6px rgba(123,108,246,.7);
}
.btn.pri:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px -6px rgba(123,108,246,.85);
}
.btn.outline {
    background: #fff;
    color: #2b3a8f;
    border-color: #d6d9fb;
}
.btn.outline:hover {
    border-color: #7b6cf6;
    background: #f7f8ff;
}

/* Quick Add Skill Box */
.skill-adder-box {
    background: #f8f9ff;
    border: 1.5px dashed #d6d9fb;
    border-radius: 14px;
    padding: 18px;
    margin-bottom: 24px;
}
.skill-adder-box h4 {
    font-family: 'Fredoka', sans-serif;
    font-size: 16px;
    color: var(--ink);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.skill-adder-grid {
    display: grid;
    grid-template-columns: 1.4fr 1fr auto;
    gap: 10px;
    align-items: center;
}

@media(max-width: 992px) {
    .profile-grid { grid-template-columns: 1fr; }
    .main-content { margin-left: 0; padding: 20px; }
    .sidebar { display: none; }
}
</style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a class="brand" href="/" aria-label="SkillConnect">
                <svg viewBox="0 0 64 32" fill="none">
                  <defs><linearGradient id="g" x1="0" x2="1"><stop offset="0" stop-color="#4d6bff"/><stop offset="1" stop-color="#9b5cff"/></linearGradient></defs>
                  <path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#g)" stroke-width="4" stroke-linejoin="round"/>
                </svg>
                <span>SKILL CONNECT</span>
            </a>
        </div>
        <nav class="sidebar-nav">
            <a href="/dashboard" class="nav-item">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            
            @if(auth()->check() && auth()->user()->role === 'admin')
                <!-- MENU UNTUK ADMIN -->
                <a href="/pengguna" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Pengguna
                </a>
                <a href="/proyek" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    Proyek
                </a>
                <a href="/transaksi" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Transaksi
                </a>
                <a href="/laporan" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Laporan
                </a>
            @else
                <!-- MENU UNTUK USER MEMBER / CREATOR -->
                <a href="{{ route('profile.skill') }}" class="nav-item active">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profil & Skill
                </a>
                <a href="{{ route('proyek') }}" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    Cari Proyek
                </a>
                <a href="{{ route('proyek.create') }}" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    Buat Proyek
                </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Akun
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- TOP BAR -->
        <header class="top-bar">
            <div class="top-breadcrumb">
                SkillConnect / <span>Profil & Kelola Skill</span>
            </div>
            <div class="user-profile">
                <div class="user-info">
                    <div class="name">{{ $user->name }}</div>
                    <div class="role">{{ ucfirst($user->role) }} • Member / Creator</div>
                </div>
                <div class="avatar">{{ substr($user->name, 0, 1) }}</div>
            </div>
        </header>

        <!-- FLASH NOTIFICATION -->
        @if(session('success'))
            <div class="alert alert-success">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <div>
                    <strong>Perhatian!</strong>
                    <ul style="margin-top: 4px; padding-left: 20px;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="page-header">
            <div>
                <h1 class="page-title">Kelola Profil & Skill</h1>
                <p class="page-desc">Lengkapi identitas, tambahkan master skill & bukti portofolio untuk meningkatkan peluang proyek.</p>
            </div>
        </div>

        <div class="profile-grid">
            
            <!-- KOLOM KIRI: PREVIEW TAMPILAN PROFIL & SKILL AKTIF -->
            <div class="card">
                <div class="card-header-styled">
                    <h2>
                        <svg width="22" height="22" fill="none" stroke="#7b6cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pratinjau Profil Anda
                    </h2>
                    <span class="role-pill">{{ $user->role }}</span>
                </div>

                <div class="profile-hero">
                    <div class="big-avatar">{{ substr($user->name, 0, 1) }}</div>
                    <h3>{{ $user->name }}</h3>
                    <div class="email-badge">{{ $user->email }}</div>
                </div>

                <div class="info-row">
                    <label>File CV</label>
                    @if($user->cv_path)
                        <div class="cv-preview-card">
                            <div class="cv-icon">
                                <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div class="cv-meta">
                                <div class="cv-label">File CV</div>
                                <div class="cv-name" title="{{ basename($user->cv_path) }}">{{ basename($user->cv_path) }}</div>
                            </div>
                            <div class="cv-actions">
                                <a href="{{ Storage::url($user->cv_path) }}" target="_blank" rel="noopener noreferrer" class="btn-cv-view">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Lihat
                                </a>
                                <a href="#cv-upload-section" class="btn-cv-change" onclick="document.getElementById('cv_file').click(); return false;">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Ganti
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="val" style="color: #9aa2cc; font-style: italic; font-size: 14px;">
                            Belum ada file CV. Unggah CV di formulir sebelah kanan.
                        </div>
                    @endif
                </div>

                <div class="info-row">
                    <label>Tautan Bukti Portofolio</label>
                    @if($user->portofolio)
                        <a href="{{ $user->portofolio }}" target="_blank" rel="noopener noreferrer" class="link-portfolio">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            {{ $user->portofolio }}
                        </a>
                    @else
                        <div class="val" style="color: #9aa2cc; font-style: italic;">Belum ada tautan portofolio.</div>
                    @endif
                </div>

                <div class="info-row" style="margin-top: 24px;">
                    <label>Skill Terverifikasi ({{ $userSkills->count() }})</label>
                    <div class="skills-container">
                        @forelse($userSkills as $skill)
                            <div class="skill-tag">
                                <span class="skill-name">{{ $skill->nama_skill }}</span>
                                <span class="level-badge level-{{ $skill->pivot->tingkat_keahlian }}">
                                    {{ $skill->pivot->tingkat_keahlian }}
                                </span>
                                <form action="{{ route('profile.skill.remove', $skill->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus skill {{ $skill->nama_skill }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-remove-skill" title="Hapus skill">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p style="color: #9aa2cc; font-size: 14px; font-style: italic;">
                                Belum ada keahlian yang ditambahkan. Gunakan formulir di sebelah untuk memilih skill.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: FORMULIR EDIT PROFIL & SKILL (AD-02) -->
            <div class="card">
                <div class="card-header-styled">
                    <h2>
                        <svg width="22" height="22" fill="none" stroke="#7b6cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit Identitas & Master Skill
                    </h2>
                </div>

                <!-- BOX TAMBAH CEPAT MASTER SKILL -->
                <div class="skill-adder-box">
                    <h4>
                        <svg width="18" height="18" fill="none" stroke="#2b3a8f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Tambah Master Skill Baru ke Profil
                    </h4>
                    <form action="{{ route('profile.skill.add') }}" method="POST" class="skill-adder-grid">
                        @csrf
                        <div>
                            <select name="skill_id" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Master Skill --</option>
                                @foreach($masterSkills as $ms)
                                    <option value="{{ $ms->id }}">{{ $ms->nama_skill }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select name="tingkat_keahlian" class="form-control" required>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate" selected>Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>
                        <button type="submit" class="btn pri" style="padding: 12px 18px;">
                            + Tambah
                        </button>
                    </form>
                </div>

                <!-- FORM UTAMA EDIT PROFIL & PORTOFOLIO -->
                <form action="{{ route('profile.skill.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required placeholder="Contoh: Budi Pratama">
                    </div>

                    {{-- CV Upload Section --}}
                    <div class="form-group" id="cv-upload-section">
                        <label for="cv_file">
                            Unggah File CV <span class="req">*</span>
                        </label>

                        @if($user->cv_path)
                            {{-- File sudah ada: tampilkan info file lama & opsi ganti --}}
                            <div class="cv-preview-card" style="margin-bottom: 12px;" id="cv-existing-preview">
                                <div class="cv-icon">
                                    <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div class="cv-meta">
                                    <div class="cv-label">File CV Tersimpan</div>
                                    <div class="cv-name" title="{{ basename($user->cv_path) }}">{{ basename($user->cv_path) }}</div>
                                </div>
                                <div class="cv-actions">
                                    <a href="{{ Storage::url($user->cv_path) }}" target="_blank" rel="noopener noreferrer" class="btn-cv-view">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat
                                    </a>
                                </div>
                            </div>
                            <div class="cv-upload-area" id="cv-drop-area">
                                <input type="file" id="cv_file" name="cv_file" accept=".pdf,.doc,.docx">
                                <div class="cv-upload-icon">
                                    <svg width="24" height="24" fill="none" stroke="#7b6cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                </div>
                                <h5>Ganti File CV</h5>
                                <p>Klik atau seret file baru ke sini untuk mengganti CV</p>
                                <p style="margin-top: 6px; font-size: 12px; color: #9aa2cc;">PDF, DOC, DOCX — Maks. 2 MB</p>
                            </div>
                        @else
                            {{-- Belum ada CV: wajib upload --}}
                            <div class="cv-upload-area" id="cv-drop-area">
                                <input type="file" id="cv_file" name="cv_file" accept=".pdf,.doc,.docx" required>
                                <div class="cv-upload-icon">
                                    <svg width="24" height="24" fill="none" stroke="#7b6cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                </div>
                                <h5>Unggah File CV</h5>
                                <p>Klik di sini atau seret & lepas file CV Anda</p>
                                <p style="margin-top: 6px; font-size: 12px; color: #9aa2cc;">PDF, DOC, DOCX — Maks. 2 MB</p>
                            </div>
                        @endif

                        {{-- Pratinjau file yang baru dipilih (sebelum disimpan) --}}
                        <div class="cv-file-selected" id="cv-selected-preview">
                            <div class="file-icon">
                                <svg width="18" height="18" fill="none" stroke="#0d6e36" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div style="flex: 1; overflow: hidden;">
                                <div class="file-name" id="cv-selected-name">nama-file.pdf</div>
                                <div class="file-size" id="cv-selected-size">0 KB</div>
                            </div>
                            <button type="button" class="btn-remove-cv" id="btn-remove-cv" title="Batal pilih file">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <div class="hint">
                            File CV ini akan ditampilkan di profil Anda dan dapat dilihat oleh Project Creator.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="portofolio">Tautan Bukti Portofolio <span class="req">*</span></label>
                        <input type="url" id="portofolio" name="portofolio" class="form-control" value="{{ old('portofolio', $user->portofolio) }}" placeholder="https://github.com/username atau https://behance.net/username">
                        <div class="hint">Harus format tautan URL valid (misal: GitHub, Figma, Dribbble, atau Website Personal).</div>
                    </div>

                    <div class="form-group" style="margin-top: 24px;">
                        <label>Atau Tambah Custom Skill Khusus (Opsional):</label>
                        <div style="display: grid; grid-template-columns: 1.4fr 1fr; gap: 10px;">
                            <input type="text" name="custom_skill" class="form-control" placeholder="Nama skill baru...">
                            <select name="custom_level" class="form-control">
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate" selected>Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-top: 32px; display: flex; justify-content: flex-end; gap: 14px;">
                        <a href="{{ route('dashboard') }}" class="btn outline">Batal</a>
                        <button type="submit" class="btn pri">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </main>

<script>
(function () {
    const fileInput   = document.getElementById('cv_file');
    const dropArea    = document.getElementById('cv-drop-area');
    const selectedBox = document.getElementById('cv-selected-preview');
    const selectedName = document.getElementById('cv-selected-name');
    const selectedSize = document.getElementById('cv-selected-size');
    const removeBtn   = document.getElementById('btn-remove-cv');

    if (!fileInput) return;

    const MAX_SIZE = 2 * 1024 * 1024; // 2 MB

    function formatBytes(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
    }

    function showSelected(file) {
        selectedName.textContent = file.name;
        selectedSize.textContent = formatBytes(file.size);
        selectedBox.classList.add('show');
    }

    function clearSelected() {
        fileInput.value = '';
        selectedBox.classList.remove('show');
        dropArea.classList.remove('drag-over');
    }

    fileInput.addEventListener('change', function () {
        if (!this.files.length) return clearSelected();
        const file = this.files[0];
        if (file.size > MAX_SIZE) {
            alert('Ukuran file melebihi 2 MB. Silakan pilih file yang lebih kecil.');
            return clearSelected();
        }
        showSelected(file);
    });

    if (removeBtn) {
        removeBtn.addEventListener('click', clearSelected);
    }

    // Drag & drop events
    ['dragenter', 'dragover'].forEach(evt => {
        dropArea.addEventListener(evt, e => {
            e.preventDefault();
            dropArea.classList.add('drag-over');
        });
    });
    ['dragleave', 'drop'].forEach(evt => {
        dropArea.addEventListener(evt, e => {
            e.preventDefault();
            dropArea.classList.remove('drag-over');
        });
    });
    dropArea.addEventListener('drop', function (e) {
        const dt = e.dataTransfer;
        if (dt && dt.files.length) {
            const file = dt.files[0];
            const allowed = ['application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if (!allowed.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan PDF, DOC, atau DOCX.');
                return;
            }
            if (file.size > MAX_SIZE) {
                alert('Ukuran file melebihi 2 MB. Silakan pilih file yang lebih kecil.');
                return;
            }
            // Assign ke file input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;
            showSelected(file);
        }
    });
})();
</script>

</body>
</html>
