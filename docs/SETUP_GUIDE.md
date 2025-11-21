# Zuidakker WordPress Setup Guide

Complete handleiding voor het opzetten van de Zuidakker WordPress website met alle vereiste functionaliteiten.

## 📋 Inhoudsopgave

1. [Vereisten](#vereisten)
2. [Snelstart](#snelstart)
3. [Gedetailleerde Setup](#gedetailleerde-setup)
4. [Premium Plugins Installatie](#premium-plugins-installatie)
5. [Homepage Configuratie](#homepage-configuratie)
6. [WooCommerce Configuratie](#woocommerce-configuratie)
7. [Reserveringssysteem Setup](#reserveringssysteem-setup)
8. [Troubleshooting](#troubleshooting)

---

## Vereisten

- Docker & Docker Compose geïnstalleerd
- Minimaal 4GB vrije schijfruimte
- Internetverbinding voor plugin downloads

### Premium Plugins (Optioneel maar Aanbevolen)

De volgende plugins zijn premium en moeten handmatig worden geïnstalleerd:
- **WooCommerce Bookings** - Voor reserveringssysteem
- **WooCommerce Subscriptions** - Voor terugkerende groenteboxen

---

## Snelstart

### Stap 1: Start de Docker Omgeving

```bash
cd /media/tim/ZUIDAKKER/projects/zuidakker_2.0
docker-compose up -d
```

Wacht ongeveer 30 seconden tot alle containers actief zijn.

### Stap 2: WordPress Installatie

1. Open browser: **http://localhost:8080**
2. Selecteer taal: **Nederlands**
3. Vul in:
   - **Site titel**: Zuidakker
   - **Gebruikersnaam**: admin_tim (of eigen keuze)
   - **Wachtwoord**: admin_tim_20@%
   - **E-mail**: ---
4. Klik op **WordPress installeren**

### Stap 3: Automatische Setup Uitvoeren

Maak het setup script uitvoerbaar en voer het uit:

```bash
chmod +x setup-wordpress.sh
./setup-wordpress.sh
```

Dit script installeert automatisch:
- ✅ Kadence theme (parent)
- ✅ Zuidakker child theme (geactiveerd)
- ✅ WooCommerce
- ✅ Kadence Blocks
- ✅ Yoast SEO
- ✅ WPForms Lite
- ✅ UpdraftPlus
- ✅ GDPR Cookie Consent
- ✅ Simple Calendar
- ✅ Alle vereiste pagina's

### Stap 4: Login WordPress Admin

Ga naar **http://localhost:8080/wp-admin** en log in met je credentials.

---

## Gedetailleerde Setup

### Toegangspunten

| Service | URL | Credentials |
|---------|-----|-------------|
| WordPress Frontend | http://localhost:8080 | - |
| WordPress Admin | http://localhost:8080/wp-admin | Jouw admin account |
| phpMyAdmin | http://localhost:8081 | User: zuidakker, Pass: zuidakker |

### Container Beheer

**Containers starten:**
```bash
docker-compose up -d
```

**Containers stoppen:**
```bash
docker-compose down
```

**Logs bekijken:**
```bash
docker-compose logs -f wordpress
```

**WP-CLI commando's uitvoeren:**
```bash
docker compose exec wpcli wp plugin list
docker compose exec wpcli wp theme list
```

---

## Premium Plugins Installatie

### WooCommerce Bookings

1. Download de plugin van je WooCommerce.com account
2. Ga naar **Plugins** > **Nieuwe plugin** in WordPress admin
3. Klik op **Plugin uploaden**
4. Upload het `.zip` bestand
5. Klik op **Nu activeren**

### WooCommerce Subscriptions

1. Download de plugin van je WooCommerce.com account
2. Upload via **Plugins** > **Nieuwe plugin** > **Plugin uploaden**
3. Activeer de plugin

---

## Homepage Configuratie

### De 5-Pijler Homepage Maken

1. Ga naar **Pagina's** > **Alle pagina's**
2. Bewerk de **Homepage** (of maak een nieuwe aan)
3. Kopieer de inhoud uit `setup/homepage-template.html`
4. Plak in de Code Editor (⋮ menu > Code editor)
5. Of gebruik de shortcode: `[pillars_grid]`

### Homepage Instellen

1. Ga naar **Instellingen** > **Lezen**
2. Selecteer **Een statische pagina**
3. Kies je Homepage pagina
4. Opslaan

### Pillar Kleuren Verificatie

Elke pijler heeft zijn eigen kleurenschema (gedefinieerd in child theme):

- 🌱 **Tuinen**: Groen (#97bf85)
- 📜 **Geschiedenis**: Bruin (#c27d55)
- 🤝 **Ontmoeting**: Blauw (#6ba7b6)
- 🎓 **Educatie**: Oranje (#f0a85f)
- 🏕️ **Verblijf**: Roze (#d98c8c)

---

## WooCommerce Configuratie

### Basis Configuratie

1. Voltooi de **WooCommerce Setup Wizard**:
   - **Winkelinformatie**: Vul adres van Zuidakker in
   - **Branche**: Voedsel & dranken
   - **Producttypen**: Fysieke producten
   - **Bedrijfsdetails**: Aantal producten, verkoop al actief
   
2. **Betaalmethoden instellen**:
   - Ga naar **WooCommerce** > **Instellingen** > **Betalingen**
   - Activeer gewenste methoden (bijv. iDEAL, Bankoverschrijving)
   
3. **Verzending configureren**:
   - **WooCommerce** > **Instellingen** > **Verzending**
   - Stel verzending op of gebruik "Ophalen op locatie"

### Producten Aanmaken

#### Groente Product (Voorbeeld)

1. **Producten** > **Nieuwe product**
2. **Productnaam**: Tomaten (500g)
3. **Prijs**: €3,50
4. **Producttype**: Eenvoudig product
5. **Voorraad**: Beheer voorraad, Hoeveelheid: 50
6. **Productafbeelding**: Upload foto
7. **Publiceren**

#### Groentebox (Abonnement)

1. **Producten** > **Nieuwe product**
2. **Productnaam**: Wekelijkse Groentebox - Middel
3. **Producttype**: Eenvoudig abonnement
4. **Abonnementsprijs**: €15,00 / week
5. **Aanmeldkosten**: €0 (optioneel)
6. **Afmeldingsperiode**: Minimaal 1 week
7. **Publiceren**

---

## Reserveringssysteem Setup

### Met WooCommerce Bookings

1. **WooCommerce** > **Instellingen** > **Producten** > **Bookable products**
2. **Maak Reserveerbaar Product**:
   - **Producten** > **Nieuwe product**
   - **Producttype**: Reserveerbaar product
   
#### Voorbeeld: Bootligplaats Reservering

```
Productnaam: Bootligplaats - Dag Reservering
Producttype: Reserveerbaar product
Basis prijs: €25,00 per dag

Reserveringsinstellingen:
- Reserveringsduur: 1 dag (kan meerdere dagen)
- Kalenderduur: Dagen
- Minimum reservering: 1 dag
- Maximum reservering: 14 dagen
- Beschikbaarheid: Maandag t/m Zondag
- Max bookings per blok: 5 (5 ligplaatsen)

Beschikbaarheid:
- Range: Van nu tot 1 jaar vooruit
```

#### Gratis Tier (Community Leden)

Voor gratis reserveringen:
1. Maak product met prijs €0,00
2. Of gebruik kortingscodes van 100% voor community leden
3. **Marketing** > **Kortingen** > **Nieuwe korting**
   - Code: COMMUNITY_GRATIS
   - Kortingstype: Percentage korting
   - Kortingswaarde: 100
   - Beperk tot producten: Selecteer community tier producten

### Reserveerbare Middelen

Maak de volgende producten aan:

1. **Bootligplaats** (per dag/week)
2. **Moestuin Plot** (per maand/seizoen)
3. **Vergaderruimte** (per uur)
4. **Caravan Plaatsing** (per nacht)

---

## Custom Post Types

Het Zuidakker child theme voegt twee custom post types toe:

### Geschiedenis Items

1. **Geschiedenis Items** > **Nieuwe geschiedenis item**
2. Voeg historische mijlpalen toe
3. Gebruik featured image voor tijdlijnvisualisatie

### Activiteiten

1. **Activiteiten** > **Nieuwe activiteit**
2. Gebruik categorieën voor type activiteit
3. Perfect voor wateractiviteiten, workshops, etc.

---

## Kalender & Agenda

### Simple Calendar Configureren

1. **Calendars** in het WordPress menu
2. Maak een nieuwe kalender
3. Koppel aan Google Calendar (optioneel)
4. Voeg toe aan de Agenda pagina met shortcode

---

## Testen & Verificatie

### Checklist

- [ ] Homepage toont 5 pijlers met correcte kleuren
- [ ] Alle pagina's zijn toegankelijk
- [ ] WooCommerce winkel werkt
- [ ] Producten kunnen worden toegevoegd aan winkelwagen
- [ ] Checkout proces werkt
- [ ] Reserveringssysteem werkt (indien bookings geïnstalleerd)
- [ ] Forms werken (test contactformulier)
- [ ] Responsive design werkt op mobiel
- [ ] Custom post types werken

### Test Reservering

1. Ga naar een reserveerbaar product
2. Selecteer datum
3. Voeg toe aan winkelwagen
4. Ga naar checkout
5. Voltooi test bestelling

### Test E-commerce

1. Voeg groente/box toe aan winkelwagen
2. Ga naar checkout
3. Vul testgegevens in
4. Voltooi bestelling (gebruik test betaalmethode)

---

## Beveiliging & Onderhoud

### SSL Configuratie (Productie)

Voor productie omgeving:
1. Verkrijg SSL certificaat (Let's Encrypt)
2. Update `docker-compose.yml` voor HTTPS
3. Update WordPress URL's via WP-CLI:
   ```bash
   docker compose exec wpcli wp search-replace 'http://localhost:8080' 'https://zuidakker.nl'
   ```

### Back-ups

UpdraftPlus is geïnstalleerd:
1. **Instellingen** > **UpdraftPlus Backups**
2. Configureer back-up schema (dagelijks aanbevolen)
3. Koppel aan cloud storage (Google Drive, Dropbox)

### GDPR Compliance

Cookie Law Info is geïnstalleerd:
1. **Cookie Law Info** in het menu
2. Configureer cookie banner
3. Stel cookie categorieën in
4. Activeer voor frontend

---

## Troubleshooting

### WordPress kan niet verbinden met database

```bash
# Check of containers draaien
docker-compose ps

# Herstart containers
docker-compose restart
```

### Child theme verschijnt niet

```bash
# Controleer of bestanden bestaan
ls -la wp-content/themes/zuidakker-child/

# Heractiveer theme via WP-CLI
docker compose exec wpcli wp theme activate zuidakker-child
```

### Plugins installeren mislukt

```bash
# Handmatig installeren via WP-CLI
docker compose exec wpcli wp plugin install plugin-naam --activate
```

### Upload limiet te laag

Het `uploads.ini` bestand is al geconfigureerd voor 64MB uploads.
Als je dit wilt verhogen:

1. Bewerk `uploads.ini`
2. Herstart WordPress container:
   ```bash
   docker-compose restart wordpress
   ```

### Permissie problemen

```bash
# Fix ownership van wp-content
sudo chown -R www-data:www-data wp-content/
```

---

## Handige WP-CLI Commando's

```bash
# Plugin lijst
docker compose exec wpcli wp plugin list

# Theme lijst
docker compose exec wpcli wp theme list

# Pagina's lijst
docker compose exec wpcli wp post list --post_type=page

# Cache legen
docker compose exec wpcli wp cache flush

# Database backup
docker compose exec wpcli wp db export /var/www/setup/backup.sql

# Update alle plugins
docker compose exec wpcli wp plugin update --all

# WordPress versie checken
docker compose exec wpcli wp core version
```

---

## Volgende Stappen

1. ✅ **Content toevoegen** aan alle 5 pijler pagina's
2. ✅ **Producten uploaden** (groenten en boxen)
3. ✅ **Reserveerbare middelen** configureren
4. ✅ **Betalingsgateways** testen met test credentials
5. ✅ **Logo en branding** toevoegen via Customizer
6. ✅ **Menu's maken** (Hoofdmenu, Footer menu)
7. ✅ **Blog posts** schrijven voor nieuwssectie
8. ✅ **SEO optimaliseren** met Yoast
9. ✅ **Social media** koppelen
10. ✅ **Analytics** instellen (Google Analytics/Matomo)

---

## Support & Documentatie

- **WordPress Codex**: https://codex.wordpress.org/
- **WooCommerce Docs**: https://woocommerce.com/documentation/
- **Kadence Theme**: https://www.kadencewp.com/documentation/
- **Kadence Blocks**: https://www.kadencewp.com/kadence-blocks/

---

## Licenties & Credits

- **WordPress**: GPL v2+
- **Kadence Theme**: GPL v2+
- **WooCommerce**: GPL v3+
- **Zuidakker Child Theme**: GPL v2+

---

**Versie**: 1.0.0  
**Laatst bijgewerkt**: 2025-10-07  
**Auteur**: Zuidakker Development Team
