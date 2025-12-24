<?php
/**
 * Booking Calendar - Display availability calendar
 * Shows bookings in a calendar view for resources
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register calendar shortcode
 */
function zuidakker_booking_calendar_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'resource_id' => '',
        'type' => '',
    ), $atts );

    ob_start();
    zuidakker_render_booking_calendar( $atts );
    return ob_get_clean();
}
add_shortcode( 'booking_calendar', 'zuidakker_booking_calendar_shortcode' );

/**
 * Render booking calendar
 */
function zuidakker_render_booking_calendar( $atts ) {
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
        echo '<p>' . __( 'No bookable resources available.', 'zuidakker' ) . '</p>';
        return;
    }

    wp_enqueue_style( 'zuidakker-booking-calendar', get_stylesheet_directory_uri() . '/assets/css/booking-calendar.css', array(), '1.0' );

    $current_month = isset( $_GET['month'] ) ? intval( $_GET['month'] ) : date( 'n' );
    $current_year = isset( $_GET['year'] ) ? intval( $_GET['year'] ) : date( 'Y' );

    ?>
    <div class="zuidakker-booking-calendar">
        <div class="calendar-header">
            <h3><?php echo date_i18n( 'F Y', mktime( 0, 0, 0, $current_month, 1, $current_year ) ); ?></h3>
            <div class="calendar-nav">
                <?php
                $prev_month = $current_month - 1;
                $prev_year = $current_year;
                if ( $prev_month < 1 ) {
                    $prev_month = 12;
                    $prev_year--;
                }
                
                $next_month = $current_month + 1;
                $next_year = $current_year;
                if ( $next_month > 12 ) {
                    $next_month = 1;
                    $next_year++;
                }
                
                $base_url = remove_query_arg( array( 'month', 'year' ) );
                ?>
                <a href="<?php echo add_query_arg( array( 'month' => $prev_month, 'year' => $prev_year ), $base_url ); ?>" class="calendar-prev">
                    ← <?php _e( 'Previous', 'zuidakker' ); ?>
                </a>
                <a href="<?php echo add_query_arg( array( 'month' => $next_month, 'year' => $next_year ), $base_url ); ?>" class="calendar-next">
                    <?php _e( 'Next', 'zuidakker' ); ?> →
                </a>
            </div>
        </div>

        <?php foreach ( $resources as $resource ) : ?>
            <div class="resource-calendar">
                <h4><?php echo esc_html( $resource->post_title ); ?></h4>
                <?php zuidakker_render_month_calendar( $resource->ID, $current_month, $current_year ); ?>
            </div>
        <?php endforeach; ?>

        <div class="calendar-legend">
            <div class="legend-item">
                <span class="legend-color available"></span>
                <span><?php _e( 'Available', 'zuidakker' ); ?></span>
            </div>
            <div class="legend-item">
                <span class="legend-color booked"></span>
                <span><?php _e( 'Booked', 'zuidakker' ); ?></span>
            </div>
            <div class="legend-item">
                <span class="legend-color past"></span>
                <span><?php _e( 'Past', 'zuidakker' ); ?></span>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Render month calendar for a resource
 */
function zuidakker_render_month_calendar( $resource_id, $month, $year ) {
    $first_day = mktime( 0, 0, 0, $month, 1, $year );
    $days_in_month = date( 't', $first_day );
    $day_of_week = date( 'w', $first_day );
    
    $reservations = zuidakker_get_resource_reservations( $resource_id );
    
    $booked_dates = array();
    foreach ( $reservations as $reservation ) {
        $start = new DateTime( get_post_meta( $reservation->ID, '_reservation_start_date', true ) );
        $end = new DateTime( get_post_meta( $reservation->ID, '_reservation_end_date', true ) );
        
        $period = new DatePeriod(
            $start,
            new DateInterval( 'P1D' ),
            $end->modify( '+1 day' )
        );
        
        foreach ( $period as $date ) {
            $booked_dates[] = $date->format( 'Y-m-d' );
        }
    }
    
    $today = date( 'Y-m-d' );
    
    echo '<table class="month-calendar">';
    echo '<thead><tr>';
    
    $days = array( __( 'Sun', 'zuidakker' ), __( 'Mon', 'zuidakker' ), __( 'Tue', 'zuidakker' ), __( 'Wed', 'zuidakker' ), __( 'Thu', 'zuidakker' ), __( 'Fri', 'zuidakker' ), __( 'Sat', 'zuidakker' ) );
    foreach ( $days as $day ) {
        echo '<th>' . $day . '</th>';
    }
    
    echo '</tr></thead><tbody><tr>';
    
    for ( $i = 0; $i < $day_of_week; $i++ ) {
        echo '<td class="empty"></td>';
    }
    
    for ( $day = 1; $day <= $days_in_month; $day++ ) {
        $date = sprintf( '%04d-%02d-%02d', $year, $month, $day );
        $is_booked = in_array( $date, $booked_dates );
        $is_past = $date < $today;
        
        $class = 'day';
        if ( $is_past ) {
            $class .= ' past';
        } elseif ( $is_booked ) {
            $class .= ' booked';
        } else {
            $class .= ' available';
        }
        
        if ( $date === $today ) {
            $class .= ' today';
        }
        
        echo '<td class="' . $class . '">';
        echo '<span class="day-number">' . $day . '</span>';
        echo '</td>';
        
        if ( ( $day_of_week + $day ) % 7 == 0 && $day < $days_in_month ) {
            echo '</tr><tr>';
        }
    }
    
    $remaining_cells = ( 7 - ( ( $day_of_week + $days_in_month ) % 7 ) ) % 7;
    for ( $i = 0; $i < $remaining_cells; $i++ ) {
        echo '<td class="empty"></td>';
    }
    
    echo '</tr></tbody></table>';
}

/**
 * Add user booking dashboard shortcode
 */
function zuidakker_user_bookings_shortcode() {
    if ( ! is_user_logged_in() ) {
        return '<p>' . __( 'Please log in to view your bookings.', 'zuidakker' ) . '</p>';
    }

    ob_start();
    zuidakker_render_user_bookings();
    return ob_get_clean();
}
add_shortcode( 'my_bookings', 'zuidakker_user_bookings_shortcode' );

/**
 * Render user bookings dashboard
 */
function zuidakker_render_user_bookings() {
    $user_id = get_current_user_id();
    
    $args = array(
        'post_type' => 'reservation',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_reservation_user_id',
                'value' => $user_id,
            ),
        ),
        'orderby' => 'meta_value',
        'meta_key' => '_reservation_start_date',
        'order' => 'DESC',
    );

    $reservations = get_posts( $args );

    if ( empty( $reservations ) ) {
        echo '<p>' . __( 'You have no bookings yet.', 'zuidakker' ) . '</p>';
        return;
    }

    ?>
    <div class="user-bookings">
        <h3><?php _e( 'My Bookings', 'zuidakker' ); ?></h3>
        <table class="bookings-table">
            <thead>
                <tr>
                    <th><?php _e( 'Resource', 'zuidakker' ); ?></th>
                    <th><?php _e( 'Dates', 'zuidakker' ); ?></th>
                    <th><?php _e( 'Status', 'zuidakker' ); ?></th>
                    <th><?php _e( 'Price', 'zuidakker' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $reservations as $reservation ) :
                    $resource_id = get_post_meta( $reservation->ID, '_reservation_resource_id', true );
                    $resource = get_post( $resource_id );
                    $start_date = get_post_meta( $reservation->ID, '_reservation_start_date', true );
                    $end_date = get_post_meta( $reservation->ID, '_reservation_end_date', true );
                    $status = get_post_meta( $reservation->ID, '_reservation_status', true );
                    $price = get_post_meta( $reservation->ID, '_reservation_total_price', true );
                ?>
                <tr>
                    <td><?php echo esc_html( $resource->post_title ); ?></td>
                    <td>
                        <?php echo date_i18n( get_option( 'date_format' ), strtotime( $start_date ) ); ?> - 
                        <?php echo date_i18n( get_option( 'date_format' ), strtotime( $end_date ) ); ?>
                    </td>
                    <td>
                        <span class="status-badge status-<?php echo esc_attr( $status ); ?>">
                            <?php echo ucfirst( $status ); ?>
                        </span>
                    </td>
                    <td>
                        <?php if ( $price > 0 ) : ?>
                            €<?php echo number_format( (float) $price, 2 ); ?>
                        <?php else : ?>
                            <span style="color: #46b450;"><?php _e( 'Free', 'zuidakker' ); ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <style>
    .user-bookings {
        margin: 2rem 0;
    }
    .bookings-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .bookings-table th,
    .bookings-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    .bookings-table th {
        background: #f9f9f9;
        font-weight: 600;
    }
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 4px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    .status-confirmed {
        background: #d4edda;
        color: #155724;
    }
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    .status-completed {
        background: #d1ecf1;
        color: #0c5460;
    }
    </style>
    <?php
}
