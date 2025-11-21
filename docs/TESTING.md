# Automated Testing Guide - Zuidakker

Comprehensive testing suite for styling and functionality to prevent regressions during development.

---

## Overview

The testing suite uses **Playwright** for end-to-end testing and visual regression testing. Tests cover:

✅ **Pillar page styling** - Colors, layout, responsive design
✅ **Language switcher** - Functionality and positioning  
✅ **Homepage** - Pillar cards grid and layout
✅ **Custom post types** - Geschiedenis and Activiteiten
✅ **Visual regression** - Screenshot comparisons
✅ **Responsive design** - Mobile, tablet, desktop

---

## Quick Start

### 1. Install Dependencies

```bash
# Install Node.js dependencies
npm install

# Install Playwright browsers
npx playwright install
```

### 2. Run Tests

```bash
# Run all tests
npm test

# Run tests with UI (recommended for development)
npm run test:ui

# Run tests in headed mode (see browser)
npm run test:headed

# Run specific test suites
npm run test:pillar      # Pillar pages only
npm run test:visual      # Visual regression only
npm run test:functional  # Functionality only
npm run test:language    # Language switcher only
```

### 3. View Results

```bash
# Open HTML report
npm run report
```

---

## Test Structure

```
tests/
├── helpers/
│   ├── test-data.js      # Centralized test data (KISS principle)
│   └── page-helpers.js   # Reusable helper functions
├── e2e/
│   ├── pillar-pages.spec.js       # Pillar page tests
│   ├── language-switcher.spec.js  # Language switcher tests
│   ├── homepage.spec.js            # Homepage tests
│   └── custom-post-types.spec.js  # CPT tests
└── README.md             # Quick reference guide
```

### KISS Refactoring

Tests follow the **Keep It Simple, Stupid** principle:

✅ **Single source of truth** - All test data in `helpers/test-data.js`
✅ **Reusable helpers** - Common functions in `helpers/page-helpers.js`
✅ **Simple tests** - One assertion per test, clear names
✅ **Easy maintenance** - Change data once, affects all tests

---

## Test Categories

### Pillar Pages Tests

**File:** `tests/e2e/pillar-pages.spec.js`

Tests all 5 pillar pages (Tuinen, Geschiedenis, Ontmoeting, Educatie, Verblijf):

✅ **Color verification** - Primary and secondary colors
✅ **Visual regression** - Full-page screenshots
✅ **Accessibility** - All pages load with 200 status
✅ **Navigation** - Links between pages work
✅ **Content** - Headings and content exist
✅ **Responsive** - Mobile and tablet layouts

**Run:**
```bash
npm run test:pillar
```

### Language Switcher Tests

**File:** `tests/e2e/language-switcher.spec.js`

Tests the NL|EN language switcher:

✅ **Visibility** - Switcher appears in header
✅ **Content** - NL and EN links present
✅ **Styling** - Correct CSS applied
✅ **Functionality** - Language switching works (when configured)
✅ **Active state** - Current language highlighted
✅ **Position** - Correct placement in header
✅ **Responsive** - Works on all devices

**Run:**
```bash
npm run test:language
```

### Homepage Tests

**File:** `tests/e2e/homepage.spec.js`

Tests homepage and pillar cards grid:

✅ **Basic functionality** - Page loads successfully
✅ **Pillar cards** - All 5 cards present
✅ **Icons** - Correct emoji icons (🌱🏛️🌊🎓🏠)
✅ **Content** - Titles and subtitles
✅ **Links** - Cards link to correct pages
✅ **Colors** - Pillar-specific colors applied
✅ **Grid layout** - Correct CSS grid/flex
✅ **Hover effects** - Interactive feedback
✅ **Responsive** - Mobile stacking

**Run:**
```bash
npm test tests/e2e/homepage.spec.js
```

### Custom Post Types Tests

**File:** `tests/e2e/custom-post-types.spec.js`

Tests Geschiedenis and Activiteiten CPTs:

✅ **Registration** - CPTs registered in WordPress
✅ **Archives** - Archive pages accessible
✅ **Single posts** - Individual posts display
✅ **Features** - Thumbnails, categories work

**Run:**
```bash
npm test tests/e2e/custom-post-types.spec.js
```

---

## Visual Regression Testing

Visual regression tests take screenshots and compare them to baseline images.

### Update Baseline Screenshots

When you intentionally change styling:

```bash
npm run update-snapshots
```

This updates the baseline screenshots that future tests will compare against.

### How It Works

1. **First run:** Creates baseline screenshots
2. **Subsequent runs:** Compares current screenshots to baseline
3. **Differences:** Highlights pixel differences
4. **Threshold:** Allows small differences (100 pixels, 20% threshold)

### Screenshot Locations

```
tests/
└── e2e/
    └── *.spec.js-snapshots/
        ├── chromium/
        ├── firefox/
        └── webkit/
```

---

## Test Tags

Tests are tagged for easy filtering:

- `@visual` - Visual regression tests
- `@functional` - Functionality tests
- `@pillar` - Pillar page tests
- `@language` - Language switcher tests

**Examples:**
```bash
# Run only visual tests
npm run test:visual

# Run only functional tests
npm run test:functional

# Run specific tag
npx playwright test --grep @pillar
```

---

## Browser Coverage

Tests run on multiple browsers:

- ✅ **Chromium** (Chrome, Edge)
- ✅ **Firefox**
- ✅ **WebKit** (Safari)
- ✅ **Mobile Chrome** (Pixel 5)
- ✅ **Mobile Safari** (iPhone 12)

### Run Specific Browser

```bash
# Chromium only
npx playwright test --project=chromium

# Firefox only
npx playwright test --project=firefox

# Mobile only
npx playwright test --project="Mobile Chrome"
```

---

## Continuous Integration

### GitHub Actions (Example)

```yaml
name: Tests
on: [push, pull_request]
jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - uses: actions/setup-node@v3
      - run: npm ci
      - run: npx playwright install --with-deps
      - run: npm test
      - uses: actions/upload-artifact@v3
        if: always()
        with:
          name: test-results
          path: test-results/
```

---

## Debugging Tests

### Interactive Mode

```bash
# Open Playwright UI
npm run test:ui
```

Features:
- ✅ Run tests step-by-step
- ✅ See browser actions
- ✅ Inspect selectors
- ✅ View screenshots
- ✅ Debug failures

### Headed Mode

```bash
# See browser while tests run
npm run test:headed
```

### Debug Specific Test

```bash
# Debug single test
npx playwright test --debug tests/e2e/pillar-pages.spec.js
```

### Screenshots and Videos

Failed tests automatically capture:
- ✅ Screenshot on failure
- ✅ Video recording
- ✅ Trace file for debugging

View in HTML report:
```bash
npm run report
```

---

## Writing New Tests

### Basic Test Template

```javascript
const { test, expect } = require('@playwright/test');

test.describe('Feature Name', () => {
  
  test('@functional Feature works correctly', async ({ page }) => {
    await page.goto('/page-url');
    await page.waitForLoadState('networkidle');
    
    const element = page.locator('.selector');
    await expect(element).toBeVisible();
  });
  
  test('@visual Feature visual regression', async ({ page }) => {
    await page.goto('/page-url');
    await page.waitForLoadState('networkidle');
    
    await expect(page).toHaveScreenshot('feature.png');
  });
});
```

### Best Practices

1. **Use descriptive test names** - Clearly state what's being tested
2. **Add tags** - Use `@visual`, `@functional`, etc.
3. **Wait for network idle** - Ensure page is fully loaded
4. **Use specific selectors** - Prefer data-testid or unique classes
5. **Test one thing** - Each test should verify one behavior
6. **Clean up** - Reset state between tests if needed

---

## What's Protected

### Styling

✅ **Pillar page colors** - Primary and secondary colors for all 5 pillars
✅ **Language switcher styling** - Position, colors, hover states
✅ **Pillar cards design** - Grid layout, colors, icons
✅ **Responsive layouts** - Mobile, tablet, desktop breakpoints
✅ **Typography** - Font sizes, weights, line heights
✅ **Spacing** - Margins, padding, gaps

### Functionality

✅ **Page navigation** - All pages load correctly
✅ **Language switching** - NL/EN switcher works
✅ **Pillar card links** - Cards link to correct pages
✅ **Custom post types** - Geschiedenis and Activiteiten work
✅ **Responsive behavior** - Mobile menus, stacking, etc.
✅ **Interactive elements** - Hover effects, clicks, forms

---

## Troubleshooting

### Tests Failing After Intentional Changes

If you changed styling intentionally:

```bash
# Update baseline screenshots
npm run update-snapshots

# Re-run tests
npm test
```

### Docker Not Running

Tests require WordPress to be running:

```bash
# Start Docker
docker-compose up -d

# Verify site is accessible
curl http://localhost:8080
```

### Browser Installation Issues

```bash
# Reinstall browsers
npx playwright install --force
```

### Slow Tests

```bash
# Run tests in parallel (faster)
npx playwright test --workers=4

# Run specific browser only
npx playwright test --project=chromium
```

### Screenshot Differences

Small differences are allowed (threshold: 20%, max 100 pixels).

To see differences:
```bash
npm run report
```

Click on failed test to see visual diff.

---

## Maintenance

### Regular Tasks

**Weekly:**
- ✅ Run full test suite
- ✅ Review any failures
- ✅ Update snapshots if needed

**Before Deployment:**
- ✅ Run all tests
- ✅ Verify all browsers pass
- ✅ Check visual regressions
- ✅ Review HTML report

**After Major Changes:**
- ✅ Update baseline screenshots
- ✅ Add new tests for new features
- ✅ Update test documentation

### Adding New Tests

When adding new features:

1. **Write tests first** (TDD approach)
2. **Add to appropriate spec file**
3. **Tag appropriately** (`@visual`, `@functional`, etc.)
4. **Document in this file**
5. **Run tests to verify**

---

## Test Coverage

Current coverage:

| Feature | Tests | Status |
|---------|-------|--------|
| Pillar Pages | 15+ | ✅ |
| Language Switcher | 10+ | ✅ |
| Homepage | 12+ | ✅ |
| Custom Post Types | 6+ | ✅ |
| Responsive Design | 8+ | ✅ |
| Visual Regression | 20+ | ✅ |

**Total:** 70+ automated tests

---

## Resources

- **Playwright Docs:** https://playwright.dev/docs/intro
- **Best Practices:** https://playwright.dev/docs/best-practices
- **API Reference:** https://playwright.dev/docs/api/class-test
- **Visual Testing:** https://playwright.dev/docs/test-snapshots

---

## Summary

✅ **Comprehensive coverage** - Styling, functionality, responsiveness
✅ **Visual regression** - Prevents unintended style changes
✅ **Multi-browser** - Chrome, Firefox, Safari, Mobile
✅ **Easy to run** - Simple npm commands
✅ **Detailed reports** - HTML reports with screenshots
✅ **CI-ready** - Can integrate with GitHub Actions
✅ **Maintainable** - Clear structure and documentation

**Run tests regularly to ensure nothing breaks during development!**

---

**Last Updated:** October 12, 2024  
**Test Framework:** Playwright 1.40+  
**Coverage:** 70+ tests across 5 test suites
