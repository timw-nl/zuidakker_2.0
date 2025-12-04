# Zuidakker Documentation

Complete documentation for the Zuidakker WordPress community platform.

---

## 🚀 Quick Start

```bash
# Start environment
docker-compose up -d

# Access
# Site: http://localhost:8080
# Admin: http://localhost:8080/wp-admin (admin/admin)
# phpMyAdmin: http://localhost:8081
```

---

## 📚 Documentation Structure

### Theme Documentation (Primary)
**[Theme README](../wp-content/themes/zuidakker-child/README.md)** - Complete theme documentation
- Design system (colors, typography, spacing)
- Page types (homepage, pillar pages, sitemap, contact, agenda)
- Theme structure and files
- Features (responsive design, pillar cards, navigation)
- Customization guide
- Development notes

**[Images README](../wp-content/themes/zuidakker-child/assets/images/README.md)** - Image assets
- Current assets (logo, greenhouse photo)
- Usage in theme
- Image requirements
- Adding new images

### Project Documentation (This Folder)

**[Setup Guide](./SETUP_GUIDE.md)** - Development environment setup
- Docker configuration
- WordPress installation
- Theme activation
- Plugin installation

**[Quick Reference](./QUICK_REFERENCE.md)** - Common commands and tasks
- Docker commands
- WordPress CLI
- Troubleshooting

**[Deployment Checklist](./DEPLOYMENT_CHECKLIST.md)** - Production deployment
- Pre-deployment tasks
- Security hardening
- Performance optimization
- Backup strategy

### Additional Documentation

**[Theme (Legacy)](./THEME.md)** - Original theme documentation
- Theme structure overview
- Custom post types
- Shortcodes

**[Pillar Page Styling](./PILLAR_PAGE_STYLING.md)** - Color scheme reference
- Color definitions
- CSS variables
- Body classes

---

## 🎨 Platform Overview

**Zuidakker** is a WordPress community platform featuring:

### 5 Pillar Design

| Pillar | Color | URL |
|--------|-------|-----|
| 🌱 Tuinen (Gardens) | Green `#97bf85` | `/tuinen` |
| 🏛️ Geschiedenis (History) | Brown `#c27d55` | `/geschiedenis` |
| 🌊 Ontmoeting (Meeting) | Blue `#6ba7b6` | `/ontmoeting` |
| 🎓 Educatie (Education) | Orange `#f0a85f` | `/educatie` |
| 🏠 Verblijf (Accommodation) | Pink `#d98c8c` | `/verblijf` |

### Key Features

- ✅ **Greenhouse Photo Backgrounds** - Full-page backgrounds on all pages
- ✅ **5-Pillar Design System** - Consistent color-coded sections
- ✅ **Multilingual** - Dutch (default) and English
- ✅ **WooCommerce** - E-commerce integration
- ✅ **Custom Post Types** - Geschiedenis & Activiteiten
- ✅ **Responsive Design** - Mobile-first approach
- ✅ **Modular Code** - KISS principles applied

---

## 🏗️ Architecture

### Theme Structure

See [Theme README](../wp-content/themes/zuidakker-child/README.md) for complete theme documentation.

```
zuidakker-child/
├── functions.php          # Main loader
├── style.css              # Styles with CSS variables
├── front-page.php         # Homepage template
├── page-contact.php       # Contact page template
├── assets/
│   ├── images/           # Logo and greenhouse photo
│   └── logo/             # Logo variations
└── inc/                   # Modular functions
    ├── theme-config.php       # Core configuration
    ├── pillar-pages.php       # Pillar functionality
    ├── custom-post-types.php  # CPT registration
    ├── woocommerce.php        # WooCommerce support
    ├── footer-customization.php # Header sitemap link
    ├── sitemap-shortcode.php  # Sitemap grid
    └── contact-form.php       # Contact form
```

---

## 🔧 Technical Stack

- **CMS:** WordPress (latest)
- **Theme:** Kadence + Custom Child Theme
- **Languages:** Polylang plugin
- **E-commerce:** WooCommerce
- **Development:** Docker Compose
- **Testing:** Playwright
- **Database:** MySQL 8.0
- **PHP:** 8.3

---

## 🎯 Common Tasks

### Customizing the Theme

See [Theme README](../wp-content/themes/zuidakker-child/README.md) for:
- Changing pillar icons
- Updating colors
- Replacing background image
- Customizing footer text

### Development Setup

1. Start Docker: `docker-compose up -d`
2. Access site: http://localhost:8080
3. Login: admin/admin
4. See [Setup Guide](./SETUP_GUIDE.md) for details

### Deployment

1. Review [Deployment Checklist](./DEPLOYMENT_CHECKLIST.md)
2. Update configuration
3. Deploy files
4. Flush cache

---

## 🔍 Finding Information

**Understanding the theme design?**
→ [Theme README](../wp-content/themes/zuidakker-child/README.md) - Complete theme documentation

**Setting up development environment?**
→ [Setup Guide](./SETUP_GUIDE.md)

**Deploying to production?**
→ [Deployment Checklist](./DEPLOYMENT_CHECKLIST.md)

**Quick command reference?**
→ [Quick Reference](./QUICK_REFERENCE.md)

**Understanding pillar colors?**
→ [Pillar Styling](./PILLAR_PAGE_STYLING.md)

---

## 🆘 Support

**Common Issues:**
- Background photo not showing → Check file path in style.css
- Pillar colors not showing → Check body classes
- Sitemap link not in header → Check inc/footer-customization.php
- 404 errors → Flush permalinks (Settings → Permalinks → Save)
- Permission errors → Run `sudo chmod -R 755` on theme folder

---

**Last Updated:** December 3, 2025  
**Version:** 1.0.9  
**Platform:** De Zuidakker Community Platform
