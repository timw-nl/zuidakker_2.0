# Theme Images

This folder contains theme-specific images like logos and icons.

## Structure

- `logo.png` - Main logo (recommended: 300x100px)
- `logo-white.png` - White version for dark backgrounds
- `favicon.ico` - Site favicon (32x32px)
- `hero-bg.jpg` - Hero section background (optional)

## Usage in Theme

Access these images in your theme files:
```php
$logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.png';
```

## Content Images

For content images (photos, gallery images), use the WordPress Media Library instead:
- WordPress Admin → Media → Add New
- Stored in: `/wp-content/uploads/YYYY/MM/`
