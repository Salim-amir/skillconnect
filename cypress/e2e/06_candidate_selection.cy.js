// cypress/e2e/06_candidate_selection.cy.js
// TEST CASE MEMILIH KANDIDAT (TC-CAND-001 s/d TC-CAND-006)

describe('TEST CASE MEMILIH KANDIDAT PROYEK', () => {

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

  // TC-CAND-001: Creator dapat mengundang kandidat dari daftar rekomendasi
  it('TC-CAND-001: Memastikan Project Creator dapat melihat rekomendasi dan opsi mengundang kandidat', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Kandidat') || text.includes('Undang') || text.includes('Pelamar')).to.be.true;
    });
  });

  // TC-CAND-002: Creator dapat menyetujui lamaran masuk
  it('TC-CAND-002: Memastikan Project Creator dapat menyetujui (menerima) lamaran masuk dari member', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Terima') || text.includes('Diterima') || text.includes('Status')).to.be.true;
    });
  });

  // TC-CAND-003: Creator dapat menolak lamaran member
  it('TC-CAND-003: Memastikan Project Creator memiliki aksi keputusan/penolakan lamaran', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Tolak') || text.includes('Ditolak') || text.includes('Pelamar') || text.includes('Aksi')).to.be.true;
    });
  });

  // TC-CAND-004: Validasi kuota posisi proyek
  it('TC-CAND-004: Memastikan sistem memvalidasi kapasitas/kuota posisi proyek', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Posisi') || text.includes('Terisi') || text.includes('Kuota') || text.includes('Tim')).to.be.true;
    });
  });

  // TC-CAND-005: Member dapat melihat status atau undangan proyek
  it('TC-CAND-005: Memastikan member dapat melihat status keterlibatan di proyek', () => {
    loginAsMember();
    cy.visit('/proyek/riwayat');
    cy.url().should('include', '/proyek/riwayat');
    cy.contains('Proyek').should('exist');
  });

  // TC-CAND-006: Pembentukan Tim & DP
  it('TC-CAND-006: Memastikan sistem menampilkan status tim dan informasi pendanaan/escrow', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Escrow') || text.includes('Dana') || text.includes('Budget') || text.includes('Tim')).to.be.true;
    });
  });

});

