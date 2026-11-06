// cypress/e2e/saucedemo_standard_user.cy.js
// STANDARD USER TEST CASES (TC_STANDARD_001 s/d TC_STANDARD_009)

describe('SauceDemo - STANDARD USER TEST SUITE', () => {
  const SAUCE_URL = 'https://www.saucedemo.com';

  const loginStandardUser = () => {
    cy.visit(SAUCE_URL);
    cy.get('[data-test="username"]').clear().type('standard_user');
    cy.get('[data-test="password"]').clear().type('secret_sauce');
    cy.get('[data-test="login-button"]').click();
    cy.url().should('include', '/inventory.html');
  };

  beforeEach(() => {
    cy.clearCookies();
    cy.clearLocalStorage();
  });

  // TC_STANDARD_001: Verify the login of standard_user
  it('TC_STANDARD_001: Enter valid username and valid password', () => {
    cy.visit(SAUCE_URL);
    cy.get('[data-test="username"]').clear().type('standard_user');
    cy.get('[data-test="password"]').clear().type('secret_sauce');
    cy.get('[data-test="login-button"]').click();
    cy.url().should('include', '/inventory.html');
    cy.contains('.title', 'Products').should('be.visible');
  });

  // TC_STANDARD_002: Verify logout functionality
  it('TC_STANDARD_002: Click logout from sidebar', () => {
    loginStandardUser();
    cy.get('#react-burger-menu-btn').click();
    cy.get('#logout_sidebar_link').should('be.visible').click();
    cy.url().should('satisfy', (url) => url === `${SAUCE_URL}/` || url.endsWith('saucedemo.com/'));
    cy.get('[data-test="login-button"]').should('be.visible');
  });

  // TC_STANDARD_003: Verify product sorting by Price (Low to High)
  it('TC_STANDARD_003: Select "Price (low to high)" on filter', () => {
    loginStandardUser();
    cy.get('[data-test="product-sort-container"]').select('lohi');
    cy.get('.inventory_item_name').first().should('have.text', 'Sauce Labs Onesie');
    cy.get('.inventory_item_price').first().should('have.text', '$7.99');
  });

  // TC_STANDARD_004: Verify "Add to cart" functionality
  it('TC_STANDARD_004: Click Add to cart on a product', () => {
    loginStandardUser();
    cy.get('[data-test="add-to-cart-sauce-labs-backpack"]').click();
    cy.get('[data-test="remove-sauce-labs-backpack"]').should('be.visible');
    cy.get('.shopping_cart_badge').should('have.text', '1');
  });

  // TC_STANDARD_005: Verify "Remove" item functionality
  it('TC_STANDARD_005: Click Remove on a product in cart', () => {
    loginStandardUser();
    cy.get('[data-test="add-to-cart-sauce-labs-backpack"]').click();
    cy.get('.shopping_cart_link').click();
    cy.url().should('include', '/cart.html');
    cy.get('[data-test="remove-sauce-labs-backpack"]').click();
    cy.get('.shopping_cart_badge').should('not.exist');
    cy.get('.cart_item').should('not.exist');
  });

  // TC_STANDARD_006: Verify sidebar menu opens
  it('TC_STANDARD_006: Click burger menu', () => {
    loginStandardUser();
    cy.get('#react-burger-menu-btn').click();
    cy.get('.bm-menu-wrap').should('be.visible');
    cy.get('.bm-item-list a').should('have.length', 4);
  });

  // TC_STANDARD_007: Verify product list loads (Dynamic/Scroll)
  it('TC_STANDARD_007: Scroll inventory page and verify all 6 products', () => {
    loginStandardUser();
    cy.scrollTo('bottom');
    cy.get('.inventory_item').should('have.length', 6);
  });

  // TC_STANDARD_008: Verify checkout form validation (Empty First Name)
  it('TC_STANDARD_008: Submit checkout form with empty First Name', () => {
    loginStandardUser();
    cy.get('[data-test="add-to-cart-sauce-labs-backpack"]').click();
    cy.get('.shopping_cart_link').click();
    cy.get('[data-test="checkout"]').click();
    cy.url().should('include', '/checkout-step-one.html');
    cy.get('[data-test="lastName"]').type('Doe');
    cy.get('[data-test="postalCode"]').type('12345');
    cy.get('[data-test="continue"]').click();
    cy.get('[data-test="error"]').should('be.visible').and('contain', 'First Name is required');
  });

  // TC_STANDARD_009: Verify successful checkout process
  it('TC_STANDARD_009: Complete order with valid data', () => {
    loginStandardUser();
    cy.get('[data-test="add-to-cart-sauce-labs-backpack"]').click();
    cy.get('.shopping_cart_link').click();
    cy.get('[data-test="checkout"]').click();
    cy.get('[data-test="firstName"]').type('Salim');
    cy.get('[data-test="lastName"]').type('Amir');
    cy.get('[data-test="postalCode"]').type('65141');
    cy.get('[data-test="continue"]').click();
    cy.url().should('include', '/checkout-step-two.html');
    cy.get('[data-test="finish"]').click();
    cy.url().should('include', '/checkout-complete.html');
    cy.contains('.complete-header', 'Thank you for your order!').should('be.visible');
  });
});

