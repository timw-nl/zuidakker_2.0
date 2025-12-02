# Sitemap Grouped by Category

## Overview
The sitemap has been reorganized to group pages by category, making it easier for visitors to find what they're looking for.

## Page Groups

### 1. 🌿 De Vijf Pijlers
Contains the five main pillar pages:
- 🌱 Tuinen bij de Zuidakker
- 📚 Geschiedenis van Zuidakker
- 🤝 Ontmoeting aan de oever
- 🍎 Voedseleducatie
- 🏡 Verblijf bij de Zuidakker

### 2. 🛒 Winkel
Contains all shop-related pages:
- Shop/Winkel
- My Account/Mijn Account
- Checkout
- Cart/Winkelwagen

### 3. 📄 Algemeen
Contains general information pages:
- Agenda
- Contact
- Sitemap
- Welkom bij Zuidakker

### 4. 📑 Overige Pagina's
Contains any other pages that don't fit the above categories.

## Design Features

### Clean Grouping
- Each group has a clear heading with emoji icon
- Groups are separated by subtle divider lines
- Generous spacing between groups
- Last group has no bottom border

### Group Titles
- Large, bold headings (1.5rem)
- Dark color (#1a1a1a)
- Tight letter spacing
- Emoji icons for visual identification

### Minimal Styling
- Transparent background
- Simple bullet points
- Clean typography
- Subtle hover effects
- Colored pillar page links

## How It Works

The sitemap function now:
1. Gets all published pages
2. Sorts them into predefined groups based on page slug
3. Displays each group with its own heading
4. Only shows groups that have pages

## Customization

To add pages to a group, edit the slug arrays in `sitemap-shortcode.php`:

```php
$pillar_slugs = array( 'tuinen', 'geschiedenis', 'ontmoeting', 'educatie', 'verblijf' );
$shop_slugs = array( 'shop', 'winkel', 'my-account', 'mijn-account', 'checkout', 'cart', 'winkelwagen' );
$general_slugs = array( 'agenda', 'contact', 'sitemap', 'welkom-bij-zuidakker' );
```

## Benefits

1. **Better Organization**: Pages are logically grouped
2. **Easier Navigation**: Visitors can quickly find the type of page they need
3. **Visual Hierarchy**: Clear sections with headings
4. **Scalable**: Easy to add new groups or pages
5. **Clean Design**: Minimal, modern appearance

The sitemap is now organized, clean, and easy to navigate! 🎯
