# Theme Images

This folder contains theme-specific images used throughout the Zuidakker child theme.

## Current Assets

### Primary Images
- **`logo.png`** - Main De Zuidakker logo (1611x1413px)
  - Used in site header and branding
  - Displays on all pages
  - Uploaded to WordPress Media Library

- **`zuidakker-greenhouse.jpg`** - Greenhouse background photo
  - Full-page background for all pages
  - Fixed attachment (parallax effect)
  - Used on: Homepage, Pillar pages, Sitemap, Contact, Agenda

### Logo Variations (in `/assets/logo/`)
Multiple logo variations are available in the parent `logo` folder:
- `De Zuidakker_Beeldmerk #6F9355.png` - Green icon (used as favicon)
- `De Zuidakker_Beeldmerk #97BF85.png` - Light green icon
- `De Zuidakker_Cirkel #6F9355.png` - Circular green logo
- `De Zuidakker_Cirkel #97BF85.png` - Circular light green logo
- `De Zuidakker_Kas.png` - Greenhouse icon
- `De Zuidakker_Logo Liggend.png` - Horizontal logo
- `De Zuidakker_ Logo Staand.png` - Vertical logo

## Usage in Theme

### Background Image
The greenhouse photo is referenced in `style.css`:
```css
background-image: url('assets/images/zuidakker-greenhouse.jpg');
```

### Favicon
Set programmatically in `inc/theme-config.php`:
```php
$favicon_url = get_stylesheet_directory_uri() . '/assets/logo/De Zuidakker_Beeldmerk #6F9355.png';
```

### Logo in PHP
Access images in theme files:
```php
$logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.png';
```

## Image Requirements

### Background Images
- **Format:** JPG (for photos)
- **Size:** 1920x1080px minimum (Full HD)
- **Optimization:** Compress for web (< 500KB recommended)
- **Usage:** Full-page backgrounds with `background-size: cover`

### Logos
- **Format:** PNG with transparency
- **Main Logo:** 1611x1413px (current size)
- **Favicon:** 256x256px minimum (browser will resize)
- **Optimization:** Use PNG-8 or PNG-24 as needed

## Adding New Images

1. **For theme assets:** Place in this folder
2. **For content images:** Use WordPress Media Library
   - WordPress Admin → Media → Add New
   - Stored in: `/wp-content/uploads/YYYY/MM/`

## Notes

- All background images use `background-attachment: fixed` for parallax effect
- Images are lazy-loaded where supported
- Favicon is set via PHP (not hardcoded in HTML)
- Logo is managed through WordPress Customizer (Appearance → Customize → Site Identity)
