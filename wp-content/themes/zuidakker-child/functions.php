<?php
/**
 * Zuidakker Child Theme - KISS Refactored
 * 
 * @package Zuidakker
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Load theme modules
 */
require_once get_stylesheet_directory() . '/inc/customizer-pillars.php'; // Must load before theme-config
require_once get_stylesheet_directory() . '/inc/theme-config.php';
require_once get_stylesheet_directory() . '/inc/pillar-pages.php';
require_once get_stylesheet_directory() . '/inc/custom-post-types.php';
require_once get_stylesheet_directory() . '/inc/woocommerce.php';
require_once get_stylesheet_directory() . '/inc/booking-system.php';
require_once get_stylesheet_directory() . '/inc/booking-reservations.php';
require_once get_stylesheet_directory() . '/inc/booking-frontend.php';
require_once get_stylesheet_directory() . '/inc/booking-calendar.php';
require_once get_stylesheet_directory() . '/inc/sitemap-shortcode.php';
require_once get_stylesheet_directory() . '/inc/contact-form.php';
require_once get_stylesheet_directory() . '/inc/contact-map.php';
require_once get_stylesheet_directory() . '/inc/social-links.php';
require_once get_stylesheet_directory() . '/inc/updates-section.php';
require_once get_stylesheet_directory() . '/inc/updates-admin-page.php';
require_once get_stylesheet_directory() . '/inc/single-post-styles.php';
