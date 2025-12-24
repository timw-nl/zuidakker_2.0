<?php
/**
 * Booking System - Core Module
 * Handles bookable resources (boat berths, allotments, meeting rooms, accommodation)
 * Integrates with WooCommerce for payment processing
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register Bookable Resource Custom Post Type
 */
function zuidakker_register_bookable_resource_cpt() {
    $labels = array(
        'name'                  => __( 'Bookable Resources', 'zuidakker' ),
        'singular_name'         => __( 'Bookable Resource', 'zuidakker' ),
        'menu_name'             => __( 'Bookings', 'zuidakker' ),
        'add_new'               => __( 'Add New Resource', 'zuidakker' ),
        'add_new_item'          => __( 'Add New Bookable Resource', 'zuidakker' ),
        'edit_item'             => __( 'Edit Bookable Resource', 'zuidakker' ),
        'new_item'              => __( 'New Bookable Resource', 'zuidakker' ),
        'view_item'             => __( 'View Bookable Resource', 'zuidakker' ),
        'search_items'          => __( 'Search Bookable Resources', 'zuidakker' ),
        'not_found'             => __( 'No bookable resources found', 'zuidakker' ),
        'not_found_in_trash'    => __( 'No bookable resources found in trash', 'zuidakker' ),
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'reserveren' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 25,
        'menu_icon'             => 'dashicons-calendar-alt',
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'          => true,
    );

    register_post_type( 'bookable_resource', $args );
}
add_action( 'init', 'zuidakker_register_bookable_resource_cpt' );

/**
 * Register Resource Type Taxonomy
 */
function zuidakker_register_resource_type_taxonomy() {
    $labels = array(
        'name'              => __( 'Resource Types', 'zuidakker' ),
        'singular_name'     => __( 'Resource Type', 'zuidakker' ),
        'search_items'      => __( 'Search Resource Types', 'zuidakker' ),
        'all_items'         => __( 'All Resource Types', 'zuidakker' ),
        'edit_item'         => __( 'Edit Resource Type', 'zuidakker' ),
        'update_item'       => __( 'Update Resource Type', 'zuidakker' ),
        'add_new_item'      => __( 'Add New Resource Type', 'zuidakker' ),
        'new_item_name'     => __( 'New Resource Type Name', 'zuidakker' ),
        'menu_name'         => __( 'Resource Types', 'zuidakker' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'resource-type' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'resource_type', array( 'bookable_resource' ), $args );
}
add_action( 'init', 'zuidakker_register_resource_type_taxonomy' );

/**
 * Add default resource types on activation
 */
function zuidakker_add_default_resource_types() {
    $default_types = array(
        'boat-berth'        => __( 'Boat Berth', 'zuidakker' ),
        'allotment'         => __( 'Small Allotment', 'zuidakker' ),
        'meeting-room'      => __( 'Meeting Room', 'zuidakker' ),
        'accommodation'     => __( 'Accommodation', 'zuidakker' ),
    );

    foreach ( $default_types as $slug => $name ) {
        if ( ! term_exists( $slug, 'resource_type' ) ) {
            wp_insert_term( $name, 'resource_type', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'init', 'zuidakker_add_default_resource_types', 20 );

/**
 * Add custom meta boxes for bookable resources
 */
function zuidakker_add_booking_meta_boxes() {
    add_meta_box(
        'zuidakker_booking_details',
        __( 'Booking Details', 'zuidakker' ),
        'zuidakker_booking_details_callback',
        'bookable_resource',
        'normal',
        'high'
    );

    add_meta_box(
        'zuidakker_booking_pricing',
        __( 'Pricing & Tiers', 'zuidakker' ),
        'zuidakker_booking_pricing_callback',
        'bookable_resource',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'zuidakker_add_booking_meta_boxes' );

/**
 * Booking details meta box callback
 */
function zuidakker_booking_details_callback( $post ) {
    wp_nonce_field( 'zuidakker_booking_details', 'zuidakker_booking_nonce' );
    
    $surface_area = get_post_meta( $post->ID, '_booking_surface_area', true );
    $location = get_post_meta( $post->ID, '_booking_location', true );
    $capacity = get_post_meta( $post->ID, '_booking_capacity', true );
    $min_duration = get_post_meta( $post->ID, '_booking_min_duration', true );
    $max_duration = get_post_meta( $post->ID, '_booking_max_duration', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="booking_surface_area"><?php _e( 'Surface Area (m²)', 'zuidakker' ); ?></label></th>
            <td>
                <input type="number" id="booking_surface_area" name="booking_surface_area" 
                       value="<?php echo esc_attr( $surface_area ); ?>" step="0.1" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="booking_location"><?php _e( 'Location', 'zuidakker' ); ?></label></th>
            <td>
                <input type="text" id="booking_location" name="booking_location" 
                       value="<?php echo esc_attr( $location ); ?>" class="regular-text" />
                <p class="description"><?php _e( 'Physical location or area identifier', 'zuidakker' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="booking_capacity"><?php _e( 'Capacity', 'zuidakker' ); ?></label></th>
            <td>
                <input type="number" id="booking_capacity" name="booking_capacity" 
                       value="<?php echo esc_attr( $capacity ); ?>" class="small-text" />
                <p class="description"><?php _e( 'Maximum number of people (for meeting rooms/accommodation)', 'zuidakker' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="booking_min_duration"><?php _e( 'Minimum Duration (days)', 'zuidakker' ); ?></label></th>
            <td>
                <input type="number" id="booking_min_duration" name="booking_min_duration" 
                       value="<?php echo esc_attr( $min_duration ?: 1 ); ?>" class="small-text" min="1" />
            </td>
        </tr>
        <tr>
            <th><label for="booking_max_duration"><?php _e( 'Maximum Duration (days)', 'zuidakker' ); ?></label></th>
            <td>
                <input type="number" id="booking_max_duration" name="booking_max_duration" 
                       value="<?php echo esc_attr( $max_duration ?: 365 ); ?>" class="small-text" min="1" />
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Pricing & tiers meta box callback
 */
function zuidakker_booking_pricing_callback( $post ) {
    $tier = get_post_meta( $post->ID, '_booking_tier', true );
    $price = get_post_meta( $post->ID, '_booking_price', true );
    $wc_product_id = get_post_meta( $post->ID, '_booking_wc_product_id', true );
    ?>
    <p>
        <label for="booking_tier"><strong><?php _e( 'Booking Tier', 'zuidakker' ); ?></strong></label><br>
        <select id="booking_tier" name="booking_tier" style="width: 100%;">
            <option value="free" <?php selected( $tier, 'free' ); ?>><?php _e( 'Free Tier', 'zuidakker' ); ?></option>
            <option value="professional" <?php selected( $tier, 'professional' ); ?>><?php _e( 'Professional Tier', 'zuidakker' ); ?></option>
        </select>
    </p>
    
    <p id="price_field" style="<?php echo ( $tier === 'free' ) ? 'display:none;' : ''; ?>">
        <label for="booking_price"><strong><?php _e( 'Price per Day (€)', 'zuidakker' ); ?></strong></label><br>
        <input type="number" id="booking_price" name="booking_price" 
               value="<?php echo esc_attr( $price ); ?>" step="0.01" min="0" style="width: 100%;" />
    </p>

    <p>
        <label><strong><?php _e( 'WooCommerce Product', 'zuidakker' ); ?></strong></label><br>
        <?php if ( $wc_product_id ) : ?>
            <a href="<?php echo admin_url( 'post.php?post=' . $wc_product_id . '&action=edit' ); ?>" target="_blank">
                <?php _e( 'Edit Product', 'zuidakker' ); ?> #<?php echo $wc_product_id; ?>
            </a>
        <?php else : ?>
            <em><?php _e( 'No product linked yet', 'zuidakker' ); ?></em>
        <?php endif; ?>
    </p>

    <script>
    jQuery(document).ready(function($) {
        $('#booking_tier').on('change', function() {
            if ($(this).val() === 'free') {
                $('#price_field').hide();
                $('#booking_price').val('0');
            } else {
                $('#price_field').show();
            }
        });
    });
    </script>
    <?php
}

/**
 * Save booking meta data
 */
function zuidakker_save_booking_meta( $post_id ) {
    if ( ! isset( $_POST['zuidakker_booking_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['zuidakker_booking_nonce'], 'zuidakker_booking_details' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array(
        'booking_surface_area',
        'booking_location',
        'booking_capacity',
        'booking_min_duration',
        'booking_max_duration',
        'booking_tier',
        'booking_price',
    );

    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }

    zuidakker_sync_booking_with_woocommerce( $post_id );
}
add_action( 'save_post_bookable_resource', 'zuidakker_save_booking_meta' );

/**
 * Sync bookable resource with WooCommerce product
 */
function zuidakker_sync_booking_with_woocommerce( $post_id ) {
    if ( ! function_exists( 'wc_get_product' ) ) {
        return;
    }

    $tier = get_post_meta( $post_id, '_booking_tier', true );
    
    if ( $tier !== 'professional' ) {
        return;
    }

    $wc_product_id = get_post_meta( $post_id, '_booking_wc_product_id', true );
    $resource = get_post( $post_id );
    $price = get_post_meta( $post_id, '_booking_price', true );

    if ( $wc_product_id && get_post_status( $wc_product_id ) === 'publish' ) {
        $product = wc_get_product( $wc_product_id );
        $product->set_name( $resource->post_title );
        $product->set_regular_price( $price );
        $product->save();
    } else {
        $product = new WC_Product_Simple();
        $product->set_name( $resource->post_title );
        $product->set_status( 'publish' );
        $product->set_catalog_visibility( 'visible' );
        $product->set_regular_price( $price );
        $product->set_virtual( true );
        $product->set_sold_individually( true );
        
        $product_id = $product->save();
        update_post_meta( $post_id, '_booking_wc_product_id', $product_id );
        update_post_meta( $product_id, '_linked_booking_resource', $post_id );
    }
}

/**
 * Add custom columns to bookable resources admin list
 */
function zuidakker_booking_custom_columns( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
        $new_columns[ $key ] = $value;
        if ( $key === 'title' ) {
            $new_columns['resource_type'] = __( 'Type', 'zuidakker' );
            $new_columns['booking_tier'] = __( 'Tier', 'zuidakker' );
            $new_columns['booking_price'] = __( 'Price', 'zuidakker' );
        }
    }
    return $new_columns;
}
add_filter( 'manage_bookable_resource_posts_columns', 'zuidakker_booking_custom_columns' );

/**
 * Populate custom columns
 */
function zuidakker_booking_custom_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'resource_type':
            $terms = get_the_terms( $post_id, 'resource_type' );
            if ( $terms && ! is_wp_error( $terms ) ) {
                echo esc_html( $terms[0]->name );
            }
            break;
        case 'booking_tier':
            $tier = get_post_meta( $post_id, '_booking_tier', true );
            if ( $tier === 'professional' ) {
                echo '<span style="color: #0073aa; font-weight: bold;">Professional</span>';
            } else {
                echo '<span style="color: #46b450;">Free</span>';
            }
            break;
        case 'booking_price':
            $tier = get_post_meta( $post_id, '_booking_tier', true );
            if ( $tier === 'professional' ) {
                $price = get_post_meta( $post_id, '_booking_price', true );
                echo '€' . number_format( (float) $price, 2 ) . ' / ' . __( 'day', 'zuidakker' );
            } else {
                echo '—';
            }
            break;
    }
}
add_action( 'manage_bookable_resource_posts_custom_column', 'zuidakker_booking_custom_column_content', 10, 2 );
