# Product Requirements Document (PRD)

## 1. Project Overview
This project involves a **WordPress**-based community platform that integrates the following functionalities:
- Informative pages (gardens, history, meeting, food education, accommodation, and a calendar)
- A **Booking System** for various community resources (e.g., boat berths, small allotments, meeting rooms, overnight accommodation)
- An **E-commerce System** for selling seasonal vegetables and vegetable boxes.

The goal is to provide a seamless user experience for both community members and administrators, supporting both free and professional booking tiers.

---

## 2. Objectives
- Create a **centralized platform** for community activities and resources.
- Enable users to easily **reserve and pay** for community assets.
- Facilitate the sale of seasonal produce and curated vegetable boxes.
- Ensure scalability, security, and ease of management.

---

## 3. Target Audiences
- **Community Members:** Individuals who wish to book slots or purchase products.
- **Administrators (Admins):** Manage content, bookings, and e-commerce.
- **Booking Managers:** Manage the bookable objects and reservations.
- **Shop Managers:** Oversee inventory and sales.

---

## 4. Core Functionalities

### 4.1 Content Pages
- **Homepage:** Overview, featured blog posts, quick links.
- **History Page:** Background and milestones.
- **Meeting Page:** Describes the different options (such as meeting room, allotment garden) available for rent at Zuidakker.
- **Activities Page:** List and categorize events.
- **Food Education Page:** Educational page about locally grown food, in own garden/allotment and greenhouse.
- **Accommodation Page:** Page about short-stay possibilities such as caravan, small boat berth, and facilities.
- **Calendar Page:** Calendar view with iCal/Google Calendar (if applicable) to show availability to page visitors.
- **Blog/News:** Latest news and upcoming events.
- **Sitemap:** Quick overview of the website's public pages.

### 4.2 Booking System (Integrated with WooCommerce)
- **Bookable Objects:** Boat berths, small allotments, meeting rooms, accommodation.
- **Attributes:** Name, surface area ($m^2$), location, availability calendar.
- **Free & Professional Tiers:** Limited/free and paid/premium options.
- **User Authentication:** Email registration, verification, login.
- **Booking Workflow:** Object selection $\rightarrow$ Date/period selection $\rightarrow$ Confirmation $\rightarrow$ **Payment via WooCommerce (if Professional Tier)** $\rightarrow$ Email notification.
- **Admin Functions:** Add/edit/delete bookable objects (as WooCommerce Products), manage availability, set pricing tiers, view reports.
- **Enhancements:** Waitlist, cancellation/refund policy, recurring reservations (optional).

### 4.3 E-commerce System
- **Products:** Individual vegetables, seasonal boxes (small, medium, large).
- **Features:** Seasonal product management, subscription options, dynamic pricing, discounts, customer dashboard.
- **Checkout:** Shopping cart, payment gateways, confirmation emails.
- **Inventory:** Stock management, seasonal updates.

---

## 5. Additional Professional Features
- **Responsive Design & WCAG Compliance** (Accessibility).
- **Multilingual Support** (default Dutch, possibility for English).
- **SEO Optimization** (structured data, breadcrumbs, canonical URLs).
- **Newsletter & Marketing Integration** (Mailchimp/Brevo).
- **Social Media Integration**.
- **Analytics** (Google Analytics/Matomo).
- **Regular Backups** (UpdraftPlus).
- **Caching & Performance Optimization** (WP Rocket/LiteSpeed Cache).
- **Staging Environment** for testing.
- **Contact Forms and FAQ**.

---

## 6. User Roles & Permissions
- **Administrator:** Full control (content, bookings, products).
- **Editor:** Manage content and blog posts.
- **Booking Manager:** Manage bookable objects/reservations.
- **Shop Manager:** Manage inventory, sales, and promotions.
- **Customer/User:** Book slots, purchase products.

---

## 7. Technology Stack
- **Platform:** WordPress (latest version).
- **Plugins:**
  - **WooCommerce** (e-commerce).
  - **WooCommerce Subscriptions** (for recurring boxes).
  - **WooCommerce Bookings or specialized booking plugin** (for object reservations, with a strong preference for an existing solution that integrates with WooCommerce for payments).
  - **Kadence Blocks or Spectra** (Gutenberg Block Library for advanced content layouts).
  - Yoast SEO.
  - WPForms or Gravity Forms.
  - FullCalendar (for calendar/availability).
  - UpdraftPlus (backups).
- **Theme:** Lightweight, block-based theme (e.g., Astra, GeneratePress, Kadence).

---

## 8. User Flows

### Booking Flow
1. User signs up with email $\rightarrow$ verification.
2. Selects bookable object.
3. Chooses period/date.
4. Confirms reservation.
5. **Is directed to WooCommerce Checkout (if paid).**
6. Payment completed.
7. Confirmation email sent.

### Shopping Flow
1. User browses vegetables/boxes.
2. Adds items to cart.
3. Proceeds to checkout (WooCommerce).
4. Payment processed.
5. Order confirmation email sent.

---

## 9. Compliance & Security
- **GDPR/AVG Compliance** (cookie consent, data export/deletion requests).
- **SSL/TLS**.