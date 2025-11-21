// @ts-check
const { test, expect } = require('@playwright/test');
const { goto } = require('../helpers/page-helpers');

/**
 * Custom Post Types Tests - KISS Refactored
 * Simple tests for Geschiedenis and Activiteiten
 */

const CPT_ARCHIVES = [
  { name: 'Geschiedenis', slug: 'geschiedenis-item' },
  { name: 'Activiteiten', slug: 'activiteit' }
];

test.describe('Custom Post Types', () => {
  
  for (const cpt of CPT_ARCHIVES) {
    test(`${cpt.name} archive is accessible`, async ({ page }) => {
      const response = await page.goto(`/${cpt.slug}/`);
      
      // Should load or redirect (both are OK)
      expect([200, 301, 302]).toContain(response?.status() || 0);
    });
  }
});
