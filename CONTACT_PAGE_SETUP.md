# Contact Page Setup Instructions

## What's Been Created

### 1. Files Created
- ✅ `page-contact.php` - Contact page template
- ✅ `inc/contact-form.php` - Form handler and email functionality
- ✅ Contact page styling added to `style.css`

### 2. Features Included

#### Contact Information Cards
- 📍 **Address** - Zuidakker location
- ✉️ **Email** - Contact email with mailto link
- 📞 **Phone** - Phone number with tel link
- 🕐 **Opening Hours** - Business hours

#### Contact Form
- Name field (required)
- Email field (required)
- Phone field (optional)
- Subject field (required)
- Message textarea (required)
- Modern submit button with hover effects

#### Form Functionality
- Email validation
- Security nonce verification
- Sends email to site admin
- Success/error messages
- Spam protection

## Setup Steps

### Step 1: Create the Contact Page in WordPress

1. Log in to WordPress Admin
2. Go to **Pages → Add New**
3. Title: "Contact" (or "Contacteer ons")
4. In the right sidebar, find **Page Attributes**
5. Select **Template: Contact Page**
6. **Important**: Set the page slug to `contact` (lowercase)
7. Click **Publish**

### Step 2: Update Contact Information

Edit `page-contact.php` and update these lines with your actual information:

```php
// Line 41-46: Address
<strong>Zuidakker</strong><br>
Zuidakkerstraat 1<br>
1234 AB Amsterdam<br>
Nederland

// Line 54: Email
<a href="mailto:info@zuidakker.nl">info@zuidakker.nl</a>

// Line 63: Phone
<a href="tel:+31201234567">+31 (0)20 123 4567</a>

// Line 72-74: Opening Hours
Ma - Vr: 09:00 - 17:00<br>
Za: 10:00 - 16:00<br>
Zo: Gesloten
```

### Step 3: Test the Contact Form

1. Visit your contact page: `http://localhost:8080/contact/`
2. Fill out the form
3. Submit
4. Check your WordPress admin email for the message

### Step 4: Verify Sitemap Integration

The contact page will automatically appear in your sitemap because:
- It's a published page
- The sitemap displays all published pages
- No additional configuration needed

To verify:
1. Go to `http://localhost:8080/sitemap/`
2. Look for "Contact" in the page list

## Customization Options

### Using a Plugin Instead

If you prefer to use a contact form plugin (recommended for advanced features):

1. Install a plugin like:
   - **Contact Form 7** (most popular)
   - **WPForms** (user-friendly)
   - **Gravity Forms** (advanced)

2. Edit `page-contact.php` around line 104:
   ```php
   // Replace the HTML form with:
   <?php echo do_shortcode('[contact-form-7 id="123" title="Contact form"]'); ?>
   ```

### Changing Colors

The contact page uses the Tuinen (green) color scheme. To change:

In `style.css`, search for `contact-card h3` and `contact-submit-btn`:
- Replace `--pillar-tuinen-*` with another pillar color
- Or use custom colors

### Adding Google Maps

Add this after the contact info cards in `page-contact.php`:

```php
<div class="contact-map">
    <iframe 
        src="https://www.google.com/maps/embed?pb=YOUR_EMBED_CODE"
        width="100%" 
        height="450" 
        style="border:0; border-radius: 1rem;" 
        allowfullscreen="" 
        loading="lazy">
    </iframe>
</div>
```

## Modern Design Features

### Contact Cards
- Glass-morphism effect
- Hover lift animation
- Icon rotation on hover
- Responsive grid layout

### Contact Form
- Modern input styling
- Focus states with green accent
- Gradient submit button
- Animated arrow on hover
- Success/error messages

### Responsive Design
- Mobile-optimized
- Touch-friendly inputs
- Stacked layout on small screens

## Email Configuration

The form sends emails using WordPress's `wp_mail()` function.

**To ensure emails work:**
1. Install an SMTP plugin like **WP Mail SMTP**
2. Configure with your email provider
3. Test email delivery

**Default behavior:**
- Emails sent to: WordPress admin email
- From: Site name and admin email
- Reply-to: Form submitter's email

## Security Features

- ✅ Nonce verification
- ✅ Data sanitization
- ✅ Email validation
- ✅ Required field validation
- ✅ XSS protection

## Troubleshooting

### Form not sending emails?
- Install WP Mail SMTP plugin
- Check spam folder
- Verify admin email in Settings → General

### Page not showing template?
- Make sure you selected "Contact Page" template
- Clear cache if using caching plugin

### Styling issues?
- Clear browser cache
- Check if CSS file is loading
- Verify no theme conflicts

## Next Steps

1. Create the contact page in WordPress
2. Update contact information
3. Test the form
4. Verify it appears in sitemap
5. Customize as needed

Your contact page is ready with modern design, working form, and automatic sitemap integration! 📧✨
