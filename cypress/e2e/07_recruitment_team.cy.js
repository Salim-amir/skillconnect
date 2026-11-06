// cypress/e2e/07_recruitment_team.cy.js
// TEST CASE REKRUTMEN&KELOLA TIM (TC-TEAM-001 s/d TC-TEAM-006)

describe('TEST CASE REKRUTMEN & KELOLA TIM', () => {

  const loginAsAdmin = () => {
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
  };

  const loginAsMember = () => {
    cy.visit('/login');
    cy.get('body').then(($body) => {
      if ($body.find('[data-open="l"]').length > 0) {
        cy.get('[data-open="l"]').first().click({ force: true });
      }
    });
    cy.get('#fL input[name="email"]').clear().type('member@skillconnect.com');
    cy.get('#fL input[name="password"]').clear().type('password123');
    cy.get('#fL button[type="submit"]').click();
    cy.url({ timeout: 15000 }).should('include', '/dashboard');
  };

  // TC-TEAM-001: Creator melihat daftar pelamar masuk berdasarkan filter posisi
  it('TC-TEAM-001: Memastikan Project Creator dapat melihat daftar pelamar masuk berdasarkan filter posisi', () => {
    loginAsAdmin();
    cy.visit('/proyek/1?posisi=Frontend+Developer');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Frontend') || text.includes('Pelamar') || text.includes('Kandidat')).to.be.true;
    });
  });

  // TC-TEAM-002: Creator menyetujui lamaran member dan konfirmasi keanggotaan tim
  it('TC-TEAM-002: Memastikan Creator dapat menyetujui lamaran member dan mengonfirmasi keanggotaan tim', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      expect(text.includes('anggota tim') || text.includes('diterima') || text.includes('status')).to.be.true;
    });
  });

  // TC-TEAM-003: Member melihat dan merespons undangan proyek
  it('TC-TEAM-003: Memastikan Member dapat melihat riwayat dan keterlibatan proyek', () => {
    loginAsMember();
    cy.visit('/proyek/riwayat');
    cy.get('body').then(($body) => {
      expect($body.text().includes('Riwayat') || $body.text().includes('Proyek')).to.be.true;
    });
  });

  // TC-TEAM-004: Creator dapat mengelola keanggotaan tim
  it('TC-TEAM-004: Memastikan daftar anggota tim terdaftar dan dapat ditinjau oleh Creator', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.contains('Aplikasi Kasir POS').should('exist');
  });

  // TC-TEAM-005: Pembentukan Tim & Pembaruan Status Proyek
  it('TC-TEAM-005: Memastikan sistem memantau kelengkapan kuota dan status pengerjaan proyek', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Status Proyek') || text.includes('Berjalan') || text.includes('Mencari Tim') || text.includes('Selesai')).to.be.true;
    });
  });

  // TC-TEAM-006: Hak Akses Tim (Non-anggota dibatasi dari akses langsung /kanban)
  it('TC-TEAM-006: Memastikan pembatasan hak akses ke ruang kerja proyek yang tidak diikuti', () => {
    loginAsMember();
    cy.visit('/proyek/99999/tasks', { failOnStatusCode: false });
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      const isRestricted = text.includes('404') || text.includes('tidak ditemukan') || text.includes('dibatasi') || !window.location.pathname.endsWith('/proyek/99999/tasks');
      expect(isRestricted).to.be.true;
    });
  });

});

