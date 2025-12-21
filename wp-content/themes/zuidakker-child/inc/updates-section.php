<?php
/**
 * Updates Section - Homepage Updates Container
 * Allows content administrators to add updates via WordPress Customizer
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register Customizer settings for updates section
 */
function zuidakker_customize_register_updates( $wp_customize ) {
    
    // Add section for Updates
    $wp_customize->add_section( 'zuidakker_updates_section', array(
        'title'       => __( '📢 Homepage Updates', 'zuidakker-child' ),
        'description' => __( 'Beheer de updates sectie op de homepage. Deze verschijnt onder de pijlers.', 'zuidakker-child' ),
        'priority'    => 35,
    ) );
    
    // Enable/Disable Updates Section
    $wp_customize->add_setting( 'zuidakker_updates_enabled', array(
        'default'           => '1',
        'sanitize_callback' => 'absint',
        'type'              => 'theme_mod',
    ) );
    $wp_customize->add_control( 'zuidakker_updates_enabled', array(
        'label'   => __( 'Toon Updates Sectie', 'zuidakker-child' ),
        'section' => 'zuidakker_updates_section',
        'type'    => 'checkbox',
    ) );
    
    // Updates Title
    $wp_customize->add_setting( 'zuidakker_updates_title', array(
        'default'           => 'Laatste Updates',
        'sanitize_callback' => 'sanitize_text_field',
        'type'              => 'theme_mod',
    ) );
    $wp_customize->add_control( 'zuidakker_updates_title', array(
        'label'   => __( 'Titel', 'zuidakker-child' ),
        'section' => 'zuidakker_updates_section',
        'type'    => 'text',
    ) );
    
    // Updates Content
    $wp_customize->add_setting( 'zuidakker_updates_content', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'zuidakker_updates_content', array(
        'label'       => __( 'Inhoud', 'zuidakker-child' ),
        'description' => __( 'Tekst invoeren voor updates sectie', 'zuidakker-child' ),
        'section'     => 'zuidakker_updates_section',
        'type'        => 'textarea',
    ) );
    
    // Background Color
    $wp_customize->add_setting( 'zuidakker_updates_bg_color', array(
        'default'           => 'rgba(255, 255, 255, 0.15)',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'zuidakker_updates_bg_color', array(
        'label'       => __( 'Achtergrondkleur (RGBA)', 'zuidakker-child' ),
        'description' => __( 'Bijv: rgba(255, 255, 255, 0.15)', 'zuidakker-child' ),
        'section'     => 'zuidakker_updates_section',
        'type'        => 'text',
    ) );
    
    // Text Color
    $wp_customize->add_setting( 'zuidakker_updates_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zuidakker_updates_text_color', array(
        'label'   => __( 'Tekstkleur', 'zuidakker-child' ),
        'section' => 'zuidakker_updates_section',
    ) ) );
}
add_action( 'customize_register', 'zuidakker_customize_register_updates' );

/**
 * Updates section shortcode
 * Usage: [updates_section]
 */
function zuidakker_updates_section_shortcode() {
    // Check if updates section is enabled (try admin page first, then Customizer)
    $enabled = get_option( 'zuidakker_updates_enabled', get_theme_mod( 'zuidakker_updates_enabled', '1' ) );
    if ( ! $enabled || $enabled === '0' ) {
        return '';
    }
    
    // Get settings from admin page first, fallback to Customizer
    $title = get_option( 'zuidakker_updates_title', get_theme_mod( 'zuidakker_updates_title', 'Laatste Updates' ) );
    $content = get_option( 'zuidakker_updates_content', get_theme_mod( 'zuidakker_updates_content', '' ) );
    $display_mode = get_option( 'zuidakker_updates_display_mode', 'custom' );
    $posts_count = get_option( 'zuidakker_updates_posts_count', '3' );
    $posts_category = get_option( 'zuidakker_updates_posts_category', '' );
    $bg_color = get_option( 'zuidakker_updates_bg_color', get_theme_mod( 'zuidakker_updates_bg_color', 'rgba(255, 255, 255, 0.15)' ) );
    $text_color = get_option( 'zuidakker_updates_text_color', get_theme_mod( 'zuidakker_updates_text_color', '#ffffff' ) );
    
    // Don't show if no content and mode is custom
    if ( $display_mode === 'custom' && empty( $content ) ) {
        return '';
    }
    
    ob_start();
    ?>
    <div class="updates-section" style="--updates-bg-color: <?php echo esc_attr( $bg_color ); ?>; --updates-text-color: <?php echo esc_attr( $text_color ); ?>;">
        <div class="updates-container">
            <?php if ( ! empty( $title ) ) : ?>
                <h2 class="updates-title"><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>
            
            <?php if ( $display_mode === 'custom' || $display_mode === 'both' ) : ?>
                <?php if ( ! empty( $content ) ) : ?>
                    <div class="updates-content">
                        <?php echo wp_kses_post( $content ); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php if ( $display_mode === 'posts' || $display_mode === 'both' ) : ?>
                <?php
                // Query posts
                $args = array(
                    'posts_per_page' => absint( $posts_count ),
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                
                if ( ! empty( $posts_category ) ) {
                    $args['cat'] = absint( $posts_category );
                }
                
                $posts_query = new WP_Query( $args );
                
                if ( $posts_query->have_posts() ) : ?>
                    <div class="updates-posts">
                        <?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
                            <article class="update-post">
                                <div class="update-post-header">
                                    <h3 class="update-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <time class="update-post-date" datetime="<?php echo get_the_date( 'c' ); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </div>
                                <?php if ( has_excerpt() ) : ?>
                                    <div class="update-post-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" class="update-post-link">Lees meer →</a>
                            </article>
                        <?php endwhile; ?>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'updates_section', 'zuidakker_updates_section_shortcode' );
