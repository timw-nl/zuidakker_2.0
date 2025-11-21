<?php
/**
 * WooCommerce - KISS
 * WooCommerce theme support and customizations
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add WooCommerce support
 */
function zuidakker_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'zuidakker_woocommerce_support' );

/**
 * Set product columns
 */
add_filter( 'loop_shop_columns', function() { return 3; } );
