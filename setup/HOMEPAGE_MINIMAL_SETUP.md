# Minimal Homepage Setup - Complete

## What Was Changed

### 1. Removed Sidebar
- **File:** `wp-content/themes/zuidakker-child/front-page.php`
- **Change:** Removed `get_sidebar()` call to eliminate sidebar from homepage

### 2. Updated Homepage Content
- **Page ID:** 27 (your homepage)
- **Content:** Now shows ONLY:
  - Hero section with welcome text
  - Pillars grid (5 colorful cards)
  - Header (automatic)
  - Footer (automatic)

### 3. Removed Extra Sections
The following were removed from the homepage:
- ❌ Latest News section
- ❌ Winkel/Reserveren/Agenda buttons
- ❌ Sidebar widgets
- ❌ Any other extra content

## Current Homepage Structure

```
┌─────────────────────────────────┐
│         HEADER (Kadence)        │
├─────────────────────────────────┤
│       Hero Section              │
│   "Welkom bij Zuidakker"        │
├─────────────────────────────────┤
│       Pillars Grid              │
│  🌱 🏛️ 🌊 🎓 🏠                  │
│  (5 colorful cards)             │
├─────────────────────────────────┤
│         FOOTER (Kadence)        │
└─────────────────────────────────┘
```

## View Your Homepage

Visit: **http://localhost:8080**

## If You Need to Edit Content

### Via WordPress Admin:
1. Go to: http://localhost:8080/wp-admin
2. Pages → Edit "Home" (ID: 27)
3. Edit the hero text or add/remove content
4. Update

### Via WP-CLI:
```bash
# View current content
docker compose exec wpcli wp post get 27 --field=post_content

# Edit content
docker compose exec wpcli wp post edit 27
```

## Restore Full Template (if needed)

If you want to add back the news/buttons sections:
```bash
# Copy content from the full template
cat setup/homepage-template.html

# Then update via WordPress Admin or WP-CLI
```

## Files Modified
- ✅ `wp-content/themes/zuidakker-child/front-page.php` - Removed sidebar
- ✅ Homepage content (Page ID 27) - Simplified to hero + pillars only
- ✅ Created `setup/homepage-template-minimal.html` - Clean template for reference
