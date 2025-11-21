// @ts-check
const { defineConfig, devices } = require('@playwright/test');

/**
 * Playwright Config - KISS Refactored
 * Simple configuration for Zuidakker tests
 */
module.exports = defineConfig({
  testDir: './tests',
  timeout: 30 * 1000,
  
  expect: {
    timeout: 5000,
    toHaveScreenshot: { maxDiffPixels: 100, threshold: 0.2 },
  },
  
  fullyParallel: true,
  retries: process.env.CI ? 2 : 0,
  workers: process.env.CI ? 1 : undefined,
  
  reporter: [['html'], ['list']],
  
  use: {
    baseURL: 'http://localhost:8080',
    trace: 'on-first-retry',
    screenshot: 'only-on-failure',
  },

  // Test on Chrome by default (add more browsers as needed)
  projects: [
    { name: 'chromium', use: { ...devices['Desktop Chrome'] } },
  ],
});
