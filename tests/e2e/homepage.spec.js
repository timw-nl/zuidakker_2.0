// @ts-check
const { test, expect } = require('@playwright/test');
const { PILLARS, SELECTORS } = require('../helpers/test-data');
const { goto, count } = require('../helpers/page-helpers');

/**
 * Homepage Tests - KISS Refactored
 * Simple tests for homepage and pillar cards
 */

test.describe('Homepage', () => {
  
  test('loads successfully', async ({ page }) => {
    const response = await page.goto('/');
    expect(response?.status()).toBe(200);
  });
  
  test('has a title', async ({ page }) => {
    await goto(page, '/');
    const title = await page.title();
    expect(title.length).toBeGreaterThan(0);
  });
  
  test.skip('visual regression', async ({ page }) => {
    await goto(page, '/');
    await expect(page).toHaveScreenshot('homepage.png', { fullPage: true });
  });
});

test.describe('Pillar Cards', () => {
  
  test('pillar cards or links exist', async ({ page }) => {
    await goto(page, '/');
    
    // Check if any pillar-related elements exist
    const hasCards = await count(page, SELECTORS.pillarCard) > 0;
    const hasGrid = await count(page, SELECTORS.pillarsGrid) > 0;
    
    expect(hasCards || hasGrid).toBeTruthy();
  });
  
  test('pillar cards have correct content', async ({ page }) => {
    await goto(page, '/');
    
    for (const pillar of PILLARS) {
      const card = page.locator(`.pillar-${pillar.slug}`).first();
      
      if (await card.count() > 0) {
        const text = await card.textContent();
        
        // Check for icon, title, and subtitle
        expect(text).toContain(pillar.icon);
        expect(text).toContain(pillar.name);
        expect(text).toContain(pillar.subtitle);
      }
    }
  });
  
  test('pillar cards link to correct pages', async ({ page }) => {
    await goto(page, '/');
    
    for (const pillar of PILLARS) {
      const card = page.locator(`.pillar-${pillar.slug}`).first();
      
      if (await card.count() > 0) {
        const href = await card.getAttribute('href');
        expect(href).toContain(pillar.slug);
      }
    }
  });
});

test.describe('Homepage - Mobile', () => {
  
  test.use({ viewport: { width: 375, height: 667 } });
  
  test('works on mobile', async ({ page }) => {
    await goto(page, '/');
    await expect(page.locator('body')).toBeVisible();
  });
});
