# Zuidakker WordPress - Plugin List

Complete overzicht van alle benodigde plugins voor het Zuidakker platform.

## 🔌 Core Plugins (Gratis - Auto Geïnstalleerd)

### E-commerce & Reserveringen

| Plugin | Versie | Doel | Status |
|--------|--------|------|--------|
| **WooCommerce** | Latest | E-commerce platform voor groenten en reserveringen | ✅ Auto |
| **Kadence Blocks** | Latest | Geavanceerde Gutenberg blocks voor layouts | ✅ Auto |

### SEO & Marketing

| Plugin | Versie | Doel | Status |
|--------|--------|------|--------|
| **Yoast SEO** | Latest | SEO optimalisatie | ✅ Auto |
| **Cookie Law Info** | Latest | GDPR cookie consent | ✅ Auto |

### Formulieren & Communicatie

| Plugin | Versie | Doel | Status |
|--------|--------|------|--------|
| **WPForms Lite** | Latest | Contactformulieren | ✅ Auto |

### Kalender & Planning

| Plugin | Versie | Doel | Status |
|--------|--------|------|--------|
| **Simple Calendar** | Latest | Google Calendar integratie | ✅ Auto |

### Onderhoud & Beveiliging

| Plugin | Versie | Doel | Status |
|--------|--------|------|--------|
| **UpdraftPlus** | Latest | Backup & restore | ✅ Auto |

---

## 💎 Premium Plugins (Handmatige Installatie Vereist)

### WooCommerce Extensions

| Plugin | Prijs | Doel | Prioriteit | Installatie |
|--------|-------|------|-----------|-------------|
| **WooCommerce Bookings** | ~€249/jaar | Reserveringssysteem voor ligplaatsen, moestuinen, kamers | 🔴 Hoog | Handmatig |
| **WooCommerce Subscriptions** | ~€199/jaar | Terugkerende groenteboxen abonnementen | 🔴 Hoog | Handmatig |

**Licentie Info**: Deze plugins vereisen een actieve WooCommerce.com licentie.

**Download Locatie**: https://woocommerce.com/my-account/downloads/

**Installatie Stappen**:
1. Log in op WooCommerce.com
2. Download plugin `.zip` bestand
3. WordPress Admin → Plugins → Nieuwe plugin → Plugin uploaden
4. Klik "Nu activeren"
5. Voer licentie key in via WooCommerce → Instellingen → Abonnementen/Bookings

---

## 🎯 Aanbevolen Aanvullende Plugins

### Performance & Optimalisatie

| Plugin | Type | Doel | Installatie |
|--------|------|------|-------------|
| **WP Rocket** of **LiteSpeed Cache** | Gratis/Premium | Caching & snelheidsoptimalisatie | Optioneel |
| **Imagify** of **ShortPixel** | Freemium | Afbeelding compressie | Optioneel |
| **WP-Optimize** | Gratis | Database optimalisatie | Optioneel |

**WP-CLI Installatie**:
```bash
# LiteSpeed Cache (gratis)
make install-plugin name=litespeed-cache

# WP-Optimize
make install-plugin name=wp-optimize
```

### Beveiliging

| Plugin | Type | Doel | Installatie |
|--------|------|------|-------------|
| **Wordfence Security** | Freemium | Firewall & malware scanner | Optioneel |
| **iThemes Security** | Freemium | Beveiligingshardening | Optioneel |
| **Limit Login Attempts Reloaded** | Gratis | Brute force bescherming | Aanbevolen |

**WP-CLI Installatie**:
```bash
make install-plugin name=limit-login-attempts-reloaded
```

### Marketing & Nieuwsbrief

| Plugin | Type | Doel | Installatie |
|--------|------|------|-------------|
| **Mailchimp for WooCommerce** | Gratis | E-mail marketing integratie | Optioneel |
| **Newsletter** | Gratis | Interne nieuwsbrief systeem | Optioneel |
| **Social Snap** | Premium | Social media delen & analytics | Optioneel |

**WP-CLI Installatie**:
```bash
make install-plugin name=mailchimp-for-woocommerce
```

### Multilingual (Voor Engels)

| Plugin | Type | Doel | Installatie |
|--------|------|------|-------------|
| **WPML** | Premium €99+ | Professionele meertaligheid | Optioneel |
| **Polylang** | Freemium | Gratis meertaligheid | Optioneel |

### WooCommerce Uitbreidingen

| Plugin | Type | Doel | Installatie |
|--------|------|------|-------------|
| **WooCommerce PDF Invoices** | Gratis | Automatische facturen | Aanbevolen |
| **YITH WooCommerce Wishlist** | Freemium | Verlanglijst functie | Optioneel |
| **WooCommerce Product Enquiry** | Gratis | Product vragen formulier | Optioneel |

**WP-CLI Installatie**:
```bash
make install-plugin name=woocommerce-pdf-invoices-packing-slips
```

---

## 🚫 Niet Aanbevolen Plugins

### Vermijd Deze

| Plugin | Reden |
|--------|-------|
| **Jetpack** | Te zwaar, veel onnodige features |
| **All-in-One SEO** | Conflicteert met Yoast SEO |
| **Page Builders** (Elementor, Divi Builder) | Kadence Blocks is voldoende |
| **Revolution Slider** | Te zwaar, gebruik native Gutenberg blocks |

---

## 📦 Plugin Categorieën Overzicht

```
Core Functionaliteit:
├── WooCommerce (E-commerce)
├── WooCommerce Bookings (Reserveringen) [Premium]
├── WooCommerce Subscriptions (Abonnementen) [Premium]
└── Kadence Blocks (Page Builder)

Content & SEO:
├── Yoast SEO
├── Simple Calendar
└── WPForms Lite

Beveiliging & Onderhoud:
├── UpdraftPlus
├── Cookie Law Info (GDPR)
└── [Optioneel: Wordfence]

Performance:
└── [Optioneel: LiteSpeed Cache]

Marketing:
└── [Optioneel: Mailchimp Integration]
```

---

## 🔄 Update Strategie

### Automatische Updates

**Aan te zetten voor**:
- Minor WordPress core updates
- Minor plugin updates (veiligheid)

**WP-CLI Configuratie**:
```bash
# Check updates
docker compose exec wpcli wp plugin list --update=available

# Update specifieke plugin
docker compose exec wpcli wp plugin update woocommerce

# Update alle plugins (voorzichtig in productie!)
docker compose exec wpcli wp plugin update --all --dry-run
```

### Update Schema

| Frequentie | Actie | Methode |
|------------|-------|---------|
| **Wekelijks** | Check voor veiligheid updates | WP Admin dashboard |
| **Maandelijks** | Update alle plugins in staging | `make update-plugins` |
| **Per kwartaal** | Major version updates | Handmatig met backup |

---

## 📊 Plugin Prioriteiten

### Must-Have (Kritisch)
1. ✅ WooCommerce
2. ✅ WooCommerce Bookings
3. ✅ WooCommerce Subscriptions
4. ✅ Kadence Blocks
5. ✅ UpdraftPlus

### Should-Have (Belangrijk)
6. ✅ Yoast SEO
7. ✅ WPForms Lite
8. ✅ Cookie Law Info
9. ⭕ LiteSpeed Cache
10. ⭕ Limit Login Attempts

### Nice-to-Have (Optioneel)
11. ⭕ Mailchimp Integration
12. ⭕ PDF Invoices
13. ⭕ Wordfence Security
14. ⭕ Polylang (als meertalig nodig is)

**Legenda**:
- ✅ = Geïnstalleerd/vereist
- ⭕ = Optioneel

---

## 💡 Plugin Management Tips

### Best Practices

1. **Minimaliseer plugins**: Gebruik alleen wat echt nodig is
2. **Regelmatige updates**: Check wekelijks voor veiligheid
3. **Test eerst in staging**: Nooit direct in productie updaten
4. **Maak backups**: Voor elke grote update
5. **Monitor performance**: Check laadtijden na plugin installatie
6. **Verwijder ongebruikte plugins**: Niet alleen deactiveren

### Performance Check

```bash
# Check welke plugins actief zijn
docker compose exec wpcli wp plugin list --status=active

# Deactiveer plugin (test impact)
docker compose exec wpcli wp plugin deactivate plugin-naam

# Verwijder plugin
docker compose exec wpcli wp plugin delete plugin-naam
```

---

## 🛠️ Troubleshooting

### Plugin Conflicten

**Symptoom**: White screen, errors, of crash  
**Oplossing**:
```bash
# Deactiveer alle plugins
docker compose exec wpcli wp plugin deactivate --all

# Activeer één voor één
docker compose exec wpcli wp plugin activate plugin-naam
```

### Database Errors

**Symptoom**: Database errors na plugin update  
**Oplossing**:
```bash
# Herstel vanaf backup
make restore
```

### Licentie Problemen (Premium)

**Symptoom**: "License expired" waarschuwingen  
**Oplossing**:
1. Check licentie status op WooCommerce.com
2. Hernieuw indien verlopen
3. Voer nieuwe key in via plugin settings

---

**Laatst bijgewerkt**: 2025-10-07  
**Versie**: 1.0.0
