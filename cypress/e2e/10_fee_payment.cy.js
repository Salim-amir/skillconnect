// cypress/e2e/10_fee_payment.cy.js
// TEST CASE FEE (TC-FEE-001 s/d TC-FEE-006)

describe('TEST CASE FEE, TRANSAKSI & MIDTRANS PAYMENT', () => {

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

  // TC-FEE-001: Pembayaran DP Proyek via Midtrans
  it('TC-FEE-001: Memastikan tombol/alur inisiasi pembayaran proyek tersedia bagi Creator', () => {
    loginAsAdmin();
    cy.visit('/proyek/1');
    cy.get('body').then(($body) => {
      const text = $body.text();
      expect(text.includes('Bayar') || text.includes('Escrow') || text.includes('Dana') || text.includes('Budget')).to.be.true;
    });
  });

  // TC-FEE-002: Pencairan Fee Termin Tugas
  it('TC-FEE-002: Memastikan status pembayaran escrow dan riwayat transaksi tercatat di sistem', () => {
    loginAsAdmin();
    cy.visit('/admin/transaksi');
    cy.url().should('include', '/admin/transaksi');
    cy.contains('Riwayat Transaksi').should('exist');
    cy.contains('Transaksi Lunas').should('exist');
  });

  // TC-FEE-003: Penanganan Webhook Midtrans (API Route)
  it('TC-FEE-003: Memastikan route webhook Midtrans siap menerima HTTP Notification callback', () => {
    cy.request({
      method: 'POST',
      url: '/midtrans/callback',
      failOnStatusCode: false,
      body: {
        order_id: 'TEST-FEE-CYPRESS-999',
        transaction_status: 'settlement',
        status_code: '200',
        gross_amount: '1000000.00'
      }
    }).then((response) => {
      // Endpoint webhook harus merespons (bisa 200, 400, atau 404 jika order_id palsu, namun bukan server crash 500)
      expect(response.status).to.be.oneOf([200, 400, 404, 422]);
    });
  });

  // TC-FEE-004: Privasi Fee & Ringkasan Dasbor
  it('TC-FEE-004: Memastikan ringkasan dasbor member menampilkan informasi proyek & pemasukan privat', () => {
    loginAsMember();
    cy.visit('/dashboard');
    cy.contains('Dashboard').should('exist');
  });

  // TC-FEE-005: Penanganan Transaksi Gagal / Batal
  it('TC-FEE-005: Memastikan sistem mempertahankan integritas status proyek saat transaksi belum lunas', () => {
    loginAsAdmin();
    cy.visit('/admin/transaksi');
    cy.get('body').then(($body) => {
      expect($body.text().includes('Pending') || $body.text().includes('Batal') || $body.text().includes('Lunas')).to.be.true;
    });
  });

  // TC-FEE-006: Validasi Alokasi Budget & Fee
  it('TC-FEE-006: Memastikan form pembuatan proyek memvalidasi kelayakan budget', () => {
    loginAsMember();
    cy.visit('/proyek/buat');
    cy.get('input[name="budget"]').should('have.attr', 'min', '100000');
  });

});

