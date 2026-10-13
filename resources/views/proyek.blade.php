<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Eksplorasi Proyek - SkillConnect</title>
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

/* Header & Search Bar */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 16px;
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

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 11px 22px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14.5px;
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

/* Filter Card */
.filter-card {
    background: #fff;
    border: 1.5px solid var(--line);
    border-radius: 18px;
    padding: 20px 24px;
    margin-bottom: 28px;
    box-shadow: 0 6px 20px -10px rgba(80,70,200,.15);
}

.filter-form {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr auto;
    gap: 14px;
    align-items: center;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid var(--line);
    border-radius: 12px;
    font-family: 'Nunito', sans-serif;
    font-size: 14.5px;
    color: var(--ink);
    background: #fff;
    outline: none;
    transition: border-color .2s;
}
.form-control:focus {
    border-color: #7b6cf6;
}

/* Project Cards Grid */
.project-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
    gap: 24px;
}

.project-card {
    background: #fff;
    border: 1.5px solid var(--line);
    border-radius: 20px;
    box-shadow: 0 12px 34px -18px rgba(80,70,200,.25);
    padding: 26px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease;
    position: relative;
    overflow: hidden;
}
.project-card:hover {
    transform: translateY(-5px);
    border-color: #7b6cf6;
    box-shadow: 0 20px 40px -18px rgba(123,108,246,.35);
}

.project-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #4b5ce8, #7b6cf6);
}

.card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 12px;
}

.category-badge {
    font-size: 12px;
    font-weight: 700;
    color: #5b3fd0;
    background: #f1edff;
    padding: 4px 12px;
    border-radius: 99px;
    border: 1px solid #e0d6ff;
}

.status-badge {
    font-size: 11.5px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 8px;
}
.status-Mencari-Tim { background: #e5f2ff; color: #0055cc; }
.status-Berjalan { background: #fff5e5; color: #cc7700; }
.status-Selesai { background: #e5ffe8; color: #008736; }

.project-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 20px;
    color: var(--ink);
    margin-bottom: 10px;
    line-height: 1.3;
}
.project-title a:hover {
    color: #7b6cf6;
}

.project-desc {
    color: var(--mute);
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 16px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.project-skills {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 20px;
}
.skill-pill {
    font-size: 11.5px;
    font-weight: 700;
    background: #f4f6ff;
    color: #2b3a8f;
    border: 1px solid #e0e3fa;
    padding: 3px 9px;
    border-radius: 6px;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
    border-top: 1.5px solid #f0f2ff;
}

.budget-box .label {
    font-size: 11px;
    font-weight: 700;
    color: #8b95b5;
    text-transform: uppercase;
}
.budget-box .amount {
    font-family: 'Fredoka', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #2b3a8f;
}

.applied-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #fff8e5;
    color: #b37400;
    border: 1px solid #ffe199;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: #fff;
    border: 1.5px dashed var(--line);
    border-radius: 20px;
    grid-column: 1 / -1;
}
.empty-state svg {
    margin-bottom: 16px;
    color: #9aa2cc;
}
.empty-state h3 {
    font-family: 'Fredoka', sans-serif;
    font-size: 22px;
    color: var(--ink);
    margin-bottom: 6px;
}
.empty-state p {
    color: var(--mute);
    font-size: 15px;
    margin-bottom: 20px;
}

@media(max-width: 992px) {
    .filter-form { grid-template-columns: 1fr; }
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
                <a href="/proyek" class="nav-item active">
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
                <a href="{{ route('profile.skill') }}" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profil & Skill
                </a>
                <a href="{{ route('proyek') }}" class="nav-item active">
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
                @if(auth()->check() && auth()->user()->role === 'admin')
                    SkillConnect / <span>Kelola Proyek</span>
                @else
                    SkillConnect / <span>Eksplorasi & Gabung Proyek</span>
                @endif
            </div>
            <div class="user-profile">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Tamu' }}</div>
                    <div class="role">{{ auth()->check() ? ucfirst(auth()->user()->role) : 'Guest' }}</div>
                </div>
                <div class="avatar">{{ substr(auth()->check() ? auth()->user()->name : 'U', 0, 1) }}</div>
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

        @if(auth()->check() && auth()->user()->role === 'admin')
        {{-- ===================== ADMIN: TABEL MANAJEMEN PROYEK ===================== --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Kelola Proyek</h1>
                <p class="page-desc">Pantau, kelola, dan moderasi semua proyek yang ada di platform SkillConnect.</p>
            </div>
        </div>

        <!-- FILTER PENCARIAN ADMIN -->
        <div class="filter-card">
            <form action="{{ route('proyek') }}" method="GET" class="filter-form">
                <div>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari judul proyek, creator, atau deskripsi...">
                </div>
                <div>
                    <select name="kategori" class="form-control">
                        <option value="Semua">Semua Kategori</option>
                        <option value="Web Development" {{ request('kategori') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                        <option value="Mobile App" {{ request('kategori') == 'Mobile App' ? 'selected' : '' }}>Mobile App</option>
                        <option value="UI/UX Design" {{ request('kategori') == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                        <option value="Data Science & AI" {{ request('kategori') == 'Data Science & AI' ? 'selected' : '' }}>Data Science & AI</option>
                        <option value="Digital Marketing" {{ request('kategori') == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                    </select>
                </div>
                <div>
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="Mencari Tim" {{ request('status') == 'Mencari Tim' ? 'selected' : '' }}>Mencari Tim</option>
                        <option value="Berjalan" {{ request('status') == 'Berjalan' ? 'selected' : '' }}>Berjalan</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn pri">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- STATISTIK RINGKAS -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px;">
            <div style="background: #fff; border: 1.5px solid #e0e3fa; border-radius: 14px; padding: 18px 20px; text-align: center;">
                <div style="font-size: 28px; font-weight: 800; color: #2b3a8f; font-family: 'Fredoka', sans-serif;">{{ $projects->total() }}</div>
                <div style="font-size: 13px; color: #4b5686; font-weight: 600;">Total Proyek</div>
            </div>
            <div style="background: #fff; border: 1.5px solid #e0e3fa; border-radius: 14px; padding: 18px 20px; text-align: center;">
                <div style="font-size: 28px; font-weight: 800; color: #0ea853; font-family: 'Fredoka', sans-serif;">{{ $projects->where('status_project', 'Mencari Tim')->count() }}</div>
                <div style="font-size: 13px; color: #4b5686; font-weight: 600;">Mencari Tim</div>
            </div>
            <div style="background: #fff; border: 1.5px solid #e0e3fa; border-radius: 14px; padding: 18px 20px; text-align: center;">
                <div style="font-size: 28px; font-weight: 800; color: #e88e0c; font-family: 'Fredoka', sans-serif;">{{ $projects->where('status_project', 'Berjalan')->count() }}</div>
                <div style="font-size: 13px; color: #4b5686; font-weight: 600;">Berjalan</div>
            </div>
            <div style="background: #fff; border: 1.5px solid #e0e3fa; border-radius: 14px; padding: 18px 20px; text-align: center;">
                <div style="font-size: 28px; font-weight: 800; color: #7b6cf6; font-family: 'Fredoka', sans-serif;">{{ $projects->where('status_project', 'Selesai')->count() }}</div>
                <div style="font-size: 13px; color: #4b5686; font-weight: 600;">Selesai</div>
            </div>
        </div>

        <!-- TABEL MANAJEMEN PROYEK -->
        <div style="background: #fff; border: 1.5px solid #e0e3fa; border-radius: 16px; box-shadow: 0 6px 24px -12px rgba(80,70,200,.15); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr>
                        <th style="padding: 14px 18px; background: #f4f6ff; color: #4b5686; font-weight: 700; font-family: 'Fredoka', sans-serif; text-align: left;">No</th>
                        <th style="padding: 14px 18px; background: #f4f6ff; color: #4b5686; font-weight: 700; font-family: 'Fredoka', sans-serif; text-align: left;">Judul Proyek</th>
                        <th style="padding: 14px 18px; background: #f4f6ff; color: #4b5686; font-weight: 700; font-family: 'Fredoka', sans-serif; text-align: left;">Creator</th>
                        <th style="padding: 14px 18px; background: #f4f6ff; color: #4b5686; font-weight: 700; font-family: 'Fredoka', sans-serif; text-align: left;">Kategori</th>
                        <th style="padding: 14px 18px; background: #f4f6ff; color: #4b5686; font-weight: 700; font-family: 'Fredoka', sans-serif; text-align: left;">Budget</th>
                        <th style="padding: 14px 18px; background: #f4f6ff; color: #4b5686; font-weight: 700; font-family: 'Fredoka', sans-serif; text-align: center;">Anggota</th>
                        <th style="padding: 14px 18px; background: #f4f6ff; color: #4b5686; font-weight: 700; font-family: 'Fredoka', sans-serif; text-align: center;">Status</th>
                        <th style="padding: 14px 18px; background: #f4f6ff; color: #4b5686; font-weight: 700; font-family: 'Fredoka', sans-serif; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $idx => $p)
                    <tr style="border-bottom: 1px solid #edf0ff;">
                        <td style="padding: 14px 18px; color: #4b5686; font-weight: 600;">{{ $projects->firstItem() + $idx }}</td>
                        <td style="padding: 14px 18px;">
                            <div style="font-weight: 700; color: #1c2766; margin-bottom: 2px;">{{ Str::limit($p->judul_project, 35) }}</div>
                            <div style="font-size: 12px; color: #9aa2cc;">{{ $p->created_at->format('d M Y') }}</div>
                        </td>
                        <td style="padding: 14px 18px; color: #4b5686; font-weight: 600;">{{ $p->creator->name ?? '-' }}</td>
                        <td style="padding: 14px 18px;">
                            <span class="category-badge" style="font-size: 12px;">{{ $p->kategori }}</span>
                        </td>
                        <td style="padding: 14px 18px; font-weight: 700; color: #2b3a8f;">Rp {{ number_format($p->budget, 0, ',', '.') }}</td>
                        <td style="padding: 14px 18px; text-align: center;">
                            <span style="background: #eef0ff; color: #2b3a8f; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700;">{{ $p->members->count() }}</span>
                        </td>
                        <td style="padding: 14px 18px; text-align: center;">
                            @php
                                $statusColors = [
                                    'Mencari Tim' => 'background: #e5ffe5; color: #008000;',
                                    'Berjalan'    => 'background: #fff5e5; color: #cc7a00;',
                                    'Selesai'     => 'background: #eef0ff; color: #2b3a8f;',
                                ];
                            @endphp
                            <span style="{{ $statusColors[$p->status_project] ?? 'background: #f0f0f0; color: #666;' }} padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 700;">
                                {{ $p->status_project }}
                            </span>
                        </td>
                        <td style="padding: 14px 18px; text-align: center;">
                            <a href="{{ route('proyek.detail', $p->id) }}" style="padding: 6px 14px; background: linear-gradient(90deg, #2b3a8f, #7b6cf6); color: #fff; border-radius: 8px; font-size: 12.5px; font-weight: 700; text-decoration: none; display: inline-block;">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="padding: 60px 18px; text-align: center; color: #9aa2cc;">
                            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom: 12px; opacity: .5;"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <div style="font-family: 'Fredoka', sans-serif; font-weight: 700; font-size: 16px; color: #4b5686;">Belum Ada Proyek</div>
                            <div style="font-size: 13.5px; margin-top: 4px;">Belum ada proyek yang terdaftar di platform.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 32px;">
            {{ $projects->links() }}
        </div>

        @else
        {{-- ===================== USER: CARD GRID EKSPLORASI ===================== --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Eksplorasi Daftar Proyek</h1>
                <p class="page-desc">Temukan proyek kolaborasi yang sesuai dengan keahlian Anda, kirim proposal, dan bergabung dengan tim.</p>
            </div>
            <a href="{{ route('proyek.create') }}" class="btn pri">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                Buat Proyek Baru
            </a>
        </div>

        <!-- FILTER & SEARCH -->
        <div class="filter-card">
            <form action="{{ route('proyek') }}" method="GET" class="filter-form">
                <div>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari judul proyek, kata kunci, atau deskripsi...">
                </div>
                <div>
                    <select name="kategori" class="form-control">
                        <option value="Semua">Semua Kategori</option>
                        <option value="Web Development" {{ request('kategori') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                        <option value="Mobile App" {{ request('kategori') == 'Mobile App' ? 'selected' : '' }}>Mobile App</option>
                        <option value="UI/UX Design" {{ request('kategori') == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                        <option value="Data Science & AI" {{ request('kategori') == 'Data Science & AI' ? 'selected' : '' }}>Data Science & AI</option>
                        <option value="Digital Marketing" {{ request('kategori') == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                    </select>
                </div>
                <div>
                    <select name="skill_id" class="form-control">
                        <option value="">Semua Skill</option>
                        @foreach($allSkills as $sk)
                            <option value="{{ $sk->id }}" {{ request('skill_id') == $sk->id ? 'selected' : '' }}>{{ $sk->nama_skill }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn pri">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- DAFTAR PROYEK CARD GRID -->
        <div class="project-grid">
            @forelse($projects as $p)
                <div class="project-card">
                    <div>
                        <div class="card-top">
                            <span class="category-badge">{{ $p->kategori }}</span>
                            <span class="status-badge status-{{ str_replace(' ', '-', $p->status_project) }}">
                                {{ $p->status_project }}
                            </span>
                        </div>

                        <h3 class="project-title">
                            <a href="{{ route('proyek.detail', $p->id) }}">{{ $p->judul_project }}</a>
                        </h3>

                        <p class="project-desc">{{ $p->deskripsi }}</p>

                        <div class="project-skills">
                            @forelse($p->skills as $sk)
                                <span class="skill-pill">{{ $sk->nama_skill }}</span>
                            @empty
                                <span class="skill-pill" style="color: #9aa2cc;">Skill Terbuka</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="budget-box">
                            <div class="label">Budget Proyek</div>
                            <div class="amount">Rp {{ number_format($p->budget, 0, ',', '.') }}</div>
                        </div>

                        <div>
                            @if(in_array($p->id, $userAppliedProjectIds))
                                <span class="applied-badge">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Sudah Melamar
                                </span>
                            @else
                                <a href="{{ route('proyek.detail', $p->id) }}" class="btn outline" style="padding: 8px 16px; font-size: 13.5px;">
                                    Lihat Detail & Gabung →
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg width="64" height="64" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <h3>Belum Ada Proyek yang Ditemukan</h3>
                    <p>Coba gunakan kata kunci pencarian yang lain atau jadilah yang pertama membuat proyek baru!</p>
                    <a href="{{ route('proyek.create') }}" class="btn pri">+ Buat Proyek Baru Sekarang</a>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 32px;">
            {{ $projects->links() }}
        </div>
        @endif

    </main>

</body>
</html>
