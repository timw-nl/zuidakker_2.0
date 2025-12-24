<?php
/**
 * Booking Reservations - Manage bookings and availability
 * Handles reservation creation, availability checks, and booking management
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register Reservation Custom Post Type
 */
function zuidakker_register_reservation_cpt() {
    $labels = array(
        'name'                  => __( 'Reservations', 'zuidakker' ),
        'singular_name'         => __( 'Reservation', 'zuidakker' ),
        'menu_name'             => __( 'Reservations', 'zuidakker' ),
        'add_new'               => __( 'Add New Reservation', 'zuidakker' ),
        'add_new_item'          => __( 'Add New Reservation', 'zuidakker' ),
        'edit_item'             => __( 'Edit Reservation', 'zuidakker' ),
        'new_item'              => __( 'New Reservation', 'zuidakker' ),
        'view_item'             => __( 'View Reservation', 'zuidakker' ),
        'search_items'          => __( 'Search Reservations', 'zuidakker' ),
        'not_found'             => __( 'No reservations found', 'zuidakker' ),
        'not_found_in_trash'    => __( 'No reservations found in trash', 'zuidakker' ),
    );

    $args = array(
        'labels'                => $labels,
        'public'                => false,
        'publicly_queryable'    => false,
        'show_ui'               => true,
        'show_in_menu'          => 'edit.php?post_type=bookable_resource',
        'query_var'             => true,
        'capability_type'       => 'post',
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array( 'title' ),
        'show_in_rest'          => false,
    );

    register_post_type( 'reservation', $args );
}
add_action( 'init', 'zuidakker_register_reservation_cpt' );

/**
 * Add reservation meta boxes
 */
function zuidakker_add_reservation_meta_boxes() {
    add_meta_box(
        'zuidakker_reservation_details',
        __( 'Reservation Details', 'zuidakker' ),
        'zuidakker_reservation_details_callback',
        'reservation',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'zuidakker_add_reservation_meta_boxes' );

/**
 * Reservation details meta box callback
 */
function zuidakker_reservation_details_callback( $post ) {
    wp_nonce_field( 'zuidakker_reservation_details', 'zuidakker_reservation_nonce' );
    
    $resource_id = get_post_meta( $post->ID, '_reservation_resource_id', true );
    $user_id = get_post_meta( $post->ID, '_reservation_user_id', true );
    $start_date = get_post_meta( $post->ID, '_reservation_start_date', true );
    $end_date = get_post_meta( $post->ID, '_reservation_end_date', true );
    $status = get_post_meta( $post->ID, '_reservation_status', true );
    $order_id = get_post_meta( $post->ID, '_reservation_order_id', true );
    $total_price = get_post_meta( $post->ID, '_reservation_total_price', true );
    
    $resources = get_posts( array(
        'post_type' => 'bookable_resource',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ) );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="reservation_resource_id"><?php _e( 'Bookable Resource', 'zuidakker' ); ?></label></th>
            <td>
                <select id="reservation_resource_id" name="reservation_resource_id" style="width: 100%;" required>
                    <option value=""><?php _e( 'Select a resource', 'zuidakker' ); ?></option>
                    <?php foreach ( $resources as $resource ) : ?>
                        <option value="<?php echo $resource->ID; ?>" <?php selected( $resource_id, $resource->ID ); ?>>
                            <?php echo esc_html( $resource->post_title ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="reservation_user_id"><?php _e( 'User', 'zuidakker' ); ?></label></th>
            <td>
                <?php
                wp_dropdown_users( array(
                    'name' => 'reservation_user_id',
                    'id' => 'reservation_user_id',
                    'selected' => $user_id,
                    'show_option_none' => __( 'Select a user', 'zuidakker' ),
                    'class' => 'regular-text',
                ) );
                ?>
            </td>
        </tr>
        <tr>
            <th><label for="reservation_start_date"><?php _e( 'Start Date', 'zuidakker' ); ?></label></th>
            <td>
                <input type="date" id="reservation_start_date" name="reservation_start_date" 
                       value="<?php echo esc_attr( $start_date ); ?>" required />
            </td>
        </tr>
        <tr>
            <th><label for="reservation_end_date"><?php _e( 'End Date', 'zuidakker' ); ?></label></th>
            <td>
                <input type="date" id="reservation_end_date" name="reservation_end_date" 
                       value="<?php echo esc_attr( $end_date ); ?>" required />
            </td>
        </tr>
        <tr>
            <th><label for="reservation_status"><?php _e( 'Status', 'zuidakker' ); ?></label></th>
            <td>
                <select id="reservation_status" name="reservation_status">
                    <option value="pending" <?php selected( $status, 'pending' ); ?>><?php _e( 'Pending', 'zuidakker' ); ?></option>
                    <option value="confirmed" <?php selected( $status, 'confirmed' ); ?>><?php _e( 'Confirmed', 'zuidakker' ); ?></option>
                    <option value="cancelled" <?php selected( $status, 'cancelled' ); ?>><?php _e( 'Cancelled', 'zuidakker' ); ?></option>
                    <option value="completed" <?php selected( $status, 'completed' ); ?>><?php _e( 'Completed', 'zuidakker' ); ?></option>
                </select>
            </td>
        </tr>
        <?php if ( $order_id ) : ?>
        <tr>
            <th><?php _e( 'WooCommerce Order', 'zuidakker' ); ?></th>
            <td>
                <a href="<?php echo admin_url( 'post.php?post=' . $order_id . '&action=edit' ); ?>" target="_blank">
                    <?php _e( 'View Order', 'zuidakker' ); ?> #<?php echo $order_id; ?>
                </a>
            </td>
        </tr>
        <?php endif; ?>
        <?php if ( $total_price ) : ?>
        <tr>
            <th><?php _e( 'Total Price', 'zuidakker' ); ?></th>
            <td>
                <strong>€<?php echo number_format( (float) $total_price, 2 ); ?></strong>
            </td>
        </tr>
        <?php endif; ?>
    </table>
    <?php
}

/**
 * Save reservation meta data
 */
function zuidakker_save_reservation_meta( $post_id ) {
    if ( ! isset( $_POST['zuidakker_reservation_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['zuidakker_reservation_nonce'], 'zuidakker_reservation_details' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array(
        'reservation_resource_id',
        'reservation_user_id',
        'reservation_start_date',
        'reservation_end_date',
        'reservation_status',
    );

    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }

    zuidakker_calculate_reservation_price( $post_id );
}
add_action( 'save_post_reservation', 'zuidakker_save_reservation_meta' );

/**
 * Calculate reservation total price
 */
function zuidakker_calculate_reservation_price( $reservation_id ) {
    $resource_id = get_post_meta( $reservation_id, '_reservation_resource_id', true );
    $start_date = get_post_meta( $reservation_id, '_reservation_start_date', true );
    $end_date = get_post_meta( $reservation_id, '_reservation_end_date', true );
    
    if ( ! $resource_id || ! $start_date || ! $end_date ) {
        return 0;
    }

    $tier = get_post_meta( $resource_id, '_booking_tier', true );
    
    if ( $tier === 'free' ) {
        update_post_meta( $reservation_id, '_reservation_total_price', 0 );
        return 0;
    }

    $price_per_day = get_post_meta( $resource_id, '_booking_price', true );
    $start = new DateTime( $start_date );
    $end = new DateTime( $end_date );
    $days = $start->diff( $end )->days + 1;
    
    $total = $price_per_day * $days;
    update_post_meta( $reservation_id, '_reservation_total_price', $total );
    
    return $total;
}

/**
 * Check if resource is available for given dates
 */
function zuidakker_check_availability( $resource_id, $start_date, $end_date, $exclude_reservation_id = null ) {
    $args = array(
        'post_type' => 'reservation',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_reservation_resource_id',
                'value' => $resource_id,
            ),
            array(
                'key' => '_reservation_status',
                'value' => array( 'pending', 'confirmed' ),
                'compare' => 'IN',
            ),
        ),
    );

    if ( $exclude_reservation_id ) {
        $args['post__not_in'] = array( $exclude_reservation_id );
    }

    $reservations = get_posts( $args );
    
    $start = new DateTime( $start_date );
    $end = new DateTime( $end_date );

    foreach ( $reservations as $reservation ) {
        $res_start = new DateTime( get_post_meta( $reservation->ID, '_reservation_start_date', true ) );
        $res_end = new DateTime( get_post_meta( $reservation->ID, '_reservation_end_date', true ) );

        if ( $start <= $res_end && $end >= $res_start ) {
            return false;
        }
    }

    return true;
}

/**
 * Get all reservations for a resource
 */
function zuidakker_get_resource_reservations( $resource_id, $status = array( 'confirmed', 'pending' ) ) {
    $args = array(
        'post_type' => 'reservation',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_reservation_resource_id',
                'value' => $resource_id,
            ),
            array(
                'key' => '_reservation_status',
                'value' => $status,
                'compare' => 'IN',
            ),
        ),
        'orderby' => 'meta_value',
        'meta_key' => '_reservation_start_date',
        'order' => 'ASC',
    );

    return get_posts( $args );
}

/**
 * Add custom columns to reservations admin list
 */
function zuidakker_reservation_custom_columns( $columns ) {
    return array(
        'cb' => $columns['cb'],
        'title' => __( 'Reservation', 'zuidakker' ),
        'resource' => __( 'Resource', 'zuidakker' ),
        'user' => __( 'User', 'zuidakker' ),
        'dates' => __( 'Dates', 'zuidakker' ),
        'status' => __( 'Status', 'zuidakker' ),
        'price' => __( 'Price', 'zuidakker' ),
        'date' => __( 'Created', 'zuidakker' ),
    );
}
add_filter( 'manage_reservation_posts_columns', 'zuidakker_reservation_custom_columns' );

/**
 * Populate custom columns
 */
function zuidakker_reservation_custom_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'resource':
            $resource_id = get_post_meta( $post_id, '_reservation_resource_id', true );
            if ( $resource_id ) {
                $resource = get_post( $resource_id );
                if ( $resource ) {
                    echo '<a href="' . get_edit_post_link( $resource_id ) . '">' . esc_html( $resource->post_title ) . '</a>';
                }
            }
            break;
        case 'user':
            $user_id = get_post_meta( $post_id, '_reservation_user_id', true );
            if ( $user_id ) {
                $user = get_userdata( $user_id );
                if ( $user ) {
                    echo esc_html( $user->display_name );
                }
            }
            break;
        case 'dates':
            $start = get_post_meta( $post_id, '_reservation_start_date', true );
            $end = get_post_meta( $post_id, '_reservation_end_date', true );
            if ( $start && $end ) {
                echo date_i18n( 'd M Y', strtotime( $start ) ) . ' - ' . date_i18n( 'd M Y', strtotime( $end ) );
            }
            break;
        case 'status':
            $status = get_post_meta( $post_id, '_reservation_status', true );
            $colors = array(
                'pending' => '#f0ad4e',
                'confirmed' => '#46b450',
                'cancelled' => '#dc3232',
                'completed' => '#00a0d2',
            );
            $color = isset( $colors[ $status ] ) ? $colors[ $status ] : '#999';
            echo '<span style="color: ' . $color . '; font-weight: bold;">' . ucfirst( $status ) . '</span>';
            break;
        case 'price':
            $price = get_post_meta( $post_id, '_reservation_total_price', true );
            if ( $price > 0 ) {
                echo '€' . number_format( (float) $price, 2 );
            } else {
                echo '<span style="color: #46b450;">Free</span>';
            }
            break;
    }
}
add_action( 'manage_reservation_posts_custom_column', 'zuidakker_reservation_custom_column_content', 10, 2 );

/**
 * Send reservation confirmation email
 */
function zuidakker_send_reservation_confirmation( $reservation_id ) {
    $user_id = get_post_meta( $reservation_id, '_reservation_user_id', true );
    $resource_id = get_post_meta( $reservation_id, '_reservation_resource_id', true );
    $start_date = get_post_meta( $reservation_id, '_reservation_start_date', true );
    $end_date = get_post_meta( $reservation_id, '_reservation_end_date', true );
    
    if ( ! $user_id || ! $resource_id ) {
        return;
    }

    $user = get_userdata( $user_id );
    $resource = get_post( $resource_id );
    
    $subject = sprintf( __( 'Reservation Confirmation - %s', 'zuidakker' ), $resource->post_title );
    
    $message = sprintf(
        __( "Hello %s,\n\nYour reservation has been confirmed!\n\nResource: %s\nStart Date: %s\nEnd Date: %s\n\nThank you for booking with Zuidakker.\n\nBest regards,\nZuidakker Team", 'zuidakker' ),
        $user->display_name,
        $resource->post_title,
        date_i18n( get_option( 'date_format' ), strtotime( $start_date ) ),
        date_i18n( get_option( 'date_format' ), strtotime( $end_date ) )
    );
    
    wp_mail( $user->user_email, $subject, $message );
}
