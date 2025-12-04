<?php
/**
 * Header Customization - KISS
 * Add sitemap link to header
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add sitemap link to header (optimized with icon)
 */
function zuidakker_add_sitemap_to_header() {
    $sitemap_url = esc_url( home_url( '/sitemap' ) );
    $sitemap_label = esc_js( __( 'Sitemap', 'zuidakker-child' ) );
    ?>
    <script>
    (function() {
        function addSitemapLink() {
            var header = document.querySelector('.site-header, header, #masthead');
            if (header && !header.querySelector('.sitemap-link')) {
                var container = document.createElement('div');
                container.className = 'header-sitemap-link';
                var link = document.createElement('a');
                link.href = '<?php echo $sitemap_url; ?>';
                link.className = 'sitemap-link';
                link.setAttribute('aria-label', '<?php echo $sitemap_label; ?>');
                link.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7v6h6"/><path d="M21 17a9 9 0 0 0-9-9 9 9 0 0 0-6 2.3L3 13"/></svg>';
                container.appendChild(link);
                var headerInner = header.querySelector('.site-container, .header-inner, .site-header-wrap');
                if (headerInner) {
                    headerInner.appendChild(container);
                } else {
                    header.appendChild(container);
                }
            }
        }
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', addSitemapLink);
        } else {
            addSitemapLink();
        }
    })();
    </script>
    <?php
}
add_action( 'wp_head', 'zuidakker_add_sitemap_to_header', 5 );
