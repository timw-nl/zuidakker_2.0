/**
 * Customizer Preview Script
 * Live preview updates for pillar settings
 */
(function($) {
    'use strict';

    var pillars = ['tuinen', 'geschiedenis', 'ontmoeting', 'educatie', 'verblijf'];
    var colorTypes = ['primary', 'secondary', 'light', 'dark'];

    // Update CSS variable helper
    function updateCSSVariable(varName, value) {
        document.documentElement.style.setProperty(varName, value);
    }

    // Bind color settings for each pillar
    pillars.forEach(function(slug) {
        colorTypes.forEach(function(type) {
            wp.customize('zuidakker_pillar_' + slug + '_' + type, function(value) {
                value.bind(function(newval) {
                    updateCSSVariable('--pillar-' + slug + '-' + type, newval);
                });
            });
        });

        // Bind text settings - update pillar cards
        wp.customize('zuidakker_pillar_' + slug + '_name', function(value) {
            value.bind(function(newval) {
                $('.pillar-' + slug + ' h3').text(newval);
            });
        });

        wp.customize('zuidakker_pillar_' + slug + '_subtitle', function(value) {
            value.bind(function(newval) {
                $('.pillar-' + slug + ' .subtitle').text(newval);
            });
        });

        wp.customize('zuidakker_pillar_' + slug + '_icon', function(value) {
            value.bind(function(newval) {
                $('.pillar-' + slug + ' .pillar-card-icon').text(newval);
            });
        });

        wp.customize('zuidakker_pillar_' + slug + '_description', function(value) {
            value.bind(function(newval) {
                $('.pillar-' + slug + ' p').text(newval);
            });
        });
    });

    // General settings
    wp.customize('zuidakker_header_green', function(value) {
        value.bind(function(newval) {
            updateCSSVariable('--header-green', newval);
        });
    });

    wp.customize('zuidakker_header_dark_green', function(value) {
        value.bind(function(newval) {
            updateCSSVariable('--header-dark-green', newval);
        });
    });

    wp.customize('zuidakker_sitemap_primary', function(value) {
        value.bind(function(newval) {
            updateCSSVariable('--pillar-sitemap-primary', newval);
        });
    });

    wp.customize('zuidakker_sitemap_secondary', function(value) {
        value.bind(function(newval) {
            updateCSSVariable('--pillar-sitemap-secondary', newval);
        });
    });

    // Footer text
    wp.customize('zuidakker_footer_text', function(value) {
        value.bind(function(newval) {
            $('.site-footer .footer-html, .site-info').text(newval);
        });
    });

})(jQuery);
