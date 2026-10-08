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
    grid-template-columns: 1.2fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
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

/* Chart Placeholder Placeholder */
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
            <a href="/dashboard" class="nav-item active">
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
                <!-- MENU UNTUK USER (MEMBER / CREATOR) -->
                <a href="#" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profil & Skill
                </a>
                <a href="/proyek" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    Proyek
                </a>
                <a href="#" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    Rekomendasi
                </a>
                <a href="#" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Portofolio
                </a>
            @endif
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- TOP BAR -->
        <header class="top-bar">
            <div class="user-profile">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Nama Pengguna' }}</div>
                    <div class="role">
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            Administrator
                        @else
                            Project Creator & Member
                        @endif
                    </div>
                </div>
                <div class="avatar">{{ substr(auth()->check() ? auth()->user()->name : 'U', 0, 1) }}</div>
            </div>
        </header>

        @if(auth()->check() && auth()->user()->role === 'admin')
            <!-- ===================== ADMIN DASHBOARD ===================== -->
            <h1 class="page-title">Dashboard Admin</h1>

            <!-- 4 SUMMARY CARDS -->
            <div class="grid-stats grid-stats-4">
                <div class="card">
                    <div class="card-title">Pengguna</div>
                    <div class="stat-value">2.450</div>
                </div>
                <div class="card">
                    <div class="card-title">Proyek</div>
                    <div class="stat-value">124</div>
                </div>
                <div class="card">
                    <div class="card-title">Selesai</div>
                    <div class="stat-value">89</div>
                </div>
                <div class="card">
                    <div class="card-title">Transaksi</div>
                    <div class="stat-value currency">Rp 12.5M</div>
                </div>
            </div>

            <!-- 2 MIDDLE CARDS (CHART & NEW USERS TABLE) -->
            <div class="grid-content">
                <div class="card">
                    <div class="card-title">Grafik Analitik</div>
                    <div class="chart-placeholder">
                        [ Area Chart Analitik ]
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
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Budi Santoso</td>
                                    <td>budi@mail.com</td>
                                    <td><span class="badge success">Aktif</span></td>
                                </tr>
                                <tr>
                                    <td>Siti Aminah</td>
                                    <td>siti@mail.com</td>
                                    <td><span class="badge success">Aktif</span></td>
                                </tr>
                                <tr>
                                    <td>Andi Wijaya</td>
                                    <td>andi@mail.com</td>
                                    <td><span class="badge warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>Rina Melati</td>
                                    <td>rina@mail.com</td>
                                    <td><span class="badge success">Aktif</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        @else
            <!-- ===================== USER DASHBOARD ===================== -->
            <h1 class="page-title">Dashboard Pengguna</h1>

            <!-- 3 SUMMARY CARDS -->
            <div class="grid-stats">
                <div class="card">
                    <div class="card-title">Proyek Aktif</div>
                    <div class="stat-value">3</div>
                </div>
                <div class="card">
                    <div class="card-title">Proyek Selesai</div>
                    <div class="stat-value">12</div>
                </div>
                <div class="card">
                    <div class="card-title">Total Pemasukan</div>
                    <div class="stat-value currency">Rp 4.500.000</div>
                </div>
            </div>

            <!-- 2 MIDDLE CARDS (CHART & TASKS) -->
            <div class="grid-content">
                <div class="card">
                    <div class="card-title">Grafik Pemasukan</div>
                    <div class="chart-placeholder">
                        [ Area Chart Pemasukan ]
                    </div>
                </div>
                
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
            </div>

            <!-- 2 BOTTOM CARDS (INCOME DETAILS & INVITATIONS) -->
            <div class="grid-content">
                <div class="card">
                    <div class="card-title">Rincian Pemasukan Terakhir</div>
                    <div class="income-list">
                        <div class="list-item">
                            <div class="task-info">
                                <h4>Pembayaran Termin 2 (Final)</h4>
                                <p>Proyek: Redesign Website Perusahaan</p>
                            </div>
                            <div style="font-weight: 700; color: #008000;">+ Rp 1.500.000</div>
                        </div>
                        <div class="list-item">
                            <div class="task-info">
                                <h4>Pembayaran Termin 1 (DP)</h4>
                                <p>Proyek: Aplikasi Mobile E-Learning</p>
                            </div>
                            <div style="font-weight: 700; color: #008000;">+ Rp 2.000.000</div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-title">Undangan Proyek</div>
                    <div class="invite-list">
                        <div class="list-item" style="flex-direction: column; align-items: flex-start; gap: 12px;">
                            <div class="task-info">
                                <h4>Pengembangan Sistem ERP Berbasis Web</h4>
                                <p>Creator: PT Teknologi Maju • Butuh role: Backend Developer (Laravel)</p>
                            </div>
                            <div class="btn-group">
                                <button class="btn-sm pri">Terima</button>
                                <button class="btn-sm ghost">Tolak</button>
                            </div>
                        </div>
                        <div class="list-item" style="flex-direction: column; align-items: flex-start; gap: 12px;">
                            <div class="task-info">
                                <h4>Aplikasi Booking Futsal</h4>
                                <p>Creator: Budi Santoso • Butuh role: UI/UX Designer</p>
                            </div>
                            <div class="btn-group">
                                <button class="btn-sm pri">Terima</button>
                                <button class="btn-sm ghost">Tolak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </main>

</body>
</html>
