<?php
/**
 * Contact Map Functionality
 * Handles map display and initialization for contact page
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enqueue Leaflet map scripts and styles
 */
function zuidakker_enqueue_contact_map_assets() {
    // Only load on contact page
    if ( ! is_page_template( 'page-contact.php' ) && ! is_page( 'contact' ) ) {
        return;
    }
    
    // Leaflet CSS
    wp_enqueue_style(
        'leaflet-css',
        'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
        array(),
        '1.9.4'
    );
    
    // Leaflet JS
    wp_enqueue_script(
        'leaflet-js',
        'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
        array(),
        '1.9.4',
        true
    );
    
    // Custom map initialization
    wp_add_inline_script(
        'leaflet-js',
        zuidakker_get_map_init_script()
    );
}
add_action( 'wp_enqueue_scripts', 'zuidakker_enqueue_contact_map_assets' );

/**
 * Get map initialization script
 */
function zuidakker_get_map_init_script() {
    $lat = 52.2029;
    $lng = 4.6382;
    $zoom = 15;
    $address = esc_js( 'Zuidakker<br>Zuideinde 112 e<br>2371BZ Roelofarendsveen' );
    
    return "
    document.addEventListener('DOMContentLoaded', function() {
        var mapElement = document.getElementById('contact-map');
        if (!mapElement) return;
        
        var map = L.map('contact-map').setView([{$lat}, {$lng}], {$zoom});
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a>',
            maxZoom: 19
        }).addTo(map);
        
        var marker = L.marker([{$lat}, {$lng}]).addTo(map);
        marker.bindPopup('<b>{$address}</b>').openPopup();
    });
    ";
}

/**
 * Display contact map HTML
 */
function zuidakker_display_contact_map() {
    ?>
    <div id="contact-map" class="contact-map"></div>
    <?php
}
