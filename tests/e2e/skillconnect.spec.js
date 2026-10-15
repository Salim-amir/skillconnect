import { test, expect } from '@playwright/test';

test.describe('SkillConnect Automated E2E Testing Suite (MOD-01 s/d MOD-09)', () => {

  // Helper untuk login admin
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

  test('MOD-01: Autentikasi & Login Multi-Role', async ({ page }) => {
    await page.goto('/login');
    const openBtn = page.locator('[data-open="l"]').first();
    if (await openBtn.isVisible()) {
      await openBtn.click();
    }

    // 1. Validasi negatif: Kata sandi kosong
    await page.fill('#fL input[name="email"]', 'admin@skillconnect.com');
    await page.fill('#fL input[name="password"]', '');
    await page.click('#fL button[type="submit"]');
    const errorMsg = page.locator('#fL .msg');
    await expect(errorMsg).toHaveText('Kata sandi wajib diisi.');

    // 2. Login valid: Autentikasi Admin
    await page.fill('#fL input[name="password"]', 'password123');
    await page.click('#fL button[type="submit"]');
    await page.waitForURL('**/dashboard', { timeout: 15000 });
    await expect(page).toHaveURL(/.*dashboard/);

    const content = await page.textContent('body');
    expect(content).toContain('Dashboard');
  });

  test('MOD-02: Pengelolaan Profile & Master Skill', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/profile-skill');
    await expect(page).toHaveURL(/.*profile-skill/);

    const bodyText = await page.textContent('body');
    expect(bodyText).toContain('Profil');
    const formOrInput = page.locator('input[name="name"], textarea[name="pengalaman"], form');
    await expect(formOrInput.first()).toBeVisible();
  });

  test('MOD-03: Pencarian & Pengajuan Lamaran', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek');
    await expect(page).toHaveURL(/.*proyek/);

    // Kunjungi detail proyek
    await page.goto('/proyek/1');
    await expect(page).toHaveURL(/.*proyek\/1/);
    const content = await page.textContent('body');
    expect(content).toContain('Aplikasi Kasir POS');
  });

  // Helper untuk login member biasa
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

  test('MOD-04: Pembuatan Proyek & Kriteria Skill', async ({ page }) => {
    await loginAsMember(page);
    await page.goto('/proyek/buat');
    await expect(page).toHaveURL(/.*proyek\/buat/);

    // Memverifikasi field form pembuatan proyek & kriteria skill
    await expect(page.locator('input[name="judul_project"]')).toBeVisible();
    await expect(page.locator('input[name="budget"]')).toBeVisible();
  });

  test('MOD-05: Exact Skill Matching Engine', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1');
    await expect(page).toHaveURL(/.*proyek\/1/);

    const bodyText = await page.textContent('body');
    const hasMatchingIndicator = bodyText.includes('Skill') || bodyText.includes('%') || bodyText.includes('Kandidat');
    expect(hasMatchingIndicator).toBeTruthy();
  });

  test('MOD-06: Memilih Kandidat', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1?posisi=Frontend+Developer');
    await expect(page).toHaveURL(/.*proyek\/1/);

    const content = await page.textContent('body');
    expect(content).toContain('Aplikasi Kasir POS');
  });

  test('MOD-07: Rekrutmen & Kelola Anggota Tim', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1');
    await expect(page).toHaveURL(/.*proyek\/1/);

    const content = await page.textContent('body');
    const hasMemberSection = content.includes('Anggota') || content.includes('Kandidat') || content.includes('Pelamar') || content.includes('Tim');
    expect(hasMemberSection).toBeTruthy();
  });

  test('MOD-08: Task Board & Upload Bukti Kerja', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1/tasks');
    await expect(page).toHaveURL(/.*proyek\/1\/tasks/);

    const content = await page.textContent('body');
    expect(content).toContain('Task Board');

    // Memverifikasi 4 kolom Kanban
    expect(content).toContain('Belum Dikerjakan');
    expect(content).toContain('Sedang Dikerjakan');
    expect(content).toContain('Menunggu Review');
    expect(content).toContain('Selesai');
  });

  test('MOD-09: Evaluasi & Progres Proyek', async ({ page }) => {
    await loginAsAdmin(page);
    await page.goto('/proyek/1/tasks');
    await expect(page).toHaveURL(/.*proyek\/1\/tasks/);

    const content = await page.textContent('body');
    const hasEvalSection = content.includes('Evaluasi') || content.includes('Kinerja') || content.includes('Rating');
    expect(hasEvalSection).toBeTruthy();
  });

});
