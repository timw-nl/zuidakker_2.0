# Background Image Setup Instructions

## Step 1: Save the Image

Save your greenhouse/building photo to:
```
/home/tim/projects/zuidakker/zuidakker_2.0/wp-content/themes/zuidakker-child/assets/images/zuidakker-greenhouse.jpg
```

## Step 2: What's Been Implemented

The CSS has been updated to add your photo as a background for the pillars container (the homepage grid with the 5 pillar cards).

### Features Added:
1. **Background Image**: Your greenhouse photo
2. **White Overlay**: Semi-transparent gradient overlay (92-88% opacity) to ensure text readability
3. **Fixed Attachment**: Parallax-like effect when scrolling
4. **Cover Sizing**: Image fills the entire container
5. **Center Position**: Image is centered for best composition

### CSS Applied:
```css
.pillars-container {
    background-image: 
        linear-gradient(135deg, rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0.88)),
        url('assets/images/zuidakker-greenhouse.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}
```

## Step 3: Customization Options

If you want to adjust the overlay opacity:
- **More visible photo**: Change `0.92` and `0.88` to lower values (e.g., `0.85` and `0.80`)
- **Less visible photo**: Change to higher values (e.g., `0.95` and `0.92`)

If you want to change the background position:
- `center` - Current setting
- `top` - Show top of image
- `bottom` - Show bottom of image
- `center top` - Center horizontally, top vertically

## Alternative: Using WordPress Media Library

Instead of manually placing the file, you can:
1. Upload the image through WordPress Media Library
2. Get the image URL
3. Replace `assets/images/zuidakker-greenhouse.jpg` with the full URL in the CSS

## Result

The pillars container will now have a beautiful, subtle background showing your Zuidakker greenhouse and building, with the pillar cards overlaying it in a modern, professional way.
