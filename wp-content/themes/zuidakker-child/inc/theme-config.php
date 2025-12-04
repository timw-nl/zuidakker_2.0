<?php
/**
 * Theme Configuration - KISS
 * Basic theme setup and configuration
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Pillar pages configuration (cached for performance)
 * Now reads from Customizer settings - manageable via wp-admin > Appearance > Customize
 */
function zuidakker_get_pillars() {
    // Use Customizer-based function if available
    if ( function_exists( 'zuidakker_get_pillars_from_customizer' ) ) {
        return zuidakker_get_pillars_from_customizer();
    }
    
    // Fallback to defaults (only used if customizer-pillars.php not loaded)
    static $pillars = null;
    
    if ( $pillars === null ) {
        $pillars = array(
            'tuinen' => array(
                'name' => 'Tuinen',
                'subtitle' => 'Gardens',
                'icon' => '🌱',
                'description' => 'Ontdek de tuinen van RKBS Kaskade basisschool bij Zuidakker.'
            ),
            'geschiedenis' => array(
                'name' => 'Geschiedenis',
                'subtitle' => 'History',
                'icon' => '🏛️',
                'description' => 'Ontdek de geschiedenis van activiteiten op Zuideinde 112 van de familie Warmerdam en de Zuidakker.'
            ),
            'ontmoeting' => array(
                'name' => 'Ontmoeting',
                'subtitle' => 'Meeting',
                'icon' => '🌊',
                'description' => 'Ontmoetingsplek aan de waterkant voor vergaderingen en volkstuinen.'
            ),
            'educatie' => array(
                'name' => 'Voedseleducatie',
                'subtitle' => 'Food Education',
                'icon' => '🎓',
                'description' => 'Educatief programma over duurzame voedselproductie bij Zuidakker.'
            ),
            'verblijf' => array(
                'name' => 'Verblijf',
                'subtitle' => 'Stays',
                'icon' => '🏠',
                'description' => 'Korte verblijven, camping en accommodatie zoals boothuizen bij Zuidakker.'
            )
        );
    }
    
    return $pillars;
}

/**
 * Enqueue styles with optimization
 */
function zuidakker_enqueue_styles() {
    $parent_version = wp_get_theme()->parent()->get('Version');
    $child_version = wp_get_theme()->get('Version');
    
    // Enqueue parent theme
    wp_enqueue_style( 'kadence-style', get_template_directory_uri() . '/style.css', array(), $parent_version );
    
    // Enqueue child theme with media="all" for better performance
    wp_enqueue_style( 'zuidakker-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'kadence-style' ), $child_version, 'all' );
}
add_action( 'wp_enqueue_scripts', 'zuidakker_enqueue_styles', 10 );

/**
 * Add preload for critical assets
 */
function zuidakker_preload_assets() {
    echo '<link rel="preload" href="' . esc_url( get_stylesheet_directory_uri() . '/assets/images/zuidakker-greenhouse.jpg' ) . '" as="image">' . "\n";
}
add_action( 'wp_head', 'zuidakker_preload_assets', 1 );

/**
 * Set Dutch as default language
 */
add_filter( 'locale', function() { return 'nl_NL'; } );

/**
 * Set HTML lang attribute to Dutch for proper hyphenation
 */
function zuidakker_set_html_lang( $output ) {
    return str_replace( 'lang="en-US"', 'lang="nl-NL"', $output );
}
add_filter( 'language_attributes', 'zuidakker_set_html_lang' );

/**
 * Load theme textdomain
 */
function zuidakker_load_textdomain() {
    load_child_theme_textdomain( 'zuidakker-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'zuidakker_load_textdomain' );

/**
 * Add favicon
 */
function zuidakker_add_favicon() {
    $favicon_url = get_stylesheet_directory_uri() . '/assets/logo/De Zuidakker_Beeldmerk #6F9355.png';
    echo '<link rel="icon" type="image/png" href="' . esc_url( $favicon_url ) . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url( $favicon_url ) . '">' . "\n";
}
add_action( 'wp_head', 'zuidakker_add_favicon' );
add_action( 'admin_head', 'zuidakker_add_favicon' );

/**
 * Customize footer credits - Remove Kadence links
 * Manageable via wp-admin > Appearance > Customize > ⚙️ Algemene Instellingen
 */
function zuidakker_custom_footer_credits() {
    return get_theme_mod( 'zuidakker_footer_text', '© ' . date('Y') . ' De Zuidakker' );
}
add_filter( 'kadence_footer_credit', 'zuidakker_custom_footer_credits' );

/**
 * Remove Kadence theme attribution completely
 */
add_filter( 'kadence_footer_html', function() {
    return get_theme_mod( 'zuidakker_footer_text', '© ' . date('Y') . ' De Zuidakker' );
}, 20 );

/**
 * Add performance and security headers
 */
function zuidakker_add_headers() {
    if ( ! is_admin() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( 'X-XSS-Protection: 1; mode=block' );
    }
}
add_action( 'send_headers', 'zuidakker_add_headers' );

/**
 * Security: Remove WordPress version
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Optimize WordPress performance
 */
function zuidakker_optimize_performance() {
    // Remove emoji scripts
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    
    // Remove unnecessary WordPress features
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    
    // Disable embeds
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
}
add_action( 'init', 'zuidakker_optimize_performance' );

/**
 * Defer non-critical JavaScript
 */
function zuidakker_defer_scripts( $tag, $handle, $src ) {
    // Skip admin and jQuery
    if ( is_admin() || strpos( $handle, 'jquery' ) !== false ) {
        return $tag;
    }
    
    // Defer non-critical scripts
    return str_replace( ' src', ' defer src', $tag );
}
add_filter( 'script_loader_tag', 'zuidakker_defer_scripts', 10, 3 );

/**
 * Suppress PHP deprecation warnings in production
 */
if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
    error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT );
    ini_set( 'display_errors', '0' );
}
