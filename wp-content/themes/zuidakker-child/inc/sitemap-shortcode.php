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
    ?>
    <div class="sitemap-tree">
        <?php
        // Get all published pages
        $pages = get_pages( array(
            'sort_column' => 'menu_order, post_title',
            'post_status' => 'publish',
        ) );
        
        if ( $pages ) {
            echo '<ul class="sitemap-list">';
            zuidakker_display_page_tree( $pages, 0 );
            echo '</ul>';
        } else {
            echo '<p>' . esc_html__( 'Geen pagina\'s gevonden.', 'zuidakker-child' ) . '</p>';
        }
        ?>
    </div>
    
    <style>
    .sitemap-tree {
        margin: 2rem 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    
    .sitemap-list {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }
    
    .sitemap-list ul {
        list-style: none;
        padding-left: 2rem;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        border-left: 2px solid #e0e0e0;
    }
    
    .sitemap-list li {
        margin: 0.5rem 0;
        position: relative;
    }
    
    .sitemap-list li::before {
        content: "📄";
        margin-right: 0.5rem;
        font-size: 1rem;
    }
    
    .sitemap-list li.has-children::before {
        content: "📁";
    }
    
    .sitemap-list a {
        color: var(--pillar-sitemap-primary, #2c5530);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .sitemap-list a:hover {
        color: var(--pillar-sitemap-secondary, #4a7c59);
        text-decoration: underline;
    }
    
    .sitemap-list .page-description {
        display: block;
        color: #666;
        font-size: 0.9rem;
        margin-top: 0.25rem;
        margin-left: 1.5rem;
        font-style: italic;
    }
    
    /* Pillar pages special styling */
    .sitemap-list .pillar-tuinen a {
        color: var(--pillar-tuinen-primary, #97bf85);
    }
    
    .sitemap-list .pillar-geschiedenis a {
        color: var(--pillar-geschiedenis-primary, #c27d55);
    }
    
    .sitemap-list .pillar-ontmoeting a {
        color: var(--pillar-ontmoeting-primary, #6ba7b6);
    }
    
    .sitemap-list .pillar-educatie a {
        color: var(--pillar-educatie-primary, #f0a85f);
    }
    
    .sitemap-list .pillar-verblijf a {
        color: var(--pillar-verblijf-primary, #d98c8c);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .sitemap-list ul {
            padding-left: 1.5rem;
        }
    }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode( 'sitemap_tree', 'zuidakker_sitemap_tree_shortcode' );

/**
 * Display page tree recursively
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
    .sitemap-simple ul {
        list-style: none;
        padding-left: 0;
    }
    
    .sitemap-simple ul ul {
        padding-left: 2rem;
        margin-top: 0.5rem;
    }
    
    .sitemap-simple li {
        margin: 0.5rem 0;
    }
    
    .sitemap-simple a {
        color: var(--pillar-sitemap-primary, #2c5530);
        text-decoration: none;
    }
    
    .sitemap-simple a:hover {
        color: var(--pillar-sitemap-secondary, #4a7c59);
        text-decoration: underline;
    }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode( 'sitemap_simple', 'zuidakker_sitemap_simple_shortcode' );
