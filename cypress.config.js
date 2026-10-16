import { defineConfig } from "cypress";

export default defineConfig({
  e2e: {
    baseUrl: "http://127.0.0.1:8000",
    viewportWidth: 1280,
    viewportHeight: 800,
    video: false,
    screenshotOnRunFailure: true,
    supportFile: false,
    defaultCommandTimeout: 15000,
    pageLoadTimeout: 60000,
    chromeWebSecurity: false,
    specPattern: "cypress/e2e/**/*.cy.{js,jsx,ts,tsx}",
  },
});
