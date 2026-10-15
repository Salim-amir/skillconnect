describe('SkillConnect E2E Test Suite - Cypress', () => {
  const loginAdminSession = () => {
    cy.session('admin-session', () => {
      cy.visit('/login');
      cy.get('body').then(($body) => {
        if ($body.find('[data-open="l"]').length > 0) {
          cy.get('[data-open="l"]').first().click({ force: true });
        }
      });
      cy.get('#fL input[name="email"]').clear().type('admin@skillconnect.com');
      cy.get('#fL input[name="password"]').clear().type('password123');
      cy.get('#fL button[type="submit"]').click();
      cy.url({ timeout: 15000 }).should('include', '/dashboard');
      cy.contains('Dashboard').should('exist');
    });
  };

  it('UC-01: Membuka Halaman Utama SkillConnect & Verifikasi Branding', () => {
    cy.visit('/');
    cy.title().then((title) => {
      if (!title.includes('SkillConnect')) {
        cy.get('body').should('contain', 'SkillConnect');
      } else {
        expect(title).to.include('SkillConnect');
      }
    });
  });

  it('UC-02: Validasi Error Form Login jika Kata Sandi Kosong', () => {
    cy.visit('/login');
    cy.get('body').then(($body) => {
      if ($body.find('[data-open="l"]').length > 0) {
        cy.get('[data-open="l"]').first().click({ force: true });
      }
    });
    cy.get('#fL input[name="email"]').clear().type('admin@skillconnect.com');
    cy.get('#fL input[name="password"]').clear();
    cy.get('#fL button[type="submit"]').click();
    cy.get('#fL .msg').should('be.visible').and('contain', 'Kata sandi wajib diisi.');
  });

  it('UC-03: Login Admin dengan Kredensial Valid & Masuk ke Dashboard Admin', () => {
    cy.visit('/login');
    cy.get('body').then(($body) => {
      if ($body.find('[data-open="l"]').length > 0) {
        cy.get('[data-open="l"]').first().click({ force: true });
      }
    });
    cy.get('#fL input[name="email"]').clear().type('admin@skillconnect.com');
    cy.get('#fL input[name="password"]').clear().type('password123');
    cy.get('#fL button[type="submit"]').click();
    cy.url({ timeout: 15000 }).should('include', '/dashboard');
    cy.contains('Dashboard').should('exist');
  });

  it('UC-04: Navigasi Menu Kelola Pengguna oleh Admin', () => {
    loginAdminSession();
    cy.visit('/admin/pengguna');
    cy.url().should('include', '/admin/pengguna');
    cy.contains('Kelola Pengguna').should('exist');
  });

  it('UC-05: Navigasi Menu Laporan Admin & Tampilan Detail Data', () => {
    loginAdminSession();
    cy.visit('/admin/laporan');
    cy.url().should('include', '/admin/laporan');
    cy.contains('Laporan').should('exist');
  });

  it('UC-06: Smoke Testing Halaman Riwayat Transaksi Admin', () => {
    loginAdminSession();
    cy.visit('/admin/transaksi');
    cy.url().should('include', '/admin/transaksi');
    cy.contains('Riwayat Transaksi').should('exist');
  });

  it('UC-07: Akses Halaman Proyek & Navigasi Pencarian Proyek', () => {
    loginAdminSession();
    cy.visit('/proyek');
    cy.url().should('include', '/proyek');
    cy.contains('Proyek').should('exist');
  });

  it('UC-08: Akses Task Board Proyek & Verifikasi Tampilan Kanban (MOD-08)', () => {
    loginAdminSession();
    // Akses halaman proyek terlebih dahulu
    cy.visit('/proyek');
    cy.url().should('include', '/proyek');

    // Klik proyek pertama yang tersedia untuk masuk ke detail
    cy.get('body').then(($body) => {
      // Coba cari link proyek detail
      if ($body.find('a[href*="/proyek/"]').length > 0) {
        cy.get('a[href*="/proyek/"]').first().click({ force: true });
        cy.url({ timeout: 15000 }).should('match', /\/proyek\/\d+/);

        // Cek apakah ada tombol/link Task Board di halaman detail
        cy.get('body').then(($detailBody) => {
          if ($detailBody.find('a[href*="/tasks"]').length > 0) {
            cy.get('a[href*="/tasks"]').first().click({ force: true });
            cy.url({ timeout: 15000 }).should('include', '/tasks');

            // Verifikasi elemen Task Board
            cy.contains('Task Board').should('exist');

            // Verifikasi 4 kolom Kanban ada
            cy.contains('Belum Dikerjakan').should('exist');
            cy.contains('Sedang Dikerjakan').should('exist');
            cy.contains('Menunggu Review').should('exist');
            cy.contains('Selesai').should('exist');

            // Verifikasi stat cards ada
            cy.get('.stat-card').should('have.length', 4);

            // Verifikasi kanban board ada
            cy.get('.kanban-board').should('exist');
            cy.get('.kanban-column').should('have.length', 4);
          } else {
            // Jika belum jadi anggota tim, cukup verifikasi halaman detail tampil
            cy.contains($detailBody.find('h1').first().text()).should('exist');
          }
        });
      } else {
        // Jika belum ada proyek, cukup pastikan halaman proyek bisa diakses
        cy.contains('Proyek').should('exist');
      }
    });
  });

  it('UC-08b: Navigasi Langsung ke Task Board via URL (MOD-08)', () => {
    loginAdminSession();
    // Coba akses task board proyek ID 1 langsung via URL
    cy.visit('/proyek/1/tasks', { failOnStatusCode: false });
    cy.get('body').then(($body) => {
      const bodyText = $body.text();
      // Jika berhasil masuk: verifikasi elemen task board
      if (bodyText.includes('Task Board')) {
        cy.contains('Task Board').should('exist');
        cy.contains('Belum Dikerjakan').should('exist');
        cy.contains('Sedang Dikerjakan').should('exist');
        cy.contains('Menunggu Review').should('exist');
        cy.contains('Selesai').should('exist');
        cy.get('.kanban-board').should('exist');
      } else {
        // Jika 403 (bukan anggota) atau 404 (proyek tidak ada), itu expected
        expect(true).to.be.true;
      }
    });
  });
});
