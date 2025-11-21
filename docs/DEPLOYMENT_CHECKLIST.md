# Zuidakker WordPress - Deployment Checklist

## 📋 Pre-Deployment Checklist

### 1. Lokale Ontwikkeling

- [ ] Docker containers starten: `make up`
- [ ] WordPress installatie wizard voltooid
- [ ] Automatische setup uitgevoerd: `make setup`
- [ ] Zuidakker child theme actief
- [ ] Alle gratis plugins geïnstalleerd en geactiveerd
- [ ] Homepage met 5-pijler grid aangemaakt
- [ ] Alle 7 vereiste pagina's aangemaakt
- [ ] Custom post types (Geschiedenis, Activiteiten) werken

### 2. Premium Plugins

- [ ] WooCommerce Bookings licentie verkregen
- [ ] WooCommerce Subscriptions licentie verkregen
- [ ] WooCommerce Bookings geïnstalleerd en geactiveerd
- [ ] WooCommerce Subscriptions geïnstalleerd en geactiveerd
- [ ] Licentie keys ingevoerd en gevalideerd

### 3. WooCommerce Configuratie

- [ ] WooCommerce setup wizard voltooid
- [ ] Winkelinformatie ingevuld (adres, contact)
- [ ] BTW instellingen geconfigureerd
- [ ] Verzendmethoden ingesteld
- [ ] Betalingsgateways geconfigureerd (iDEAL, etc.)
- [ ] Email templates aangepast met Zuidakker branding
- [ ] Test bestelling succesvol afgerond

### 4. Reserveringssysteem

- [ ] Bootligplaats product aangemaakt (reserveerbaar)
- [ ] Moestuin plot product aangemaakt
- [ ] Vergaderruimte product aangemaakt
- [ ] Verblijf/caravan product aangemaakt
- [ ] Gratis tier geconfigureerd (€0 of kortingscodes)
- [ ] Professional tier geconfigureerd (betaald)
- [ ] Beschikbaarheidskalender ingesteld
- [ ] Test reservering succesvol afgerond

### 5. E-commerce Producten

- [ ] Minimaal 5 groente producten aangemaakt
- [ ] Groentebox Klein aangemaakt
- [ ] Groentebox Middel aangemaakt
- [ ] Groentebox Groot aangemaakt
- [ ] Abonnementen geconfigureerd voor boxen
- [ ] Productafbeeldingen geüpload (hoge kwaliteit)
- [ ] Voorraad instellingen geconfigureerd
- [ ] Prijzen en BTW correct ingesteld

### 6. Content & Pagina's

- [ ] Homepage volledig ingevuld met content
- [ ] Tuinen pagina: content + afbeeldingen
- [ ] Geschiedenis pagina: content + tijdlijn items
- [ ] Ontmoeting pagina: content + reserveringslinks
- [ ] Educatie pagina: content + programma info
- [ ] Verblijf pagina: content + accommodatie details
- [ ] Agenda pagina: kalender geïntegreerd
- [ ] Blog: minimaal 3 posts gepubliceerd
- [ ] Footer content ingevuld
- [ ] Contact pagina met werkend formulier

### 7. Menu's & Navigatie

- [ ] Hoofdmenu aangemaakt en toegewezen
- [ ] Footer menu aangemaakt
- [ ] Alle pagina's in menu's opgenomen
- [ ] WooCommerce pagina's in menu
- [ ] Menu responsive getest
- [ ] Breadcrumbs werken

### 8. Branding & Design

- [ ] Logo geüpload (header)
- [ ] Favicon toegevoegd
- [ ] Kleuren gecontroleerd op alle pagina's
- [ ] Typografie consistent
- [ ] Responsive design getest (mobile, tablet, desktop)
- [ ] 5-pijler kleuren correct weergegeven
- [ ] Hover effecten werken
- [ ] Afbeeldingen geoptimaliseerd

### 9. SEO Optimalisatie

- [ ] Yoast SEO basis instellingen geconfigureerd
- [ ] Homepage meta title & description
- [ ] Alle pagina's meta descriptions
- [ ] Focus keywords ingesteld
- [ ] XML sitemap gegenereerd
- [ ] Google Search Console verbonden
- [ ] Robots.txt geconfigureerd
- [ ] Schema.org markup actief
- [ ] Open Graph tags werkend
- [ ] Permalinks structuur: `/%postname%/`

### 10. Performance

- [ ] Caching plugin geïnstalleerd (LiteSpeed Cache)
- [ ] Browser caching ingeschakeld
- [ ] Afbeelding compressie actief (Imagify/ShortPixel)
- [ ] CSS/JS minificatie
- [ ] Database geoptimaliseerd
- [ ] Lazy loading voor afbeeldingen
- [ ] CDN overwogen/geconfigureerd
- [ ] PageSpeed score > 80

### 11. Beveiliging

- [ ] Alle wachtwoorden veranderd (sterk)
- [ ] Admin username NIET "admin"
- [ ] Wordfence of iThemes Security geïnstalleerd
- [ ] Limit Login Attempts actief
- [ ] SSL certificaat geïnstalleerd
- [ ] HTTPS afdwingen
- [ ] WordPress & plugins up-to-date
- [ ] Database prefix veranderd (niet wp_)
- [ ] File editing uitgeschakeld in wp-config
- [ ] Beveiligingsheaders ingesteld

### 12. GDPR & Privacy

- [ ] Privacy Policy pagina aangemaakt
- [ ] Cookie consent banner actief (Cookie Law Info)
- [ ] Cookie categorieën geconfigureerd
- [ ] Google Analytics privacy-vriendelijk
- [ ] WooCommerce privacy instellingen
- [ ] Data export/verwijdering werkend
- [ ] Terms & Conditions pagina
- [ ] AVG-compliant formulieren

### 13. Email & Communicatie

- [ ] SMTP plugin geconfigureerd (WP Mail SMTP)
- [ ] Test email verzonden en ontvangen
- [ ] WooCommerce email templates getest
- [ ] Reservering confirmatie emails werkend
- [ ] Contactformulier test succesvol
- [ ] Nieuwsbrief signup werkend
- [ ] Email branding consistent

### 14. Backups & Onderhoud

- [ ] UpdraftPlus geconfigureerd
- [ ] Cloud storage verbonden (Google Drive/Dropbox)
- [ ] Backup schema ingesteld (dagelijks)
- [ ] Handmatige backup gemaakt en getest
- [ ] Restore procedure getest
- [ ] Monitoring ingesteld
- [ ] Uptime monitoring (UptimeRobot)

### 15. Analytics & Tracking

- [ ] Google Analytics geïnstalleerd
- [ ] Google Tag Manager (optioneel)
- [ ] E-commerce tracking actief
- [ ] Goals/conversies ingesteld
- [ ] WooCommerce analytics werkend
- [ ] Privacy-vriendelijk tracking

### 16. Testing

#### Functionaliteit
- [ ] Homepage laadt correct
- [ ] Alle pagina's toegankelijk
- [ ] Zoekfunctie werkt
- [ ] Formulieren verzenden
- [ ] Winkelwagen functionaliteit
- [ ] Checkout proces compleet
- [ ] Reserveringen kunnen worden gemaakt
- [ ] Account registratie werkt
- [ ] Wachtwoord reset werkt

#### Cross-browser
- [ ] Chrome
- [ ] Firefox
- [ ] Safari
- [ ] Edge
- [ ] Mobile browsers (iOS Safari, Chrome Mobile)

#### Responsive
- [ ] iPhone (375px)
- [ ] iPad (768px)
- [ ] Laptop (1366px)
- [ ] Desktop (1920px)
- [ ] Landscape & portrait modes

#### Performance
- [ ] Laadtijd < 3 seconden
- [ ] Time to Interactive < 5 seconden
- [ ] Core Web Vitals groen
- [ ] Lighthouse score > 80

### 17. Migratie naar Productie

- [ ] Database backup gemaakt
- [ ] Files backup gemaakt
- [ ] DNS instellingen voorbereid
- [ ] Productie database aangemaakt
- [ ] WordPress geïnstalleerd op productie
- [ ] Database geïmporteerd
- [ ] Files geüpload
- [ ] URL's vervangen (search-replace)
- [ ] Permalinks geflushed
- [ ] Cache geleegd
- [ ] Test op productie domein

### 18. Post-Launch

- [ ] Google Search Console sitemap submitted
- [ ] Social media geüpdatet met nieuwe URL
- [ ] Newsletter verzonden (indien van toepassing)
- [ ] 301 redirects van oude site (indien applicable)
- [ ] Broken links gecontroleerd
- [ ] 404 pagina gecustomized
- [ ] Maintenance mode uitgeschakeld
- [ ] Caching volledige ingeschakeld
- [ ] Final performance test
- [ ] Final security scan

### 19. Documentatie

- [ ] Admin login credentials gedocumenteerd (veilig opgeslagen)
- [ ] Plugin licenties gedocumenteerd
- [ ] Hosting details gedocumenteerd
- [ ] DNS settings gedocumenteerd
- [ ] Email settings gedocumenteerd
- [ ] Backup locaties gedocumenteerd
- [ ] Handoff documentatie voor beheerders

### 20. Training & Support

- [ ] Beheerders training gegeven
- [ ] Winkel managers training gegeven
- [ ] Content editors training gegeven
- [ ] Documentatie aan team gedeeld
- [ ] Support kanaal ingesteld
- [ ] Maintenance contract (indien applicable)

---

## 🚨 Critical Items (Blocker voor Launch)

Deze items zijn **absoluut vereist** voor productie:

1. ✅ SSL certificaat actief en werkend
2. ✅ Betalingsgateways geconfigureerd en getest
3. ✅ WooCommerce Bookings werkend (voor reserveringen)
4. ✅ Backup systeem actief
5. ✅ GDPR compliance (Cookie consent, Privacy Policy)
6. ✅ Alle security hardening compleet
7. ✅ Test bestellingen succesvol afgerond
8. ✅ Email verzending werkend

---

## 🎯 Launch Day Checklist

**30 minuten voor launch:**
- [ ] Final database backup
- [ ] Final files backup
- [ ] Cache legen
- [ ] Smoke test: homepage, winkel, checkout
- [ ] Monitor logs voor errors

**Op launch moment:**
- [ ] DNS switch uitvoeren
- [ ] SSL verificatie
- [ ] Eerste productie test
- [ ] Monitoring activeren

**Direct na launch:**
- [ ] Bevestig site bereikbaar op nieuwe URL
- [ ] Test checkout flow
- [ ] Test reservering flow
- [ ] Controleer email verzending
- [ ] Monitor server resources
- [ ] Check Google Analytics tracking

**Eerste 24 uur:**
- [ ] Monitor error logs
- [ ] Check performance metrics
- [ ] Beantwoord support vragen
- [ ] Fix critical bugs indien nodig

---

## 📞 Emergency Contacts

**Hosting Support:**
- Provider: _________________
- Telefoon: _________________
- Email: ____________________

**Developer:**
- Naam: ____________________
- Telefoon: _________________
- Email: ____________________

**Domain Registrar:**
- Provider: _________________
- Login: ____________________

---

## 🔄 Post-Launch Maintenance

**Wekelijks:**
- [ ] Check for plugin updates
- [ ] Review backup status
- [ ] Check security logs
- [ ] Monitor site performance

**Maandelijks:**
- [ ] Update plugins (staging first)
- [ ] Update WordPress core (staging first)
- [ ] Review analytics
- [ ] Test backups restore
- [ ] Security scan

**Per Kwartaal:**
- [ ] Full site audit
- [ ] Performance optimization
- [ ] SEO review
- [ ] Content refresh
- [ ] User feedback review

---

**Checklist Versie**: 1.0.0  
**Laatst bijgewerkt**: 2025-10-07  
**Project**: Zuidakker WordPress Platform v2.0
