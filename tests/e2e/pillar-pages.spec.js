// @ts-check
const { test, expect } = require('@playwright/test');
const { PILLARS, SELECTORS } = require('../helpers/test-data');
const { goto } = require('../helpers/page-helpers');

/**
 * Pillar Pages Tests - KISS Refactored
 * Simple, focused tests for the 5 pillar pages
 */

test.describe('Pillar Pages', () => {
  
  // Test each pillar page
  for (const pillar of PILLARS) {
    
    test(`${pillar.name} page loads successfully`, async ({ page }) => {
      const response = await page.goto(`/${pillar.slug}`);
      expect(response?.status()).toBe(200);
    });
    
    test(`${pillar.name} has correct body class`, async ({ page }) => {
      await goto(page, `/${pillar.slug}`);
      
      const bodyClass = await page.locator('body').getAttribute('class');
      expect(bodyClass).toContain(`page-${pillar.slug}`);
    });
    
    test(`${pillar.name} has heading and content`, async ({ page }) => {
      await goto(page, `/${pillar.slug}`);
      
      // Check heading exists
      await expect(page.locator(SELECTORS.heading).first()).toBeVisible();
      
      // Check content exists
      await expect(page.locator(SELECTORS.content).first()).toBeVisible();
    });
    
    test.skip(`${pillar.name} visual regression`, async ({ page }) => {
      await goto(page, `/${pillar.slug}`);
      await expect(page).toHaveScreenshot(`${pillar.slug}.png`, { fullPage: true });
    });
  }
});

test.describe('Pillar Pages - Mobile', () => {
  
  test.use({ viewport: { width: 375, height: 667 } });
  
  for (const pillar of PILLARS) {
    test(`${pillar.name} works on mobile`, async ({ page }) => {
      await goto(page, `/${pillar.slug}`);
      await expect(page.locator(SELECTORS.content).first()).toBeVisible();
    });
  }
});
