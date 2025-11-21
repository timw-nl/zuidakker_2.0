# Pillar Page Styling Guide

This document describes the visual styling applied to each pillar page.

## Design Concept

Each pillar page has a unique color scheme with:
- **Header**: Primary color of the pillar
- **Content Area**: Secondary (darker) color of the pillar
- **Rounded Edges**: 12px border-radius on all major elements
- **White Text**: For readability on colored backgrounds

## Color Schemes by Page

### 🌱 Tuinen (Gardens)
- **URL**: `/tuinen`
- **Primary Color** (Header): `#97bf85` (Light Green)
- **Secondary Color** (Content): `#6f9357` (Dark Green)
- **Theme**: Nature, growth, education

### 🏛️ Geschiedenis (History)
- **URL**: `/geschiedenis`
- **Primary Color** (Header): `#c27d55` (Light Brown)
- **Secondary Color** (Content): `#b4412f` (Dark Brown)
- **Theme**: Heritage, tradition, stories

### 🌊 Ontmoeting (Meeting on the Shore)
- **URL**: `/ontmoeting`
- **Primary Color** (Header): `#6ba7b6` (Light Blue)
- **Secondary Color** (Content): `#2a677e` (Dark Blue)
- **Theme**: Water, community, gathering

### 🎓 Voedseleducatie (Food Education)
- **URL**: `/educatie`
- **Primary Color** (Header): `#f0a85f` (Light Orange)
- **Secondary Color** (Content): `#d97225` (Dark Orange)
- **Theme**: Learning, nutrition, sustainability

### 🏠 Verblijf (Accommodation)
- **URL**: `/verblijf`
- **Primary Color** (Header): `#d98c8c` (Light Pink/Rose)
- **Secondary Color** (Content): `#b35a5a` (Dark Pink/Rose)
- **Theme**: Comfort, rest, hospitality

### 🗺️ Sitemap
- **URL**: `/sitemap`
- **Primary Color** (Header): `#2c5530` (Dark Green)
- **Secondary Color** (Content): `#4a7c59` (Medium Green)
- **Theme**: Navigation, overview, structure

## Visual Elements

### Header Styling (Navigation Bar)
- Background: Primary color
- Rounded bottom corners: `border-radius: 0 0 12px 12px`
- Padding: 0.5rem (compact vertical spacing)
- Margin bottom: 0.5rem (reduced from 1rem)
- White text for navigation
- **Optimized for minimal vertical space**

### Page Title Area (Entry Header)
- Background: Primary color
- Fully rounded corners: `border-radius: 12px`
- Padding: 0.25rem vertical, 1rem horizontal (ultra-compact)
- Margin bottom: 0.25rem (significantly reduced)
- White text for page titles
- **Centered alignment** with flexbox
- **Minimal height** with auto sizing

### Content Area Styling
- Background: Secondary color
- Fully rounded corners: `border-radius: 12px`
- Padding: 2rem
- White text for all content
- Margin top: 0.5rem (reduced from 1rem)
- **Compact spacing** between all sections

### Typography
- All headings (h1, h2, h3): White color
- Body text: White color
- Maintains readability on colored backgrounds

### Rounded Edges
- All major elements: 12px border-radius
- Consistent with homepage pillar cards
- Creates cohesive, modern design

## Page Structure

```
┌─────────────────────────────────┐
│  HEADER (Primary Color)         │ ← Rounded bottom corners
│  - Navigation bar                │   (0.5rem padding)
└─────────────────────────────────┘
        ↓ 0.5rem spacing (COMPACT)
┌─────────────────────────────────┐
│  PAGE TITLE (Primary Color)      │ ← Fully rounded + CENTERED
│  - Entry header                  │   (0.25rem padding - MINIMAL)
└─────────────────────────────────┘
        ↓ 0.5rem spacing (COMPACT)
┌─────────────────────────────────┐
│  CONTENT (Secondary Color)       │ ← Fully rounded
│  - Page content                  │   (2rem padding)
│  - White text                    │
│  - Headings & paragraphs         │
└─────────────────────────────────┘
```

## Implementation Details

### CSS Classes
Each page automatically gets a body class:
- `body.page-tuinen`
- `body.page-geschiedenis`
- `body.page-ontmoeting`
- `body.page-educatie`
- `body.page-verblijf`
- `body.page-sitemap`

### Responsive Design
- Maintains color scheme on all screen sizes
- Rounded corners scale appropriately
- Padding adjusts for mobile devices

### Accessibility
- High contrast between text and background
- White text on darker secondary colors
- Readable font sizes maintained

## Testing Checklist

To verify the styling is working:

1. ✅ Visit each pillar page
2. ✅ Check header has primary color
3. ✅ Check content area has secondary color
4. ✅ Verify all corners are rounded (12px)
5. ✅ Confirm text is white and readable
6. ✅ **Verify compact spacing** (headers take minimal vertical space)
7. ✅ **Check centered alignment** of page titles
8. ✅ **Confirm hero containers match content width**
9. ✅ Test on mobile and desktop
10. ✅ Hard refresh browser (Ctrl+Shift+R)

## Browser Cache

If you don't see the changes:
1. Hard refresh: `Ctrl + Shift + R`
2. Clear browser cache
3. Check theme version is 1.0.5 or higher

## Recent Optimizations (v1.0.9)

### Spacing Improvements
- **Reduced vertical spacing** by 50% for all headers
- **Centered page titles** with flexbox alignment
- **Minimal padding** on entry headers (0.25rem vs 0.5rem)
- **Compact margins** throughout (0.5rem vs 1rem)
- **Hero containers** now match content container width
- **Ultra-tight line spacing** (1.1-1.2) for headings

### Targeted Elements
- `.entry-hero-container-inner`
- `.hero-section-overlay`
- `.hero-container`
- `.entry-header`
- `.site-container`
- `.primary` content areas

## Future Enhancements

Potential additions:
- Hover effects on content blocks
- Gradient backgrounds
- Custom icons for each pillar
- Animated transitions between pages
- Dark mode support
- Further micro-spacing optimizations
