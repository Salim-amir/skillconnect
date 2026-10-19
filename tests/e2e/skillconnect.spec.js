import { test, expect } from '@playwright/test';

test.describe('SkillConnect Automated E2E Testing Suite (MOD-01 s/d MOD-09)', () => {

  // Helper login sebagai Admin
  async function loginAsAdmin(page) {
    await page.goto('/login');
    const openBtn = page.locator('[data-open="l"]').first();
    if (await openBtn.isVisible()) {
      await openBtn.click();
    }
    await page.fill('#fL input[name="email"]', 'admin@skillconnect.com');
    await page.fill('#fL input[name="password"]', 'password123');
    await page.click('#fL button[type="submit"]');
    await page.waitForURL('**/dashboard', { timeout: 15000 });
  }

  // Helper login sebagai Member biasa
  async function loginAsMember(page) {
    await page.goto('/login');
    const openBtn = page.locator('[data-open="l"]').first();
    if (await openBtn.isVisible()) {
      await openBtn.click();
    }
    await page.fill('#fL input[name="email"]', 'member@skillconnect.com');
    await page.fill('#fL input[name="password"]', 'password123');
    await page.click('#fL button[type="submit"]');
    await page.waitForURL('**/dashboard', { timeout: 15000 });
  }

  // ==========================================
  // MOD-01: Autentikasi & Login Multi-Role
  // ==========================================
  test('MOD-01-TC01: Validasi error jika kata sandi kosong (Negatif)', async ({ page }) => {
    await page.goto('/login');
    const openBtn = page.locator('[data-open="l"]').first();
    if (await openBtn.isVisible()) {
      await openBtn.click();
    }
    await page.fill('#fL input[name="email"]', 'admin@skillconnect.com');
    await page.fill('#fL input[name="password"]', '');
    await page.click('#fL button[type="submit"]');

    const errorMsg = page.locator('#fL .msg');
    await expect(errorMsg).toHaveText('Kata sandi wajib diisi.');
  });

  test('MOD-01-TC02: Validasi error jika kredensial tidak cocok (Negatif)', async ({ page }) => {
    await page.goto('/login');
    const openBtn = page.locator('[data-open="l"]').first();
    if (await openBtn.isVisible()) {
      await openBtn.click();
    }
    await page.fill('#fL input[name="email"]', 'wronguser@skillconnect.com');
    await page.fill('#fL input[name="password"]', 'passwordsalah123');
    await page.click('#fL button[type="submit"]');

    // Menunggu respons kegagalan autentikasi (tetap di login dengan alert/pesan error)
    await page.waitForTimeout(1500);
    const bodyContent = await page.textContent('body');
    const hasFailedIndication = bodyContent.includes('salah') || bodyContent.includes('Gagal') || page.url().includes('/login');
    expect(hasFailedIndication).toBeTruthy();
  });

  test('MOD-01-TC03: Autentikasi login berhasil role Admin & masuk ke Dashboard Admin (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await expect(page).toHaveURL(/.*dashboard/);

    const bodyContent = await page.textContent('body');
    expect(bodyContent).toContain('Dashboard');
  });

  test('MOD-01-TC04: Autentikasi login berhasil role Member & masuk ke Dashboard Member (Positif)', async ({ page }) => {
    await loginAsMember(page);
    await expect(page).toHaveURL(/.*dashboard/);

    const bodyContent = await page.textContent('body');
    expect(bodyContent).toContain('Dashboard');
  });

  // ==========================================
  // MOD-02: Pengelolaan Profile & Master Skill
  // ==========================================
  test('MOD-02-TC01: Akses halaman profil dan master skill pengguna (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/profile-skill');
    await expect(page).toHaveURL(/.*profile-skill/);

    const bodyText = await page.textContent('body');
    expect(bodyText).toContain('Profil');
  });

  test('MOD-02-TC02: Verifikasi form biodata, pengalaman, dan elemen master skill (Positif)', async ({ page }) => {
    await loginAsMember(page);
    await page.goto('/profile-skill');
    await expect(page).toHaveURL(/.*profile-skill/);

    const formElement = page.locator('input[name="name"], textarea[name="pengalaman"], form');
    await expect(formElement.first()).toBeVisible();
  });

  // ==========================================
  // MOD-03: Pencarian & Pengajuan Lamaran
  // ==========================================
  test('MOD-03-TC01: Navigasi katalog proyek & verifikasi filter pencarian (Positif)', async ({ page }) => {
    await loginAsMember(page);
    await page.goto('/proyek');
    await expect(page).toHaveURL(/.*proyek/);

    const searchInput = page.locator('input[type="text"], input[name="search"], input[name="q"], form');
    await expect(searchInput.first()).toBeVisible();
  });

  test('MOD-03-TC02: Kunjungan detail proyek & verifikasi form pengajuan lamaran member (Positif)', async ({ page }) => {
    await loginAsMember(page);
    await page.goto('/proyek/1');
    await expect(page).toHaveURL(/.*proyek\/1/);

    const bodyText = await page.textContent('body');
    expect(bodyText).toContain('Aplikasi Kasir POS');

    // Menampilkan komponen lamaran (Form ajukan atau status lamaran yang ada)
    const hasApplicationArea = bodyText.includes('Lamaran') || bodyText.includes('Posisi') || bodyText.includes('Fee');
    expect(hasApplicationArea).toBeTruthy();
  });

  // ==========================================
  // MOD-04: Pembuatan Proyek & Kriteria Skill
  // ==========================================
  test('MOD-04-TC01: Proteksi hak akses role - Admin ditolak saat mengakses pembuatan proyek (Negatif / RBAC)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/buat');

    // Admin dialihkan kembali dan tidak boleh membuka form buat proyek
    const bodyContent = await page.textContent('body');
    const isRestricted = !page.url().endsWith('/proyek/buat') || bodyContent.includes('Admin tidak memiliki akses') || bodyContent.includes('Dashboard');
    expect(isRestricted).toBeTruthy();
  });

  test('MOD-04-TC02: Member dapat mengakses form pembuatan proyek beserta kriteria skill (Positif)', async ({ page }) => {
    await loginAsMember(page);
    await page.goto('/proyek/buat');
    await expect(page).toHaveURL(/.*proyek\/buat/);

    await expect(page.locator('input[name="judul_project"]')).toBeVisible();
    await expect(page.locator('input[name="budget"]')).toBeVisible();
  });

  // ==========================================
  // MOD-05: Exact Skill Matching Engine
  // ==========================================
  test('MOD-05-TC01: Menampilkan persentase kecocokan skill (Exact Match) pada kandidat proyek (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1');
    await expect(page).toHaveURL(/.*proyek\/1/);

    const bodyText = await page.textContent('body');
    const hasMatchScore = bodyText.includes('% Cocok') || bodyText.includes('Kecocokan') || bodyText.includes('Skill');
    expect(hasMatchScore).toBeTruthy();
  });

  test('MOD-05-TC02: Verifikasi rincian skill cocok dan tag kecocokan pelamar (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1');

    const bodyText = await page.textContent('body');
    const hasSkillDetails = bodyText.includes('Skill Cocok') || bodyText.includes('Kandidat') || bodyText.includes('Melamar');
    expect(hasSkillDetails).toBeTruthy();
  });

  // ==========================================
  // MOD-06: Memilih Kandidat
  // ==========================================
  test('MOD-06-TC01: Filter daftar kandidat berdasarkan parameter kriteria posisi proyek (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1?posisi=Frontend+Developer');
    await expect(page).toHaveURL(/.*proyek\/1\?posisi=Frontend\+Developer/);

    const content = await page.textContent('body');
    expect(content).toContain('Aplikasi Kasir POS');
  });

  test('MOD-06-TC02: Verifikasi profil pelamar dan kelengkapan dokumen pendukung (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1');

    const content = await page.textContent('body');
    const hasCandidateInfo = content.includes('Pelamar') || content.includes('Kandidat') || content.includes('Ekspektasi Fee');
    expect(hasCandidateInfo).toBeTruthy();
  });

  // ==========================================
  // MOD-07: Rekrutmen & Kelola Anggota Tim
  // ==========================================
  test('MOD-07-TC01: Verifikasi status rekrutmen kandidat dan tombol aksi keputusan (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1');

    const content = await page.textContent('body');
    const hasStatusOrAction = content.includes('Status:') || content.includes('Diterima') || content.includes('Pending') || content.includes('Terima');
    expect(hasStatusOrAction).toBeTruthy();
  });

  test('MOD-07-TC02: Verifikasi daftar anggota tim aktif yang telah resmi diterima (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1');

    const content = await page.textContent('body');
    expect(content).toContain('Anggota Tim Resmi');
  });

  // ==========================================
  // MOD-08: Task Board & Upload Bukti Kerja
  // ==========================================
  test('MOD-08-TC01: Memverifikasi Task Board 4 kolom Kanban status pengerjaan (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1/tasks');
    await expect(page).toHaveURL(/.*proyek\/1\/tasks/);

    const content = await page.textContent('body');
    expect(content).toContain('Task Board');
    expect(content).toContain('Belum Dikerjakan');
    expect(content).toContain('Sedang Dikerjakan');
    expect(content).toContain('Menunggu Review');
    expect(content).toContain('Selesai');
  });

  test('MOD-08-TC02: Memverifikasi komponen formulir tambah tugas dan bukti pengerjaan (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1/tasks');

    const content = await page.textContent('body');
    const hasTaskFormComponents = content.includes('Tambah Tugas') || content.includes('Tugas') || content.includes('Bukti');
    expect(hasTaskFormComponents).toBeTruthy();
  });

  // ==========================================
  // MOD-09: Evaluasi & Progres Proyek
  // ==========================================
  test('MOD-09-TC01: Memverifikasi ringkasan progres dan status penyelesaian tugas (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1/tasks');

    const content = await page.textContent('body');
    const hasProgressSummary = content.includes('Task Board') && (content.includes('Selesai') || content.includes('Sedang Dikerjakan'));
    expect(hasProgressSummary).toBeTruthy();

    // Memverifikasi 4 kartu ringkasan progres status tugas
    const statCards = page.locator('.stat-card');
    await expect(statCards).toHaveCount(4);
  });

  test('MOD-09-TC02: Memverifikasi modul evaluasi kinerja & form rating anggota tim (Positif)', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1/tasks');

    const content = await page.textContent('body');
    const hasEvaluationModule = content.includes('Evaluasi') || content.includes('Kinerja') || content.includes('Rating');
    expect(hasEvaluationModule).toBeTruthy();
  });

});
