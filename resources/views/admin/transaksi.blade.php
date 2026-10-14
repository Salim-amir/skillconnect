<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Riwayat Transaksi - SkillConnect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --bg: #ffffff;
    --ink: #0a0a0a;
    --mute: #525252;
    --primary: #ff007f;
    --secondary: #7000ff;
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
.badge.success { background: #e5ffe5; color: #008000; }
.badge.warning { background: #fff5e5; color: #cc7700; }
.badge.danger { background: #ffe5e5; color: #cc0000; }

.currency {
    font-family: 'Fredoka', sans-serif;
    font-weight: 600;
    color: #2b3a8f;
}

.btn {
    display: inline-block;
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
.btn.ghost {
    background: transparent;
    color: #4b5686;
    border-color: #d6d9fb;
}
.btn.ghost:hover {
    background: #f4f6ff;
    color: #1c2766;
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
                <a href="/pengguna" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Pengguna
                </a>
                <a href="/proyek" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    Proyek
                </a>
                <a href="/transaksi" class="nav-item active">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Transaksi
                </a>
                <a href="/laporan" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Laporan
                </a>
            @else
                <!-- Saat ini tidak ada Transaksi untuk User di Mockup, tapi kita tampilkan saja kalau mau disamakan -->
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

        <div class="page-header">
            @if(auth()->check() && auth()->user()->role === 'admin')
                <h1 class="page-title">Riwayat Transaksi Sistem</h1>
            @else
                <h1 class="page-title">Riwayat Transaksi Anda</h1>
            @endif
            
            <div style="display: flex; gap: 10px;">
                <button class="btn ghost">Export Data</button>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Pengirim (Creator)</th>
                            <th>Penerima (Member)</th>
                            <th>Proyek</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dummy interaktif untuk preview UI -->
                        <tr>
                            <td style="color: #8f9bd8; font-weight: 600;">#TRX-0921A</td>
                            <td>Budi Santoso</td>
                            <td>Agus Pratama</td>
                            <td style="font-weight: 700; color: #1c2766;">Desain UI/UX E-Commerce</td>
                            <td class="currency">Rp 2.500.000</td>
                            <td><span class="badge success">Lunas</span></td>
                            <td>12 Okt 2026</td>
                        </tr>
                        <tr>
                            <td style="color: #8f9bd8; font-weight: 600;">#TRX-0922B</td>
                            <td>Siti Aminah</td>
                            <td>Rudi Hermawan</td>
                            <td style="font-weight: 700; color: #1c2766;">Pengembangan API Payment</td>
                            <td class="currency">Rp 5.000.000</td>
                            <td><span class="badge warning">Tertunda (Escrow)</span></td>
                            <td>10 Okt 2026</td>
                        </tr>
                        <tr>
                            <td style="color: #8f9bd8; font-weight: 600;">#TRX-0923C</td>
                            <td>Rina Melati</td>
                            <td>Dewi Sartika</td>
                            <td style="font-weight: 700; color: #1c2766;">Pembuatan Company Profile</td>
                            <td class="currency">Rp 1.000.000</td>
                            <td><span class="badge danger">Dibatalkan</span></td>
                            <td>08 Okt 2026</td>
                        </tr>
                        <tr>
                            <td style="color: #8f9bd8; font-weight: 600;">#TRX-0924D</td>
                            <td>PT Teknologi Maju</td>
                            <td>Ahmad Fauzi</td>
                            <td style="font-weight: 700; color: #1c2766;">Sistem ERP Berbasis Web</td>
                            <td class="currency">Rp 10.000.000</td>
                            <td><span class="badge success">Lunas</span></td>
                            <td>01 Okt 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</body>
</html>
