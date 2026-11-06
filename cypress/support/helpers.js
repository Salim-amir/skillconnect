// cypress/support/helpers.js

export const openLoginModal = () => {
  cy.visit('/login');
  cy.get('body').then(($body) => {
    if ($body.find('[data-open="l"]').length > 0) {
      cy.get('[data-open="l"]').first().click({ force: true });
    }
  });
};

export const openRegisterModal = () => {
  cy.visit('/register');
  cy.get('body').then(($body) => {
    if ($body.find('[data-open="r"]').length > 0) {
      cy.get('[data-open="r"]').first().click({ force: true });
    }
  });
};

export const login = (email, password) => {
  cy.visit('/login');
  cy.get('body').then(($body) => {
    if ($body.find('[data-open="l"]').length > 0) {
      cy.get('[data-open="l"]').first().click({ force: true });
    }
  });
  if (email !== null && email !== '') {
    cy.get('#fL input[name="email"]').clear().type(email);
  } else {
    cy.get('#fL input[name="email"]').clear();
  }
  if (password !== null && password !== '') {
    cy.get('#fL input[name="password"]').clear().type(password);
  } else {
    cy.get('#fL input[name="password"]').clear();
  }
  cy.get('#fL button[type="submit"]').click();
};

export const loginAsMember = () => {
  login('member@skillconnect.com', 'password123');
  cy.url({ timeout: 15000 }).should('include', '/dashboard');
  cy.contains('Dashboard').should('exist');
};

export const loginAsAdmin = () => {
  login('admin@skillconnect.com', 'password123');
  cy.url({ timeout: 15000 }).should('include', '/dashboard');
  cy.contains('Dashboard').should('exist');
};

export const logout = () => {
  cy.get('body').then(($body) => {
    if ($body.find('#global-logout-form').length > 0) {
      cy.get('#global-logout-form').submit();
    } else {
      cy.visit('/');
    }
  });
};

