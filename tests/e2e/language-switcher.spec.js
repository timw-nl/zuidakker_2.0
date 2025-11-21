// @ts-check
const { test, expect } = require('@playwright/test');
const { LANGUAGES, SELECTORS } = require('../helpers/test-data');
const { goto } = require('../helpers/page-helpers');

/**
 * Language Switcher Tests - KISS Refactored
 * Simple tests for NL|EN language switcher
 */

test.describe('Language Switcher', () => {
  
  test('is visible in header', async ({ page }) => {
    await goto(page, '/');
    
    // Wait for JavaScript to add switcher
    await page.waitForSelector(SELECTORS.languageSwitcher, { timeout: 5000 });
    
    await expect(page.locator(SELECTORS.languageSwitcher)).toBeVisible();
  });
  
  test('contains NL and EN', async ({ page }) => {
    await goto(page, '/');
    await page.waitForSelector(SELECTORS.languageSwitcher, { timeout: 5000 });
    
    const switcher = page.locator(SELECTORS.languageSwitcher);
    const text = await switcher.textContent();
    
    expect(text).toContain('NL');
    expect(text).toContain('EN');
  });
  
  test('has separator between languages', async ({ page }) => {
    await goto(page, '/');
    await page.waitForSelector(SELECTORS.languageSwitcher, { timeout: 5000 });
    
    await expect(page.locator(SELECTORS.langSeparator)).toBeVisible();
  });
  
  test('is positioned in header area', async ({ page }) => {
    await goto(page, '/');
    await page.waitForSelector(SELECTORS.languageSwitcher, { timeout: 5000 });
    
    const switcher = page.locator(SELECTORS.languageSwitcher);
    const navigation = page.locator(SELECTORS.navigation);
    
    // Both should be visible
    await expect(switcher).toBeVisible();
    await expect(navigation).toBeVisible();
  });
});

test.describe('Language Switcher - Mobile', () => {
  
  test.use({ viewport: { width: 375, height: 667 } });
  
  test('works on mobile', async ({ page }) => {
    await goto(page, '/');
    await page.waitForSelector(SELECTORS.languageSwitcher, { timeout: 5000 });
    
    await expect(page.locator(SELECTORS.languageSwitcher)).toBeVisible();
  });
});
