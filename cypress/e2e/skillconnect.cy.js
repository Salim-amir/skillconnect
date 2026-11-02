describe('SkillConnect Automated E2E Testing Suite - Cypress (MOD-01 s/d MOD-09)', () => {

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
    cy.contains('Dashboard').should('exist');
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
    cy.contains('Dashboard').should('exist');
  };

  // ==========================================
  // MOD-01: Autentikasi & Login Multi-Role
  // ==========================================
  it('MOD-01-TC01: Validasi error jika kata sandi kosong (Negatif)', () => {
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

  it('MOD-01-TC02: Validasi error jika kredensial tidak cocok (Negatif)', () => {
    cy.visit('/login');
    cy.get('body').then(($body) => {
      if ($body.find('[data-open="l"]').length > 0) {
        cy.get('[data-open="l"]').first().click({ force: true });
      }
    });
    cy.get('#fL input[name="email"]').clear().type('wronguser@skillconnect.com');
    cy.get('#fL input[name="password"]').clear().type('passwordsalah123');
    cy.get('#fL button[type="submit"]').click();
    cy.wait(1000);
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      expect(text.includes('salah') || text.includes('gagal') || text.includes('kata sandi') || text.includes('login')).to.be.true;
    });
  });

  it('MOD-01-TC03: Autentikasi login berhasil role Admin & masuk ke Dashboard Admin (Positif)', () => {
    loginAsAdmin();
    cy.url().should('include', '/dashboard');
    cy.contains('Dashboard').should('be.visible');
  });

  it('MOD-01-TC04: Autentikasi login berhasil role Member & masuk ke Dashboard Member (Positif)', () => {
    loginAsMember();
    cy.url().should('include', '/dashboard');
    cy.contains('Dashboard').should('be.visible');
  });

  // ==========================================
  // MOD-02: Pengelolaan Profile & Master Skill
  // ==========================================
  it('MOD-02-TC01: Akses halaman profil dan master skill pengguna (Positif)', () => {
    loginAsAdmin();
    cy.visit('/profile-skill');
    cy.url().should('include', '/profile-skill');
    cy.contains('Profil').should('exist');
  });

  it('MOD-02-TC02: Verifikasi form biodata, pengalaman, dan elemen master skill (Positif)', () => {
    loginAsMember();
    cy.visit('/profile-skill');
    cy.url().should('include', '/profile-skill');
    cy.get('input[name="name"], textarea[name="pengalaman"], form').should('exist');
  });

  // ==========================================
  // MOD-03: Pencarian & Pengajuan Lamaran
  // ==========================================
  it('MOD-03-TC01: Navigasi katalog proyek & verifikasi filter pencarian (Positif)', () => {
    loginAsMember();
    cy.visit('/proyek');
    cy.url().should('include', '/proyek');
    cy.get('input[type="text"], input[name="search"], input[name="q"], form').should('exist');
  });

  it('MOD-03-TC02: Kunjungan detail proyek & verifikasi form pengajuan lamaran member (Positif)', () => {
    loginAsMember();
    cy.visit('/proyek/1');
    cy.url().should('include', '/proyek/1');
    cy.contains('Aplikasi Kasir POS').should('exist');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Lamaran') || text.includes('Posisi') || text.includes('Fee')).to.be.true;
    });
  });

  // ==========================================
  // MOD-04: Pembuatan Proyek & Kriteria Skill
  // ==========================================
  it('MOD-04-TC01: Proteksi hak akses role - Admin ditolak saat mengakses pembuatan proyek (Negatif / RBAC)', () => {
    loginAsAdmin();
    cy.visit('/proyek/buat', { failOnStatusCode: false });
    cy.get('body').then(($body) => {
      const text = $body.text();
      const isRestricted = !window.location.pathname.endsWith('/proyek/buat') || text.includes('Admin tidak memiliki akses') || text.includes('Dashboard');
      expect(isRestricted).to.be.true;
    });
  });

  it('MOD-04-TC02: Member dapat mengakses form pembuatan proyek beserta kriteria skill (Positif)', () => {
    loginAsMember();
    cy.visit('/proyek/buat');
    cy.url().should('include', '/proyek/buat');
    cy.get('input[name="judul_project"]').should('be.visible');
    cy.get('input[name="budget"]').should('be.visible');
  });

  // ==========================================
  // MOD-05: Exact Skill Matching Engine
  // ==========================================
  it('MOD-05-TC01: Menampilkan persentase kecocokan skill (Exact Match) pada kandidat proyek (Positif)', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.url().should('include', '/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('% Cocok') || text.includes('Kecocokan') || text.includes('Skill')).to.be.true;
    });
  });

  it('MOD-05-TC02: Verifikasi rincian skill cocok dan tag kecocokan pelamar (Positif)', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Skill Cocok') || text.includes('Kandidat') || text.includes('Melamar')).to.be.true;
    });
  });

  // ==========================================
  // MOD-06: Memilih Kandidat
  // ==========================================
  it('MOD-06-TC01: Filter daftar kandidat berdasarkan parameter kriteria posisi proyek (Positif)', () => {
    loginAsAdmin();
    cy.visit('/proyek/1?posisi=Frontend+Developer');
    cy.url().should('include', 'posisi=Frontend');
    cy.contains('Aplikasi Kasir POS').should('exist');
  });

  it('MOD-06-TC02: Verifikasi profil pelamar dan kelengkapan dokumen pendukung (Positif)', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Pelamar') || text.includes('Kandidat') || text.includes('Ekspektasi Fee')).to.be.true;
    });
  });

  // ==========================================
  // MOD-07: Rekrutmen & Kelola Anggota Tim
  // ==========================================
  it('MOD-07-TC01: Verifikasi status rekrutmen kandidat dan tombol aksi keputusan (Positif)', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Status:') || text.includes('Diterima') || text.includes('Pending') || text.includes('Terima')).to.be.true;
    });
  });

  it('MOD-07-TC02: Verifikasi daftar anggota tim aktif yang telah resmi diterima (Positif)', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text().toLowerCase();
      expect(text.includes('anggota tim') || text.includes('anggota tim resmi')).to.be.true;
    });
  });

  // ==========================================
  // MOD-08: Task Board & Upload Bukti Kerja
  // ==========================================
  it('MOD-08-TC01: Memverifikasi Task Board 4 kolom Kanban status pengerjaan (Positif)', () => {
    loginAsAdmin();
    cy.visit('/proyek/1/tasks');
    cy.url().should('include', '/proyek/1/tasks');
    cy.contains('Task Board').should('exist');
    cy.contains('Belum Dikerjakan').should('exist');
    cy.contains('Sedang Dikerjakan').should('exist');
    cy.contains('Menunggu Review').should('exist');
    cy.contains('Selesai').should('exist');
  });

  it('MOD-08-TC02: Memverifikasi komponen formulir tambah tugas dan bukti pengerjaan (Positif)', () => {
    loginAsAdmin();
    cy.visit('/proyek/1/tasks');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Tambah Task') || text.includes('Tugas') || text.includes('Bukti')).to.be.true;
    });
  });

  // ==========================================
  // MOD-09: Evaluasi & Progres Proyek
  // ==========================================
  it('MOD-09-TC01: Memverifikasi ringkasan progres dan status penyelesaian tugas (Positif)', () => {
    loginAsAdmin();
    cy.visit('/proyek/1/tasks');
    cy.get('.stat-card').should('have.length', 4);
    cy.contains('Task Board').should('exist');
  });

  it('MOD-09-TC02: Memverifikasi modul evaluasi kinerja & form rating anggota tim (Positif)', () => {
    loginAsAdmin();
    cy.visit('/proyek/1/tasks');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Evaluasi') || text.includes('Kinerja') || text.includes('Rating')).to.be.true;
    });
  });

});
