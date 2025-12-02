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
        padding: var(--space-md, 1rem);
        margin-top: var(--space-lg, 1.5rem);
    }
    
    .footer-sitemap-link .sitemap-link {
        color: var(--pillar-sitemap-primary, #2c5530);
        text-decoration: none;
        font-size: 0.9375rem;
        font-weight: 600;
        transition: all var(--transition-fast, 150ms);
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs, 0.25rem);
        padding: var(--space-sm, 0.5rem) var(--space-md, 1rem);
        border-radius: var(--radius-lg, 0.75rem);
        background: linear-gradient(135deg, rgba(44, 85, 48, 0.05), rgba(44, 85, 48, 0.02));
        position: relative;
        letter-spacing: -0.01em;
    }
    
    .footer-sitemap-link .sitemap-link::before {
        content: '🗺️';
        font-size: 1.1rem;
        transition: transform var(--transition-base, 250ms);
    }
    
    .footer-sitemap-link .sitemap-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, 
            var(--pillar-sitemap-primary, #2c5530), 
            var(--pillar-sitemap-secondary, #4a7c59));
        transition: width var(--transition-base, 250ms);
        border-radius: var(--radius-full, 9999px);
    }
    
    .footer-sitemap-link .sitemap-link:hover {
        color: var(--pillar-sitemap-secondary, #4a7c59);
        background: linear-gradient(135deg, rgba(44, 85, 48, 0.1), rgba(44, 85, 48, 0.05));
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm, 0 1px 3px rgba(0, 0, 0, 0.08));
    }
    
    .footer-sitemap-link .sitemap-link:hover::before {
        transform: scale(1.1) rotate(-5deg);
    }
    
    .footer-sitemap-link .sitemap-link:hover::after {
        width: 100%;
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
