<style>
/* ===== UNIFIED SIDEBAR CSS ===== */
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

@media(max-width: 992px) {
    .sidebar { display: none; }
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

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-header">
        <a class="brand" href="/" aria-label="SkillConnect">
            <svg viewBox="0 0 64 32" fill="none">
              <defs><linearGradient id="sb_g" x1="0" y1="0" x2="1" y2="0"><stop offset="0" stop-color="#4d6bff"/><stop offset="1" stop-color="#9b5cff"/></linearGradient></defs>
              <path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#sb_g)" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>SKILL CONNECT</span>
        </a>
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
            <a href="{{ route('profile.skill') }}" class="nav-item {{ request()->routeIs('profile.skill') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Profil & Keahlian
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
</script>
