<?php
/**
 * Booking Frontend - User-facing booking interface
 * Handles booking form display, submission, and WooCommerce integration
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register booking shortcode
 */
function zuidakker_booking_form_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'resource_id' => '',
        'type' => '',
    ), $atts );

    ob_start();
    zuidakker_render_booking_form( $atts );
    return ob_get_clean();
}
add_shortcode( 'booking_form', 'zuidakker_booking_form_shortcode' );

/**
 * Render booking form
 */
function zuidakker_render_booking_form( $atts ) {
    if ( ! is_user_logged_in() ) {
        echo '<div class="booking-login-notice">';
        echo '<p>' . __( 'Please log in to make a reservation.', 'zuidakker' ) . '</p>';
        echo '<a href="' . wp_login_url( get_permalink() ) . '" class="button">' . __( 'Log In', 'zuidakker' ) . '</a> ';
        echo '<a href="' . wp_registration_url() . '" class="button">' . __( 'Register', 'zuidakker' ) . '</a>';
        echo '</div>';
        return;
    }

    $resource_id = isset( $atts['resource_id'] ) ? intval( $atts['resource_id'] ) : 0;
    $type = isset( $atts['type'] ) ? sanitize_text_field( $atts['type'] ) : '';

    $resources = array();
    if ( $resource_id ) {
        $resources[] = get_post( $resource_id );
    } elseif ( $type ) {
        $resources = get_posts( array(
            'post_type' => 'bookable_resource',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'resource_type',
                    'field' => 'slug',
                    'terms' => $type,
                ),
            ),
        ) );
    } else {
        $resources = get_posts( array(
            'post_type' => 'bookable_resource',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
        ) );
    }

    if ( empty( $resources ) ) {
        echo '<p>' . __( 'No bookable resources available at this time.', 'zuidakker' ) . '</p>';
        return;
    }

    wp_enqueue_script( 'zuidakker-booking', get_stylesheet_directory_uri() . '/assets/js/booking.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'zuidakker-booking', 'zuidakkerBooking', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'zuidakker_booking_nonce' ),
    ) );

    ?>
    <div class="zuidakker-booking-form">
        <form id="booking-form" method="post" action="">
            <?php wp_nonce_field( 'zuidakker_booking_action', 'zuidakker_booking_nonce' ); ?>
            
            <div class="booking-field">
                <label for="booking_resource"><?php _e( 'Select Resource', 'zuidakker' ); ?> *</label>
                <select id="booking_resource" name="booking_resource" required>
                    <option value=""><?php _e( 'Choose a resource...', 'zuidakker' ); ?></option>
                    <?php foreach ( $resources as $resource ) : 
                        $tier = get_post_meta( $resource->ID, '_booking_tier', true );
                        $price = get_post_meta( $resource->ID, '_booking_price', true );
                        $terms = get_the_terms( $resource->ID, 'resource_type' );
                        $type_name = $terms && ! is_wp_error( $terms ) ? $terms[0]->name : '';
                    ?>
                        <option value="<?php echo $resource->ID; ?>" 
                                data-tier="<?php echo esc_attr( $tier ); ?>"
                                data-price="<?php echo esc_attr( $price ); ?>"
                                data-min-duration="<?php echo esc_attr( get_post_meta( $resource->ID, '_booking_min_duration', true ) ?: 1 ); ?>"
                                data-max-duration="<?php echo esc_attr( get_post_meta( $resource->ID, '_booking_max_duration', true ) ?: 365 ); ?>">
                            <?php echo esc_html( $resource->post_title ); ?>
                            <?php if ( $type_name ) echo ' (' . esc_html( $type_name ) . ')'; ?>
                            <?php if ( $tier === 'professional' ) echo ' - €' . number_format( (float) $price, 2 ) . '/' . __( 'day', 'zuidakker' ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="resource-details" style="display: none;">
                <div class="resource-info"></div>
            </div>

            <div class="booking-field">
                <label for="booking_start_date"><?php _e( 'Start Date', 'zuidakker' ); ?> *</label>
                <input type="date" id="booking_start_date" name="booking_start_date" 
                       min="<?php echo date( 'Y-m-d' ); ?>" required />
            </div>

            <div class="booking-field">
                <label for="booking_end_date"><?php _e( 'End Date', 'zuidakker' ); ?> *</label>
                <input type="date" id="booking_end_date" name="booking_end_date" 
                       min="<?php echo date( 'Y-m-d' ); ?>" required />
            </div>

            <div id="booking-summary" style="display: none;">
                <h3><?php _e( 'Booking Summary', 'zuidakker' ); ?></h3>
                <div class="summary-content"></div>
            </div>

            <div id="availability-message"></div>

            <div class="booking-actions">
                <button type="button" id="check-availability" class="button">
                    <?php _e( 'Check Availability', 'zuidakker' ); ?>
                </button>
                <button type="submit" id="submit-booking" class="button button-primary" style="display: none;">
                    <?php _e( 'Confirm Booking', 'zuidakker' ); ?>
                </button>
            </div>
        </form>
    </div>

    <style>
    .zuidakker-booking-form {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background: #f9f9f9;
        border-radius: 8px;
    }
    .booking-field {
        margin-bottom: 1.5rem;
    }
    .booking-field label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    .booking-field input,
    .booking-field select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }
    #resource-details {
        background: #fff;
        padding: 1rem;
        margin: 1rem 0;
        border-radius: 4px;
        border-left: 4px solid #46b450;
    }
    #booking-summary {
        background: #fff;
        padding: 1.5rem;
        margin: 1.5rem 0;
        border-radius: 4px;
        border: 2px solid #0073aa;
    }
    #booking-summary h3 {
        margin-top: 0;
        color: #0073aa;
    }
    .summary-content p {
        margin: 0.5rem 0;
    }
    .summary-content .total-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: #0073aa;
        margin-top: 1rem;
    }
    #availability-message {
        margin: 1rem 0;
        padding: 1rem;
        border-radius: 4px;
    }
    #availability-message.available {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    #availability-message.unavailable {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .booking-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    .booking-actions button {
        flex: 1;
        padding: 1rem;
        font-size: 1rem;
    }
    .booking-login-notice {
        text-align: center;
        padding: 2rem;
        background: #f9f9f9;
        border-radius: 8px;
    }
    </style>
    <?php
}

/**
 * Handle booking form submission
 */
function zuidakker_handle_booking_submission() {
    if ( ! isset( $_POST['zuidakker_booking_nonce'] ) || 
         ! wp_verify_nonce( $_POST['zuidakker_booking_nonce'], 'zuidakker_booking_action' ) ) {
        return;
    }

    if ( ! is_user_logged_in() ) {
        wp_die( __( 'You must be logged in to make a reservation.', 'zuidakker' ) );
    }

    $resource_id = isset( $_POST['booking_resource'] ) ? intval( $_POST['booking_resource'] ) : 0;
    $start_date = isset( $_POST['booking_start_date'] ) ? sanitize_text_field( $_POST['booking_start_date'] ) : '';
    $end_date = isset( $_POST['booking_end_date'] ) ? sanitize_text_field( $_POST['booking_end_date'] ) : '';

    if ( ! $resource_id || ! $start_date || ! $end_date ) {
        wp_die( __( 'Please fill in all required fields.', 'zuidakker' ) );
    }

    if ( ! zuidakker_check_availability( $resource_id, $start_date, $end_date ) ) {
        wp_die( __( 'This resource is not available for the selected dates.', 'zuidakker' ) );
    }

    $resource = get_post( $resource_id );
    $user_id = get_current_user_id();
    $tier = get_post_meta( $resource_id, '_booking_tier', true );

    $reservation_title = sprintf(
        '%s - %s to %s',
        $resource->post_title,
        date_i18n( 'd M Y', strtotime( $start_date ) ),
        date_i18n( 'd M Y', strtotime( $end_date ) )
    );

    $reservation_id = wp_insert_post( array(
        'post_type' => 'reservation',
        'post_title' => $reservation_title,
        'post_status' => 'publish',
    ) );

    if ( is_wp_error( $reservation_id ) ) {
        wp_die( __( 'Failed to create reservation. Please try again.', 'zuidakker' ) );
    }

    update_post_meta( $reservation_id, '_reservation_resource_id', $resource_id );
    update_post_meta( $reservation_id, '_reservation_user_id', $user_id );
    update_post_meta( $reservation_id, '_reservation_start_date', $start_date );
    update_post_meta( $reservation_id, '_reservation_end_date', $end_date );
    update_post_meta( $reservation_id, '_reservation_status', 'pending' );

    $total_price = zuidakker_calculate_reservation_price( $reservation_id );

    if ( $tier === 'professional' && $total_price > 0 ) {
        $redirect_url = zuidakker_create_booking_order( $reservation_id );
        wp_redirect( $redirect_url );
        exit;
    } else {
        update_post_meta( $reservation_id, '_reservation_status', 'confirmed' );
        zuidakker_send_reservation_confirmation( $reservation_id );
        
        $redirect_url = add_query_arg( 'booking_confirmed', $reservation_id, get_permalink() );
        wp_redirect( $redirect_url );
        exit;
    }
}
add_action( 'template_redirect', 'zuidakker_handle_booking_submission' );

/**
 * Create WooCommerce order for booking
 */
function zuidakker_create_booking_order( $reservation_id ) {
    if ( ! function_exists( 'wc_create_order' ) ) {
        return home_url();
    }

    $resource_id = get_post_meta( $reservation_id, '_reservation_resource_id', true );
    $wc_product_id = get_post_meta( $resource_id, '_booking_wc_product_id', true );
    $total_price = get_post_meta( $reservation_id, '_reservation_total_price', true );
    $start_date = get_post_meta( $reservation_id, '_reservation_start_date', true );
    $end_date = get_post_meta( $reservation_id, '_reservation_end_date', true );

    if ( ! $wc_product_id ) {
        return home_url();
    }

    $order = wc_create_order();
    $product = wc_get_product( $wc_product_id );
    
    $start = new DateTime( $start_date );
    $end = new DateTime( $end_date );
    $days = $start->diff( $end )->days + 1;

    $order->add_product( $product, $days );
    $order->set_total( $total_price );
    $order->update_meta_data( '_booking_reservation_id', $reservation_id );
    $order->save();

    update_post_meta( $reservation_id, '_reservation_order_id', $order->get_id() );

    return $order->get_checkout_payment_url();
}

/**
 * Update reservation status when order is completed
 */
function zuidakker_update_reservation_on_order_complete( $order_id ) {
    $order = wc_get_order( $order_id );
    $reservation_id = $order->get_meta( '_booking_reservation_id' );

    if ( $reservation_id ) {
        update_post_meta( $reservation_id, '_reservation_status', 'confirmed' );
        zuidakker_send_reservation_confirmation( $reservation_id );
    }
}
add_action( 'woocommerce_order_status_completed', 'zuidakker_update_reservation_on_order_complete' );
add_action( 'woocommerce_payment_complete', 'zuidakker_update_reservation_on_order_complete' );

/**
 * AJAX: Check availability
 */
function zuidakker_ajax_check_availability() {
    check_ajax_referer( 'zuidakker_booking_nonce', 'nonce' );

    $resource_id = isset( $_POST['resource_id'] ) ? intval( $_POST['resource_id'] ) : 0;
    $start_date = isset( $_POST['start_date'] ) ? sanitize_text_field( $_POST['start_date'] ) : '';
    $end_date = isset( $_POST['end_date'] ) ? sanitize_text_field( $_POST['end_date'] ) : '';

    if ( ! $resource_id || ! $start_date || ! $end_date ) {
        wp_send_json_error( array( 'message' => __( 'Invalid data provided.', 'zuidakker' ) ) );
    }

    $available = zuidakker_check_availability( $resource_id, $start_date, $end_date );

    if ( $available ) {
        $resource = get_post( $resource_id );
        $tier = get_post_meta( $resource_id, '_booking_tier', true );
        $price_per_day = get_post_meta( $resource_id, '_booking_price', true );
        
        $start = new DateTime( $start_date );
        $end = new DateTime( $end_date );
        $days = $start->diff( $end )->days + 1;
        $total = $tier === 'professional' ? $price_per_day * $days : 0;

        wp_send_json_success( array(
            'available' => true,
            'days' => $days,
            'price_per_day' => $price_per_day,
            'total' => $total,
            'tier' => $tier,
        ) );
    } else {
        wp_send_json_error( array( 'message' => __( 'This resource is not available for the selected dates.', 'zuidakker' ) ) );
    }
}
add_action( 'wp_ajax_zuidakker_check_availability', 'zuidakker_ajax_check_availability' );
add_action( 'wp_ajax_nopriv_zuidakker_check_availability', 'zuidakker_ajax_check_availability' );

/**
 * Display booking confirmation message
 */
function zuidakker_display_booking_confirmation() {
    if ( isset( $_GET['booking_confirmed'] ) ) {
        $reservation_id = intval( $_GET['booking_confirmed'] );
        $resource_id = get_post_meta( $reservation_id, '_reservation_resource_id', true );
        $resource = get_post( $resource_id );
        
        echo '<div class="booking-confirmation" style="background: #d4edda; color: #155724; padding: 1.5rem; border-radius: 8px; margin: 2rem 0; border: 1px solid #c3e6cb;">';
        echo '<h3 style="margin-top: 0;">' . __( 'Booking Confirmed!', 'zuidakker' ) . '</h3>';
        echo '<p>' . sprintf( __( 'Your reservation for %s has been confirmed. You will receive a confirmation email shortly.', 'zuidakker' ), '<strong>' . esc_html( $resource->post_title ) . '</strong>' ) . '</p>';
        echo '</div>';
    }
}
add_action( 'wp_head', 'zuidakker_display_booking_confirmation' );
