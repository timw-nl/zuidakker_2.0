# Zuidakker 2.0 - WordPress Community Platform

A WordPress website for zuidakker.nl with a 5-pillar design and specific functionalities for community management, bookings, and e-commerce.

## 🚀 Quick Start

```bash
# Start the Docker environment
docker-compose up -d

# Access the site
# WordPress: http://localhost:8080
# Admin: http://localhost:8080/wp-admin
# phpMyAdmin: http://localhost:8081
```

## 📚 Documentation

All documentation is located in the **[docs/](./docs/)** folder:

- **[Setup Guide](./docs/SETUP_GUIDE.md)** - Complete installation instructions
- **[Quick Reference](./docs/QUICK_REFERENCE.md)** - Common commands and tasks
- **[Pillar Page Styling](./docs/PILLAR_PAGE_STYLING.md)** - Design and color schemes
- **[Language Setup](./docs/LANGUAGE_SETUP.md)** - Multilingual configuration
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
├── docs/                      # All documentation
├── docker-compose.yml         # Docker configuration
├── wp-content/               # WordPress content
│   └── themes/
│       └── zuidakker-child/  # Custom theme
├── setup/                    # Setup scripts and templates
└── README.md                 # This file
```

## 🔧 Development

See [docs/SETUP_GUIDE.md](./docs/SETUP_GUIDE.md) for detailed development setup instructions.

## 📝 License

Custom project for Zuidakker community platform.

---

For detailed documentation, visit the **[docs/](./docs/)** folder.
