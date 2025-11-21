<?php
/**
 * Custom Post Types - KISS
 * Register Geschiedenis and Activiteiten CPTs
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register custom post types
 */
function zuidakker_register_cpts() {
    // Geschiedenis (History)
    register_post_type( 'geschiedenis', array(
        'labels' => array(
            'name' => __( 'Geschiedenis Items', 'zuidakker-child' ),
            'singular_name' => __( 'Geschiedenis Item', 'zuidakker-child' ),
            'menu_name' => __( 'Geschiedenis', 'zuidakker-child' ),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'menu_position' => 5,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'geschiedenis-item' ),
    ) );
    
    // Activiteiten (Activities)
    register_post_type( 'activiteit', array(
        'labels' => array(
            'name' => __( 'Activiteiten', 'zuidakker-child' ),
            'singular_name' => __( 'Activiteit', 'zuidakker-child' ),
            'menu_name' => __( 'Activiteiten', 'zuidakker-child' ),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-location',
        'menu_position' => 6,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest' => true,
        'taxonomies' => array( 'category' ),
        'rewrite' => array( 'slug' => 'activiteit' ),
    ) );
}
add_action( 'init', 'zuidakker_register_cpts' );
