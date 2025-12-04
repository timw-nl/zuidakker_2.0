# Zuidakker Child Theme Documentation

## Overview
Custom WordPress child theme for De Zuidakker community platform, built on the Kadence theme. Features a modern 5-pillar design system with greenhouse photo backgrounds and consistent styling across all pages.

**Version:** 1.1.0  
**Parent Theme:** Kadence  
**Language:** Dutch (nl_NL)

---

## Table of Contents
1. [Design System](#design-system)
2. [Page Types](#page-types)
3. [Theme Structure](#theme-structure)
4. [Features](#features)
5. [Customization](#customization)
6. [Development Notes](#development-notes)

---

## Design System

### Color Palette
The theme uses a 5-pillar color scheme representing different aspects of Zuidakker:

#### Tuinen (Gardens) - Green
- Primary: `#97bf85`
- Secondary: `#6f9357`
- Light: `#b8d9a8`
- Dark: `#4a6b3d`

#### Geschiedenis (History) - Brown
- Primary: `#c27d55`
- Secondary: `#b4412f`
- Light: `#d9a68a`
- Dark: `#8a3020`

#### Ontmoeting (Meeting) - Blue
- Primary: `#6ba7b6`
- Secondary: `#2a677e`
- Light: `#9cc8d4`
- Dark: `#1a4d5e`

#### Voedseleducatie (Food Education) - Orange
- Primary: `#f0a85f`
- Secondary: `#d97225`
- Light: `#ffc88f`
- Dark: `#b85510`

#### Verblijf (Accommodation) - Pink/Rose
- Primary: `#d98c8c`
- Secondary: `#b35a5a`
- Light: `#f0b3b3`
- Dark: `#8a3a3a`

#### Sitemap - Dark Green
- Primary: `#2c5530`
- Secondary: `#4a7c59`
- Light: `#5a9668`
- Dark: `#1a3320`

#### Header Green
- Default: `#3d5e41`
- Dark: `#2c4730`

### Background Image
All pages use the greenhouse photo (`assets/images/zuidakker-greenhouse.jpg`) as a full-page background with:
- Fixed attachment (parallax effect)
- Cover sizing
- Center positioning
- Color overlays specific to each pillar (30% opacity)

### Typography
- **Font smoothing:** Antialiased for better readability
- **Hyphenation:** Automatic Dutch hyphenation enabled
- **Word breaking:** Smart word-wrap for long Dutch words
- **Responsive sizing:** Uses `clamp()` for fluid typography

### Spacing Scale
```css
--space-xs: 0.25rem
--space-sm: 0.5rem
--space-md: 1rem
--space-lg: 1.5rem
--space-xl: 2rem
--space-2xl: 3rem
--space-3xl: 4rem
```

### Border Radius
```css
--radius-sm: 0.375rem
--radius-md: 0.5rem
--radius-lg: 0.75rem
--radius-xl: 1rem
--radius-2xl: 1.5rem
--radius-full: 9999px
```

### Shadows
```css
--shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08), 0 1px 2px rgba(0, 0, 0, 0.06)
--shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07), 0 2px 4px rgba(0, 0, 0, 0.06)
--shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1), 0 6px 12px rgba(0, 0, 0, 0.08)
--shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.12), 0 10px 20px rgba(0, 0, 0, 0.1)
```

---

## Page Types

### Homepage
- **Background:** Greenhouse photo with no color overlay
- **Header:** Semi-transparent green (85% opacity)
- **Hero Text:** Dark overlay boxes with backdrop blur
- **Pillar Cards:** 5 cards in responsive grid with gradient backgrounds
- **Features:**
  - Fade-in animations
  - Scroll indicator
  - Hover effects on cards
  - 50% opacity cards that become 100% on hover

### Pillar Pages (Tuinen, Geschiedenis, Ontmoeting, Educatie, Verblijf)
- **Background:** Greenhouse photo with pillar-specific color overlay (30% opacity)
- **Header:** Semi-transparent with pillar color (85% opacity)
- **Content:** Darker semi-transparent boxes (90% opacity) with rounded corners
- **Entry Header:** Transparent to show photo
- **Consistent Design:** All pillar pages share the same structure

### Sitemap Page
- **Background:** Greenhouse photo (same as homepage)
- **Header:** Semi-transparent dark green
- **Content:** Transparent to show pillar cards
- **Purpose:** Overview of all 5 pillars with navigation cards

### Contact Page
- **Background:** Greenhouse photo
- **Header:** Semi-transparent green
- **Content:** White cards with contact information
- **Features:**
  - Contact info grid
  - Contact form section
  - Hover effects on cards

### Agenda Page (page-id-12)
- **Background:** Greenhouse photo
- **Header:** Semi-transparent green
- **Content:** Transparent background
- **Purpose:** Event calendar and availability overview

---

## Theme Structure

```
zuidakker-child/
├── assets/
│   ├── images/
│   │   ├── logo.png
│   │   └── zuidakker-greenhouse.jpg
│   └── logo/
│       ├── De Zuidakker_Beeldmerk #6F9355.png (favicon)
│       └── [other logo variations]
├── inc/
│   ├── theme-config.php          # Core theme configuration
│   ├── pillar-pages.php          # Pillar page functionality
│   ├── custom-post-types.php     # Custom post types
│   ├── woocommerce.php           # WooCommerce integration
│   ├── footer-customization.php  # Header sitemap link (renamed from footer)
│   ├── sitemap-shortcode.php     # Sitemap grid shortcode
│   └── contact-form.php          # Contact form handling
├── front-page.php                # Homepage template
├── page-contact.php              # Contact page template
├── style.css                     # Main stylesheet
├── functions.php                 # Theme functions loader
└── README.md                     # This file
```

---

## Features

### 1. Responsive Design
- Mobile-first approach
- Breakpoints:
  - Desktop: 1024px+
  - Tablet: 768px - 1023px
  - Mobile: < 768px
- Flexible grid layouts
- Responsive typography with `clamp()`

### 2. Pillar Card System
- **5 Pillars:** Tuinen, Geschiedenis, Ontmoeting, Educatie, Verblijf
- **Icons:** Emoji-based (configurable in `inc/theme-config.php`)
- **Animations:** Staggered fade-in on load
- **Hover Effects:**
  - Scale and lift transform
  - Opacity change (50% → 100%)
  - Icon rotation
  - Shadow enhancement

### 3. Header Navigation
- **Sitemap Link:** Positioned in top-right of header
- **Styling:** Semi-transparent with backdrop blur
- **Responsive:** Stacks below logo on mobile
- **Language Switcher:** Vertical layout with active state

### 4. Footer Customization
- **Credits:** Custom "© 2025 De Zuidakker" text
- **Kadence Links:** Hidden via CSS and filters
- **Styling:** Centered text with proper spacing

### 5. Favicon
- **Image:** Green Zuidakker logo
- **Locations:** Browser tab, bookmarks, mobile home screen
- **Format:** PNG with Apple touch icon support

### 6. Accessibility
- **Focus Indicators:** Custom outline styles
- **Screen Reader Text:** Proper ARIA labels
- **Keyboard Navigation:** Full support
- **Color Contrast:** WCAG AA compliant
- **Reduced Motion:** Respects user preferences

### 7. Performance
- **Image Optimization:** Lazy loading support
- **CSS Variables:** Efficient styling
- **Minimal JavaScript:** Relies on CSS animations
- **Fixed Backgrounds:** Parallax effect without heavy scripts

### 8. Internationalization
- **Language:** Dutch (nl_NL)
- **Hyphenation:** Automatic Dutch word breaking
- **Text Domain:** zuidakker-child
- **HTML Lang:** Set to nl-NL for proper hyphenation

---

## Customization

### 🎨 Managing Site via WordPress Admin (Recommended)

The entire site design is now manageable from **wp-admin > Appearance > Customize > 🌿 Zuidakker Pijlers**

#### 🌱 Pillar Sections (5x)
For each pillar (Tuinen, Geschiedenis, Ontmoeting, Educatie, Verblijf):
- **Naam** - Display name
- **Ondertitel** - English subtitle
- **Icoon** - Emoji icon
- **Beschrijving** - Description text
- **Kleuren** - Primary, Secondary, Light, and Dark colors

#### ⚙️ Algemene Instellingen
- **Header kleuren** - Header color scheme
- **Sitemap kleuren** - Sitemap page colors
- **Footer tekst** - Copyright text at bottom of pages

#### 📱 Social Media
- **Facebook URL** - Leave empty to hide
- **Instagram URL** - Leave empty to hide
- **LinkedIn URL** - Leave empty to hide
- **YouTube URL** - Leave empty to hide

#### 📍 Contact & Kaart
- **Adres** - Address shown on contact page and map popup
- **Kaart Latitude** - Map marker latitude
- **Kaart Longitude** - Map marker longitude
- **Kaart Zoom niveau** - Map zoom level (1-18)

Changes are previewed live and saved to the database - no code editing required!

**Icon Resources:**
- [Emojipedia](https://emojipedia.org/)
- [Unicode Emoji List](https://unicode.org/emoji/charts/full-emoji-list.html)

### Changing Pillar Icons (Legacy - Code)
If you prefer editing code, modify `inc/theme-config.php`, function `zuidakker_get_pillars()`:

```php
'tuinen' => array(
    'icon' => '🌱',  // Change this emoji
    // ...
),
```

### Changing Colors (Legacy - Code)
Colors are now managed via Customizer, but CSS variables in `style.css` serve as fallbacks:

### Changing Background Image
Replace `assets/images/zuidakker-greenhouse.jpg` with your image, or update the URL in `style.css`:

```css
background-image: url('assets/images/your-image.jpg');
```

### Adding New Pages
1. Create page in WordPress admin
2. Add page-specific styles in `style.css`:

```css
body.page-yourpage {
    background-image: url('assets/images/zuidakker-greenhouse.jpg');
    /* ... */
}
```

### Customizing Footer Text
Edit `inc/theme-config.php`, function `zuidakker_custom_footer_credits()`:

```php
function zuidakker_custom_footer_credits() {
    return '© ' . date('Y') . ' Your Custom Text';
}
```

---

## Development Notes

### CSS Architecture
- **Variables First:** All colors, spacing, and effects use CSS variables
- **Mobile First:** Base styles for mobile, enhanced for larger screens
- **BEM-like Naming:** Clear, descriptive class names
- **Modular Sections:** Each section clearly commented

### PHP Best Practices
- **KISS Principle:** Keep It Simple, Stupid
- **Security:** All inputs escaped, outputs sanitized
- **Namespacing:** Uses Kadence namespace where appropriate
- **Hooks:** Proper use of WordPress actions and filters

### Browser Support
- **Modern Browsers:** Chrome, Firefox, Safari, Edge (latest 2 versions)
- **Fallbacks:** Graceful degradation for older browsers
- **Prefixes:** Vendor prefixes for CSS properties where needed

### Known Limitations
1. **Hyphenation:** Browser support varies; fallback to word-break
2. **Fixed Backgrounds:** May not work on iOS (falls back to scroll)
3. **Backdrop Blur:** Limited support in older browsers

### File Permissions
After deployment, ensure proper permissions:
```bash
sudo chown -R $USER:$USER /path/to/zuidakker-child/
sudo chmod -R 755 /path/to/zuidakker-child/
sudo find /path/to/zuidakker-child/ -type f -exec chmod 644 {} \;
```

### Testing Checklist
- [ ] All pillar pages display correctly
- [ ] Homepage pillar cards are clickable
- [ ] Sitemap link appears in header
- [ ] Background images load on all pages
- [ ] Contact form works
- [ ] Responsive design on mobile/tablet
- [ ] Favicon appears in browser
- [ ] Footer credits are correct
- [ ] Dutch hyphenation works

---

## Changelog

### Version 1.1.0 (Current)
- **NEW: 100% WordPress Admin manageable** (excluding Docker)
- **WordPress Customizer integration:**
  - 🌱 5 Pillar sections: names, icons, descriptions, colors
  - ⚙️ General settings: header colors, sitemap colors, footer text
  - 📱 Social Media: Facebook, Instagram, LinkedIn, YouTube URLs
  - 📍 Contact & Map: address, coordinates, zoom level
- Live preview of all changes
- Added `inc/customizer-pillars.php` for all Customizer settings
- Added `assets/js/customizer-preview.js` for live preview
- Dynamic CSS generation from Customizer settings
- Updated all theme files to read from Customizer

### Version 1.0.9
- Implemented greenhouse photo backgrounds across all pages
- Added semi-transparent headers with backdrop blur
- Created consistent pillar page design
- Moved sitemap link from footer to header
- Added favicon support
- Customized footer credits
- Improved text overflow handling with Dutch hyphenation
- Added rounded corners to content boxes
- Enhanced accessibility features

### Previous Versions
- Initial theme setup with 5-pillar color system
- Basic pillar card implementation
- WooCommerce integration
- Custom post types for history and activities

---

## Support & Resources

### WordPress Codex
- [Child Themes](https://developer.wordpress.org/themes/advanced-topics/child-themes/)
- [Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)

### Kadence Theme
- [Documentation](https://www.kadencewp.com/knowledge-base/)
- [Support Forum](https://wordpress.org/support/theme/kadence/)

### CSS Resources
- [CSS Variables](https://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties)
- [CSS Grid](https://css-tricks.com/snippets/css/complete-guide-grid/)
- [Clamp() Function](https://developer.mozilla.org/en-US/docs/Web/CSS/clamp)

---

## License
GNU General Public License v2 or later  
http://www.gnu.org/licenses/gpl-2.0.html

---

## Credits
- **Theme Development:** Zuidakker Team
- **Parent Theme:** Kadence by Kadence WP
- **Icons:** Unicode Emoji
- **Photography:** Zuidakker greenhouse photo

---

*Last Updated: December 3, 2025*
