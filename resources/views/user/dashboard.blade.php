<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Dashboard - SkillConnect</title>
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

/* ===== DASHBOARD CARDS ===== */
.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 28px;
    color: #1c2766;
    margin-bottom: 24px;
}

.grid-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}

.card {
    background: #fff;
    border: 1.5px solid #e0e3fa;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 10px 30px -20px rgba(80,70,200,.2);
    transition: transform .2s, box-shadow .2s;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 44px -26px rgba(80,70,200,.4);
}

.card-title {
    font-size: 15px;
    font-weight: 600;
    color: #4b5686;
    margin-bottom: 12px;
}

.stat-value {
    font-family: 'Fredoka', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: #1c2766;
}
.stat-value.currency {
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.grid-content {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 24px;
}

.card.full-width {
    grid-column: 1 / -1;
}

@media (max-width: 900px) {
    .grid-content {
        grid-template-columns: 1fr;
    }
    .grid-stats {
        grid-template-columns: 1fr;
    }
}

/* Task & List Items */
.list-item {
    padding: 16px;
    border-radius: 12px;
    background: #f8f9ff;
    border: 1px solid #edf0ff;
    margin-bottom: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.list-item:last-child {
    margin-bottom: 0;
}

.task-info h4 {
    color: #1c2766;
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 4px;
}

.task-info p {
    color: #4b5686;
    font-size: 13px;
}

.badge {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
}
.badge.danger { background: #ffe5e5; color: #d8000c; }
.badge.success { background: #e5ffe5; color: #008000; }
.badge.warning { background: #fff5e5; color: #cc7a00; }

.btn-group {
    display: flex;
    gap: 8px;
}

.btn-sm {
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 13px;
    border: 1.5px solid transparent;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    transition: .2s;
}

.btn-sm.pri {
    background: linear-gradient(90deg,#2b3a8f,#7b6cf6);
    color: #fff;
}
.btn-sm.pri:hover {
    box-shadow: 0 4px 12px rgba(123,108,246,.4);
    transform: translateY(-1px);
}

.btn-sm.ghost {
    background: #fff;
    border-color: #d6d9fb;
    color: #4b5686;
}
.btn-sm.ghost:hover {
    border-color: #7b6cf6;
    color: #1c2766;
}

/* ===== Toast Notification ===== */
.toast-notification {
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%) translateY(100px);
    background: linear-gradient(135deg, #7c8cf8, #a78bfa);
    color: #fff;
    padding: 16px 28px;
    border-radius: 14px;
    font-size: 15px;
    font-weight: 700;
    font-family: 'Nunito', sans-serif;
    z-index: 9999;
    box-shadow: 0 10px 40px -8px rgba(124, 140, 248, 0.45);
    opacity: 0;
    animation: toastSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards,
               toastSlideDown 0.4s cubic-bezier(0.55, 0, 1, 0.45) 3.5s forwards;
    display: flex;
    align-items: center;
    gap: 8px;
    text-align: center;
    letter-spacing: 0.3px;
    pointer-events: none;
}
.toast-notification.toast-error {
    background: linear-gradient(135deg, #f87171, #f43f5e);
    box-shadow: 0 10px 40px -8px rgba(248, 113, 113, 0.45);
}

@keyframes toastSlideUp {
    0% { opacity: 0; transform: translateX(-50%) translateY(100px); }
    100% { opacity: 1; transform: translateX(-50%) translateY(0); }
}

@keyframes toastSlideDown {
    0% { opacity: 1; transform: translateX(-50%) translateY(0); }
    100% { opacity: 0; transform: translateX(-50%) translateY(100px); }
}

@media(max-width: 992px) {
    .main-content {
        margin-left: 0 !important;
        padding: 16px !important;
        padding-top: 76px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }
    .top-bar { display: none !important; }
    .grid-stats { grid-template-columns: repeat(2, 1fr); }
}
@media(max-width: 600px) {
    .grid-stats { grid-template-columns: 1fr; }
}
/* ===== INJECTED RESPONSIVE CSS ===== */

@media(max-width: 992px) {
    .main-content {
        margin-left: 0 !important;
        padding: 16px !important;
        padding-top: 76px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        overflow-x: hidden !important;
    }
    .top-bar { display: none !important; }
    .grid-stats, .grid-stats-4, .stats-grid { grid-template-columns: repeat(2, 1fr) !important; }
    .grid-content { grid-template-columns: 1fr !important; }
    .filter-bar { flex-direction: column !important; align-items: stretch !important; }
}
@media(max-width: 600px) {
    .grid-stats, .grid-stats-4, .stats-grid { grid-template-columns: 1fr !important; }
    .search-box, .btn { width: 100% !important; }
}
.table-responsive {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

</style>
</head>
<body>

    @include('shared.sidebar')


    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- TOP BAR -->
        <header class="top-bar">
            <div class="user-profile">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Nama Pengguna' }}</div>
                    <div class="role">
                        @if(auth()->check() && auth()->user()->role === 'creator')
                            Project Creator
                        @elseif(auth()->check() && auth()->user()->role === 'member')
                            Project Member
                        @else
                            {{ ucfirst(auth()->user()->role ?? 'User') }}
                        @endif
                    </div>
                </div>
                <div class="avatar">{{ substr(auth()->check() ? auth()->user()->name : 'U', 0, 1) }}</div>
            </div>
        </header>

        {{-- Toast notifications are rendered as fixed bottom popups --}}

        <!-- ===================== USER DASHBOARD ===================== -->
        <h1 class="page-title">Dashboard Pengguna</h1>

        <!-- 3 SUMMARY CARDS -->
        <div class="grid-stats">
            <div class="card">
                <div class="card-title">Proyek Aktif</div>
                <div class="stat-value">{{ $totalActive ?? 0 }}</div>
            </div>
            <div class="card">
                <div class="card-title">Proyek Selesai</div>
                <div class="stat-value">{{ $totalCompleted ?? 0 }}</div>
            </div>
            <div class="card">
                <div class="card-title">Total Pemasukan</div>
                <div class="stat-value currency">Rp {{ number_format($totalEarned ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- DASHBOARD CARDS GRID -->
        <div class="grid-content">
            
            <!-- Tugas Mendekati Deadline -->
            <div class="card">
                <div class="card-title">Tugas Mendekati Deadline</div>
                <div class="task-list">
                    <div class="list-item">
                        <div class="task-info">
                            <h4>Desain UI/UX Landing Page</h4>
                            <p>Proyek: Aplikasi E-Commerce</p>
                        </div>
                        <span class="badge danger">Besok</span>
                    </div>
                    <div class="list-item">
                        <div class="task-info">
                            <h4>Setup Database MySQL</h4>
                            <p>Proyek: Sistem Manajemen Kasir</p>
                        </div>
                        <span class="badge warning">3 Hari lagi</span>
                    </div>
                    <div class="list-item">
                        <div class="task-info">
                            <h4>Integrasi API Payment Gateway</h4>
                            <p>Proyek: Aplikasi E-Commerce</p>
                        </div>
                        <span class="badge success">Aman</span>
                    </div>
                </div>
            </div>

            <!-- Status Pendaftaran Proyek -->
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                    <div class="card-title" style="margin-bottom: 0;">Status Pendaftaran Proyek</div>
                    <a href="{{ route('proyek') }}" style="font-size: 13px; font-weight: 700; color: #7b6cf6; text-decoration: none;">Cari Proyek &rarr;</a>
                </div>
                <div class="application-list">
                    @if(isset($myApplications) && $myApplications->count() > 0)
                        @foreach($myApplications as $app)
                            <div class="list-item">
                                <div class="task-info">
                                    <h4>{{ $app->judul_project }}</h4>
                                    <p>Creator: {{ $app->creator_name ?? 'Project Creator' }} &bull; Posisi: {{ $app->peran }}</p>
                                </div>
                                <div>
                                    @if($app->status_keanggotaan === 'Diterima')
                                        <span class="badge success">Diterima</span>
                                    @elseif($app->status_keanggotaan === 'Ditolak')
                                        <span class="badge danger">Ditolak</span>
                                    @else
                                        <span class="badge warning">{{ $app->status_keanggotaan ?? 'Menunggu Review' }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="list-item">
                            <div class="task-info">
                                <h4>Pengembangan Sistem ERP Berbasis Web</h4>
                                <p>Creator: PT Teknologi Maju &bull; Posisi: Backend Developer (Laravel)</p>
                            </div>
                            <span class="badge warning">Menunggu Review</span>
                        </div>
                        <div class="list-item">
                            <div class="task-info">
                                <h4>Aplikasi Booking Futsal</h4>
                                <p>Creator: Budi Santoso &bull; Posisi: UI/UX Designer</p>
                            </div>
                            <span class="badge success">Diterima</span>
                        </div>
                        <div class="list-item">
                            <div class="task-info">
                                <h4>Platform E-Commerce Fashion</h4>
                                <p>Creator: Toko Busana &bull; Posisi: Frontend Developer</p>
                            </div>
                            <span class="badge warning">Menunggu Review</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Rincian Pemasukan Terakhir (Full Width) -->
            <div class="card full-width">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                    <div class="card-title" style="margin-bottom: 0;">Rincian Pemasukan Terakhir</div>
                    <a href="{{ route('proyek.riwayat') }}" style="font-size: 13px; font-weight: 700; color: #7b6cf6; text-decoration: none;">Lihat Portofolio & Fee &rarr;</a>
                </div>
                <div class="income-list" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 14px;">
                    <div class="list-item" style="margin-bottom: 0;">
                        <div class="task-info">
                            <h4>Pembayaran Termin 2 (Final)</h4>
                            <p>Proyek: Redesign Website Perusahaan</p>
                        </div>
                        <div style="font-weight: 700; color: #008000; font-size: 15px;">+ Rp 1.500.000</div>
                    </div>
                    <div class="list-item" style="margin-bottom: 0;">
                        <div class="task-info">
                            <h4>Pembayaran Termin 1 (DP)</h4>
                            <p>Proyek: Aplikasi Mobile E-Learning</p>
                        </div>
                        <div style="font-weight: 700; color: #008000; font-size: 15px;">+ Rp 2.000.000</div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    @if(session('success'))
        <div class="toast-notification" id="toastNotif">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="toast-notification toast-error" id="toastNotif">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

<script>
    // Auto-remove toast dari DOM setelah animasi selesai
    const toast = document.getElementById('toastNotif');
    if (toast) {
        setTimeout(() => {
            toast.remove();
        }, 4000);
    }
</script>
</body>
</html>
