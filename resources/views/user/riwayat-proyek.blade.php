<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Portofolio & Fee - SkillConnect</title>
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

.nav-item svg { width: 20px; height: 20px; flex-shrink: 0; }

.nav-item:hover { background: #f4f6ff; color: #1c2766; }

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
.top-breadcrumb span { color: var(--ink); font-weight: 700; }

.user-profile { display: flex; align-items: center; gap: 12px; }

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

/* Page Header */
.page-header { margin-bottom: 24px; }
.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 30px;
    color: var(--ink);
}
.page-desc { color: var(--mute); font-size: 15px; margin-top: 2px; }

/* KOTAK FEE TERPISAH (SESUAI REVISI TEMAN) */
.fee-boxes-grid {
    display: grid;
    grid-template-columns: 1.3fr 1fr 1fr;
    gap: 20px;
    margin-bottom: 32px;
}

.fee-card {
    background: #fff;
    border: 1.5px solid var(--line);
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 10px 30px -16px rgba(80,70,200,.2);
    position: relative;
    overflow: hidden;
}

.fee-card.highlight {
    background: linear-gradient(135deg, #2b3a8f, #7b6cf6 80%);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 14px 34px -10px rgba(123,108,246,.55);
}

.fee-card-label {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: #8b95b5;
    margin-bottom: 8px;
}
.fee-card.highlight .fee-card-label {
    color: rgba(255, 255, 255, 0.85);
}

.fee-amount {
    font-family: 'Fredoka', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.1;
}
.fee-card.highlight .fee-amount {
    color: #fff;
}

.fee-badge-desc {
    margin-top: 10px;
    font-size: 13px;
    color: var(--mute);
    display: flex;
    align-items: center;
    gap: 6px;
}
.fee-card.highlight .fee-badge-desc {
    color: rgba(255, 255, 255, 0.85);
}

/* TAB CONTAINER UNTUK RIWAYAT PROYEK */
.history-section {
    background: #fff;
    border: 1.5px solid var(--line);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 32px -16px rgba(80,70,200,.25);
}

.tabs-nav {
    display: flex;
    gap: 12px;
    border-bottom: 2px solid #f0f2ff;
    padding-bottom: 16px;
    margin-bottom: 24px;
}

.tab-btn {
    padding: 10px 22px;
    border-radius: 12px;
    font-family: 'Nunito', sans-serif;
    font-weight: 700;
    font-size: 14.5px;
    cursor: pointer;
    border: 1.5px solid transparent;
    background: #f4f6ff;
    color: var(--mute);
    transition: all .2s;
}
.tab-btn:hover { color: var(--ink); background: #eef1ff; }
.tab-btn.active {
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    color: #fff;
    box-shadow: 0 6px 18px -4px rgba(123,108,246,.5);
}

/* TABLE RIWAYAT BERSIH (TANPA FEE) */
.history-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14.5px;
}

.history-table th {
    background: #f8f9ff;
    color: #4b5686;
    font-weight: 700;
    font-family: 'Fredoka', sans-serif;
    padding: 14px 20px;
    text-align: left;
    border-bottom: 2px solid var(--line);
}
.history-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #edf0ff;
    color: var(--ink);
}
.history-table tr:hover td { background: #fafbff; }

.status-badge {
    padding: 4px 12px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 700;
    display: inline-block;
}
.status-Selesai { background: #e5ffe8; color: #008736; }
.status-Berjalan { background: #fff5e5; color: #cc7700; }
.status-Mencari-Tim { background: #e5f2ff; color: #0055cc; }

.btn-detail {
    color: #2b3a8f;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 8px;
    background: #f4f6ff;
    border: 1px solid #d6d9fb;
    display: inline-block;
    transition: .15s;
}
.btn-detail:hover {
    background: #7b6cf6;
    color: #fff;
    border-color: #7b6cf6;
}

@media(max-width: 992px) {
    .fee-boxes-grid { grid-template-columns: 1fr; }
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
            <a href="{{ route('profile.skill') }}" class="nav-item">
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
            <a href="{{ route('proyek.riwayat') }}" class="nav-item active">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Portofolio & Fee
            </a>
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
                SkillConnect / <span>Portofolio & Fee</span>
            </div>
            <div class="user-profile">
                <div class="user-info">
                    <div class="name">{{ $user->name }}</div>
                    <div class="role">Member / Creator</div>
                </div>
                <div class="avatar">{{ substr($user->name, 0, 1) }}</div>
            </div>
        </header>

        <div class="page-header">
            <h1 class="page-title">Portofolio & Fee</h1>
            <p class="page-desc">Rekam jejak kontribusi & portofolio proyek Anda, lengkap dengan grafik pemasukan bulanan.</p>
        </div>

        <!-- 3 KOTAK FEE TERPISAH (SESUAI CATATAN REVISI) -->
        <div class="fee-boxes-grid">
            <div class="fee-card highlight">
                <div class="fee-card-label">Total Fee Diterima (Lunas)</div>
                <div class="fee-amount">Rp {{ number_format($totalEarnedFee, 0, ',', '.') }}</div>
                <div class="fee-badge-desc">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    Dari proyek yang telah diselesaikan
                </div>
            </div>

            <div class="fee-card">
                <div class="fee-card-label">Fee Dalam Proses (Pending)</div>
                <div class="fee-amount" style="color: #b37400;">Rp {{ number_format($pendingFee, 0, ',', '.') }}</div>
                <div class="fee-badge-desc" style="color: #8b95b5;">
                    Menunggu approval / pengerjaan selesai
                </div>
            </div>

            <div class="fee-card">
                <div class="fee-card-label">Total Proyek Selesai</div>
                <div class="fee-amount" style="color: #2b3a8f;">{{ $totalCompletedProjects }} Proyek</div>
                <div class="fee-badge-desc" style="color: #8b95b5;">
                    {{ $totalActiveProjects }} proyek sedang berjalan
                </div>
            </div>
        </div>

        <!-- TABEL RIWAYAT PROYEK BERSIH (TANPA KOLOM FEE) -->
        <div class="history-section">
            <div class="tabs-nav">
                <button type="button" class="tab-btn active" onclick="switchTab('joined')">
                    Proyek yang Diikuti (Member) • {{ $joinedProjects->count() }}
                </button>
                <button type="button" class="tab-btn" onclick="switchTab('created')">
                    Proyek yang Dibuat (Creator) • {{ $createdProjects->count() }}
                </button>
            </div>

            <!-- TAB 1: PROYEK YANG DIIKUTI (TANPA ADA FEE) -->
            <div id="tab-joined">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Judul Proyek</th>
                            <th>Kategori</th>
                            <th>Pembuat Proyek</th>
                            <th>Peran / Posisi</th>
                            <th>Status Proyek</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($joinedProjects as $jp)
                            <tr>
                                <td style="font-weight: 700; color: var(--ink);">{{ $jp->judul_project }}</td>
                                <td>{{ $jp->kategori }}</td>
                                <td>{{ $jp->creator_name }}</td>
                                <td><span style="font-weight: 700; color: #7b6cf6;">{{ $jp->user_role }}</span></td>
                                <td>
                                    <span class="status-badge status-{{ str_replace(' ', '-', $jp->status_project) }}">
                                        {{ $jp->status_project }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('proyek.detail', $jp->id) }}" class="btn-detail">Lihat Rincian</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #9aa2cc; padding: 40px;">
                                    Belum ada proyek yang diikuti. Mulai cari proyek dan ajukan lamaran!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- TAB 2: PROYEK YANG DIBUAT SENDIRI (TANPA ADA FEE) -->
            <div id="tab-created" style="display: none;">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Judul Proyek</th>
                            <th>Kategori</th>
                            <th>Jumlah Anggota</th>
                            <th>Status Proyek</th>
                            <th>Tanggal Publikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($createdProjects as $cp)
                            <tr>
                                <td style="font-weight: 700; color: var(--ink);">{{ $cp->judul_project }}</td>
                                <td>{{ $cp->kategori }}</td>
                                <td>{{ $cp->members->count() }} Anggota</td>
                                <td>
                                    <span class="status-badge status-{{ str_replace(' ', '-', $cp->status_project) }}">
                                        {{ $cp->status_project }}
                                    </span>
                                </td>
                                <td>{{ $cp->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('proyek.detail', $cp->id) }}" class="btn-detail">Kelola Tim</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #9aa2cc; padding: 40px;">
                                    Anda belum pernah membuat proyek. Buat proyek baru untuk merekrut anggota tim!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script>
        function switchTab(type) {
            const tabJoined = document.getElementById('tab-joined');
            const tabCreated = document.getElementById('tab-created');
            const btns = document.querySelectorAll('.tab-btn');

            if (type === 'joined') {
                tabJoined.style.display = 'block';
                tabCreated.style.display = 'none';
                btns[0].classList.add('active');
                btns[1].classList.remove('active');
            } else {
                tabJoined.style.display = 'none';
                tabCreated.style.display = 'block';
                btns[0].classList.remove('active');
                btns[1].classList.add('active');
            }
        }
    </script>
</body>
</html>
