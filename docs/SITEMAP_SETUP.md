# Sitemap Page Setup

How to create and configure the sitemap page with folder tree structure.

---

## Quick Setup

### Option A: Automated Setup (Recommended)

**From Terminal:**

```bash
# Using Makefile (recommended)
make setup-sitemap

# Or run the script directly
./setup-sitemap.sh
```

This script will:
- ✅ Check if WordPress is running
- ✅ Create the sitemap page automatically
- ✅ Add the sitemap_tree shortcode
- ✅ Publish the page
- ✅ Flush rewrite rules

**Done!** Visit: http://localhost:8080/sitemap

---

### Option B: Manual Setup

**In WordPress Admin:**

1. **Go to Pages → Add New**
2. **Title:** `Sitemap`
3. **Slug:** `sitemap` (should be automatic)

### 2. Add Content

**Add these blocks in order:**

**Block 1: Paragraph**
```
Overzicht van alle pagina's op de site.
```

**Block 2: Shortcode**
```
[sitemap_tree]
```

### 3. Publish

Click **Publish** button.

### 4. View Result

Visit: http://localhost:8080/sitemap

---

## What You'll See

### Folder Tree Structure

```
📁 Homepage
📄 Tuinen (Gardens)
   Description if added
📄 Geschiedenis (History)
   Description if added
📄 Ontmoeting (Meeting)
   Description if added
📄 Educatie (Education)
   Description if added
📄 Verblijf (Accommodation)
   Description if added
📁 Parent Page
   📄 Child Page 1
   📄 Child Page 2
      📄 Grandchild Page
📄 Sitemap
📄 Other Pages...
```

### Features

**Visual Indicators:**
- 📁 Folder icon for pages with children
- 📄 Page icon for regular pages
- Indentation shows hierarchy
- Border line shows parent-child relationship

**Color Coding:**
- Pillar pages use their pillar colors
- Other pages use sitemap green
- Hover effect on all links

**Responsive:**
- Desktop: Full tree with indentation
- Mobile: Reduced indentation, still clear hierarchy

---

## Shortcode Options

### Primary Shortcode: [sitemap_tree]

**Features:**
- Hierarchical folder tree
- Icons (📁 folders, 📄 pages)
- Color-coded pillar pages
- Shows page excerpts
- Indented structure
- Border lines

**Usage:**
```
[sitemap_tree]
```

### Alternative: [sitemap_simple]

**Features:**
- Simple bulleted list
- Hierarchical structure
- No icons
- Simpler styling

**Usage:**
```
[sitemap_simple]
```

---

## Customization

### Add Page Descriptions

To show descriptions under page titles:

1. **Edit any page**
2. **Find "Excerpt" panel** (in sidebar)
   - If not visible: Click ⋮ (three dots) → Preferences → Panels → Enable "Excerpt"
3. **Add excerpt text**
4. **Update page**
5. Description appears in sitemap

**Example:**
```
📄 Tuinen
   Ontdek de tuinen van RKBS Kaskade basisschool bij Zuidakker.
```

### Change Colors

Edit `inc/sitemap-shortcode.php`:

```css
.sitemap-list a {
    color: #your-color;
}

.sitemap-list a:hover {
    color: #your-hover-color;
}
```

### Change Icons

Edit `inc/sitemap-shortcode.php`:

```css
.sitemap-list li::before {
    content: "📄";  /* Change to any emoji or remove */
}

.sitemap-list li.has-children::before {
    content: "📁";  /* Change folder icon */
}
```

### Exclude Pages

To exclude specific pages from sitemap:

Edit `inc/sitemap-shortcode.php`, find:
```php
$pages = get_pages( array(
    'sort_column' => 'menu_order, post_title',
    'post_status' => 'publish',
) );
```

Change to:
```php
$pages = get_pages( array(
    'sort_column' => 'menu_order, post_title',
    'post_status' => 'publish',
    'exclude' => array( 123, 456 ), // Page IDs to exclude
) );
```

---

## Multilingual Support

### With Polylang

The sitemap automatically works with Polylang:

**Dutch version:** `/sitemap`
- Shows only Dutch pages
- Dutch descriptions

**English version:** `/en/sitemap`
- Shows only English pages
- English descriptions

### Setup Translations

1. **Create Dutch sitemap page:**
   - Title: `Sitemap`
   - Content: `Overzicht van alle pagina's op de site.`
   - Shortcode: `[sitemap_tree]`

2. **Create English translation:**
   - Click + under EN flag
   - Title: `Sitemap`
   - Content: `Overview of all pages on the site.`
   - Shortcode: `[sitemap_tree]`

3. **Both versions work independently**

---

## Styling Details

### Desktop View

```
Overzicht van alle pagina's op de site.

📁 Homepage
📄 Tuinen
   Ontdek de tuinen...
📄 Geschiedenis
   Ontdek de geschiedenis...
│  
├─ 📄 Child Page
│  
└─ 📄 Another Child
```

### Mobile View

```
Overzicht van alle pagina's op de site.

📁 Homepage
📄 Tuinen
  Ontdek de tuinen...
📄 Geschiedenis
  Ontdek de geschiedenis...
 📄 Child Page
 📄 Another Child
```

---

## CSS Classes

For custom styling:

```css
.sitemap-tree              /* Main container */
.sitemap-list              /* Main list */
.sitemap-list ul           /* Nested lists */
.sitemap-list li           /* List items */
.sitemap-list li.has-children  /* Parent pages */
.sitemap-list a            /* Links */
.page-description          /* Excerpts */

/* Pillar-specific */
.pillar-tuinen a
.pillar-geschiedenis a
.pillar-ontmoeting a
.pillar-educatie a
.pillar-verblijf a
```

---

## Troubleshooting

### Sitemap Shows No Pages

**Cause:** No published pages or wrong shortcode

**Fix:**
1. Verify pages are published (not drafts)
2. Check shortcode spelling: `[sitemap_tree]`
3. Refresh page

### Hierarchy Not Showing

**Cause:** Pages not set as children

**Fix:**
1. Edit page
2. Find "Page Attributes" panel
3. Set "Parent Page"
4. Update page

### Colors Not Working

**Cause:** CSS variables not loaded

**Fix:**
1. Verify child theme is active
2. Hard refresh: `Ctrl + Shift + R`
3. Check `style.css` has color variables

### Icons Not Showing

**Cause:** Browser doesn't support emojis

**Fix:**
- Use different browser
- Or change icons to text/symbols in CSS

---

## Example Page Structure

### Recommended Hierarchy

```
Homepage (no parent)
├─ Tuinen (no parent)
├─ Geschiedenis (no parent)
├─ Ontmoeting (no parent)
│  ├─ Meeting Rooms (parent: Ontmoeting)
│  └─ Allotments (parent: Ontmoeting)
├─ Educatie (no parent)
├─ Verblijf (no parent)
│  ├─ Camping (parent: Verblijf)
│  └─ Boat Houses (parent: Verblijf)
├─ Shop (no parent)
├─ Contact (no parent)
└─ Sitemap (no parent)
```

---

## Advanced Usage

### Combine with Other Content

```html
<h2>Overzicht van alle pagina's op de site.</h2>

<p>Gebruik deze sitemap om snel de gewenste pagina te vinden.</p>

[sitemap_tree]

<h3>Meer informatie</h3>
<p>Voor vragen, neem contact op via het contactformulier.</p>
```

### Add Custom Sections

```html
<h2>Overzicht van alle pagina's op de site.</h2>

<h3>Hoofdpagina's</h3>
[sitemap_tree]

<h3>Blog Posts</h3>
<!-- Add blog archive link -->
<a href="/blog">Bekijk alle blog posts</a>
```

---

## Testing Checklist

- [ ] Sitemap page created with slug `sitemap`
- [ ] Heading text added
- [ ] Shortcode `[sitemap_tree]` added
- [ ] Page published
- [ ] All pages appear in tree
- [ ] Hierarchy is correct (parents/children)
- [ ] Links work
- [ ] Pillar colors show correctly
- [ ] Hover effects work
- [ ] Mobile view is readable
- [ ] Excerpts show (if added)
- [ ] Icons display correctly

---

## Summary

**To create sitemap:**
1. Create page with slug `sitemap`
2. Add text: "Overzicht van alle pagina's op de site."
3. Add shortcode: `[sitemap_tree]`
4. Publish

**Result:**
- Beautiful folder tree structure
- Color-coded pillar pages
- Hierarchical organization
- Responsive design
- Multilingual support

---

**Last Updated:** October 12, 2024  
**Shortcode:** `[sitemap_tree]`  
**Alternative:** `[sitemap_simple]`
