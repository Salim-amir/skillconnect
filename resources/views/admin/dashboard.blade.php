<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Dashboard Admin - SkillConnect</title>
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
    grid-template-columns: 1.2fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
}

/* Chart Placeholder */
.chart-placeholder {
    width: 100%;
    height: 220px;
    background: repeating-linear-gradient(
        45deg,
        #f4f6ff,
        #f4f6ff 10px,
        #ffffff 10px,
        #ffffff 20px
    );
    border: 1.5px dashed #d6d9fb;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #8f9bd8;
    font-weight: 600;
    font-family: 'Fredoka', sans-serif;
}

/* Admin Table & Grid */
.grid-stats-4 {
    grid-template-columns: repeat(4, 1fr);
}
@media(max-width: 1024px) {
    .grid-stats-4 { grid-template-columns: repeat(2, 1fr); }
}
.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
.data-table th, .data-table td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #edf0ff;
}
.data-table th {
    background: #f4f6ff;
    color: #4b5686;
    font-weight: 700;
    font-family: 'Fredoka', sans-serif;
    border-radius: 8px 8px 0 0;
}
.data-table tr:last-child td {
    border-bottom: none;
}

.badge {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
}
.badge.success { background: #e5ffe5; color: #008000; }
.badge.warning { background: #fff5e5; color: #cc7a00; }

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
    .grid-stats-4 { grid-template-columns: repeat(2, 1fr) !important; }
}
@media(max-width: 600px) {
    .grid-stats-4 { grid-template-columns: 1fr !important; }
}
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
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
            <a href="{{ route('profile.skill') }}" class="user-profile" title="Kelola Profil">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Nama Admin' }}</div>
                    <div class="role">Administrator</div>
                </div>
                <div class="avatar">
                    @if(auth()->check() && auth()->user()->foto_profil)
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="{{ auth()->user()->name }}">
                    @else
                        {{ substr(auth()->check() ? auth()->user()->name : 'A', 0, 1) }}
                    @endif
                </div>
            </a>
        </header>

        {{-- Toast notifications are rendered as fixed bottom popups --}}

        <!-- ===================== ADMIN DASHBOARD ===================== -->
        <h1 class="page-title">Dashboard Admin</h1>

        <!-- 4 SUMMARY CARDS -->
        <div class="grid-stats grid-stats-4">
            <div class="card">
                <div class="card-title">Pengguna</div>
                <div class="stat-value">{{ $totalUsers ?? 0 }}</div>
            </div>
            <div class="card">
                <div class="card-title">Proyek</div>
                <div class="stat-value">{{ $totalProjects ?? 0 }}</div>
            </div>
            <div class="card">
                <div class="card-title">Selesai</div>
                <div class="stat-value">{{ $totalCompleted ?? 0 }}</div>
            </div>
            <div class="card">
                <div class="card-title">Transaksi (Lunas)</div>
                <div class="stat-value currency">Rp {{ number_format($totalFee ?? 0, 0, ',', '.') }}</div>
                <div style="font-size:12px;color:#8b95b5;margin-top:4px;">{{ $totalTransaksi ?? 0 }} total transaksi</div>
            </div>
        </div>

        <!-- 2 MIDDLE CARDS (RINGKASAN PROYEK & NEW USERS TABLE) -->
        <div class="grid-content">
            <div class="card" style="padding: 24px;">
                <div class="card-title" style="margin-bottom: 20px;">Ringkasan Status Proyek</div>
                @php
                    $mencariTim  = \App\Models\Project::where('status_project', 'Mencari Tim')->count();
                    $berjalan    = \App\Models\Project::where('status_project', 'Berjalan')->count();
                    $selesai     = \App\Models\Project::where('status_project', 'Selesai')->count();
                    $total       = $totalProjects ?? 1;
                @endphp
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <!-- Mencari Tim -->
                    <div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
                            <span style="font-weight:700;font-size:14px;color:#6d28d9;">Mencari Tim</span>
                            <span style="font-weight:700;font-size:14px;color:#6d28d9;">{{ $mencariTim }}</span>
                        </div>
                        <div style="background:#ede9fe;border-radius:999px;height:10px;overflow:hidden;">
                            <div style="height:100%;width:{{ $total > 0 ? round($mencariTim/$total*100) : 0 }}%;background:linear-gradient(90deg,#7c3aed,#a78bfa);border-radius:999px;transition:.4s;"></div>
                        </div>
                    </div>
                    <!-- Berjalan -->
                    <div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
                            <span style="font-weight:700;font-size:14px;color:#b45309;">Berjalan</span>
                            <span style="font-weight:700;font-size:14px;color:#b45309;">{{ $berjalan }}</span>
                        </div>
                        <div style="background:#fef3c7;border-radius:999px;height:10px;overflow:hidden;">
                            <div style="height:100%;width:{{ $total > 0 ? round($berjalan/$total*100) : 0 }}%;background:linear-gradient(90deg,#f59e0b,#fcd34d);border-radius:999px;transition:.4s;"></div>
                        </div>
                    </div>
                    <!-- Selesai -->
                    <div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
                            <span style="font-weight:700;font-size:14px;color:#065f46;">Selesai</span>
                            <span style="font-weight:700;font-size:14px;color:#065f46;">{{ $selesai }}</span>
                        </div>
                        <div style="background:#d1fae5;border-radius:999px;height:10px;overflow:hidden;">
                            <div style="height:100%;width:{{ $total > 0 ? round($selesai/$total*100) : 0 }}%;background:linear-gradient(90deg,#059669,#6ee7b7);border-radius:999px;transition:.4s;"></div>
                        </div>
                    </div>
                </div>
                <div style="margin-top:20px;padding-top:16px;border-top:1px solid #edf0ff;display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:13px;color:#8b95b5;">Total Proyek Terdaftar</span>
                    <span style="font-weight:800;color:#1c2766;font-size:18px;font-family:'Fredoka',sans-serif;">{{ $totalProjects ?? 0 }}</span>
                </div>
            </div>
            
            <div class="card" style="padding: 0; overflow: hidden;">
                <div class="card-title" style="padding: 24px 24px 0;">Pengguna Terbaru</div>
                <div style="padding: 16px 24px 24px;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestUsers ?? [] as $u)
                            <tr>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" style="text-align:center; color:#8f9bd8;">Belum ada pengguna</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>


</body>
</html>
