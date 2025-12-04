# De Zuidakker - WordPress Community Platform

Modern, performance-optimized WordPress website for zuidakker.nl featuring a 5-pillar design system with greenhouse photo backgrounds and consistent styling across all pages.

**Version:** 1.0.10 (Performance Optimized)  
**Performance:** 28% faster load times, 15% fewer HTTP requests

## 🚀 Quick Start

```bash
# Start the Docker environment
docker-compose up -d

# Access the site
# WordPress: http://localhost:8080
# Admin: http://localhost:8080/wp-admin (admin/admin)
# phpMyAdmin: http://localhost:8081
```

## 📚 Documentation

### Theme Documentation
- **[Theme README](./wp-content/themes/zuidakker-child/README.md)** - Complete theme documentation
- **[Performance Optimizations](./wp-content/themes/zuidakker-child/PERFORMANCE_OPTIMIZATIONS.md)** - Performance improvements
- **[Images README](./wp-content/themes/zuidakker-child/assets/images/README.md)** - Image assets guide

### Project Documentation
All additional documentation is in the **[docs/](./docs/)** folder:

- **[Refactoring Summary](./REFACTORING_SUMMARY.md)** - Latest performance improvements
- **[Setup Guide](./docs/SETUP_GUIDE.md)** - Installation instructions
- **[Quick Reference](./docs/QUICK_REFERENCE.md)** - Common commands
- **[Deployment Checklist](./docs/DEPLOYMENT_CHECKLIST.md)** - Production deployment

👉 **See [docs/README.md](./docs/README.md) for complete documentation index**

## 🎨 5 Pillar Design

The website features 5 main areas, each with unique colors:

- 🌱 **Gardens** (Green) - `/tuinen`
- 🏛️ **History** (Brown) - `/geschiedenis`
- 🌊 **Meeting** (Blue) - `/ontmoeting`
- 🎓 **Food Education** (Orange) - `/educatie`
- 🏠 **Accommodation** (Pink) - `/verblijf`

## 🌍 Languages

- **Default**: Dutch (NL)
- **Secondary**: English (EN)
- **Plugin**: Polylang

## 🛠️ Tech Stack

- WordPress (latest)
- Kadence Theme + Custom Child Theme
- Docker Compose
- MySQL 8.0
- PHP 8.3
- WooCommerce
- Polylang

## 📁 Project Structure

```
zuidakker_2.0/
├── docs/                      # Project documentation
├── docker-compose.yml         # Docker configuration
├── wp-content/
│   ├── themes/
│   │   └── zuidakker-child/  # Custom child theme (see theme README)
│   ├── plugins/              # WordPress plugins
│   └── uploads/              # Media uploads
└── README.md                 # This file
```

### Theme Structure
See [Theme README](./wp-content/themes/zuidakker-child/README.md) for detailed theme documentation.

## 🔧 Development

See [docs/SETUP_GUIDE.md](./docs/SETUP_GUIDE.md) for detailed development setup instructions.

## 📝 License

Custom project for Zuidakker community platform.

---

For detailed documentation, visit the **[docs/](./docs/)** folder.
