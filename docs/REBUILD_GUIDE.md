# Zuidakker Platform - Rebuild Guide

Complete guide to rebuild the Zuidakker WordPress platform from scratch.

---

## Overview

**Zuidakker** is a WordPress-based community platform with:
- 5-pillar design (Gardens, History, Meeting, Education, Accommodation)
- Multilingual support (Dutch/English)
- WooCommerce integration
- Custom post types
- Automated testing

---

## Quick Start

### 1. Start Docker Environment

```bash
docker-compose up -d
```

**Access:**
- Site: http://localhost:8080
- Admin: http://localhost:8080/wp-admin
- phpMyAdmin: http://localhost:8081

### 2. Install WordPress

Complete the WordPress installation wizard with your preferred settings.

### 3. Activate Theme

1. Go to **Appearance → Themes**
2. Activate **Zuidakker Child Theme**
3. Parent theme (Kadence) activates automatically

### 4. Configure Polylang

See **[Language Setup](#language-setup)** section below.

### 5. Create Pages

See **[Required Pages](#required-pages)** section below.

### 6. Run Tests

```bash
npm install
npx playwright install chromium
npm test
```

---

## Architecture

### Theme Structure

```
wp-content/themes/zuidakker-child/
├── functions.php          # Main loader (14 lines)
├── style.css              # Pillar colors & styles
└── inc/                   # Modular functions
    ├── theme-config.php       # Setup & pillar configuration
    ├── pillar-pages.php       # Body classes & shortcode
    ├── custom-post-types.php  # Geschiedenis & Activiteiten
    ├── woocommerce.php        # WooCommerce support
    └── language-switcher.php  # NL|EN switcher
```

### Pillar Configuration

All pillar data centralized in `inc/theme-config.php`:

```php
function zuidakker_get_pillars() {
    return array(
        'tuinen' => array(
            'name' => 'Tuinen',
            'subtitle' => 'Gardens',
            'icon' => '🌱',
            'description' => '...'
        ),
        // ... 5 pillars total
    );
}
```

### MU Plugin

```
wp-content/mu-plugins/
└── polylang-textdomain-fix.php  # WordPress 6.7+ compatibility
```

---

## 5 Pillar Design

### Color Scheme

| Pillar | Primary | Secondary | URL |
|--------|---------|-----------|-----|
| 🌱 Tuinen | `#97bf85` | `#6f9357` | `/tuinen` |
| 🏛️ Geschiedenis | `#c27d55` | `#b4412f` | `/geschiedenis` |
| 🌊 Ontmoeting | `#6ba7b6` | `#2a677e` | `/ontmoeting` |
| 🎓 Educatie | `#f0a85f` | `#d97225` | `/educatie` |
| 🏠 Verblijf | `#d98c8c` | `#b35a5a` | `/verblijf` |

### Styling

All colors defined in `style.css`:

```css
:root {
    --pillar-tuinen-primary: #97bf85;
    --pillar-tuinen-secondary: #6f9357;
    /* ... etc */
}
```

Body classes automatically applied: `page-tuinen`, `page-geschiedenis`, etc.

---

## Required Pages

Create these pages in WordPress admin:

### Core Pages

1. **Homepage**
   - Add hero section (Custom HTML block)
   - Add pillar grid (Shortcode: `[pillars_grid]`)
   - Set as homepage: Settings → Reading

2. **Tuinen** (slug: `tuinen`)
   - Gardens content
   - Automatic green styling

3. **Geschiedenis** (slug: `geschiedenis`)
   - History content
   - Automatic brown styling

4. **Ontmoeting** (slug: `ontmoeting`)
   - Meeting content
   - Automatic blue styling

5. **Educatie** (slug: `educatie`)
   - Food education content
   - Automatic orange styling

6. **Verblijf** (slug: `verblijf`)
   - Accommodation content
   - Automatic pink styling

7. **Sitemap** (slug: `sitemap`)
   - Site structure overview

### WooCommerce Pages

8. **Shop** (slug: `winkel`)
9. **My Account** (slug: `mijn-account`)
10. **Cart** (auto-created by WooCommerce)
11. **Checkout** (auto-created by WooCommerce)

---

## Language Setup

### 1. Add Languages in Polylang

1. Go to **Languages → Languages**
2. Add **Dutch (Nederlands)**:
   - Code: `nl`
   - Locale: `nl_NL`
   - ✅ Set as default
3. Add **English (United States)**:
   - Code: `en`
   - Locale: `en_US`

### 2. Configure URL Structure

1. Go to **Languages → Settings**
2. Select: "Directory name in pretty permalinks"
3. Check: "Hide URL for default language"
4. Save Changes

### 3. Flush Permalinks

1. Go to **Settings → Permalinks**
2. Click **Save Changes**

### 4. Language Switcher

The NL|EN switcher appears automatically in the header once languages are configured.

**See:** `docs/POLYLANG.md` for complete guide.

---

## Custom Post Types

### Geschiedenis (History Items)

**Purpose:** Historical content about Zuidakker

**Features:**
- Title, content, featured image, excerpt
- Archive page: `/geschiedenis-item/`
- Menu icon: Calendar
- Gutenberg support

### Activiteiten (Activities)

**Purpose:** Water activities and events

**Features:**
- Title, content, featured image, excerpt
- Categories support
- Archive page: `/activiteit/`
- Menu icon: Location
- Gutenberg support

**Registered in:** `inc/custom-post-types.php`

---

## WooCommerce Setup

### 1. Install WooCommerce

```bash
wp plugin install woocommerce --activate
```

Or via WordPress Admin: **Plugins → Add New**

### 2. Run Setup Wizard

Follow WooCommerce setup wizard for:
- Store details
- Payment methods
- Shipping options
- Tax settings

### 3. Theme Support

Already configured in `inc/woocommerce.php`:
- Product gallery zoom
- Product gallery lightbox
- Product gallery slider
- 3 products per row

---

## Homepage Implementation

### Hero Section

Add **Custom HTML block**:

```html
<div class="hero-section">
    <h1>Welkom bij Zuidakker</h1>
    <p>Ontdek Zuidakker door onze vijf hoofdgebieden.</p>
</div>
```

### Pillar Cards Grid

Add **Shortcode block**:

```
[pillars_grid]
```

### Features

- 5 cards horizontal (desktop)
- Stacks vertically (mobile)
- Rounded corners
- Hover effects
- Icon circles
- Bilingual subtitles

**Styling:** Automatic via `style.css`

---

## Testing

### Install Dependencies

```bash
npm install
npx playwright install chromium
```

### Run Tests

```bash
# All tests
npm test

# Interactive mode
npm run test:ui

# Specific tests
npx playwright test pillar-pages
npx playwright test homepage
npx playwright test language-switcher
```

### Test Coverage

- ✅ Pillar pages (colors, layout, content)
- ✅ Homepage (pillar cards, grid)
- ✅ Language switcher (NL|EN)
- ✅ Custom post types
- ✅ Mobile responsiveness

**See:** `docs/TESTING.md` for complete guide.

---

## Deployment Checklist

### Pre-Deployment

- [ ] All pages created and translated
- [ ] Polylang configured (NL/EN)
- [ ] WooCommerce setup complete
- [ ] Products added
- [ ] Tests passing (`npm test`)
- [ ] Images optimized
- [ ] SSL certificate ready

### Production Setup

- [ ] Update `wp-config.php` (database, salts)
- [ ] Set correct site URL
- [ ] Configure email (SMTP)
- [ ] Setup backups
- [ ] Enable caching
- [ ] Security hardening

**See:** `docs/DEPLOYMENT_CHECKLIST.md` for complete list.

---

## Troubleshooting

### Pillar Colors Not Showing

1. Check body class: `page-{slug}`
2. Clear cache: `Ctrl + Shift + R`
3. Verify CSS variables in `style.css`

### Language Switcher Not Working

1. Configure languages in Polylang
2. Flush permalinks
3. Check browser console for errors

### Tests Failing

1. Ensure Docker is running
2. Site accessible at http://localhost:8080
3. Run `npm install` again
4. Check `test-results/` for details

### 404 Errors

1. Go to **Settings → Permalinks**
2. Click **Save Changes**
3. Flush cache

---

## File Structure

```
zuidakker_2.0/
├── docker-compose.yml
├── wp-content/
│   ├── themes/
│   │   ├── kadence/          # Parent theme
│   │   └── zuidakker-child/  # Custom theme
│   ├── mu-plugins/
│   │   └── polylang-textdomain-fix.php
│   └── plugins/
│       ├── polylang/
│       └── woocommerce/
├── tests/
│   ├── helpers/
│   │   ├── test-data.js
│   │   └── page-helpers.js
│   └── e2e/
│       ├── pillar-pages.spec.js
│       ├── homepage.spec.js
│       ├── language-switcher.spec.js
│       └── custom-post-types.spec.js
└── docs/
    ├── REBUILD_GUIDE.md      # This file
    ├── POLYLANG.md
    ├── TESTING.md
    └── DEPLOYMENT_CHECKLIST.md
```

---

## Quick Commands

```bash
# Start environment
docker-compose up -d

# Stop environment
docker-compose down

# View logs
docker-compose logs -f wordpress

# Run tests
npm test

# Update snapshots
npm run update-snapshots

# Flush cache
docker compose exec wordpress wp cache flush --allow-root
```

---

## Additional Resources

- **Language Setup:** `docs/POLYLANG.md`
- **Testing Guide:** `docs/TESTING.md`
- **Deployment:** `docs/DEPLOYMENT_CHECKLIST.md`
- **Quick Reference:** `docs/QUICK_REFERENCE.md`
- **Pillar Styling:** `docs/PILLAR_PAGE_STYLING.md`

---

## Support

For issues or questions:
1. Check troubleshooting section above
2. Review relevant documentation
3. Check test results for errors
4. Verify Docker is running

---

**Last Updated:** October 12, 2024  
**Version:** 2.0  
**Status:** Production Ready
