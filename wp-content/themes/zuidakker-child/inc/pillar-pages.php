<?php
/**
 * Pillar Pages - KISS
 * Body classes and pillar grid shortcode
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add body class for pillar pages
 */
function zuidakker_pillar_body_class( $classes ) {
    if ( ! is_page() ) {
        return $classes;
    }
    
    global $post;
    $pillars = array_keys( zuidakker_get_pillars() );
    $pillars[] = 'sitemap'; // Add sitemap
    
    if ( in_array( $post->post_name, $pillars ) ) {
        $classes[] = 'page-' . $post->post_name;
    }
    
    return $classes;
}
add_filter( 'body_class', 'zuidakker_pillar_body_class' );

/**
 * Pillar grid shortcode
 * Usage: [pillars_grid]
 */
function zuidakker_pillars_grid_shortcode() {
    $pillars = zuidakker_get_pillars();
    
    ob_start();
    ?>
    <div class="pillars-container">
        <div class="pillars-grid">
            <?php foreach ( $pillars as $slug => $pillar ) : ?>
                <a href="<?php echo esc_url( home_url( '/' . $slug ) ); ?>" class="pillar-card pillar-<?php echo esc_attr( $slug ); ?>">
                    <div class="pillar-card-icon"><?php echo $pillar['icon']; ?></div>
                    <h3><?php echo esc_html( $pillar['name'] ); ?></h3>
                    <div class="subtitle"><?php echo esc_html( $pillar['subtitle'] ); ?></div>
                    <p><?php echo esc_html( $pillar['description'] ); ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'pillars_grid', 'zuidakker_pillars_grid_shortcode' );
