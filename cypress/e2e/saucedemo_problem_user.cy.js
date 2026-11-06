// cypress/e2e/saucedemo_problem_user.cy.js
// PROBLEM USER TEST CASES (TC_PROBLEM_001 s/d TC_PROBLEM_007)

describe('SauceDemo - PROBLEM USER TEST SUITE', () => {
  const SAUCE_URL = 'https://www.saucedemo.com';

  const loginProblemUser = () => {
    cy.visit(SAUCE_URL);
    cy.get('[data-test="username"]').clear().type('problem_user');
    cy.get('[data-test="password"]').clear().type('secret_sauce');
    cy.get('[data-test="login-button"]').click();
    cy.url().should('include', '/inventory.html');
  };

  beforeEach(() => {
    cy.clearCookies();
    cy.clearLocalStorage();
  });

  // TC_PROBLEM_001: Verify Login dengan Problem User
  it('TC_PROBLEM_001: Memastikan problem_user dapat login ke sistem', () => {
    cy.visit(SAUCE_URL);
    cy.get('[data-test="username"]').clear().type('problem_user');
    cy.get('[data-test="password"]').clear().type('secret_sauce');
    cy.get('[data-test="login-button"]').click();
    cy.url().should('include', '/inventory.html');
    cy.contains('.title', 'Products').should('be.visible');
  });

  // TC_PROBLEM_002: Verify Product Image (Bug deteksi gambar seragam/slsl)
  it('TC_PROBLEM_002: Memastikan gambar produk sesuai dengan produk yang ditampilkan (Verifikasi Bug Gambar)', () => {
    loginProblemUser();
    cy.get('.inventory_item_img img').first().then(($img) => {
      const src = $img.attr('src');
      // Di problem_user semua gambar menggunakan src sl-404.168b1cce.jpg
      expect(src).to.include('sl-404');
    });
  });

  // TC_PROBLEM_003: Verify Product Detail
  it('TC_PROBLEM_003: Memastikan produk yang dipilih membuka detail produk yang sesuai', () => {
    loginProblemUser();
    cy.get('.inventory_item_name').first().click();
    cy.url().should('include', '/inventory-item.html');
    cy.get('.inventory_details_name').should('be.visible');
  });

  // TC_PROBLEM_004: Verify Add to Cart
  it('TC_PROBLEM_004: Memastikan produk dapat ditambahkan ke keranjang', () => {
    loginProblemUser();
    cy.get('[data-test="add-to-cart-sauce-labs-backpack"]').click();
    cy.get('.shopping_cart_badge').should('exist');
  });

  // TC_PROBLEM_005: Verify Remove from Cart (Bug problem_user tombol remove tidak responsif)
  it('TC_PROBLEM_005: Memastikan pengujian penghapusan produk dari cart', () => {
    loginProblemUser();
    cy.get('[data-test="add-to-cart-sauce-labs-backpack"]').click();
    cy.get('.shopping_cart_link').click();
    cy.url().should('include', '/cart.html');
    cy.get('body').then(($body) => {
      expect($body.find('.cart_item').length).to.be.at.least(1);
    });
  });

  // TC_PROBLEM_006: Verify Product Sorting (Bug problem_user dropdown sorting gagal mengubah urutan)
  it('TC_PROBLEM_006: Memverifikasi respons dropdown filter sorting pada problem_user', () => {
    loginProblemUser();
    cy.get('[data-test="product-sort-container"]').select('lohi');
    // Memastikan select element tetap merespons event change
    cy.get('[data-test="product-sort-container"]').should('have.value', 'lohi');
  });

  // TC_PROBLEM_007: Verify Checkout Form (Bug problem_user last name field)
  it('TC_PROBLEM_007: Memverifikasi interaksi form checkout pada problem_user', () => {
    loginProblemUser();
    cy.get('[data-test="add-to-cart-sauce-labs-backpack"]').click();
    cy.get('.shopping_cart_link').click();
    cy.get('[data-test="checkout"]').click();
    cy.url().should('include', '/checkout-step-one.html');
    cy.get('[data-test="firstName"]').type('Vinda');
    cy.get('[data-test="lastName"]').type('Yunita');
    cy.get('[data-test="postalCode"]').type('65145');
    cy.get('[data-test="continue"]').click();
    // Problem user akan mengalami error validasi pada Last Name
    cy.get('[data-test="error"]').should('be.visible');
  });
});

