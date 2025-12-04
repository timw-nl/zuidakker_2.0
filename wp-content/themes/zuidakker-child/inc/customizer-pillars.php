<?php
/**
 * Customizer Settings for 5-Pillar Design System
 * 
 * Allows managing pillar configuration from wp-admin > Appearance > Customize
 * 
 * @package Zuidakker
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Default pillar configuration
 */
function zuidakker_get_pillar_defaults() {
    return array(
        'tuinen' => array(
            'name'        => 'Tuinen',
            'subtitle'    => 'Gardens',
            'icon'        => '🌱',
            'description' => 'Ontdek de tuinen van RKBS Kaskade basisschool bij Zuidakker.',
            'primary'     => '#97bf85',
            'secondary'   => '#6f9357',
            'light'       => '#b8d9a8',
            'dark'        => '#4a6b3d',
        ),
        'geschiedenis' => array(
            'name'        => 'Geschiedenis',
            'subtitle'    => 'History',
            'icon'        => '🏛️',
            'description' => 'Ontdek de geschiedenis van activiteiten op Zuideinde 112 van de familie Warmerdam en de Zuidakker.',
            'primary'     => '#c27d55',
            'secondary'   => '#b4412f',
            'light'       => '#d9a68a',
            'dark'        => '#8a3020',
        ),
        'ontmoeting' => array(
            'name'        => 'Ontmoeting',
            'subtitle'    => 'Meeting',
            'icon'        => '🌊',
            'description' => 'Ontmoetingsplek aan de waterkant voor vergaderingen en volkstuinen.',
            'primary'     => '#6ba7b6',
            'secondary'   => '#2a677e',
            'light'       => '#9cc8d4',
            'dark'        => '#1a4d5e',
        ),
        'educatie' => array(
            'name'        => 'Voedseleducatie',
            'subtitle'    => 'Food Education',
            'icon'        => '🎓',
            'description' => 'Educatief programma over duurzame voedselproductie bij Zuidakker.',
            'primary'     => '#f0a85f',
            'secondary'   => '#d97225',
            'light'       => '#ffc88f',
            'dark'        => '#b85510',
        ),
        'verblijf' => array(
            'name'        => 'Verblijf',
            'subtitle'    => 'Stays',
            'icon'        => '🏠',
            'description' => 'Korte verblijven, camping en accommodatie zoals boothuizen bij Zuidakker.',
            'primary'     => '#d98c8c',
            'secondary'   => '#b35a5a',
            'light'       => '#f0b3b3',
            'dark'        => '#8a3a3a',
        ),
    );
}

/**
 * Register Customizer settings for pillars
 */
function zuidakker_customize_register_pillars( $wp_customize ) {
    
    $defaults = zuidakker_get_pillar_defaults();
    $pillar_keys = array_keys( $defaults );
    
    // Add main panel for Zuidakker settings
    $wp_customize->add_panel( 'zuidakker_pillars_panel', array(
        'title'       => __( '🌿 Zuidakker Pijlers', 'zuidakker-child' ),
        'description' => __( 'Beheer de 5 pijlers van Zuidakker: namen, iconen, kleuren en beschrijvingen.', 'zuidakker-child' ),
        'priority'    => 30,
    ) );
    
    // Create sections and settings for each pillar
    foreach ( $pillar_keys as $index => $slug ) {
        $pillar = $defaults[ $slug ];
        $section_id = 'zuidakker_pillar_' . $slug;
        
        // Add section for this pillar
        $wp_customize->add_section( $section_id, array(
            'title'    => sprintf( '%s %s', $pillar['icon'], $pillar['name'] ),
            'panel'    => 'zuidakker_pillars_panel',
            'priority' => ( $index + 1 ) * 10,
        ) );
        
        // --- Text Settings ---
        
        // Name
        $wp_customize->add_setting( "zuidakker_pillar_{$slug}_name", array(
            'default'           => $pillar['name'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( "zuidakker_pillar_{$slug}_name", array(
            'label'   => __( 'Naam', 'zuidakker-child' ),
            'section' => $section_id,
            'type'    => 'text',
        ) );
        
        // Subtitle
        $wp_customize->add_setting( "zuidakker_pillar_{$slug}_subtitle", array(
            'default'           => $pillar['subtitle'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( "zuidakker_pillar_{$slug}_subtitle", array(
            'label'   => __( 'Ondertitel (Engels)', 'zuidakker-child' ),
            'section' => $section_id,
            'type'    => 'text',
        ) );
        
        // Icon
        $wp_customize->add_setting( "zuidakker_pillar_{$slug}_icon", array(
            'default'           => $pillar['icon'],
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( "zuidakker_pillar_{$slug}_icon", array(
            'label'       => __( 'Icoon (Emoji)', 'zuidakker-child' ),
            'description' => __( 'Gebruik een emoji zoals 🌱, 🏛️, 🌊, 🎓, 🏠', 'zuidakker-child' ),
            'section'     => $section_id,
            'type'        => 'text',
        ) );
        
        // Description
        $wp_customize->add_setting( "zuidakker_pillar_{$slug}_description", array(
            'default'           => $pillar['description'],
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( "zuidakker_pillar_{$slug}_description", array(
            'label'   => __( 'Beschrijving', 'zuidakker-child' ),
            'section' => $section_id,
            'type'    => 'textarea',
        ) );
        
        // --- Color Settings ---
        
        // Primary Color
        $wp_customize->add_setting( "zuidakker_pillar_{$slug}_primary", array(
            'default'           => $pillar['primary'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, "zuidakker_pillar_{$slug}_primary", array(
            'label'   => __( 'Primaire kleur', 'zuidakker-child' ),
            'section' => $section_id,
        ) ) );
        
        // Secondary Color
        $wp_customize->add_setting( "zuidakker_pillar_{$slug}_secondary", array(
            'default'           => $pillar['secondary'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, "zuidakker_pillar_{$slug}_secondary", array(
            'label'   => __( 'Secundaire kleur', 'zuidakker-child' ),
            'section' => $section_id,
        ) ) );
        
        // Light Color
        $wp_customize->add_setting( "zuidakker_pillar_{$slug}_light", array(
            'default'           => $pillar['light'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, "zuidakker_pillar_{$slug}_light", array(
            'label'   => __( 'Lichte kleur', 'zuidakker-child' ),
            'section' => $section_id,
        ) ) );
        
        // Dark Color
        $wp_customize->add_setting( "zuidakker_pillar_{$slug}_dark", array(
            'default'           => $pillar['dark'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, "zuidakker_pillar_{$slug}_dark", array(
            'label'   => __( 'Donkere kleur', 'zuidakker-child' ),
            'section' => $section_id,
        ) ) );
    }
    
    // --- General Settings Section ---
    $wp_customize->add_section( 'zuidakker_general_settings', array(
        'title'    => __( '⚙️ Algemene Instellingen', 'zuidakker-child' ),
        'panel'    => 'zuidakker_pillars_panel',
        'priority' => 100,
    ) );
    
    // Header Green
    $wp_customize->add_setting( 'zuidakker_header_green', array(
        'default'           => '#3d5e41',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'zuidakker_header_green', array(
        'label'   => __( 'Header kleur', 'zuidakker-child' ),
        'section' => 'zuidakker_general_settings',
    ) ) );
    
    // Header Dark Green
    $wp_customize->add_setting( 'zuidakker_header_dark_green', array(
        'default'           => '#2c4730',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'zuidakker_header_dark_green', array(
        'label'   => __( 'Header donkere kleur', 'zuidakker-child' ),
        'section' => 'zuidakker_general_settings',
    ) ) );
    
    // Sitemap Primary
    $wp_customize->add_setting( 'zuidakker_sitemap_primary', array(
        'default'           => '#2c5530',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'zuidakker_sitemap_primary', array(
        'label'   => __( 'Sitemap primaire kleur', 'zuidakker-child' ),
        'section' => 'zuidakker_general_settings',
    ) ) );
    
    // Sitemap Secondary
    $wp_customize->add_setting( 'zuidakker_sitemap_secondary', array(
        'default'           => '#4a7c59',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'zuidakker_sitemap_secondary', array(
        'label'   => __( 'Sitemap secundaire kleur', 'zuidakker-child' ),
        'section' => 'zuidakker_general_settings',
    ) ) );
}
add_action( 'customize_register', 'zuidakker_customize_register_pillars' );

/**
 * Get pillar setting from Customizer with fallback to default
 */
function zuidakker_get_pillar_setting( $slug, $key ) {
    $defaults = zuidakker_get_pillar_defaults();
    $default_value = isset( $defaults[ $slug ][ $key ] ) ? $defaults[ $slug ][ $key ] : '';
    
    return get_theme_mod( "zuidakker_pillar_{$slug}_{$key}", $default_value );
}

/**
 * Get all pillars with Customizer values
 */
function zuidakker_get_pillars_from_customizer() {
    static $pillars = null;
    
    if ( $pillars === null ) {
        $defaults = zuidakker_get_pillar_defaults();
        $pillars = array();
        
        foreach ( $defaults as $slug => $default ) {
            $pillars[ $slug ] = array(
                'name'        => zuidakker_get_pillar_setting( $slug, 'name' ),
                'subtitle'    => zuidakker_get_pillar_setting( $slug, 'subtitle' ),
                'icon'        => zuidakker_get_pillar_setting( $slug, 'icon' ),
                'description' => zuidakker_get_pillar_setting( $slug, 'description' ),
                'primary'     => zuidakker_get_pillar_setting( $slug, 'primary' ),
                'secondary'   => zuidakker_get_pillar_setting( $slug, 'secondary' ),
                'light'       => zuidakker_get_pillar_setting( $slug, 'light' ),
                'dark'        => zuidakker_get_pillar_setting( $slug, 'dark' ),
            );
        }
    }
    
    return $pillars;
}

/**
 * Generate dynamic CSS from Customizer settings
 */
function zuidakker_generate_dynamic_css() {
    $pillars = zuidakker_get_pillars_from_customizer();
    
    // General settings
    $header_green      = get_theme_mod( 'zuidakker_header_green', '#3d5e41' );
    $header_dark_green = get_theme_mod( 'zuidakker_header_dark_green', '#2c4730' );
    $sitemap_primary   = get_theme_mod( 'zuidakker_sitemap_primary', '#2c5530' );
    $sitemap_secondary = get_theme_mod( 'zuidakker_sitemap_secondary', '#4a7c59' );
    
    ob_start();
    ?>
    <style id="zuidakker-dynamic-css">
    :root {
        <?php foreach ( $pillars as $slug => $pillar ) : ?>
        /* <?php echo esc_html( $pillar['name'] ); ?> */
        --pillar-<?php echo esc_attr( $slug ); ?>-primary: <?php echo esc_attr( $pillar['primary'] ); ?>;
        --pillar-<?php echo esc_attr( $slug ); ?>-secondary: <?php echo esc_attr( $pillar['secondary'] ); ?>;
        --pillar-<?php echo esc_attr( $slug ); ?>-light: <?php echo esc_attr( $pillar['light'] ); ?>;
        --pillar-<?php echo esc_attr( $slug ); ?>-dark: <?php echo esc_attr( $pillar['dark'] ); ?>;
        
        <?php endforeach; ?>
        
        /* Sitemap */
        --pillar-sitemap-primary: <?php echo esc_attr( $sitemap_primary ); ?>;
        --pillar-sitemap-secondary: <?php echo esc_attr( $sitemap_secondary ); ?>;
        
        /* Header */
        --header-green: <?php echo esc_attr( $header_green ); ?>;
        --header-dark-green: <?php echo esc_attr( $header_dark_green ); ?>;
    }
    </style>
    <?php
    echo ob_get_clean();
}
add_action( 'wp_head', 'zuidakker_generate_dynamic_css', 100 );

/**
 * Enqueue Customizer preview script for live updates
 */
function zuidakker_customizer_preview_js() {
    wp_enqueue_script(
        'zuidakker-customizer-preview',
        get_stylesheet_directory_uri() . '/assets/js/customizer-preview.js',
        array( 'customize-preview', 'jquery' ),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'customize_preview_init', 'zuidakker_customizer_preview_js' );
