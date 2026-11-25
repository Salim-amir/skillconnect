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
    transition: all 0.2s ease;
    overflow: hidden;
    flex-shrink: 0;
}
.user-profile .avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}
/* Topbar user info text (name + role) */
.user-profile .user-info {
    text-align: right;
}
.user-profile .user-info .name {
    font-weight: 700;
    color: #1c2766;
    font-size: 14.5px;
    line-height: 1.2;
    white-space: nowrap;
}
.user-profile .user-info .role {
    font-size: 12px;
    color: #7b6cf6;
    font-weight: 600;
    white-space: nowrap;
}
/* Legacy .role-badge di-override jadi konsisten dengan .role */
.user-profile .user-info .role-badge {
    display: inline;
    font-size: 12px;
    padding: 0;
    border-radius: 0;
    background: none;
    color: #7b6cf6;
    font-weight: 600;
    margin-top: 0;
}
/* Global .avatar standalone (di luar .user-profile) tetap sama */
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
    border-radius: 50%;
}
/* Global .user-info override for topbar consistency */
.top-bar .user-info {
    text-align: right;
}
.top-bar .user-info .name {
    font-weight: 700;
    color: #1c2766;
    font-size: 14.5px;
    line-height: 1.2;
    white-space: nowrap;
}
.top-bar .user-info .role,
.top-bar .user-info .role-badge {
    font-size: 12px;
    color: #7b6cf6;
    font-weight: 600;
    white-space: nowrap;
    display: block;
    background: none;
    border-radius: 0;
    padding: 0;
    margin: 0;
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
/* ===== ICON-ONLY PILL RAIL (default), EXPANDS ON CLICK ===== */
.sidebar {
    width: 76px;
    background: #ffffff;
    border: 1.5px solid #e6e9fc;
    border-radius: 999px;
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 16px;
    left: 16px;
    bottom: 16px;
    height: calc(100vh - 32px);
    z-index: 100;
    box-shadow: 0 20px 50px -12px rgba(79, 70, 229, 0.16);
    overflow: hidden;
    transition: width 0.32s cubic-bezier(0.16, 1, 0.3, 1), border-radius 0.32s ease, box-shadow 0.32s ease;
    cursor: pointer;
}
.sidebar.expanded {
    width: 254px;
    border-radius: 28px;
    box-shadow: 0 24px 55px -12px rgba(79, 70, 229, 0.22);
    cursor: default;
}

@media(min-width: 993px) {
    .main-content {
        margin-left: 108px !important;
        transition: margin-left 0.32s cubic-bezier(0.16, 1, 0.3, 1);
    }
    body.sidebar-is-expanded .main-content {
        margin-left: 286px !important;
    }
}

.sidebar-header {
    padding: 18px 10px 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0;
    border-bottom: 1.5px solid #f1f3ff;
    transition: padding 0.25s ease;
}
.sidebar.expanded .sidebar-header {
    flex-direction: row;
    justify-content: flex-start;
    padding: 20px 18px 16px;
}

.sidebar .brand {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 16.5px;
    letter-spacing: .04em;
    text-decoration: none;
    overflow: hidden;
}
.sidebar .brand svg {
    width: 40px;
    height: 24px;
    flex-shrink: 0;
    background: #f4f6ff;
    padding: 5px 7px;
    border-radius: 12px;
    border: 1px solid #e4e7fb;
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.sidebar:not(.expanded) .brand:hover svg {
    transform: translateY(-4px) scale(1.1);
}
.sidebar .brand span {
    display: none;
    background: linear-gradient(90deg, #1c2766, #7b6cf6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    white-space: nowrap;
}
.sidebar.expanded .brand span {
    display: inline;
}

/* Remove collapse button entirely */
.sidebar-collapse-btn {
    display: none !important;
}

.sidebar-nav {
    padding: 16px 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
}
.sidebar.expanded .sidebar-nav {
    padding: 16px 14px;
    align-items: stretch;
    gap: 6px;
}

.sidebar-nav::-webkit-scrollbar { width: 4px; }
.sidebar-nav::-webkit-scrollbar-thumb { background: #d6d9fb; border-radius: 99px; }

.nav-label {
    display: none;
    font-size: 10.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #8d98c2;
    padding: 4px 12px 4px;
    white-space: nowrap;
}
.sidebar.expanded .nav-label {
    display: block;
}

/* ===== NAV ITEM: clean circle (collapsed) -> pill (expanded) ===== */
.sidebar-nav .nav-item {
    width: 46px;
    height: 46px;
    padding: 0;
    border-radius: 50%;
    font-weight: 600;
    color: #5b6594;
    background: transparent;
    border: 1.5px solid transparent;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    text-decoration: none;
    white-space: nowrap;
    position: relative;
    flex-shrink: 0;
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1),
                background 0.2s ease,
                box-shadow 0.2s ease,
                color 0.2s ease,
                border-color 0.2s ease;
}
.sidebar.expanded .sidebar-nav .nav-item {
    width: 100%;
    height: auto;
    padding: 11px 16px;
    border-radius: 999px;
    justify-content: flex-start;
    background: #f8f9ff;
    border-color: #eceffd;
}

.sidebar-nav .nav-item .nav-text {
    display: none;
}
.sidebar.expanded .sidebar-nav .nav-item .nav-text {
    display: inline;
}

.sidebar-nav .nav-item svg {
    width: 21px;
    height: 21px;
    flex-shrink: 0;
}

/* ===== HOVER: gelembung naik (bubble rise) saat icon-only ===== */
.sidebar:not(.expanded) .sidebar-nav .nav-item:hover {
    transform: translateY(-6px) scale(1.15);
    background: #eef1ff;
    color: #2b3a8f;
    box-shadow: 0 10px 22px -5px rgba(123, 108, 246, 0.32);
}
.sidebar.expanded .sidebar-nav .nav-item:hover {
    background: #eef1ff;
    border-color: #d3dafc;
    color: #1c2766;
    transform: translateX(3px);
}

/* ===== ACTIVE STATE ===== */
.sidebar .sidebar-nav .nav-item.active {
    background: linear-gradient(135deg, #2b3a8f, #7b6cf6) !important;
    color: #ffffff !important;
    border-color: transparent !important;
    font-weight: 700 !important;
    box-shadow: 0 8px 20px -4px rgba(123, 108, 246, 0.48) !important;
}
.sidebar.expanded .sidebar-nav .nav-item.active {
    background: linear-gradient(135deg, #2b3a8f, #7b6cf6) !important;
    border-color: transparent !important;
    color: #ffffff !important;
}
.sidebar .sidebar-nav .nav-item.active .nav-text,
.sidebar .sidebar-nav .nav-item.active svg {
    color: #ffffff !important;
}

.sidebar-footer {
    padding: 12px 10px;
    border-top: 1.5px solid #f0f2ff;
    margin-top: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}
.sidebar.expanded .sidebar-footer {
    padding: 14px;
    align-items: stretch;
    gap: 10px;
}

/* User avatar mini */
.sidebar-user-mini {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 4px;
    border-radius: 999px;
    background: #f6f8ff;
    border: 1.5px solid #e6e9fc;
    text-decoration: none;
    transition: background .2s, transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.sidebar.expanded .sidebar-user-mini {
    justify-content: flex-start;
    padding: 7px 10px;
}
.sidebar:not(.expanded) .sidebar-user-mini:hover {
    background: #eef1ff;
    transform: translateY(-5px) scale(1.1);
}
.sidebar.expanded .sidebar-user-mini:hover {
    background: #eef1ff;
}
.sidebar-user-mini .mini-meta {
    display: none;
}
.sidebar.expanded .sidebar-user-mini .mini-meta {
    display: block;
}
.sidebar-user-mini .mini-av {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f5fe0, #7b6cf6);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 14px;
    flex-shrink: 0;
    overflow: hidden;
    border: 2px solid #ffffff;
    box-shadow: 0 3px 8px rgba(123, 108, 246, 0.3);
}
.sidebar-user-mini .mini-av img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.sidebar-user-mini .mini-meta {
    overflow: hidden;
    line-height: 1.2;
}
.sidebar-user-mini .mini-name {
    color: #1c2766;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.sidebar-user-mini .mini-role {
    color: #7b6cf6;
    font-size: 11px;
    font-weight: 600;
    text-transform: capitalize;
}

.btn-logout {
    width: 48px;
    height: 48px;
    padding: 0;
    background: #fff1f2;
    border: 1.5px solid #fecdd3;
    color: #e11d48;
    border-radius: 50%;
    font-weight: 700;
    font-size: 13.5px;
    font-family: inherit;
    cursor: pointer;
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), background 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin: 0 auto;
}
.sidebar.expanded .btn-logout {
    width: 100%;
    height: auto;
    padding: 10px 14px;
    border-radius: 999px;
}
.sidebar:not(.expanded) .btn-logout:hover {
    background: #ffe4e6;
    border-color: #fda4af;
    transform: translateY(-5px) scale(1.1);
    box-shadow: 0 8px 20px -4px rgba(225, 29, 72, 0.25);
}
.sidebar.expanded .btn-logout:hover {
    background: #ffe4e6;
    border-color: #fda4af;
}
.btn-logout .nav-text {
    display: none;
}
.sidebar.expanded .btn-logout .nav-text {
    display: inline;
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
    border: 1.5px solid #e0e3fa;
    background: #f6f7ff;
    color: #1c2766;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .2s;
    margin-left: auto;
}
.sidebar-close-btn:active {
    background: #eef1ff;
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
        border-radius: 0 24px 24px 0 !important;
        z-index: 9999 !important;
        background: #ffffff !important;
        transform: translateX(-100%);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        display: flex !important;
        overflow: hidden !important;
        box-shadow: 0 0 50px rgba(15, 23, 42, 0.25) !important;
    }
    .sidebar.open {
        transform: translateX(0) !important;
    }
    .sidebar-close-btn {
        display: flex;
    }
    .sidebar-header {
        flex-direction: row;
        justify-content: space-between;
        padding: 16px 18px;
    }
    .sidebar .brand span {
        display: inline;
        background: linear-gradient(90deg, #1c2766, #7b6cf6);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        font-family: 'Fredoka', sans-serif;
        font-weight: 700;
        font-size: 16.5px;
        letter-spacing: .04em;
    }
    .sidebar .brand {
        gap: 9px;
    }
    .sidebar-nav {
        padding: 16px 14px;
        align-items: stretch;
        overflow-y: auto;
    }
    .nav-label {
        display: block !important;
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #8d98c2;
        padding: 4px 12px 2px;
    }
    .sidebar-nav .nav-item {
        width: 100%;
        height: auto;
        padding: 11px 16px;
        border-radius: 999px;
        justify-content: flex-start;
        gap: 12px;
    }
    .sidebar-nav .nav-item .nav-text {
        display: inline;
    }
    .nav-tooltip {
        display: none !important;
    }
    .sidebar-footer {
        padding: 14px;
        align-items: stretch;
    }
    .sidebar-user-mini {
        justify-content: flex-start;
        gap: 10px;
        padding: 7px 10px;
    }
    .sidebar-user-mini .mini-meta {
        display: block;
    }
    .btn-logout {
        width: 100%;
        height: auto;
        padding: 10px 14px;
        border-radius: 999px;
    }
    .btn-logout .nav-text {
        display: inline;
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
<aside class="sidebar" id="mainSidebar">
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
            <a href="{{ route('dashboard') }}" aria-label="Dashboard" class="nav-item {{ request()->routeIs('dashboard') || request()->is('admin/dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="/admin/pengguna" aria-label="Pengguna" class="nav-item {{ request()->is('admin/pengguna*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="nav-text">Pengguna</span>
            </a>
            <a href="/admin/proyek" aria-label="Proyek" class="nav-item {{ request()->is('admin/proyek*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                <span class="nav-text">Proyek</span>
            </a>
            <a href="/admin/transaksi" aria-label="Transaksi" class="nav-item {{ request()->is('admin/transaksi*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                <span class="nav-text">Transaksi</span>
            </a>
            <a href="/admin/laporan" aria-label="Laporan" class="nav-item {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="nav-text">Laporan</span>
            </a>

        @elseif(auth()->check() && auth()->user()->role === 'creator')
            <span class="nav-label">Menu Creator</span>
            <a href="{{ route('dashboard') }}" aria-label="Dashboard" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="{{ route('proyek.create') }}" aria-label="Buat Proyek Baru" class="nav-item {{ request()->routeIs('proyek.create') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                <span class="nav-text">Buat Proyek Baru</span>
            </a>
            <a href="{{ route('proyek') }}" aria-label="Kelola Proyek" class="nav-item {{ request()->routeIs('proyek') || request()->routeIs('proyek.detail') || request()->routeIs('proyek.tasks') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                <span class="nav-text">Kelola Proyek</span>
            </a>
            <a href="{{ route('proyek.riwayat') }}" aria-label="Riwayat & Transaksi" class="nav-item {{ request()->routeIs('proyek.riwayat') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="nav-text">Riwayat & Transaksi</span>
            </a>

        @else
            <!-- MENU UNTUK MEMBER -->
            <span class="nav-label">Menu Member</span>
            <a href="{{ route('dashboard') }}" aria-label="Dashboard" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="{{ route('proyek') }}" aria-label="Jelajahi Proyek" class="nav-item {{ request()->routeIs('proyek') || request()->routeIs('proyek.detail') || request()->routeIs('proyek.tasks') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span class="nav-text">Jelajahi Proyek</span>
            </a>
            <a href="{{ route('proyek.riwayat') }}" aria-label="Portofolio & Fee" class="nav-item {{ request()->routeIs('proyek.riwayat') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="nav-text">Portofolio & Fee</span>
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        @if(auth()->check())
            <a href="{{ route('profile.skill') }}" class="sidebar-user-mini" title="Kelola Profil">
                <div class="mini-av">
                    @if(auth()->user()->foto_profil)
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="{{ auth()->user()->name }}">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="mini-meta">
                    <div class="mini-name">{{ auth()->user()->name }}</div>
                    <div class="mini-role">{{ auth()->user()->role }}</div>
                </div>
            </a>
        @endif
        <form id="global-logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button" class="btn-logout" title="Keluar Akun" onclick="openLogoutModal()">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="nav-text">Keluar Akun</span>
            </button>
        </form>
    </div>
</aside>

<script>
// Restore expanded state immediately to prevent flicker on page navigation
(function() {
    try {
        if (window.innerWidth > 992 && localStorage.getItem('sc_sidebar_expanded') === '1') {
            var sb = document.getElementById('mainSidebar');
            if (sb) {
                sb.style.transition = 'none';
                sb.classList.add('expanded');
                document.body.classList.add('sidebar-is-expanded');
                requestAnimationFrame(function() {
                    requestAnimationFrame(function() {
                        sb.style.transition = '';
                    });
                });
            }
        }
    } catch (e) {}
})();

// Desktop click-to-toggle sidebar:
// - Default is icon-only pill rail with bubble-rise hover effect.
// - Clicking when collapsed expands the sidebar and persists state across pages.
// - When expanded, clicking another menu item navigates normally and keeps sidebar open.
// - Clicking the active menu item again (or header/empty sidebar area) collapses it back.
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('mainSidebar');
    if (!sidebar) return;

    function expandSidebar() {
        sidebar.classList.add('expanded');
        document.body.classList.add('sidebar-is-expanded');
        try { localStorage.setItem('sc_sidebar_expanded', '1'); } catch (e) {}
    }

    function collapseSidebar() {
        sidebar.classList.remove('expanded');
        document.body.classList.remove('sidebar-is-expanded');
        try { localStorage.setItem('sc_sidebar_expanded', '0'); } catch (e) {}
    }

    sidebar.addEventListener('click', function(e) {
        if (window.innerWidth <= 992) return;

        if (!sidebar.classList.contains('expanded')) {
            // First click expands sidebar to show menu labels instead of navigating/triggering immediately
            if (e.target.closest('a') || e.target.closest('button')) {
                e.preventDefault();
                e.stopPropagation();
            }
            expandSidebar();
            return;
        }

        // Sidebar is already expanded:
        // Clicking the currently active nav item or brand logo toggles it closed
        const clickedActiveNav = e.target.closest('.nav-item.active');
        const clickedBrand = e.target.closest('.brand');
        const clickedEmptySpace = !e.target.closest('a') && !e.target.closest('button') && !e.target.closest('form');

        if (clickedActiveNav || clickedBrand || clickedEmptySpace) {
            if (clickedActiveNav || clickedBrand) {
                e.preventDefault();
                e.stopPropagation();
            }
            collapseSidebar();
        }
    }, true);
});
</script>

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
