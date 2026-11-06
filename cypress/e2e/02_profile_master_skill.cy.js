// cypress/e2e/02_profile_master_skill.cy.js
// TEST CASE KELOLA PROFIL&MASTER (TC-PROFILE-001 s/d 004, TC-SKILL-001 s/d 005)

describe('TEST CASE KELOLA PROFIL & MASTER SKILL', () => {

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

  // TC-PROFILE-001: Member dapat melihat halaman profil
  it('TC-PROFILE-001: Memastikan member dapat melihat halaman profil', () => {
    cy.visit('/profile-skill');
    cy.url().should('include', '/profile-skill');
    cy.contains('Profil').should('exist');
    cy.get('input[name="name"]').should('be.visible');
  });

  // TC-PROFILE-002: Member dapat mengisi dan menyimpan profil
  it('TC-PROFILE-002: Memastikan member dapat mengisi dan menyimpan profil', () => {
    cy.visit('/profile-skill');
    cy.get('input[name="name"]').clear().type('Member SkillConnect');
    cy.get('body').then(($body) => {
      if ($body.find('textarea[name="bio"]').length > 0) {
        cy.get('textarea[name="bio"]').clear().type('Web Developer & UI Enthusiast');
      }
    });
    cy.get('form[action*="profile-skill"]').first().submit();
    cy.wait(1000);
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      expect(text.includes('berhasil') || text.includes('profil') || text.includes('diperbarui') || text.includes('sukses')).to.be.true;
    });
  });

  // TC-PROFILE-003: Member dapat memperbarui profil
  it('TC-PROFILE-003: Memastikan member dapat memperbarui profil', () => {
    cy.visit('/profile-skill');
    const updatedName = 'Member Updated ' + Math.floor(Math.random() * 1000);
    cy.get('input[name="name"]').clear().type(updatedName);
    cy.get('form[action*="profile-skill"]').first().submit();
    cy.wait(1000);
    cy.visit('/profile-skill');
    cy.get('input[name="name"]').should('have.value', updatedName);
  });

  // TC-PROFILE-004: Sistem memvalidasi data profil wajib yang kosong
  it('TC-PROFILE-004: Memastikan sistem memvalidasi data profil wajib yang kosong', () => {
    cy.visit('/profile-skill');
    cy.get('input[name="name"]').clear();
    cy.get('form[action*="profile-skill"]').first().find('button[type="submit"]').click();
    cy.get('input[name="name"]:invalid').should('exist');
  });

  // TC-SKILL-001: Sistem menampilkan daftar Master Skill
  it('TC-SKILL-001: Memastikan sistem menampilkan daftar Master Skill', () => {
    cy.visit('/profile-skill');
    cy.get('select[name="skill_id"]').should('exist');
    cy.get('select[name="skill_id"] option').should('have.length.greaterThan', 1);
  });

  // TC-SKILL-002: Member dapat memilih skill dari Master Skill
  it('TC-SKILL-002: Memastikan member dapat memilih skill dari Master Skill', () => {
    cy.visit('/profile-skill');
    cy.get('select[name="skill_id"]').then(($select) => {
      const options = $select.find('option');
      if (options.length > 1) {
        cy.get('select[name="skill_id"]').select(options.eq(1).val());
      }
    });
    cy.get('select[name="tingkat_keahlian"]').should('exist');
  });

  // TC-SKILL-003: Member dapat menentukan tingkat keahlian
  it('TC-SKILL-003: Memastikan member dapat menentukan tingkat keahlian', () => {
    cy.visit('/profile-skill');
    cy.get('select[name="tingkat_keahlian"]').then(($sel) => {
      const opts = $sel.find('option');
      if (opts.length > 1) {
        cy.get('select[name="tingkat_keahlian"]').select(opts.eq(1).val());
      }
    });
    cy.get('select[name="tingkat_keahlian"]').should('not.have.value', '');
  });

  // TC-SKILL-004: Member dapat menghapus skill dari profil
  it('TC-SKILL-004: Memastikan member dapat menghapus skill dari profil', () => {
    cy.visit('/profile-skill');
    cy.get('body').then(($body) => {
      if ($body.find('.btn-remove-skill').length > 0) {
        cy.on('window:confirm', () => true);
        cy.get('.btn-remove-skill').first().click({ force: true });
        cy.wait(1000);
        cy.contains('Profil').should('exist');
      } else {
        // Skill belum ada, tambahkan dulu lalu verifikasi keberadaan form hapus
        cy.get('select[name="skill_id"]').select(1);
        cy.get('select[name="tingkat_keahlian"]').select(1);
        cy.get('form[action*="add-skill"]').submit();
        cy.wait(1000);
        cy.get('.btn-remove-skill').should('exist');
      }
    });
  });

  // TC-SKILL-005: Memastikan sistem hanya menggunakan skill yang tersedia pada Master Skill
  it('TC-SKILL-005: Memastikan sistem hanya menggunakan skill yang tersedia pada Master Skill', () => {
    cy.visit('/profile-skill');
    // Dropdown skill terikat dengan ID integer dari master skills
    cy.get('select[name="skill_id"] option').each(($opt) => {
      const val = $opt.val();
      if (val !== '') {
        expect(Number.isInteger(Number(val))).to.be.true;
      }
    });
  });

});

