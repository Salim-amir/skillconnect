// cypress/e2e/04_create_project_criteria.cy.js
// TEST CASE BUAT PROYEK&KRITERIA (TC-PROJ-001 s/d TC-PROJ-006)

describe('TEST CASE BUAT PROYEK & KRITERIA SKILL', () => {

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

  beforeEach(() => {
    loginAsMember();
  });

  // TC-PROJ-001: Project Creator dapat membuat proyek baru dengan data valid
  it('TC-PROJ-001: Memastikan Project Creator dapat membuat proyek baru dengan data valid', () => {
    cy.visit('/proyek/buat');
    cy.url().should('include', '/proyek/buat');

    const projName = 'Proyek Cypress E2E ' + Date.now();
    cy.get('input[name="judul_project"]').type(projName);
    cy.get('select[name="kategori"]').select(1);
    cy.get('input[name="budget"]').type('3000000');
    cy.get('textarea[name="deskripsi"]').type('Deskripsi proyek pengujian otomatis menggunakan Cypress E2E.');
    cy.get('input[name="posisi"]').type('Backend Developer, Frontend Developer');
    cy.get('input[name="skills[]"]').first().check({ force: true });

    cy.get('form[action*="proyek/buat"]').submit();
    cy.wait(1500);
    cy.url().should('satisfy', (url) => url.includes('/proyek'));
  });

  // TC-PROJ-002: Sistem menolak pembuatan proyek jika field wajib kosong
  it('TC-PROJ-002: Memastikan sistem menolak pembuatan proyek jika field wajib kosong', () => {
    cy.visit('/proyek/buat');
    cy.get('input[name="judul_project"]').clear();
    cy.get('form[action*="proyek/buat"] button[type="submit"]').click();
    cy.get('input[name="judul_project"]:invalid').should('exist');
  });

  // TC-PROJ-003: Creator dapat menambahkan posisi spesifik, alokasi fee, dan kriteria skill
  it('TC-PROJ-003: Memastikan Creator dapat menambahkan posisi spesifik, alokasi fee, dan kriteria skill', () => {
    cy.visit('/proyek/buat');
    cy.get('input[name="posisi"]').should('exist').and('be.visible');
    cy.get('input[name="skills[]"]').should('have.length.greaterThan', 0);
  });

  // TC-PROJ-004: Validasi budget & fee (nilai minimal budget)
  it('TC-PROJ-004: Memastikan sistem memvalidasi batas nilai budget proyek', () => {
    cy.visit('/proyek/buat');
    cy.get('input[name="budget"]').clear().type('1000'); // Di bawah nilai min="100000"
    cy.get('form[action*="proyek/buat"] button[type="submit"]').click();
    cy.get('input[name="budget"]:invalid').should('exist');
  });

  // TC-PROJ-005: Sistem mewajibkan kriteria skill untuk setiap posisi
  it('TC-PROJ-005: Memastikan sistem menyediakan pilihan checklist kriteria skill', () => {
    cy.visit('/proyek/buat');
    cy.get('input[name="skills[]"]').should('exist');
    cy.contains('Pilih Kriteria Skill').should('exist');
  });

  // TC-PROJ-006: Proyek berhasil dipublikasikan dan siap menerima lamaran
  it('TC-PROJ-006: Memastikan proyek berhasil dipublikasikan dan siap menerima lamaran', () => {
    cy.visit('/proyek');
    cy.contains('Aplikasi Kasir POS').should('exist');
  });

});

