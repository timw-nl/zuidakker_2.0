<?php
/**
 * Contact Form Handler
 * Handles contact form submissions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Handle contact form submission
 */
function zuidakker_handle_contact_form() {
    // Verify nonce
    if ( ! isset( $_POST['contact_nonce'] ) || ! wp_verify_nonce( $_POST['contact_nonce'], 'zuidakker_contact_form' ) ) {
        wp_die( 'Security check failed' );
    }

    // Sanitize form data
    $name = sanitize_text_field( $_POST['contact_name'] );
    $email = sanitize_email( $_POST['contact_email'] );
    $phone = sanitize_text_field( $_POST['contact_phone'] );
    $subject = sanitize_text_field( $_POST['contact_subject'] );
    $message = sanitize_textarea_field( $_POST['contact_message'] );

    // Validate required fields
    if ( empty( $name ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
        wp_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
        exit;
    }

    // Prepare email
    $to = get_option( 'admin_email' ); // Send to site admin email
    $email_subject = 'Nieuw contactformulier bericht: ' . $subject;
    
    $email_body = "Nieuw bericht van het contactformulier:\n\n";
    $email_body .= "Naam: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Telefoon: $phone\n";
    $email_body .= "Onderwerp: $subject\n\n";
    $email_body .= "Bericht:\n$message\n";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    // Send email
    $sent = wp_mail( $to, $email_subject, $email_body, $headers );

    // Redirect with success or error message
    if ( $sent ) {
        wp_redirect( add_query_arg( 'contact', 'success', wp_get_referer() ) );
    } else {
        wp_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
    }
    exit;
}
add_action( 'admin_post_zuidakker_contact_form', 'zuidakker_handle_contact_form' );
add_action( 'admin_post_nopriv_zuidakker_contact_form', 'zuidakker_handle_contact_form' );

/**
 * Display contact form messages
 */
function zuidakker_contact_form_messages() {
    if ( ! isset( $_GET['contact'] ) ) {
        return;
    }

    $message_type = $_GET['contact'];
    
    if ( $message_type === 'success' ) {
        echo '<div class="contact-message contact-success">
            <strong>✓ Bedankt!</strong> Uw bericht is succesvol verzonden. We nemen zo spoedig mogelijk contact met u op.
        </div>';
    } elseif ( $message_type === 'error' ) {
        echo '<div class="contact-message contact-error">
            <strong>✗ Fout</strong> Er is iets misgegaan bij het verzenden van uw bericht. Probeer het later opnieuw.
        </div>';
    }
}
add_action( 'wp_head', 'zuidakker_contact_form_messages' );
