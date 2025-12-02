# Stylesheet Cleanup Summary

## Completed Actions

### ✅ Removed Duplicate Section
- Removed empty "PILLAR CARD STYLES" section (was duplicate)
- Kept the actual pillar card styles section

## Identified Issues & Recommendations

### 1. **Repetitive Pillar Page Styling** (HIGH PRIORITY)
**Current**: Each of the 6 pillar pages has ~40 lines of nearly identical code
- Lines 309-348: Tuinen
- Lines 351-390: Geschiedenis  
- Lines 393-432: Ontmoeting
- Lines 435-474: Educatie
- Lines 477-516: Verblijf
- Lines 519-558: Sitemap

**Total**: ~240 lines of repetitive code

**Recommendation**: Consolidate into shared styles + individual color variables
```css
/* Shared pillar page styles */
body[class*="page-tuinen"],
body[class*="page-geschiedenis"],
body[class*="page-ontmoeting"],
body[class*="page-educatie"],
body[class*="page-verblijf"],
body[class*="page-sitemap"] {
    /* Common background, header, content styles */
}

/* Individual colors only */
body.page-tuinen { background-color: var(--pillar-tuinen-primary); }
body.page-geschiedenis { background-color: var(--pillar-geschiedenis-primary); }
/* etc. */
```

**Savings**: ~180 lines

### 2. **Repetitive Container Resets** (MEDIUM PRIORITY)
Multiple sections resetting the same containers:
- Lines 598-618: content-area, content-container, site-main
- Lines 621-644: article.entry, content-bg, single-content
- Lines 812-824: Homepage specific resets

**Recommendation**: Consolidate into one comprehensive reset section

**Savings**: ~30 lines

### 3. **Excessive !important Usage** (MEDIUM PRIORITY)
Found 50+ instances of !important throughout the file.

**Examples**:
- Line 97: `.site-header` background
- Line 639-643: article/content resets
- Line 832: Menu hiding
- Lines 968-1035: Hero/header spacing

**Recommendation**: Review each !important and remove where possible by:
- Increasing specificity naturally
- Reorganizing CSS order
- Using more specific selectors

**Benefits**: Easier to override, better maintainability

### 4. **Hero/Header Spacing Overrides** (LOW PRIORITY)
Lines 968-1035: Very repetitive spacing resets for hero/header elements

**Current**: 15+ similar rules targeting various hero/header containers

**Recommendation**: Consolidate into fewer, more targeted rules

**Savings**: ~40 lines

### 5. **Language Switcher Colors** (LOW PRIORITY)
Lines 915-937: Individual language switcher colors for each pillar

**Recommendation**: Could use CSS custom properties set on body to reduce repetition

**Savings**: ~15 lines

## Summary Statistics

### Current State
- **Total Lines**: 1,408
- **Repetitive Code**: ~265 lines (19%)
- **!important Count**: 50+
- **Duplicate Sections**: 1 (removed)

### After Full Refactoring (Estimated)
- **Total Lines**: ~950-1,000
- **Reduction**: 400+ lines (28%)
- **!important Count**: <20
- **Better Organization**: ✓

## Recommended Next Steps

### Immediate (High Impact)
1. ✅ Remove duplicate sections (DONE)
2. Consolidate pillar page styles (saves 180 lines)
3. Consolidate container resets (saves 30 lines)

### Short Term (Medium Impact)
4. Reduce !important usage
5. Consolidate hero/header spacing (saves 40 lines)

### Long Term (Maintenance)
6. Reorganize into logical sections
7. Add comments for complex sections
8. Document color system usage

## Risk Assessment

### Low Risk Refactoring
- Removing duplicates ✓
- Consolidating identical rules
- Adding comments

### Medium Risk Refactoring
- Removing !important flags (test thoroughly)
- Reorganizing section order

### High Risk Refactoring
- Changing selector specificity
- Modifying core layout rules

## Testing Checklist After Refactoring

- [ ] Homepage displays correctly
- [ ] All 5 pillar pages display correctly
- [ ] Sitemap page displays correctly
- [ ] Contact page displays correctly
- [ ] Header/navigation works
- [ ] Language switcher works
- [ ] Pillar cards display correctly
- [ ] Mobile responsive layout works
- [ ] Hover effects work
- [ ] Forms display correctly

## Conclusion

The stylesheet is functional but has significant room for improvement. The main issue is repetitive code for pillar pages. A focused refactoring effort could reduce the file size by ~28% while improving maintainability.

**Recommendation**: Proceed with high-priority consolidations first, test thoroughly, then tackle medium-priority items.
