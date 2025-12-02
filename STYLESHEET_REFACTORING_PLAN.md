# Stylesheet Refactoring Plan

## Issues Found

### 1. **Duplicate Section Headers**
- "PILLAR CARD STYLES" appears twice (lines 92 and 187)
- Empty section at line 92

### 2. **Repetitive Pillar Page Styling**
Each pillar page has nearly identical code blocks:
- body.page-{pillar} background
- .site-header styling
- .entry-hero-container styling  
- .site-content transparent
- .entry-content with rounded corners

This can be consolidated using CSS attribute selectors.

### 3. **Repetitive Container Reset Code**
Multiple sections resetting padding/margin for:
- .content-area
- .content-container
- .site-main
- .content-wrap
- article.entry

### 4. **Unused/Redundant Styles**
- Line 560: Comment says "removed as each page now has its own primary background color" but code still exists below
- Multiple !important flags that could be reduced
- Overly specific selectors that could be simplified

### 5. **Inconsistent Organization**
- Some pillar-specific styles mixed with general styles
- Language switcher colors scattered
- Hero/header spacing rules are very repetitive

## Refactoring Strategy

### Phase 1: Consolidate Pillar Page Styles
Create a mixin-like approach using CSS custom properties and attribute selectors:

```css
/* All pillar pages - shared styles */
body[class*="page-tuinen"],
body[class*="page-geschiedenis"],
body[class*="page-ontmoeting"],
body[class*="page-educatie"],
body[class*="page-verblijf"],
body[class*="page-sitemap"] {
    /* Common styles */
}
```

### Phase 2: Remove Duplicate Sections
- Remove empty PILLAR CARD STYLES section at line 92
- Consolidate all pillar card styles in one place

### Phase 3: Simplify Container Resets
Create one comprehensive reset section instead of multiple scattered ones.

### Phase 4: Reduce !important Usage
Review and remove unnecessary !important flags.

### Phase 5: Better Organization
Reorganize into logical sections:
1. CSS Variables
2. Global Styles
3. Layout (Header, Hero, Content)
4. Components (Cards, Buttons, Forms)
5. Page-Specific (Pillars, Contact, Sitemap)
6. Utilities & Overrides

## Estimated Reduction
- Current: ~1408 lines
- After refactoring: ~900-1000 lines (30% reduction)
- Improved maintainability
- Easier to find and modify styles

## Priority Actions
1. **High**: Consolidate pillar page styles (saves ~200 lines)
2. **High**: Remove duplicate sections
3. **Medium**: Simplify container resets (saves ~50 lines)
4. **Medium**: Reduce !important usage
5. **Low**: Reorganize for better readability
