# Booking System - Quick Setup Guide

## Step-by-Step Setup

### 1. Initial Setup (5 minutes)

After the booking system is installed, follow these steps:

#### A. Verify Installation
1. Log into WordPress Admin
2. Look for **Bookings** in the left sidebar menu
3. You should see:
   - Bookable Resources
   - Reservations
   - Resource Types

#### B. Check WooCommerce
1. Ensure WooCommerce is installed and activated
2. Complete WooCommerce setup wizard if not done
3. Configure payment methods (Settings → Payments)

### 2. Create Your First Bookable Resource (10 minutes)

#### Example: Boat Berth

1. Go to **Bookings** → **Add New Resource**

2. **Basic Information:**
   - Title: `Boat Berth #1`
   - Description: Add details about the berth (size, amenities, etc.)
   - Featured Image: Upload a photo

3. **Resource Type:**
   - Select: `Boat Berth`

4. **Booking Details:**
   - Surface Area: `15` m²
   - Location: `North Dock, Position A1`
   - Capacity: Leave empty (not applicable)
   - Minimum Duration: `1` day
   - Maximum Duration: `30` days

5. **Pricing & Tiers:**
   - Tier: `Professional` (paid booking)
   - Price per Day: `25.00` €

6. Click **Publish**

✅ A WooCommerce product is automatically created!

#### Example: Meeting Room (Free Tier)

1. Go to **Bookings** → **Add New Resource**

2. **Basic Information:**
   - Title: `Community Meeting Room`
   - Description: Space for community meetings
   - Featured Image: Upload a photo

3. **Resource Type:**
   - Select: `Meeting Room`

4. **Booking Details:**
   - Surface Area: `40` m²
   - Location: `Main Building, Ground Floor`
   - Capacity: `20` people
   - Minimum Duration: `1` day
   - Maximum Duration: `7` days

5. **Pricing & Tiers:**
   - Tier: `Free` (no payment required)

6. Click **Publish**

### 3. Create Booking Pages (15 minutes)

#### A. Main Booking Page

1. Go to **Pages** → **Add New**
2. Title: `Reserveren` (or "Book Now")
3. Add content block and insert shortcode:

```
[booking_form]
```

4. Optional: Add introduction text above the form
5. **Publish** the page

#### B. Boat Berth Booking Page

1. Create new page: `Boot Ligplaats Reserveren`
2. Add shortcode:

```
[booking_form type="boat-berth"]
```

3. Add calendar below:

```
[booking_calendar type="boat-berth"]
```

4. **Publish**

#### C. My Bookings Page

1. Create new page: `Mijn Reserveringen`
2. Add shortcode:

```
[my_bookings]
```

3. **Publish**

#### D. Availability Calendar Page

1. Create new page: `Beschikbaarheid`
2. Add shortcode:

```
[booking_calendar]
```

3. **Publish**

### 4. Add to Navigation Menu

1. Go to **Appearance** → **Menus**
2. Add your new pages:
   - Reserveren
   - Beschikbaarheid
   - Mijn Reserveringen (for logged-in users)
3. Save menu

### 5. Test the System

#### Test Free Tier Booking:
1. Log in as a test user (or create one)
2. Go to your booking page
3. Select a free tier resource
4. Choose dates
5. Click "Check Availability"
6. Confirm booking
7. ✅ Should see confirmation message immediately

#### Test Professional Tier Booking:
1. Log in as a test user
2. Select a professional tier resource
3. Choose dates
4. Check availability
5. Confirm booking
6. ✅ Should redirect to WooCommerce checkout
7. Complete payment (use test mode)
8. ✅ Booking confirmed after payment

### 6. Configure Email Notifications

For better email delivery:

1. Install **WP Mail SMTP** plugin
2. Configure with your email provider
3. Test email sending

### 7. Set Up User Registration

Enable user registration:

1. Go to **Settings** → **General**
2. Check: "Anyone can register"
3. Default Role: `Subscriber`
4. Save changes

Or use a custom registration plugin for better control.

## Common Page Templates

### Landing Page for Bookings

```html
<h2>Reserveer Jouw Plek bij Zuidakker</h2>

<p>Welkom bij ons reserveringssysteem. Hier kun je verschillende faciliteiten boeken:</p>

<div class="booking-options">
  <div class="option">
    <h3>🚤 Boot Ligplaatsen</h3>
    <p>Reserveer een ligplaats voor je boot.</p>
    <a href="/boot-ligplaats-reserveren" class="button">Bekijk Beschikbaarheid</a>
  </div>
  
  <div class="option">
    <h3>🌱 Volkstuintjes</h3>
    <p>Huur een klein volkstuintje.</p>
    <a href="/volkstuintje-reserveren" class="button">Bekijk Beschikbaarheid</a>
  </div>
  
  <div class="option">
    <h3>🏛️ Vergaderruimte</h3>
    <p>Boek onze gemeenschapsruimte (gratis).</p>
    <a href="/vergaderruimte-reserveren" class="button">Bekijk Beschikbaarheid</a>
  </div>
  
  <div class="option">
    <h3>🏠 Overnachting</h3>
    <p>Verblijf bij Zuidakker.</p>
    <a href="/overnachting-reserveren" class="button">Bekijk Beschikbaarheid</a>
  </div>
</div>

<style>
.booking-options {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
  margin: 2rem 0;
}
.option {
  padding: 2rem;
  background: #f9f9f9;
  border-radius: 8px;
  text-align: center;
}
.option h3 {
  margin-top: 0;
}
.button {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  background: #0073aa;
  color: white;
  text-decoration: none;
  border-radius: 4px;
  margin-top: 1rem;
}
.button:hover {
  background: #005a87;
}
</style>
```

### Resource-Specific Page Template

```html
<h2>Boot Ligplaats Reserveren</h2>

<p>Reserveer een ligplaats voor je boot bij Zuidakker. Bekijk de beschikbaarheid en boek direct online.</p>

<h3>Beschikbaarheid</h3>
[booking_calendar type="boat-berth"]

<h3>Reserveer Nu</h3>
[booking_form type="boat-berth"]

<h3>Informatie</h3>
<ul>
  <li><strong>Prijs:</strong> €25 per dag</li>
  <li><strong>Minimum:</strong> 1 dag</li>
  <li><strong>Maximum:</strong> 30 dagen</li>
  <li><strong>Locatie:</strong> Noord Dok</li>
</ul>
```

## Shortcode Reference

### Booking Form
```
[booking_form]                          // All resources
[booking_form resource_id="123"]        // Specific resource
[booking_form type="boat-berth"]        // Specific type
```

### Calendar
```
[booking_calendar]                      // All resources
[booking_calendar resource_id="123"]    // Specific resource
[booking_calendar type="meeting-room"]  // Specific type
```

### User Dashboard
```
[my_bookings]                           // User's bookings
```

## Troubleshooting

### "Please log in to make a reservation"
- Users must be logged in to book
- Enable user registration in Settings → General
- Or add login/register links to your pages

### WooCommerce checkout not working
- Verify WooCommerce is active
- Check payment methods are configured
- Ensure resource is set to "Professional" tier

### Emails not sending
- Install WP Mail SMTP plugin
- Configure SMTP settings
- Test email functionality

### Calendar not displaying correctly
- Clear browser cache
- Check for JavaScript errors in console
- Verify shortcode is correct

### Double bookings occurring
- This shouldn't happen - the system prevents it
- Check that dates are being saved correctly
- Verify reservation status is "confirmed" or "pending"

## Next Steps

1. ✅ Create all your bookable resources
2. ✅ Set up booking pages for each resource type
3. ✅ Add pages to navigation menu
4. ✅ Test booking workflow (both free and paid)
5. ✅ Configure email notifications
6. ✅ Train staff on admin interface
7. ✅ Announce to community members

## Support Resources

- Full Documentation: `docs/BOOKING_SYSTEM.md`
- Code Files: `wp-content/themes/zuidakker-child/inc/booking-*.php`
- WooCommerce Docs: https://woocommerce.com/documentation/

## Tips for Success

1. **Start Simple**: Create 1-2 resources first, test thoroughly
2. **Clear Descriptions**: Add detailed descriptions to resources
3. **Good Photos**: Use high-quality featured images
4. **Test Payments**: Use WooCommerce test mode initially
5. **User Guidance**: Add help text to booking pages
6. **Monitor Bookings**: Check reservations regularly in admin
7. **Communicate**: Send reminders to users before their bookings

---

**Ready to go live?** Follow the deployment checklist in `docs/DEPLOYMENT_CHECKLIST.md`
