# Zuidakker - Quick Reference

## 🚀 Snelle Commando's

### Docker

```bash
# Start alles
docker-compose up -d

# Stop alles
docker-compose down

# Bekijk logs
docker-compose logs -f wordpress

# Herstart services
docker-compose restart
```

### Setup

```bash
# Run automatische setup
./setup-wordpress.sh

# Maak setup script uitvoerbaar (eenmalig)
chmod +x setup-wordpress.sh
```

### WP-CLI

```bash
# Basis formaat
docker compose exec wpcli wp [commando]

# Voorbeelden:
docker compose exec wpcli wp plugin list
docker compose exec wpcli wp theme list
docker compose exec wpcli wp post list --post_type=page
docker compose exec wpcli wp user list
```

## 🔗 Toegangspunten

| Service | URL | Credentials |
|---------|-----|-------------|
| WordPress | http://localhost:8080 | - |
| Admin | http://localhost:8080/wp-admin | admin / [jouw wachtwoord] |
| phpMyAdmin | http://localhost:8081 | zuidakker / zuidakker |

## 📁 Belangrijke Bestanden

```
zuidakker_2.0/
├── docker-compose.yml           # Container configuratie
├── setup-wordpress.sh           # Automatische setup script
├── uploads.ini                  # PHP upload instellingen
├── wp-content/
│   ├── themes/
│   │   └── zuidakker-child/    # Custom child theme
│   │       ├── style.css       # Styling + 5 pijler kleuren
│   │       ├── functions.php   # Theme functies
│   │       └── README.md       # Theme documentatie
│   └── plugins/                 # Geïnstalleerde plugins
└── setup/
    └── homepage-template.html   # Homepage template
```

## 🎨 Pijler Kleuren

```css
Tuinen:       #97bf85 / #6f9357  (Groen)
Geschiedenis: #c27d55 / #b4412f  (Bruin)
Ontmoeting:   #6ba7b6 / #2a677e  (Blauw)
Educatie:     #f0a85f / #d97225  (Oranje)
Verblijf:     #d98c8c / #b35a5a  (Roze)
Sitemap:      #2c5530 / #4a7c59  (Donkergroen)
```

## 📦 Geïnstalleerde Plugins (via script)

- ✅ WooCommerce
- ✅ Kadence Blocks
- ✅ Yoast SEO
- ✅ WPForms Lite
- ✅ UpdraftPlus
- ✅ GDPR Cookie Consent (Cookie Law Info)
- ✅ Simple Calendar

## 💰 Premium Plugins (handmatige installatie)

- ⚠️ WooCommerce Bookings
- ⚠️ WooCommerce Subscriptions

## 📄 Aangemaakte Pagina's

1. Tuinen bij de Zuidakker (`/tuinen`)
2. Geschiedenis van Zuidakker (`/geschiedenis`)
3. Ontmoeting aan de oever (`/ontmoeting`)
4. Voedseleducatie (`/educatie`)
5. Verblijf bij de Zuidakker (`/verblijf`)
6. Sitemap (`/sitemap`)
7. Agenda (`/agenda`)
8. WooCommerce pagina's (winkel, checkout, etc.)

## 🔧 Custom Features

### Shortcodes

```
[pillars_grid]    # 5-pijler grid op homepage
```

### Custom Post Types

- **Geschiedenis Items** - Voor historische content
- **Activiteiten** - Voor community activiteiten

### Body Classes

Automatische page-specific classes:
- `.page-tuinen`
- `.page-geschiedenis`
- `.page-ontmoeting`
- `.page-educatie`
- `.page-verblijf`

## 🐛 Troubleshooting

### Database connectie fout
```bash
docker-compose restart db wordpress
```

### Theme zichtbaar maken
```bash
docker compose exec wpcli wp theme list
docker compose exec wpcli wp theme activate zuidakker-child
```

### Plugins handmatig installeren
```bash
docker compose exec wpcli wp plugin install plugin-naam --activate
```

### Permissies fixen
```bash
sudo chown -R www-data:www-data wp-content/
```

### Cache legen
```bash
docker compose exec wpcli wp cache flush
docker compose exec wpcli wp rewrite flush
```

## 💾 Backup & Restore

### Database backup
```bash
docker compose exec wpcli wp db export /var/www/setup/backup-$(date +%Y%m%d).sql
```

### Database restore
```bash
docker compose exec wpcli wp db import /var/www/setup/backup.sql
```

### Bestanden backup
```bash
tar -czf backup-files-$(date +%Y%m%d).tar.gz wp-content/uploads/
```

## 📊 Database Direct Access

```bash
# MySQL CLI
docker exec -it zuidakker_mysql_2.0 mysql -uzuidakker -pzuidakker zuidakker
```

## 🔍 Debugging

### WordPress Debug Mode
Bewerk `docker-compose.yml`:
```yaml
environment:
  WORDPRESS_DEBUG: 'true'
```

### Bekijk error logs
```bash
docker-compose logs wordpress | grep -i error
```

## 🌐 Productie Deployment

### Search-Replace URLs
```bash
docker compose exec wpcli wp search-replace 'http://localhost:8080' 'https://zuidakker.nl' --dry-run
# Als OK, zonder --dry-run uitvoeren
```

### Permalinks flushen
```bash
docker compose exec wpcli wp rewrite flush --hard
```

---

**Pro Tip**: Voeg deze commando's toe aan je shell aliases voor sneller werken!

```bash
# Voeg toe aan ~/.bashrc of ~/.zshrc
alias wp='docker compose exec wpcli wp'
alias dcup='docker-compose up -d'
alias dcdown='docker-compose down'
alias dclogs='docker-compose logs -f'
```
