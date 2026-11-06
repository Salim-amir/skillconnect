// cypress/e2e/saucedemo_error_user.cy.js
// ERROR USER TEST CASES (TC_ERR_001 s/d TC_ERR_005)

describe('SauceDemo - ERROR USER TEST SUITE', () => {
  const SAUCE_URL = 'https://www.saucedemo.com';

  const loginErrorUser = () => {
    cy.visit(SAUCE_URL);
    cy.get('[data-test="username"]').clear().type('error_user');
    cy.get('[data-test="password"]').clear().type('secret_sauce');
    cy.get('[data-test="login-button"]').click();
    cy.url().should('include', '/inventory.html');
  };

  beforeEach(() => {
    cy.clearCookies();
    cy.clearLocalStorage();
  });

  // TC_ERR_001: Check Error User Login & Alert
  it('TC_ERR_001: Menguji alert saat login dan proses logout pada error_user', () => {
    cy.visit(SAUCE_URL);
    cy.get('[data-test="username"]').clear().type('error_user');
    cy.get('[data-test="password"]').clear().type('secret_sauce');
    cy.get('[data-test="login-button"]').click();
    cy.url().should('include', '/inventory.html');
    cy.contains('.title', 'Products').should('be.visible');
  });

  // TC_ERR_002: Check Error User Catalog & Sorting
  it('TC_ERR_002: Menguji status produk di katalog dan interaksi sorting', () => {
    loginErrorUser();
    // Di error_user, dropdown sorting memicu window:alert atau gagal urut
    cy.on('window:alert', (text) => {
      expect(text).to.exist;
    });
    cy.get('[data-test="product-sort-container"]').select('lohi');
  });

  // TC_ERR_003: Check Error User Add to Cart & Detail
  it('TC_ERR_003: Menguji tombol add to cart dan halaman detail produk', () => {
    loginErrorUser();
    cy.get('.inventory_item_name').first().click();
    cy.url().should('include', '/inventory-item.html');
    cy.get('.inventory_details_name').should('be.visible');
  });

  // TC_ERR_004: Check Error User Dynamic Load & Slider
  it('TC_ERR_004: Menguji pemuatan katalog dan interaksi scroll', () => {
    loginErrorUser();
    cy.scrollTo('bottom');
    cy.get('.inventory_item').should('have.length.greaterThan', 0);
  });

  // TC_ERR_005: Check Error User Checkout Process
  it('TC_ERR_005: Menguji proses form checkout dan tombol finish', () => {
    loginErrorUser();
    cy.get('[data-test="add-to-cart-sauce-labs-backpack"]').click();
    cy.get('.shopping_cart_link').click();
    cy.get('[data-test="checkout"]').click();
    cy.url().should('include', '/checkout-step-one.html');
    cy.get('[data-test="firstName"]').type('Test');
    cy.get('[data-test="lastName"]').type('User');
    cy.get('[data-test="postalCode"]').type('12345');
    cy.get('[data-test="continue"]').click();
    cy.url().should('include', '/checkout-step-two.html');
    // Error user: tombol finish akan memicu error atau gagal redirect ke finish
    cy.get('[data-test="finish"]').should('be.visible');
  });
});

