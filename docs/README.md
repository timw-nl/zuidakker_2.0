# Zuidakker 2.0 Documentation

Complete documentation for rebuilding and maintaining the Zuidakker WordPress platform.

---

## 🚀 Quick Start

```bash
# Start environment
docker-compose up -d

# Access
# Site: http://localhost:8080
# Admin: http://localhost:8080/wp-admin
# phpMyAdmin: http://localhost:8081

# Run tests
npm install
npx playwright install chromium
npm test
```

---

## 📚 Documentation

### Essential Guides

**[Rebuild Guide](./REBUILD_GUIDE.md)** - Complete platform rebuild instructions
- Architecture overview
- Step-by-step setup
- Required pages
- Language configuration
- WooCommerce setup
- Testing

**[Setup Guide](./SETUP_GUIDE.md)** - Development environment setup
- Docker configuration
- WordPress installation
- Theme activation
- Plugin installation

**[Quick Reference](./QUICK_REFERENCE.md)** - Common commands and tasks
- Docker commands
- WordPress CLI
- Testing commands
- Troubleshooting

### Feature Documentation

**[Polylang](./POLYLANG.md)** - Multilingual setup (NL/EN)
- Language configuration
- URL structure
- Translation workflow
- Language switcher

**[Testing](./TESTING.md)** - Automated testing
- E2E tests
- Visual regression
- Running tests
- Writing new tests

**[Theme Documentation](./THEME.md)** - Zuidakker child theme
- Theme structure (KISS modular)
- 5-pillar color scheme
- Custom post types
- Shortcodes
- Customization guide

**[Pillar Page Styling](./PILLAR_PAGE_STYLING.md)** - Color scheme reference
- Color definitions
- CSS variables
- Body classes
- Responsive design

### Deployment

**[Deployment Checklist](./DEPLOYMENT_CHECKLIST.md)** - Production deployment
- Pre-deployment tasks
- Security hardening
- Performance optimization
- Backup strategy

### Project Planning

**[Improvements Needed](./IMPROVEMENTS_NEEDED.md)** - Gap analysis & roadmap
- Current status vs. PRD
- Missing features
- Priority roadmap (6 weeks)
- Implementation guide

**[Product Requirements](./zuidakker_en.md)** - Original PRD
- Project scope
- Feature requirements
- Technical specifications

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

- ✅ **Multilingual** - Dutch (default) and English
- ✅ **WooCommerce** - E-commerce integration
- ✅ **Custom Post Types** - Geschiedenis & Activiteiten
- ✅ **Responsive Design** - Mobile-first approach
- ✅ **Automated Testing** - E2E tests with Playwright
- ✅ **Modular Code** - KISS principles applied

---

## 🏗️ Architecture

### Theme Structure

```
zuidakker-child/
├── functions.php          # Main loader
├── style.css              # Pillar colors & styles
└── inc/                   # Modular functions
    ├── theme-config.php       # Configuration & pillars
    ├── pillar-pages.php       # Body classes & shortcode
    ├── custom-post-types.php  # CPT registration
    ├── woocommerce.php        # WooCommerce support
    └── language-switcher.php  # NL|EN switcher
```

### Test Structure

```
tests/
├── helpers/
│   ├── test-data.js      # Centralized test data
│   └── page-helpers.js   # Reusable functions
└── e2e/
    ├── pillar-pages.spec.js
    ├── homepage.spec.js
    ├── language-switcher.spec.js
    └── custom-post-types.spec.js
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

## 📖 Documentation Index

### By Role

**For Developers:**
- [Rebuild Guide](./REBUILD_GUIDE.md) - Complete rebuild instructions
- [Setup Guide](./SETUP_GUIDE.md) - Development environment
- [Testing](./TESTING.md) - Automated tests
- [Quick Reference](./QUICK_REFERENCE.md) - Commands

**For Content Managers:**
- [Polylang](./POLYLANG.md) - Language setup
- [Theme](./THEME.md) - Theme features & customization
- [Pillar Styling](./PILLAR_PAGE_STYLING.md) - Color scheme

**For Project Planning:**
- [Improvements Needed](./IMPROVEMENTS_NEEDED.md) - Gap analysis & roadmap

**For Deployment:**
- [Deployment Checklist](./DEPLOYMENT_CHECKLIST.md) - Production setup

### By Topic

**Setup & Configuration:**
- Rebuild Guide - Complete platform setup
- Setup Guide - Development environment
- Polylang - Language configuration

**Development:**
- Testing - Automated tests
- Pillar Styling - Color scheme
- Quick Reference - Commands

**Deployment:**
- Deployment Checklist - Production tasks

---

## 🎯 Common Tasks

### Create Homepage

1. Create page in WordPress
2. Add hero section (Custom HTML block)
3. Add pillar grid (Shortcode: `[pillars_grid]`)
4. Set as homepage (Settings → Reading)

### Add New Language

1. Go to Languages → Languages
2. Add language (NL or EN)
3. Configure URL structure
4. Flush permalinks

### Run Tests

```bash
npm test              # All tests
npm run test:ui       # Interactive mode
npm run test:pillar   # Pillar pages only
```

### Deploy to Production

1. Review [Deployment Checklist](./DEPLOYMENT_CHECKLIST.md)
2. Run tests (`npm test`)
3. Update configuration
4. Deploy files
5. Flush cache

---

## 🔍 Finding Information

**Need to rebuild the platform?**
→ [Rebuild Guide](./REBUILD_GUIDE.md)

**Setting up development environment?**
→ [Setup Guide](./SETUP_GUIDE.md)

**Configuring languages?**
→ [Polylang](./POLYLANG.md)

**Running tests?**
→ [Testing](./TESTING.md)

**Deploying to production?**
→ [Deployment Checklist](./DEPLOYMENT_CHECKLIST.md)

**Quick command reference?**
→ [Quick Reference](./QUICK_REFERENCE.md)

**Understanding the theme?**
→ [Theme Documentation](./THEME.md)

**Understanding pillar colors?**
→ [Pillar Styling](./PILLAR_PAGE_STYLING.md)

**What's missing from the platform?**
→ [Improvements Needed](./IMPROVEMENTS_NEEDED.md)

---

## 📝 Contributing

When updating documentation:

1. Keep files focused on one topic
2. Use clear headings and structure
3. Include code examples
4. Update this README if adding new docs
5. Follow existing formatting style

---

## 🆘 Support

**For issues:**
1. Check relevant documentation
2. Review troubleshooting sections
3. Check test results
4. Verify Docker is running

**Common Issues:**
- Pillar colors not showing → Check body classes
- Language switcher not working → Configure Polylang
- Tests failing → Check Docker & site accessibility
- 404 errors → Flush permalinks

---

**Last Updated:** October 12, 2024  
**Version:** 2.0  
**Platform:** Zuidakker Community Platform
