/**
 * Page Helpers - Reusable page interaction functions
 * KISS: Simple, focused helper functions
 */

/**
 * Navigate to page and wait for it to load
 */
async function goto(page, url) {
  await page.goto(url);
  await page.waitForLoadState('networkidle');
}

/**
 * Check if element is visible
 */
async function isVisible(page, selector) {
  const element = page.locator(selector).first();
  return await element.isVisible().catch(() => false);
}

/**
 * Get element count
 */
async function count(page, selector) {
  return await page.locator(selector).count();
}

/**
 * Get element text
 */
async function getText(page, selector) {
  const element = page.locator(selector).first();
  return await element.textContent();
}

/**
 * Get CSS property value
 */
async function getCss(page, selector, property) {
  const element = page.locator(selector).first();
  return await element.evaluate((el, prop) => 
    window.getComputedStyle(el)[prop], property
  );
}

/**
 * Take screenshot with standard settings
 */
async function screenshot(page, name) {
  await page.screenshot({ 
    path: `test-results/screenshots/${name}`,
    fullPage: true 
  });
}

/**
 * Set viewport size
 */
async function setViewport(page, device) {
  const viewports = {
    mobile: { width: 375, height: 667 },
    tablet: { width: 768, height: 1024 },
    desktop: { width: 1920, height: 1080 }
  };
  
  await page.setViewportSize(viewports[device] || viewports.desktop);
}

module.exports = {
  goto,
  isVisible,
  count,
  getText,
  getCss,
  screenshot,
  setViewport
};
