import { test, expect } from '@playwright/test';

test.describe('SkillConnect Automated E2E Testing Suite (Playwright)', () => {

  test('UC-01: Membuka Halaman Utama SkillConnect & Verifikasi Elemen Branding', async ({ page }) => {
    await page.goto('/');
    await expect(page).toHaveTitle(/SkillConnect/i);
    const bodyText = await page.textContent('body');
    expect(bodyText).toContain('SkillConnect');
  });

  test('UC-02: Validasi Error Form Login jika Kata Sandi Kosong', async ({ page }) => {
    await page.goto('/');
    await page.click('[data-open="l"]');
    await page.fill('#fL input[name="email"]', 'admin@skillconnect.com');
    await page.fill('#fL input[name="password"]', '');
    await page.click('#fL button[type="submit"]');

    const msg = page.locator('#fL .msg');
    await expect(msg).toHaveText('Kata sandi wajib diisi.');
  });

  test('UC-03: Login Admin dengan Kredensial Valid & Masuk ke Dashboard Admin', async ({ page }) => {
    await page.goto('/');
    await page.click('[data-open="l"]');
    await page.fill('#fL input[name="email"]', 'admin@skillconnect.com');
    await page.fill('#fL input[name="password"]', 'password123');
    await page.click('#fL button[type="submit"]');

    await expect(page).toHaveURL(/.*dashboard/);
    const content = await page.textContent('body');
    expect(content).toContain('Dashboard');
  });

  test('UC-04: Navigasi Menu Kelola Pengguna oleh Admin', async ({ page }) => {
    await page.goto('/');
    await page.click('[data-open="l"]');
    await page.fill('#fL input[name="email"]', 'admin@skillconnect.com');
    await page.fill('#fL input[name="password"]', 'password123');
    await page.click('#fL button[type="submit"]');
    await page.waitForURL('**/dashboard');

    await page.goto('/admin/pengguna');
    await expect(page).toHaveURL(/.*admin\/pengguna/);
    const content = await page.textContent('body');
    expect(content).toContain('Kelola Pengguna');
  });

  test('UC-05: Navigasi Menu Laporan Admin & Tampilan Detail Data', async ({ page }) => {
    await page.goto('/');
    await page.click('[data-open="l"]');
    await page.fill('#fL input[name="email"]', 'admin@skillconnect.com');
    await page.fill('#fL input[name="password"]', 'password123');
    await page.click('#fL button[type="submit"]');
    await page.waitForURL('**/dashboard');

    await page.goto('/admin/laporan');
    await expect(page).toHaveURL(/.*admin\/laporan/);
    const content = await page.textContent('body');
    expect(content).toContain('Laporan');
  });

  test('UC-06: Smoke Testing Halaman Riwayat Transaksi Admin', async ({ page }) => {
    await page.goto('/');
    await page.click('[data-open="l"]');
    await page.fill('#fL input[name="email"]', 'admin@skillconnect.com');
    await page.fill('#fL input[name="password"]', 'password123');
    await page.click('#fL button[type="submit"]');
    await page.waitForURL('**/dashboard');

    await page.goto('/admin/transaksi');
    await expect(page).toHaveURL(/.*admin\/transaksi/);
    const content = await page.textContent('body');
    expect(content).toContain('Riwayat Transaksi');
  });

  test('UC-07: Akses Halaman Proyek & Navigasi Pencarian Proyek', async ({ page }) => {
    await page.goto('/');
    await page.click('[data-open="l"]');
    await page.fill('#fL input[name="email"]', 'admin@skillconnect.com');
    await page.fill('#fL input[name="password"]', 'password123');
    await page.click('#fL button[type="submit"]');
    await page.waitForURL('**/dashboard');

    await page.goto('/proyek');
    await expect(page).toHaveURL(/.*proyek/);
    const content = await page.textContent('body');
    expect(content).toContain('Proyek');
  });

});
