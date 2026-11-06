// cypress/e2e/saucedemo_locked_out_user.cy.js
// LOCKED OUT USER TEST CASES (TC_LOCKED_001 s/d TC_LOCKED_004)

describe('SauceDemo - LOCKED OUT USER TEST SUITE', () => {
  const SAUCE_URL = 'https://www.saucedemo.com';

  beforeEach(() => {
    cy.visit(SAUCE_URL);
    cy.clearCookies();
    cy.clearLocalStorage();
  });

  // TC_LOCKED_001: Verify Login dengan Locked Out User
  it('TC_LOCKED_001: Memastikan user yang akunnya terkunci tidak dapat login', () => {
    cy.get('[data-test="username"]').clear().type('locked_out_user');
    cy.get('[data-test="password"]').clear().type('secret_sauce');
    cy.get('[data-test="login-button"]').click();
    cy.get('[data-test="error"]')
      .should('be.visible')
      .and('contain', 'Sorry, this user has been locked out.');
  });

  // TC_LOCKED_002: Verify Login dengan Password Salah
  it('TC_LOCKED_002: Memastikan locked out user tetap tidak dapat masuk ketika password salah', () => {
    cy.get('[data-test="username"]').clear().type('locked_out_user');
    cy.get('[data-test="password"]').clear().type('wrongpassword');
    cy.get('[data-test="login-button"]').click();
    cy.get('[data-test="error"]')
      .should('be.visible')
      .and('contain', 'Username and password do not match');
  });

  // TC_LOCKED_003: Verify Login dengan Username Locked Out dan Password Kosong
  it('TC_LOCKED_003: Memastikan sistem melakukan validasi ketika password tidak diisi', () => {
    cy.get('[data-test="username"]').clear().type('locked_out_user');
    cy.get('[data-test="password"]').clear();
    cy.get('[data-test="login-button"]').click();
    cy.get('[data-test="error"]')
      .should('be.visible')
      .and('contain', 'Password is required');
  });

  // TC_LOCKED_004: Verify Login dengan Username Kosong
  it('TC_LOCKED_004: Memastikan sistem melakukan validasi ketika username tidak diisi', () => {
    cy.get('[data-test="username"]').clear();
    cy.get('[data-test="password"]').clear().type('secret_sauce');
    cy.get('[data-test="login-button"]').click();
    cy.get('[data-test="error"]')
      .should('be.visible')
      .and('contain', 'Username is required');
  });
});

