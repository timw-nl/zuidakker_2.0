# Zuidakker Child Theme

Custom child theme for the Zuidakker platform, based on Kadence theme.

---

## Theme Structure

```
zuidakker-child/
├── functions.php          # Main loader (15 lines)
├── style.css              # Pillar colors & styles
├── inc/                   # Modular functions (KISS)
│   ├── theme-config.php       # Setup & pillar configuration
│   ├── pillar-pages.php       # Body classes & shortcode
│   ├── custom-post-types.php  # Geschiedenis & Activiteiten
│   ├── woocommerce.php        # WooCommerce support
│   ├── language-switcher.php  # NL|EN switcher
│   └── footer-customization.php  # Footer sitemap link
└── functions.php.backup   # Original (backup)
```

---

## Features

### 5-Pillar Color Scheme

Each pillar has unique colors defined in `style.css`:

| Pillar | Primary | Secondary | Body Class |
|--------|---------|-----------|------------|
| Tuinen | `#97bf85` | `#6f9357` | `page-tuinen` |
| Geschiedenis | `#c27d55` | `#b4412f` | `page-geschiedenis` |
| Ontmoeting | `#6ba7b6` | `#2a677e` | `page-ontmoeting` |
| Educatie | `#f0a85f` | `#d97225` | `page-educatie` |
| Verblijf | `#d98c8c` | `#b35a5a` | `page-verblijf` |
| Sitemap | `#2c5530` | `#4a7c59` | `page-sitemap` |

**CSS Variables:**
```css
:root {
    --pillar-tuinen-primary: #97bf85;
    --pillar-tuinen-secondary: #6f9357;
    /* ... etc */
}
```

**Body classes automatically applied** based on page slug.

### Custom Post Types

**Geschiedenis (History Items)**
- Archive: `/geschiedenis-item/`
- Supports: title, editor, thumbnail, excerpt
- Gutenberg enabled
- Menu icon: Calendar

**Activiteiten (Activities)**
- Archive: `/activiteit/`
- Supports: title, editor, thumbnail, excerpt, categories
- Gutenberg enabled
- Menu icon: Location

### Shortcodes

**Pillar Grid**
```
[pillars_grid]
```

Generates responsive grid with all 5 pillar cards:
- Icons, titles, subtitles
- Links to pillar pages
- Hover effects
- Mobile responsive

### WooCommerce Integration

- Product gallery zoom
- Product gallery lightbox
- Product gallery slider
- 3 products per row

### Language Switcher

NL|EN switcher in header:
- Auto-detects Polylang
- Shows disabled state until configured
- Positioned next to navigation

### Footer Customization

Sitemap link in footer:
- Automatically added to footer
- Right-aligned (desktop)
- Center-aligned (mobile)
- Uses sitemap colors
- Hover effect

### Responsive Design

**Breakpoints:**
- Mobile: < 768px (1 column)
- Tablet: 768px - 1023px (2 columns)
- Desktop: ≥ 1024px (3 columns)

**Mobile-first approach**

### Accessibility

- Focus states for keyboard navigation
- Screen reader friendly
- Semantic HTML
- WCAG AA color contrast

---

## KISS Refactoring

### Modular Organization

**Before:** 336 lines in one file
**After:** 5 modules (~50 lines each)

**Benefits:**
- Easy to find code
- Easy to maintain
- Easy to test
- Clear separation of concerns

### Single Source of Truth

**Pillar configuration** in `inc/theme-config.php`:

```php
function zuidakker_get_pillars() {
    return array(
        'tuinen' => array(
            'name' => 'Tuinen',
            'subtitle' => 'Gardens',
            'icon' => '🌱',
            'description' => '...'
        ),
        // ... 5 pillars
    );
}
```

**Used by:**
- Body classes (`inc/pillar-pages.php`)
- Pillar grid shortcode (`inc/pillar-pages.php`)
- E2E tests (`tests/helpers/test-data.js`)

**Change once, affects everywhere!**

---

## Installation

### Requirements

- WordPress 6.0+
- Kadence Theme (parent)
- PHP 7.4+

### Steps

1. Install Kadence theme
2. Upload `zuidakker-child` to `/wp-content/themes/`
3. Activate via **Appearance → Themes**

---

## Customization

### Change Pillar Colors

**Edit:** `style.css`

```css
:root {
    --pillar-tuinen-primary: #97bf85;
    --pillar-tuinen-secondary: #6f9357;
}
```

### Change Pillar Data

**Edit:** `inc/theme-config.php`

```php
function zuidakker_get_pillars() {
    return array(
        'tuinen' => array(
            'name' => 'New Name',
            'subtitle' => 'New Subtitle',
            'icon' => '🌱',
            'description' => 'New description'
        ),
    );
}
```

### Add New Module

1. Create file in `inc/`
2. Add `require_once` to `functions.php`
3. Keep it focused and simple

### Modify Existing Feature

1. Find the right module in `inc/`
2. Edit only that file
3. Other modules unaffected

---

## Module Reference

### theme-config.php

**Purpose:** Basic theme setup

**Contains:**
- `zuidakker_get_pillars()` - Pillar configuration
- Style enqueuing
- Default language (Dutch)
- Textdomain loading
- Security settings

### pillar-pages.php

**Purpose:** Pillar page functionality

**Contains:**
- Body class filter
- Pillar grid shortcode

### custom-post-types.php

**Purpose:** Register CPTs

**Contains:**
- Geschiedenis CPT
- Activiteiten CPT

### woocommerce.php

**Purpose:** WooCommerce integration

**Contains:**
- Theme support
- Product columns (3)

### language-switcher.php

**Purpose:** NL|EN language switcher

**Contains:**
- Switcher JavaScript
- Polylang integration
- Fallback for unconfigured state

### footer-customization.php

**Purpose:** Footer enhancements

**Contains:**
- Sitemap link in footer
- Right-aligned positioning
- Responsive styling

---

## File Sizes

| File | Lines | Purpose |
|------|-------|---------|
| functions.php | 15 | Main loader |
| theme-config.php | 80 | Basic setup |
| pillar-pages.php | 50 | Pillar functionality |
| custom-post-types.php | 45 | CPT registration |
| woocommerce.php | 20 | WooCommerce |
| language-switcher.php | 55 | Language switcher |
| footer-customization.php | 65 | Footer sitemap link |
| **Total** | **330** | vs 336 original |

---

## Testing

Theme functionality is tested by E2E tests:

```bash
npm test
```

**Tests cover:**
- Pillar page styling
- Body classes
- Pillar grid shortcode
- Language switcher
- Custom post types

**See:** `docs/TESTING.md`

---

## Troubleshooting

### Pillar colors not showing

1. Check body class exists: `page-{slug}`
2. Clear cache: `Ctrl + Shift + R`
3. Verify CSS variables in `style.css`

### Shortcode not working

1. Check shortcode syntax: `[pillars_grid]`
2. Verify theme is active
3. Check for PHP errors

### Custom post types missing

1. Go to **Settings → Permalinks**
2. Click **Save Changes**
3. Refresh admin

### Module not loading

1. Check `require_once` in `functions.php`
2. Verify file path
3. Check for PHP syntax errors

---

## Best Practices

### DO ✅

- Keep modules focused
- Use `zuidakker_get_pillars()` for pillar data
- Follow WordPress coding standards
- Add comments for complex logic
- Test changes with E2E tests

### DON'T ❌

- Put everything in `functions.php`
- Hardcode pillar data
- Duplicate code
- Create circular dependencies
- Skip testing

---

## Migration Notes

**Original file backed up:** `functions.php.backup`

**To revert:**
```bash
cd wp-content/themes/zuidakker-child
mv functions.php.backup functions.php
rm -rf inc/
```

**All functionality preserved:**
- ✅ Pillar pages work
- ✅ Custom post types work
- ✅ Language switcher works
- ✅ WooCommerce works
- ✅ Shortcodes work

---

## Related Documentation

- **Rebuild Guide:** `docs/REBUILD_GUIDE.md`
- **Pillar Styling:** `docs/PILLAR_PAGE_STYLING.md`
- **CSS Spacing Optimizations:** `docs/CSS_SPACING_OPTIMIZATIONS.md`
- **Testing:** `docs/TESTING.md`
- **Polylang:** `docs/POLYLANG.md`

---

## Recent Updates (v1.0.9)

### CSS Spacing Optimizations
- **Reduced vertical spacing** by 50-75% for headers and hero sections
- **Centered page titles** with flexbox alignment
- **Container width matching** for consistent layout (max-width: 1200px)
- **Ultra-compact spacing** rules for minimal vertical space usage
- **Targeted optimizations** for `.entry-header`, `.hero-container`, `.site-container`

### Key Improvements
- Headers now take **60% less vertical space**
- Page titles are **perfectly centered**
- Hero containers **match content width** for visual consistency
- **Maintained readability** with careful spacing choices
- **Responsive design** preserved across all devices

### Implementation Details
- Added comprehensive CSS rules in `style.css` (lines 614-756)
- Used `!important` declarations to override theme defaults
- Targeted multiple related classes for complete coverage
- Applied progressive enhancement approach

---

**Last Updated:** October 26, 2024  
**Version:** 1.0.9  
**Architecture:** KISS Modular + Spacing Optimized
