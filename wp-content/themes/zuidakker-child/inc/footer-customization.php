<?php
/**
 * Footer Customization - KISS
 * Add sitemap link to footer
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add sitemap link to footer
 */
function zuidakker_add_sitemap_to_footer() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find footer element
        var footer = document.querySelector('.site-footer, footer, #colophon');
        
        if (footer) {
            // Check if sitemap link already exists
            if (footer.querySelector('.sitemap-link')) {
                return;
            }
            
            // Create sitemap link container
            var sitemapContainer = document.createElement('div');
            sitemapContainer.className = 'footer-sitemap-link';
            
            // Create link
            var sitemapLink = document.createElement('a');
            sitemapLink.href = '<?php echo esc_url( home_url( '/sitemap' ) ); ?>';
            sitemapLink.className = 'sitemap-link';
            sitemapLink.textContent = '<?php echo esc_html__( 'Sitemap', 'zuidakker-child' ); ?>';
            
            sitemapContainer.appendChild(sitemapLink);
            
            // Add to footer
            footer.appendChild(sitemapContainer);
        }
    });
    </script>
    
    <style>
    .footer-sitemap-link {
        text-align: right;
        padding: 1rem;
        margin-top: 1rem;
    }
    
    .footer-sitemap-link .sitemap-link {
        color: var(--pillar-sitemap-primary, #2c5530);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }
    
    .footer-sitemap-link .sitemap-link:hover {
        color: var(--pillar-sitemap-secondary, #4a7c59);
        text-decoration: underline;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .footer-sitemap-link {
            text-align: center;
        }
    }
    </style>
    <?php
}
add_action( 'wp_footer', 'zuidakker_add_sitemap_to_footer' );
