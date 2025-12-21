<?php
/**
 * Single Post Styling Override
 * Forces blur effect styling on single posts
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add inline styles for single posts to override Kadence theme
 */
function zuidakker_single_post_inline_styles() {
    if ( ! is_single() ) {
        return;
    }
    ?>
    <style id="zuidakker-single-post-override">
        /* Force transparent backgrounds on all wrapper elements */
        body.single-post .content-bg,
        body.single-post .entry-content-wrap,
        body.single-post article.entry,
        body.single-post .entry,
        body.single-post .single-entry {
            background-color: transparent !important;
            background: transparent !important;
            background-image: none !important;
            box-shadow: none !important;
        }
        
        /* Force blur effect on entry-content */
        body.single-post .entry-content {
            background-color: rgba(151, 191, 133, 0.65) !important;
            background: rgba(151, 191, 133, 0.65) !important;
            background-image: none !important;
            backdrop-filter: blur(15px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(15px) saturate(180%) !important;
            border-radius: 1rem !important;
            margin: 1.5rem !important;
            padding: 3rem !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: #fff !important;
        }
        
        /* Ensure text is white */
        body.single-post .entry-content p,
        body.single-post .entry-content h1,
        body.single-post .entry-content h2,
        body.single-post .entry-content h3,
        body.single-post .entry-content h4,
        body.single-post .entry-content h5,
        body.single-post .entry-content h6,
        body.single-post .entry-content li {
            color: #fff !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'zuidakker_single_post_inline_styles', 999 );
