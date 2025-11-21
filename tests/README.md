# Tests - KISS Approach

Simple, focused tests for Zuidakker styling and functionality.

## Quick Start

```bash
# Install
npm install
npx playwright install chromium

# Run tests
npm test

# Interactive mode
npm run test:ui
```

## Test Structure

```
tests/
├── helpers/
│   ├── test-data.js      # Centralized test data (PILLARS, SELECTORS)
│   └── page-helpers.js   # Reusable functions (goto, isVisible, etc.)
└── e2e/
    ├── pillar-pages.spec.js       # Pillar page tests
    ├── homepage.spec.js            # Homepage tests
    ├── language-switcher.spec.js  # Language switcher tests
    └── custom-post-types.spec.js  # CPT tests
```

## KISS Principles Applied

### 1. Single Source of Truth
All test data in `helpers/test-data.js`:
- Pillar configurations (colors, names, slugs)
- Selectors (CSS selectors in one place)
- Languages (NL, EN configuration)

### 2. Reusable Helpers
Common functions in `helpers/page-helpers.js`:
- `goto(page, url)` - Navigate and wait
- `isVisible(page, selector)` - Check visibility
- `count(page, selector)` - Get element count
- `getText(page, selector)` - Get text content

### 3. Simple Tests
Each test does one thing:
- ✅ Clear test names
- ✅ Minimal setup
- ✅ Single assertion per test
- ✅ No complex logic

### 4. Easy to Maintain
- Change pillar colors? Update `test-data.js` once
- Change selectors? Update `test-data.js` once
- Add new helper? Add to `page-helpers.js`

## Test Files

### pillar-pages.spec.js
Tests all 5 pillar pages:
- Page loads (200 status)
- Correct body class
- Has heading and content
- Mobile responsive

### homepage.spec.js
Tests homepage:
- Page loads
- Has title
- Pillar cards exist
- Cards have correct content and links

### language-switcher.spec.js
Tests NL|EN switcher:
- Visible in header
- Contains NL and EN
- Has separator
- Works on mobile

### custom-post-types.spec.js
Tests CPTs:
- Geschiedenis archive accessible
- Activiteiten archive accessible

## Running Tests

```bash
# All tests
npm test

# Specific file
npx playwright test pillar-pages

# Headed mode (see browser)
npm run test:headed

# Update screenshots
npm run update-snapshots
```

## Adding New Tests

1. **Add test data** to `helpers/test-data.js` if needed
2. **Add helper function** to `helpers/page-helpers.js` if needed
3. **Write simple test** in appropriate spec file
4. **Keep it simple** - one thing per test

Example:
```javascript
test('feature works', async ({ page }) => {
  await goto(page, '/page');
  await expect(page.locator('.element')).toBeVisible();
});
```

## Benefits

✅ **Easy to read** - No complex logic
✅ **Easy to maintain** - Change data in one place
✅ **Easy to extend** - Add new tests quickly
✅ **Fast** - Simple tests run faster
✅ **Reliable** - Less complexity = fewer flaky tests

---

**Keep It Simple, Stupid!**
