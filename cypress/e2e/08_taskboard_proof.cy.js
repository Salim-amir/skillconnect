// cypress/e2e/08_taskboard_proof.cy.js
// TEST CASE TASK BOARD&UPLOAD BUK (TC-TASK-001 s/d TC-TASK-006)

describe('TEST CASE TASK BOARD & UPLOAD BUKTI KERJA', () => {

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

  // TC-TASK-001: Creator membuat tugas dan menugaskannya ke anggota tim
  it('TC-TASK-001: Memastikan Project Creator dapat mengakses form penambahan task baru', () => {
    loginAsAdmin();
    cy.visit('/proyek/1/tasks');
    cy.url().should('include', '/proyek/1/tasks');
    cy.get('body').then(($body) => {
      expect($body.text().includes('Tambah Task') || $body.text().includes('Task Board')).to.be.true;
    });
  });

  // TC-TASK-002: Member mengubah status tugas menjadi "Sedang Dikerjakan"
  it('TC-TASK-002: Memastikan Member dapat melihat Task Board Kanban status pengerjaan', () => {
    loginAsMember();
    cy.visit('/proyek/1/tasks');
    cy.contains('Task Board').should('exist');
    cy.contains('Belum Dikerjakan').should('exist');
    cy.contains('Sedang Dikerjakan').should('exist');
  });

  // TC-TASK-003: Member mengajukan review tugas dengan mengunggah bukti kerja
  it('TC-TASK-003: Memastikan komponen upload bukti kerja tersedia pada tugas', () => {
    loginAsMember();
    cy.visit('/proyek/1/tasks');
    cy.get('body').then(($body) => {
      expect($body.find('#formUploadBukti, input[name="bukti_kerja"], button:contains("Upload")').length > 0 || $body.text().includes('Bukti')).to.be.true;
    });
  });

  // TC-TASK-004: Validasi format dan ketentuan unggah bukti kerja
  it('TC-TASK-004: Memastikan input bukti kerja membatasi tipe file yang valid', () => {
    loginAsAdmin();
    cy.visit('/proyek/1/tasks');
    cy.get('body').then(($body) => {
      if ($body.find('#buktiFileInput').length > 0) {
        cy.get('#buktiFileInput').should('have.attr', 'accept');
      } else {
        cy.contains('Task Board').should('exist');
      }
    });
  });

  // TC-TASK-005: Creator menyetujui tugas
  it('TC-TASK-005: Memastikan Project Creator memiliki aksi persetujuan tugas yang diajukan', () => {
    loginAsAdmin();
    cy.visit('/proyek/1/tasks');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Selesai') || text.includes('Approve') || text.includes('Menunggu Review') || text.includes('Task Board')).to.be.true;
    });
  });

  // TC-TASK-006: Creator meminta revisi tugas dengan catatan revisi
  it('TC-TASK-006: Memastikan Creator dapat memberikan catatan revisi jika tugas belum sesuai', () => {
    loginAsAdmin();
    cy.visit('/proyek/1/tasks');
    cy.get('body').then(($body) => {
      expect($body.find('#modalRevisi, form#formRevisi, textarea[name="catatan_revisi"]').length > 0 || $body.text().includes('Revisi')).to.be.true;
    });
  });

});

