# Homepage Setup Instructions

## Based on `home_look_and_feel.png` Design

The homepage has been styled to match the design mockup with:
- Dark green header
- Hero section with welcome text
- 5 colorful pillar cards in a horizontal layout

## Quick Setup

### Option 1: Using the Shortcode (Recommended)

1. Go to **WordPress Admin** → **Pages** → **Add New** (or edit existing Homepage)
2. Add a **Custom HTML block** and paste:

```html
<div class="hero-section">
    <h1>Welkom bij Zuidakker</h1>
    <p>Ontdek Zuidakker door onze vijf hoofdgebieden: tuinen, geschiedenis, ontmoeting, voedseleducatie en verblijf.</p>
</div>
```

3. Add a **Shortcode block** below it and insert:
```
[pillars_grid]
```

4. **Publish** the page
5. Go to **Settings** → **Reading**
6. Select "A static page" and choose your page as **Homepage**
7. Save

### Option 2: Copy Full Template

1. Open `setup/homepage-template.html` 
2. Copy the entire content
3. In WordPress Admin → **Pages** → Edit Homepage
4. Click **⋮** (three dots) → **Code editor**
5. Paste the content
6. Click **Exit code editor**
7. **Publish**

## Design Elements

### Colors Used

- **Header**: `#3d5e41` (dark green)
- **Background**: `#f5f5f0` (light beige/cream)
- **Tuinen**: `#97bf85` (green)
- **Geschiedenis**: `#c27d55` (brown/terracotta)
- **Ontmoeting**: `#6ba7b6` (blue)
- **Educatie**: `#f0a85f` (orange)
- **Verblijf**: `#d98c8c` (pink/rose)

### Features

✅ Responsive design (5 cards on desktop, stacked on mobile)
✅ Rounded corners (20px)
✅ Icons in circles
✅ Hover effects (lift up on hover)
✅ Clean, modern typography
✅ Bilingual subtitles (NL/EN)

## Customization

### Change Hero Text

Edit the hero section HTML:
```html
<div class="hero-section">
    <h1>Your Title Here</h1>
    <p>Your description here.</p>
</div>
```

### Change Card Content

Edit `wp-content/themes/zuidakker-child/functions.php` in the `zuidakker_pillars_grid_shortcode` function.

### Change Colors

Edit `wp-content/themes/zuidakker-child/style.css` CSS variables:
```css
:root {
    --pillar-tuinen-primary: #97bf85;
    --header-green: #3d5e41;
    /* etc. */
}
```

## Navigation Menu

To add a navigation menu in the header:

1. **Appearance** → **Menus**
2. Create a new menu called "Primary Menu"
3. Add pages: Home, Contact, etc.
4. Check "Primary Menu" location
5. Save Menu

## Header Customization

To add a logo:

1. **Appearance** → **Customize** → **Site Identity**
2. Upload logo
3. Adjust site title display

## Testing

✅ Test on desktop (1920px)
✅ Test on tablet (768px)
✅ Test on mobile (375px)
✅ Check all links work
✅ Verify hover effects
✅ Test with different browsers

---

**Design Reference**: `/home_look_and_feel.png`
**Created**: 2025-10-07
