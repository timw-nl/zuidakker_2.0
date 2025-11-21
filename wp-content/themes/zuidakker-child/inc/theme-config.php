<?php
/**
 * Theme Configuration - KISS
 * Basic theme setup and configuration
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Pillar pages configuration
 */
function zuidakker_get_pillars() {
    return array(
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

/**
 * Enqueue styles
 */
function zuidakker_enqueue_styles() {
    $parent_version = wp_get_theme()->parent()->get('Version');
    $child_version = wp_get_theme()->get('Version');
    
    wp_enqueue_style( 'kadence-style', get_template_directory_uri() . '/style.css', array(), $parent_version );
    wp_enqueue_style( 'zuidakker-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'kadence-style' ), $child_version );
}
add_action( 'wp_enqueue_scripts', 'zuidakker_enqueue_styles' );

/**
 * Set Dutch as default language
 */
add_filter( 'locale', function() { return 'nl_NL'; } );

/**
 * Load theme textdomain
 */
function zuidakker_load_textdomain() {
    load_child_theme_textdomain( 'zuidakker-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'zuidakker_load_textdomain' );

/**
 * Security: Remove WordPress version
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Suppress PHP deprecation warnings
 */
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT );
ini_set( 'display_errors', '0' );
