<?php
/**
 * Sitemap Shortcode - KISS
 * Display hierarchical page tree
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Sitemap tree shortcode
 * Usage: [sitemap_tree]
 */
function zuidakker_sitemap_tree_shortcode() {
    ob_start();
    
    // Get all published pages
    $pages = get_pages( array(
        'sort_column' => 'menu_order, post_title',
        'post_status' => 'publish',
    ) );
    
    if ( ! $pages ) {
        echo '<p>' . esc_html__( 'Geen pagina\'s gevonden.', 'zuidakker-child' ) . '</p>';
        return ob_get_clean();
    }
    
    // Define page groups
    $pillar_slugs = array( 'tuinen', 'geschiedenis', 'ontmoeting', 'educatie', 'verblijf' );
    $shop_slugs = array( 'shop', 'winkel', 'my-account', 'mijn-account', 'checkout', 'cart', 'winkelwagen' );
    $general_slugs = array( 'agenda', 'contact', 'sitemap', 'welkom-bij-zuidakker' );
    
    // Organize pages into groups
    $pillar_pages = array();
    $shop_pages = array();
    $general_pages = array();
    $other_pages = array();
    
    foreach ( $pages as $page ) {
        $slug = $page->post_name;
        
        if ( in_array( $slug, $pillar_slugs ) ) {
            $pillar_pages[] = $page;
        } elseif ( in_array( $slug, $shop_slugs ) ) {
            $shop_pages[] = $page;
        } elseif ( in_array( $slug, $general_slugs ) ) {
            $general_pages[] = $page;
        } else {
            $other_pages[] = $page;
        }
    }
    ?>
    <div class="sitemap-tree">
        
        <?php if ( ! empty( $pillar_pages ) ) : ?>
            <div class="sitemap-group">
                <h3 class="sitemap-group-title">🌿 De Vijf Pijlers</h3>
                <ul class="sitemap-list">
                    <?php zuidakker_display_grouped_pages( $pillar_pages, $pillar_slugs ); ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if ( ! empty( $shop_pages ) ) : ?>
            <div class="sitemap-group">
                <h3 class="sitemap-group-title">🛒 Winkel</h3>
                <ul class="sitemap-list">
                    <?php zuidakker_display_grouped_pages( $shop_pages, array() ); ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if ( ! empty( $general_pages ) ) : ?>
            <div class="sitemap-group">
                <h3 class="sitemap-group-title">📄 Algemeen</h3>
                <ul class="sitemap-list">
                    <?php zuidakker_display_grouped_pages( $general_pages, array() ); ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if ( ! empty( $other_pages ) ) : ?>
            <div class="sitemap-group">
                <h3 class="sitemap-group-title">📑 Overige Pagina's</h3>
                <ul class="sitemap-list">
                    <?php zuidakker_display_grouped_pages( $other_pages, array() ); ?>
                </ul>
            </div>
        <?php endif; ?>
        
    </div>
    
    <style>
    .sitemap-tree {
        margin: 0;
        max-width: 100%;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
        background: transparent;
        padding: 0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: var(--space-lg, 1.5rem);
    }
    
    .sitemap-group {
        background: var(--pillar-sitemap-secondary, #4a7c59);
        border-radius: var(--radius-xl, 1rem);
        padding: var(--space-xl, 2rem);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all var(--transition-base, 250ms);
    }
    
    .sitemap-group:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
        background: var(--pillar-sitemap-light, #5a9668);
    }
    
    .sitemap-group-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 var(--space-md, 1rem) 0;
        letter-spacing: -0.02em;
        padding-bottom: var(--space-sm, 0.5rem);
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    }
    
    .sitemap-list {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }
    
    .sitemap-list ul {
        list-style: none;
        padding-left: var(--space-xl, 2rem);
        margin-top: var(--space-sm, 0.5rem);
        margin-bottom: var(--space-sm, 0.5rem);
        border-left: 2px solid rgba(0, 0, 0, 0.08);
    }
    
    .sitemap-list li {
        margin: var(--space-xs, 0.25rem) 0;
        position: relative;
        padding: var(--space-sm, 0.5rem) 0;
        transition: all var(--transition-fast, 150ms);
    }
    
    .sitemap-list li:hover {
        transform: translateX(4px);
    }
    
    .sitemap-list li::before {
        content: "•";
        margin-right: var(--space-sm, 0.5rem);
        color: rgba(255, 255, 255, 0.5);
        font-size: 1.25rem;
        line-height: 1;
    }
    
    .sitemap-list li.has-children::before {
        content: "▸";
        color: rgba(255, 255, 255, 0.6);
    }
    
    .sitemap-list a {
        color: rgba(255, 255, 255, 0.95);
        text-decoration: none;
        font-weight: 500;
        font-size: 1rem;
        transition: color var(--transition-fast, 150ms);
        line-height: 1.6;
    }
    
    .sitemap-list a:hover {
        color: #fff;
        text-decoration: underline;
    }
    
    .sitemap-list .page-description {
        display: block;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.875rem;
        margin-top: var(--space-xs, 0.25rem);
        margin-left: 48px;
        font-style: italic;
        line-height: 1.5;
        font-weight: 400;
    }
    
    /* Pillar pages - simple and clean */
    .sitemap-list .pillar-tuinen::before {
        content: "🌱";
        color: var(--pillar-tuinen-primary, #97bf85);
        font-size: 1.25rem;
    }
    
    .sitemap-list .pillar-tuinen a {
        color: var(--pillar-tuinen-secondary, #6f9357);
        font-weight: 600;
    }
    
    .sitemap-list .pillar-geschiedenis::before {
        content: "📚";
        color: var(--pillar-geschiedenis-primary, #c27d55);
        font-size: 1.25rem;
    }
    
    .sitemap-list .pillar-geschiedenis a {
        color: var(--pillar-geschiedenis-secondary, #b4412f);
        font-weight: 600;
    }
    
    .sitemap-list .pillar-ontmoeting::before {
        content: "🤝";
        color: var(--pillar-ontmoeting-primary, #6ba7b6);
        font-size: 1.25rem;
    }
    
    .sitemap-list .pillar-ontmoeting a {
        color: var(--pillar-ontmoeting-secondary, #2a677e);
        font-weight: 600;
    }
    
    .sitemap-list .pillar-educatie::before {
        content: "🍎";
        color: var(--pillar-educatie-primary, #f0a85f);
        font-size: 1.25rem;
    }
    
    .sitemap-list .pillar-educatie a {
        color: var(--pillar-educatie-secondary, #d97225);
        font-weight: 600;
    }
    
    .sitemap-list .pillar-verblijf::before {
        content: "�";
        color: var(--pillar-verblijf-primary, #d98c8c);
        font-size: 1.25rem;
    }
    
    .sitemap-list .pillar-verblijf a {
        color: var(--pillar-verblijf-secondary, #b35a5a);
        font-weight: 600;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .sitemap-list ul {
            padding-left: var(--space-lg, 1.5rem);
        }
        
        .sitemap-list a {
            font-size: 0.9375rem;
        }
    }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode( 'sitemap_tree', 'zuidakker_sitemap_tree_shortcode' );

/**
 * Display grouped pages
 */
function zuidakker_display_grouped_pages( $pages, $pillar_slugs = array() ) {
    foreach ( $pages as $page ) {
        $page_slug = $page->post_name;
        $pillar_class = in_array( $page_slug, $pillar_slugs ) ? 'pillar-' . $page_slug : '';
        
        echo '<li class="' . esc_attr( $pillar_class ) . '">';
        echo '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">';
        echo esc_html( $page->post_title );
        echo '</a>';
        
        // Add excerpt if available
        if ( $page->post_excerpt ) {
            echo '<span class="page-description">' . esc_html( $page->post_excerpt ) . '</span>';
        }
        
        echo '</li>';
    }
}

/**
 * Display page tree recursively (kept for backward compatibility)
 */
function zuidakker_display_page_tree( $pages, $parent_id = 0 ) {
    $pillars = array( 'tuinen', 'geschiedenis', 'ontmoeting', 'educatie', 'verblijf' );
    
    foreach ( $pages as $page ) {
        if ( $page->post_parent == $parent_id ) {
            // Check if page has children
            $has_children = false;
            foreach ( $pages as $child ) {
                if ( $child->post_parent == $page->ID ) {
                    $has_children = true;
                    break;
                }
            }
            
            // Get page slug for pillar detection
            $page_slug = $page->post_name;
            $pillar_class = in_array( $page_slug, $pillars ) ? 'pillar-' . $page_slug : '';
            
            // Output page
            $li_class = $has_children ? 'has-children' : '';
            $li_class .= $pillar_class ? ' ' . $pillar_class : '';
            
            echo '<li class="' . esc_attr( $li_class ) . '">';
            echo '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">';
            echo esc_html( $page->post_title );
            echo '</a>';
            
            // Add excerpt if available
            if ( $page->post_excerpt ) {
                echo '<span class="page-description">' . esc_html( $page->post_excerpt ) . '</span>';
            }
            
            // Display children
            if ( $has_children ) {
                echo '<ul>';
                zuidakker_display_page_tree( $pages, $page->ID );
                echo '</ul>';
            }
            
            echo '</li>';
        }
    }
}

/**
 * Alternative: Simple list sitemap
 * Usage: [sitemap_simple]
 */
function zuidakker_sitemap_simple_shortcode() {
    ob_start();
    ?>
    <div class="sitemap-simple">
        <ul>
            <?php
            wp_list_pages( array(
                'title_li' => '',
                'depth' => 0,
                'sort_column' => 'menu_order, post_title',
            ) );
            ?>
        </ul>
    </div>
    
    <style>
    .sitemap-simple {
        margin: var(--space-2xl, 3rem) 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.98));
        padding: var(--space-2xl, 3rem);
        border-radius: var(--radius-xl, 1rem);
        box-shadow: var(--shadow-lg, 0 10px 25px rgba(0, 0, 0, 0.1));
        backdrop-filter: blur(10px);
    }
    
    .sitemap-simple ul {
        list-style: none;
        padding-left: 0;
    }
    
    .sitemap-simple ul ul {
        padding-left: var(--space-2xl, 3rem);
        margin-top: var(--space-md, 1rem);
        border-left: 3px solid rgba(76, 175, 80, 0.2);
    }
    
    .sitemap-simple li {
        margin: var(--space-md, 1rem) 0;
        padding: var(--space-sm, 0.5rem) var(--space-md, 1rem);
        border-radius: var(--radius-md, 0.5rem);
        transition: all var(--transition-base, 250ms);
    }
    
    .sitemap-simple li:hover {
        background: rgba(76, 175, 80, 0.05);
        transform: translateX(4px);
    }
    
    .sitemap-simple a {
        color: var(--pillar-sitemap-primary, #2c5530);
        text-decoration: none;
        font-weight: 600;
        font-size: 1.05rem;
        transition: all var(--transition-fast, 150ms);
        display: inline-block;
        position: relative;
        letter-spacing: -0.01em;
    }
    
    .sitemap-simple a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, 
            var(--pillar-sitemap-primary, #2c5530), 
            var(--pillar-sitemap-secondary, #4a7c59));
        transition: width var(--transition-base, 250ms);
        border-radius: var(--radius-full, 9999px);
    }
    
    .sitemap-simple a:hover {
        color: var(--pillar-sitemap-secondary, #4a7c59);
        transform: translateX(2px);
    }
    
    .sitemap-simple a:hover::after {
        width: 100%;
    }
    
    @media (max-width: 768px) {
        .sitemap-simple {
            padding: var(--space-lg, 1.5rem);
            margin: var(--space-lg, 1.5rem) 0;
        }
        
        .sitemap-simple ul ul {
            padding-left: var(--space-lg, 1.5rem);
        }
        
        .sitemap-simple li {
            padding: var(--space-xs, 0.25rem) var(--space-sm, 0.5rem);
        }
        
        .sitemap-simple a {
            font-size: 1rem;
        }
    }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode( 'sitemap_simple', 'zuidakker_sitemap_simple_shortcode' );
