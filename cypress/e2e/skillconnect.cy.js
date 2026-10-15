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
      cy.url().should('include', '/dashboard');
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
    cy.url().should('include', '/dashboard');
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
});
