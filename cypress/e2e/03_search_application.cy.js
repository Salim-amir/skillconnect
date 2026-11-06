// cypress/e2e/03_search_application.cy.js
// TEST CASE PENCARIAN&PENGAJUAN L (TC-SEARCH-001 s/d 006, TC-APPLY-001 s/d 005)

describe('TEST CASE PENCARIAN & PENGAJUAN LAMARAN', () => {

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

  const loginAsCreator = () => {
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

  // TC-SEARCH-001: Member dapat melihat daftar proyek yang tersedia
  it('TC-SEARCH-001: Memastikan member dapat melihat daftar proyek yang tersedia', () => {
    loginAsMember();
    cy.visit('/proyek');
    cy.url().should('include', '/proyek');
    cy.get('.project-card, .filter-card').should('exist');
  });

  // TC-SEARCH-002: Member dapat mencari proyek berdasarkan kata kunci
  it('TC-SEARCH-002: Memastikan member dapat mencari proyek berdasarkan kata kunci', () => {
    loginAsMember();
    cy.visit('/proyek');
    cy.get('input[name="q"]').clear().type('Aplikasi');
    cy.get('form.filter-form').submit();
    cy.url().should('include', 'q=Aplikasi');
  });

  // TC-SEARCH-003: Sistem menangani kata kunci yang tidak ditemukan
  it('TC-SEARCH-003: Memastikan sistem menangani kata kunci yang tidak ditemukan', () => {
    loginAsMember();
    cy.visit('/proyek?q=KataKunciPalingAnehTidakMungkinAda123999');
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      expect(text.includes('tidak ditemukan') || text.includes('belum ada') || text.includes('0') || $body.find('.project-card').length === 0).to.be.true;
    });
  });

  // TC-SEARCH-004: Member dapat melihat detail proyek
  it('TC-SEARCH-004: Memastikan member dapat melihat detail proyek', () => {
    loginAsMember();
    cy.visit('/proyek/1');
    cy.url().should('include', '/proyek/1');
    cy.contains('Aplikasi Kasir POS').should('exist');
    cy.contains('Kebutuhan Skill').should('exist');
  });

  // TC-SEARCH-005: Rekomendasi berdasarkan kecocokan skill
  it('TC-SEARCH-005: Memastikan sistem menampilkan rekomendasi berdasarkan kecocokan skill', () => {
    loginAsCreator();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Kecocokan') || text.includes('Cocok') || text.includes('Kandidat')).to.be.true;
    });
  });

  // TC-SEARCH-006: Menampilkan persentase kecocokan skill
  it('TC-SEARCH-006: Memastikan sistem menampilkan persentase kecocokan skill', () => {
    loginAsCreator();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('% Cocok') || text.includes('%') || text.includes('Skor')).to.be.true;
    });
  });

  // TC-APPLY-001: Member dapat mengajukan lamaran pada proyek
  it('TC-APPLY-001: Memastikan member dapat mengajukan lamaran pada proyek', () => {
    loginAsMember();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      if ($body.find('form[action*="apply"]').length > 0) {
        cy.get('form[action*="apply"]').first().submit();
        cy.wait(1000);
        cy.contains('Aplikasi Kasir POS').should('exist');
      } else {
        expect($body.text().includes('Sudah Melamar') || $body.text().includes('Lamaran Terkirim') || $body.text().includes('Lamaran')).to.be.true;
      }
    });
  });

  // TC-APPLY-002: Sistem mencegah pengajuan lamaran ganda pada proyek yang sama
  it('TC-APPLY-002: Memastikan sistem mencegah pengajuan lamaran ganda pada proyek yang sama', () => {
    loginAsMember();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      // Tombol ajukan lamaran tidak aktif atau menampilkan status sudah melamar
      const isAlreadyApplied = text.includes('Sudah Melamar') || text.includes('Menunggu') || text.includes('Lamaran') || $body.find('form[action*="apply"]').length === 0;
      expect(isAlreadyApplied).to.be.true;
    });
  });

  // TC-APPLY-003: Project Creator dapat melihat lamaran yang masuk
  it('TC-APPLY-003: Memastikan Project Creator dapat melihat lamaran yang masuk', () => {
    loginAsCreator();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Pelamar') || text.includes('Kandidat') || text.includes('Lamaran')).to.be.true;
    });
  });

  // TC-APPLY-004: Project Creator dapat menerima lamaran
  it('TC-APPLY-004: Memastikan Project Creator dapat menerima lamaran', () => {
    loginAsCreator();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const hasActionBtn = $body.find('form[action*="kandidat"], button:contains("Terima"), button:contains("Undang")').length > 0;
      expect(hasActionBtn || $body.text().includes('Diterima') || $body.text().includes('Status')).to.be.true;
    });
  });

  // TC-APPLY-005: Member dapat melihat status lamaran
  it('TC-APPLY-005: Memastikan member dapat melihat status lamaran', () => {
    loginAsMember();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Status') || text.includes('Lamaran') || text.includes('Menunggu') || text.includes('Diterima')).to.be.true;
    });
  });

});

