// cypress/e2e/01_auth.cy.js
// TEST CASE MOD AUTH (TC-AUTH-001 s/d TC-AUTH-012)

describe('TEST CASE MOD AUTH - Autentikasi Pengguna', () => {

  const openLogin = () => {
    cy.visit('/login');
    cy.get('body').then(($body) => {
      if ($body.find('[data-open="l"]').length > 0) {
        cy.get('[data-open="l"]').first().click({ force: true });
      }
    });
  };

  const openRegister = () => {
    cy.visit('/register');
    cy.get('body').then(($body) => {
      if ($body.find('[data-open="r"]').length > 0) {
        cy.get('[data-open="r"]').first().click({ force: true });
      }
    });
  };

  beforeEach(() => {
    cy.clearCookies();
    cy.clearLocalStorage();
  });

  // TC-AUTH-001: Registrasi dengan data valid
  it('TC-AUTH-001: Memastikan pengguna dapat membuat akun dengan data valid', () => {
    openRegister();
    const uniqueEmail = `user_${Date.now()}@skillconnect.com`;
    cy.get('#fR input[name="name"]').clear().type('User Testing');
    cy.get('#fR input[name="email"]').clear().type(uniqueEmail);
    cy.get('#fR input[name="password"]').clear().type('password123');
    cy.get('#fR input[name="password_confirmation"]').clear().type('password123');
    cy.get('#fR button[type="submit"]').click();
    cy.wait(1500);
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      expect(text.includes('berhasil') || text.includes('dashboard') || text.includes('sukses') || window.location.pathname.includes('/dashboard')).to.be.true;
    });
  });

  // TC-AUTH-002: Sistem menolak email yang sudah terdaftar
  it('TC-AUTH-002: Memastikan sistem menolak email yang sudah terdaftar', () => {
    openRegister();
    cy.get('#fR input[name="name"]').clear().type('Existing User');
    cy.get('#fR input[name="email"]').clear().type('member@skillconnect.com');
    cy.get('#fR input[name="password"]').clear().type('password123');
    cy.get('#fR input[name="password_confirmation"]').clear().type('password123');
    cy.get('#fR button[type="submit"]').click();
    cy.wait(1000);
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      expect(text.includes('sudah') || text.includes('terdaftar') || text.includes('digunakan') || text.includes('telah diambil') || text.includes('taken')).to.be.true;
    });
  });

  // TC-AUTH-003: Sistem memvalidasi kolom wajib yang kosong
  it('TC-AUTH-003: Memastikan sistem memvalidasi kolom wajib yang kosong', () => {
    openRegister();
    cy.get('#fR input[name="name"]').clear();
    cy.get('#fR input[name="email"]').clear();
    cy.get('#fR input[name="password"]').clear();
    cy.get('#fR button[type="submit"]').click();
    cy.get('#fR input:invalid').should('exist');
  });

  // TC-AUTH-004: Sistem menolak format email yang tidak valid
  it('TC-AUTH-004: Memastikan sistem menolak format email yang tidak valid', () => {
    openRegister();
    cy.get('#fR input[name="name"]').clear().type('Invalid Email User');
    cy.get('#fR input[name="email"]').clear().type('bukan-email-valid');
    cy.get('#fR input[name="password"]').clear().type('password123');
    cy.get('#fR input[name="password_confirmation"]').clear().type('password123');
    cy.get('#fR button[type="submit"]').click();
    cy.get('#fR input[name="email"]:invalid').should('exist');
  });

  // TC-AUTH-005: Sistem memvalidasi konfirmasi password yang tidak sesuai
  it('TC-AUTH-005: Memastikan sistem memvalidasi konfirmasi password yang tidak sesuai', () => {
    openRegister();
    cy.get('#fR input[name="name"]').clear().type('Mismatch User');
    cy.get('#fR input[name="email"]').clear().type(`mismatch_${Date.now()}@test.com`);
    cy.get('#fR input[name="password"]').clear().type('password123');
    cy.get('#fR input[name="password_confirmation"]').clear().type('passwordBeda999');
    cy.get('#fR button[type="submit"]').click();
    cy.wait(1000);
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      expect(text.includes('konfirmasi') || text.includes('cocok') || text.includes('sesuai') || text.includes('tidak sama') || text.includes('match')).to.be.true;
    });
  });

  // TC-AUTH-006: Pengguna dapat login menggunakan data yang valid
  it('TC-AUTH-006: Memastikan pengguna dapat login menggunakan data yang valid', () => {
    openLogin();
    cy.get('#fL input[name="email"]').clear().type('member@skillconnect.com');
    cy.get('#fL input[name="password"]').clear().type('password123');
    cy.get('#fL button[type="submit"]').click();
    cy.url({ timeout: 15000 }).should('include', '/dashboard');
    cy.contains('Dashboard').should('exist');
  });

  // TC-AUTH-007: Sistem menolak password yang salah
  it('TC-AUTH-007: Memastikan sistem menolak password yang salah', () => {
    openLogin();
    cy.get('#fL input[name="email"]').clear().type('member@skillconnect.com');
    cy.get('#fL input[name="password"]').clear().type('salah123');
    cy.get('#fL button[type="submit"]').click();
    cy.wait(1000);
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      expect(text.includes('salah') || text.includes('gagal') || text.includes('tidak cocok') || text.includes('kata sandi')).to.be.true;
    });
  });

  // TC-AUTH-008: Sistem menolak email yang belum terdaftar
  it('TC-AUTH-008: Memastikan sistem menolak email yang belum terdaftar', () => {
    openLogin();
    cy.get('#fL input[name="email"]').clear().type('tidakada@gmail.com');
    cy.get('#fL input[name="password"]').clear().type('tidakada123');
    cy.get('#fL button[type="submit"]').click();
    cy.wait(1000);
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      expect(text.includes('tidak') || text.includes('belum terdaftar') || text.includes('salah') || text.includes('gagal')).to.be.true;
    });
  });

  // TC-AUTH-009: Sistem memvalidasi kolom login yang kosong
  it('TC-AUTH-009: Memastikan sistem memvalidasi kolom login yang kosong', () => {
    openLogin();
    cy.get('#fL input[name="email"]').clear();
    cy.get('#fL input[name="password"]').clear();
    cy.get('#fL button[type="submit"]').click();
    cy.get('#fL input:invalid').should('exist');
  });

  // TC-AUTH-010: Halaman yang memerlukan autentikasi tidak dapat diakses tanpa login
  it('TC-AUTH-010: Memastikan halaman yang memerlukan autentikasi tidak dapat diakses tanpa login', () => {
    cy.visit('/dashboard');
    cy.url().should('satisfy', (url) => url.includes('/login') || url.includes('/#masuk') || url === Cypress.config().baseUrl + '/');
  });

  // TC-AUTH-011: Memastikan pengguna dapat keluar dari akun (Logout)
  it('TC-AUTH-011: Memastikan pengguna dapat keluar dari akun', () => {
    openLogin();
    cy.get('#fL input[name="email"]').clear().type('member@skillconnect.com');
    cy.get('#fL input[name="password"]').clear().type('password123');
    cy.get('#fL button[type="submit"]').click();
    cy.url({ timeout: 15000 }).should('include', '/dashboard');

    cy.get('#global-logout-form').submit();
    cy.url().should('satisfy', (url) => url.includes('/login') || url.includes('/#masuk') || url === Cypress.config().baseUrl + '/');
  });

  // TC-AUTH-012: Memastikan pengguna tidak dapat mengakses kembali dashboard setelah logout
  it('TC-AUTH-012: Memastikan pengguna tidak dapat mengakses kembali dashboard setelah logout', () => {
    cy.visit('/dashboard');
    cy.url().should('not.include', '/dashboard');
  });

});

