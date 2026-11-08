<style>
/* ===== UNIFIED SIDEBAR CSS ===== */
/* ===== Clickable Topbar User Profile ===== */
.user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none !important;
    cursor: pointer;
    padding: 4px 10px;
    border-radius: 28px;
    transition: all 0.2s ease;
}
.user-profile:hover {
    background: rgba(123, 108, 246, 0.08);
    transform: translateY(-1px);
}
.user-profile:hover .avatar {
    transform: scale(1.05);
    box-shadow: 0 6px 16px rgba(123, 108, 246, 0.45);
}
.user-profile .avatar {
    transition: all 0.2s ease;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.user-profile .avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

/* ===== GLOBAL FLOATING TOAST POPUP ===== */
.toast-notification {
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%) translateY(100px);
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    color: #fff;
    padding: 16px 28px;
    border-radius: 16px;
    font-size: 14.5px;
    font-weight: 700;
    font-family: 'Nunito', system-ui, sans-serif;
    z-index: 999999;
    box-shadow: 0 12px 36px -6px rgba(79, 70, 229, 0.45);
    opacity: 0;
    animation: toastSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards,
               toastSlideDown 0.4s cubic-bezier(0.55, 0, 1, 0.45) 3.5s forwards;
    display: flex;
    align-items: center;
    gap: 12px;
    text-align: left;
    max-width: 90vw;
    pointer-events: auto;
    cursor: pointer;
}
.toast-notification.toast-error {
    background: linear-gradient(135deg, #e11d48, #f43f5e);
    box-shadow: 0 12px 36px -6px rgba(225, 29, 72, 0.45);
}
.toast-notification svg {
    flex-shrink: 0;
}

@keyframes toastSlideUp {
    0% { opacity: 0; transform: translateX(-50%) translateY(100px); }
    100% { opacity: 1; transform: translateX(-50%) translateY(0); }
}

@keyframes toastSlideDown {
    0% { opacity: 1; transform: translateX(-50%) translateY(0); }
    100% { opacity: 0; transform: translateX(-50%) translateY(100px); }
}
    .sidebar {
    width: 280px;
    background: #fff;
    border-right: 1.5px solid #e0e3fa;
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 100;
    box-shadow: 0 0 40px rgba(80,70,200,.04);
}

.sidebar-header {
    padding: 24px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1.5px solid #f0f2ff;
}

.sidebar .brand {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 19px;
    letter-spacing: .05em;
    text-decoration: none;
}
.sidebar .brand svg { width: 44px; height: 22px; flex-shrink: 0; }
.sidebar .brand span {
    background: linear-gradient(90deg, #1c2766, #7b6cf6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.sidebar-nav {
    padding: 20px 16px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
    overflow-y: auto;
}

.nav-label {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #8d98c2;
    padding: 8px 14px 4px;
}

.sidebar-nav .nav-item {
    padding: 12px 18px;
    border-radius: 12px;
    font-weight: 600;
    color: #4b5686;
    font-size: 14.5px;
    transition: all .2s;
    border: 1.5px solid transparent;
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
}

.sidebar-nav .nav-item svg {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
}

.sidebar-nav .nav-item:hover {
    background: #f4f6ff;
    color: #1c2766;
}

.sidebar-nav .nav-item.active {
    background: linear-gradient(90deg, rgba(43,58,143,0.1), rgba(123,108,246,0.1));
    color: #2b3a8f;
    border-color: #d6d9fb;
    font-weight: 700;
}

.sidebar-footer {
    padding: 18px 16px;
    border-top: 1.5px solid #f0f2ff;
    margin-top: auto;
}

.btn-logout {
    width: 100%;
    padding: 11px;
    background: #fff;
    border: 1.5px solid #fecdd3;
    color: #e11d48;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    font-family: inherit;
    cursor: pointer;
    transition: .2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.btn-logout:hover {
    background: #ffe4e6;
    border-color: #fda4af;
}

/* ===== MOBILE TOP BAR (SHOWN ON <= 992px) ===== */
.mobile-top-bar {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 60px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1.5px solid #e0e3fa;
    z-index: 990;
    padding: 0 16px;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 10px rgba(80, 70, 200, 0.05);
}

.mobile-toggle-btn {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    border: 1.5px solid #e0e3fa;
    background: #f8f9ff;
    color: #1c2766;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .2s;
}
.mobile-toggle-btn:active {
    background: #eef1ff;
    transform: scale(0.95);
}

.mobile-user-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f5fe0, #7b6cf6);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 15px;
    box-shadow: 0 3px 8px rgba(123, 108, 246, 0.35);
}

.sidebar-close-btn {
    display: none;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    border: 1.5px solid #e2e8f0;
    background: #f8fafc;
    color: #64748b;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .2s;
    margin-left: auto;
}
.sidebar-close-btn:active {
    background: #e2e8f0;
}

/* ===== SIDEBAR BACKDROP OVERLAY ===== */
.sidebar-backdrop {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.55);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: 9998;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.sidebar-backdrop.show {
    display: block;
    opacity: 1;
}

@media(max-width: 992px) {
    .mobile-top-bar {
        display: flex;
    }
        .sidebar {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        bottom: 0 !important;
        height: 100vh !important;
        height: 100dvh !important;
        width: min(300px, 84vw) !important;
        z-index: 9999 !important;
        background: #fff !important;
        transform: translateX(-100%);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        display: flex !important;
        box-shadow: 0 0 50px rgba(15, 23, 42, 0.25) !important;
    }
    .sidebar.open {
        transform: translateX(0) !important;
    }
    .sidebar-close-btn {
        display: flex;
    }
    .sidebar-header {
        justify-content: space-between;
        padding: 16px 18px;
    }
    /* Auto adjust all content on mobile */
    .main-content {
        margin-left: 0 !important;
        padding: 16px !important;
        padding-top: 76px !important; /* space for fixed mobile topbar */
        width: 100% !important;
        max-width: 100vw !important;
        box-sizing: border-box !important;
        overflow-x: hidden !important;
    }
    .top-bar {
        display: none !important;
    }
}

/* ===== LOGOUT CONFIRMATION MODAL ===== */
.logout-modal-backdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    z-index: 99999;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    transition: opacity .25s ease;
}
.logout-modal-backdrop.show {
    display: flex;
    opacity: 1;
}

.logout-modal-card {
    background: #fff;
    border-radius: 20px;
    width: 100%;
    max-width: 420px;
    padding: 32px 28px;
    text-align: center;
    box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.35);
    border: 1px solid #e2e8f0;
    transform: scale(0.95);
    animation: modalPop .25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes modalPop {
    from { transform: scale(0.92); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.logout-modal-icon {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    background: #fee2e2;
    color: #e11d48;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    box-shadow: 0 8px 16px -4px rgba(225, 29, 72, 0.25);
}
.logout-modal-icon svg {
    width: 28px;
    height: 28px;
}

.logout-modal-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}

.logout-modal-desc {
    font-size: 14px;
    color: #64748b;
    line-height: 1.5;
    margin-bottom: 24px;
}

.logout-modal-actions {
    display: flex;
    gap: 12px;
}

.btn-modal-cancel {
    flex: 1;
    padding: 12px 18px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #cbd5e1;
    cursor: pointer;
    transition: all .2s;
    font-family: inherit;
}
.btn-modal-cancel:hover {
    background: #e2e8f0;
    color: #1e293b;
}

.btn-modal-confirm {
    flex: 1;
    padding: 12px 18px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    background: linear-gradient(135deg, #e11d48, #be123c);
    color: #fff;
    border: none;
    cursor: pointer;
    transition: all .2s;
    box-shadow: 0 4px 14px rgba(225, 29, 72, 0.35);
    font-family: inherit;
}
.btn-modal-confirm:hover {
    background: linear-gradient(135deg, #be123c, #9f1239);
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(225, 29, 72, 0.45);
}
</style>

<!-- MOBILE TOP BAR -->
<header class="mobile-top-bar">
    <button type="button" class="mobile-toggle-btn" onclick="toggleMobileSidebar()" aria-label="Buka Menu">
        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
    <a class="brand" href="{{ route('dashboard') }}" aria-label="SkillConnect" style="text-decoration:none; display:flex; align-items:center; gap:8px;">
        <svg viewBox="0 0 64 32" fill="none" style="width:36px; height:18px;">
          <defs><linearGradient id="sb_g_mob" x1="0" y1="0" x2="1" y2="0"><stop offset="0" stop-color="#4d6bff"/><stop offset="1" stop-color="#9b5cff"/></linearGradient></defs>
          <path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#sb_g_mob)" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span style="font-family:'Fredoka',sans-serif; font-size:16px; font-weight:700; background:linear-gradient(90deg, #1c2766, #7b6cf6); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">SKILL CONNECT</span>
    </a>
    <a href="{{ route('profile.skill') }}" class="mobile-user-avatar" title="Kelola Profil" style="text-decoration:none; display:flex; align-items:center; justify-content:center; overflow:hidden;">
        @if(auth()->check() && auth()->user()->foto_profil)
            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="{{ auth()->user()->name }}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
        @else
            {{ substr(auth()->check() ? auth()->user()->name : 'U', 0, 1) }}
        @endif
    </a>
</header>

<!-- BACKDROP OVERLAY UNTUK MOBILE DRAWER -->
<div id="sidebarBackdrop" class="sidebar-backdrop" onclick="closeMobileSidebar()"></div>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-header">
        <a class="brand" href="{{ route('dashboard') }}" aria-label="SkillConnect">
            <svg viewBox="0 0 64 32" fill="none">
              <defs><linearGradient id="sb_g" x1="0" y1="0" x2="1" y2="0"><stop offset="0" stop-color="#4d6bff"/><stop offset="1" stop-color="#9b5cff"/></linearGradient></defs>
              <path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#sb_g)" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>SKILL CONNECT</span>
        </a>
        <button type="button" class="sidebar-close-btn" onclick="closeMobileSidebar()" aria-label="Tutup Menu">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <nav class="sidebar-nav">
        @if(auth()->check() && auth()->user()->role === 'admin')
            <span class="nav-label">Menu Admin</span>
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') || request()->is('admin/dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="/admin/pengguna" class="nav-item {{ request()->is('admin/pengguna*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Pengguna
            </a>
            <a href="/admin/proyek" class="nav-item {{ request()->is('admin/proyek*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                Proyek
            </a>
            <a href="/admin/transaksi" class="nav-item {{ request()->is('admin/transaksi*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                Transaksi
            </a>
            <a href="/admin/laporan" class="nav-item {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Laporan
            </a>

        @elseif(auth()->check() && auth()->user()->role === 'creator')
            <span class="nav-label">Menu Creator</span>
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('proyek.create') }}" class="nav-item {{ request()->routeIs('proyek.create') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                Buat Proyek Baru
            </a>
            <a href="{{ route('proyek') }}" class="nav-item {{ request()->routeIs('proyek') || request()->routeIs('proyek.detail') || request()->routeIs('proyek.tasks') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                Kelola Proyek
            </a>
            <a href="{{ route('proyek.riwayat') }}" class="nav-item {{ request()->routeIs('proyek.riwayat') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Riwayat & Transaksi
            </a>

        @else
            <!-- MENU UNTUK MEMBER -->
            <span class="nav-label">Menu Member</span>
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('proyek') }}" class="nav-item {{ request()->routeIs('proyek') || request()->routeIs('proyek.detail') || request()->routeIs('proyek.tasks') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Jelajahi Proyek
            </a>
            <a href="{{ route('proyek.riwayat') }}" class="nav-item {{ request()->routeIs('proyek.riwayat') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Portofolio & Fee
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <form id="global-logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button" class="btn-logout" onclick="openLogoutModal()">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Keluar Akun
            </button>
        </form>
    </div>
</aside>

<!-- POPUP MODAL KONFIRMASI LOGOUT -->
<div id="logoutModal" class="logout-modal-backdrop" onclick="closeLogoutModalOnBackdrop(event)">
    <div class="logout-modal-card">
        <div class="logout-modal-icon">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
        </div>
        <h3 class="logout-modal-title">Konfirmasi Keluar Akun</h3>
        <p class="logout-modal-desc">
            Apakah Anda yakin ingin keluar dari akun SkillConnect? Anda harus masuk kembali untuk mengakses dasbor dan aktivitas Anda.
        </p>
        <div class="logout-modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeLogoutModal()">
                Batal
            </button>
            <button type="button" class="btn-modal-confirm" onclick="document.getElementById('global-logout-form').submit()">
                Ya, Keluar Akun
            </button>
        </div>
    </div>
</div>

<script>
function toggleMobileSidebar() {
    const sb = document.querySelector('.sidebar');
    const bd = document.getElementById('sidebarBackdrop');
    if (sb && bd) {
        sb.classList.toggle('open');
        bd.classList.toggle('show');
        document.body.style.overflow = sb.classList.contains('open') ? 'hidden' : '';
    }
}
function closeMobileSidebar() {
    const sb = document.querySelector('.sidebar');
    const bd = document.getElementById('sidebarBackdrop');
    if (sb && bd) {
        sb.classList.remove('open');
        bd.classList.remove('show');
        document.body.style.overflow = '';
    }
}

function openLogoutModal() {
    const modal = document.getElementById('logoutModal');
    if (modal) {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
}
function closeLogoutModal() {
    const modal = document.getElementById('logoutModal');
    if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }
}
function closeLogoutModalOnBackdrop(e) {
    if (e.target.id === 'logoutModal') {
        closeLogoutModal();
    }
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLogoutModal();
    }
});

// Auto remove global toast notification
document.addEventListener('DOMContentLoaded', function() {
    const globalToast = document.getElementById('globalToastNotif');
    if (globalToast) {
        setTimeout(function() {
            if (globalToast && globalToast.parentNode) {
                globalToast.remove();
            }
        }, 4000);
    }
});
</script>

<!-- GLOBAL FLOATING TOAST POPUP NOTIFICATION -->
@if(session('success'))
    <div class="toast-notification" id="globalToastNotif" onclick="this.remove()" title="Klik untuk menutup">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="toast-notification toast-error" id="globalToastNotif" onclick="this.remove()" title="Klik untuk menutup">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('error') }}</span>
    </div>
@elseif($errors->any())
    <div class="toast-notification toast-error" id="globalToastNotif" onclick="this.remove()" title="Klik untuk menutup">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ $errors->first() }}</span>
    </div>
@endif

@if(session('info'))
    <div class="toast-notification" id="globalToastNotif" onclick="this.remove()" title="Klik untuk menutup">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('info') }}</span>
    </div>
@endif
