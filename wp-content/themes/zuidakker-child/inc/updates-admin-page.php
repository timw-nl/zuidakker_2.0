<?php
/**
 * Updates Admin Page - Settings page for homepage updates
 * Provides a dedicated admin page for managing updates content
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add admin menu for updates settings
 */
function zuidakker_updates_admin_menu() {
    add_options_page(
        'Homepage Updates',
        'Homepage Updates',
        'manage_options',
        'zuidakker-updates',
        'zuidakker_updates_admin_page'
    );
}
add_action( 'admin_menu', 'zuidakker_updates_admin_menu' );

/**
 * Register settings
 */
function zuidakker_updates_register_settings() {
    register_setting( 'zuidakker_updates_options', 'zuidakker_updates_enabled' );
    register_setting( 'zuidakker_updates_options', 'zuidakker_updates_title' );
    register_setting( 'zuidakker_updates_options', 'zuidakker_updates_content', array(
        'sanitize_callback' => 'wp_kses_post'
    ) );
    register_setting( 'zuidakker_updates_options', 'zuidakker_updates_display_mode' );
    register_setting( 'zuidakker_updates_options', 'zuidakker_updates_posts_count' );
    register_setting( 'zuidakker_updates_options', 'zuidakker_updates_posts_category' );
    register_setting( 'zuidakker_updates_options', 'zuidakker_updates_bg_color' );
    register_setting( 'zuidakker_updates_options', 'zuidakker_updates_text_color' );
}
add_action( 'admin_init', 'zuidakker_updates_register_settings' );

/**
 * Display admin page
 */
function zuidakker_updates_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    
    // Save settings
    if ( isset( $_POST['zuidakker_updates_submit'] ) && check_admin_referer( 'zuidakker_updates_save', 'zuidakker_updates_nonce' ) ) {
        update_option( 'zuidakker_updates_enabled', isset( $_POST['zuidakker_updates_enabled'] ) ? '1' : '0' );
        update_option( 'zuidakker_updates_title', sanitize_text_field( $_POST['zuidakker_updates_title'] ) );
        update_option( 'zuidakker_updates_content', wp_kses_post( $_POST['zuidakker_updates_content'] ) );
        update_option( 'zuidakker_updates_display_mode', sanitize_text_field( $_POST['zuidakker_updates_display_mode'] ) );
        update_option( 'zuidakker_updates_posts_count', absint( $_POST['zuidakker_updates_posts_count'] ) );
        update_option( 'zuidakker_updates_posts_category', sanitize_text_field( $_POST['zuidakker_updates_posts_category'] ) );
        update_option( 'zuidakker_updates_bg_color', sanitize_text_field( $_POST['zuidakker_updates_bg_color'] ) );
        update_option( 'zuidakker_updates_text_color', sanitize_hex_color( $_POST['zuidakker_updates_text_color'] ) );
        
        echo '<div class="notice notice-success"><p>Instellingen opgeslagen!</p></div>';
    }
    
    $enabled = get_option( 'zuidakker_updates_enabled', '1' );
    $title = get_option( 'zuidakker_updates_title', 'Laatste Updates' );
    $content = get_option( 'zuidakker_updates_content', 'Welkom bij Zuidakker! Hier vind je de laatste updates over onze activiteiten en evenementen.' );
    $display_mode = get_option( 'zuidakker_updates_display_mode', 'custom' );
    $posts_count = get_option( 'zuidakker_updates_posts_count', '3' );
    $posts_category = get_option( 'zuidakker_updates_posts_category', '' );
    $bg_color = get_option( 'zuidakker_updates_bg_color', 'rgba(255, 255, 255, 0.15)' );
    $text_color = get_option( 'zuidakker_updates_text_color', '#ffffff' );
    ?>
    <div class="wrap">
        <h1>📢 Homepage Updates</h1>
        <p>Beheer de updates sectie die onder de pijlers op de homepage verschijnt.</p>
        
        <form method="post" action="">
            <?php wp_nonce_field( 'zuidakker_updates_save', 'zuidakker_updates_nonce' ); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="zuidakker_updates_enabled">Toon Updates Sectie</label>
                    </th>
                    <td>
                        <input type="checkbox" id="zuidakker_updates_enabled" name="zuidakker_updates_enabled" value="1" <?php checked( $enabled, '1' ); ?>>
                        <p class="description">Vink aan om de updates sectie op de homepage te tonen.</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="zuidakker_updates_title">Titel</label>
                    </th>
                    <td>
                        <input type="text" id="zuidakker_updates_title" name="zuidakker_updates_title" value="<?php echo esc_attr( $title ); ?>" class="regular-text">
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="zuidakker_updates_display_mode">Weergave Modus</label>
                    </th>
                    <td>
                        <select id="zuidakker_updates_display_mode" name="zuidakker_updates_display_mode" class="regular-text">
                            <option value="custom" <?php selected( $display_mode, 'custom' ); ?>>Aangepaste Tekst</option>
                            <option value="posts" <?php selected( $display_mode, 'posts' ); ?>>Recente Posts</option>
                            <option value="both" <?php selected( $display_mode, 'both' ); ?>>Beide (Tekst + Posts)</option>
                        </select>
                        <p class="description">Kies wat u wilt weergeven in de updates sectie.</p>
                    </td>
                </tr>
                
                <tr class="custom-content-row">
                    <th scope="row">
                        <label for="zuidakker_updates_content">Aangepaste Inhoud</label>
                    </th>
                    <td>
                        <?php
                        wp_editor( $content, 'zuidakker_updates_content', array(
                            'textarea_name' => 'zuidakker_updates_content',
                            'textarea_rows' => 10,
                            'media_buttons' => false,
                            'teeny' => true,
                            'quicktags' => true,
                        ) );
                        ?>
                        <p class="description">Gebruik de editor om uw updates te schrijven. HTML wordt ondersteund.</p>
                    </td>
                </tr>
                
                <tr class="posts-settings-row">
                    <th scope="row">
                        <label for="zuidakker_updates_posts_count">Aantal Posts</label>
                    </th>
                    <td>
                        <input type="number" id="zuidakker_updates_posts_count" name="zuidakker_updates_posts_count" value="<?php echo esc_attr( $posts_count ); ?>" min="1" max="10" class="small-text">
                        <p class="description">Hoeveel recente posts wilt u tonen? (1-10)</p>
                    </td>
                </tr>
                
                <tr class="posts-settings-row">
                    <th scope="row">
                        <label for="zuidakker_updates_posts_category">Categorie Filter</label>
                    </th>
                    <td>
                        <select id="zuidakker_updates_posts_category" name="zuidakker_updates_posts_category" class="regular-text">
                            <option value="">Alle Categorieën</option>
                            <?php
                            $categories = get_categories( array( 'hide_empty' => false ) );
                            foreach ( $categories as $category ) {
                                echo '<option value="' . esc_attr( $category->term_id ) . '" ' . selected( $posts_category, $category->term_id, false ) . '>' . esc_html( $category->name ) . '</option>';
                            }
                            ?>
                        </select>
                        <p class="description">Filter posts op specifieke categorie (optioneel).</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="zuidakker_updates_bg_color">Achtergrondkleur</label>
                    </th>
                    <td>
                        <input type="text" id="zuidakker_updates_bg_color" name="zuidakker_updates_bg_color" value="<?php echo esc_attr( $bg_color ); ?>" class="regular-text">
                        <p class="description">Gebruik RGBA formaat, bijv: rgba(255, 255, 255, 0.15)</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="zuidakker_updates_text_color">Tekstkleur</label>
                    </th>
                    <td>
                        <input type="text" id="zuidakker_updates_text_color" name="zuidakker_updates_text_color" value="<?php echo esc_attr( $text_color ); ?>" class="color-picker">
                        <p class="description">Kies de tekstkleur voor de updates sectie.</p>
                    </td>
                </tr>
            </table>
            
            <p class="submit">
                <input type="submit" name="zuidakker_updates_submit" class="button button-primary" value="Instellingen Opslaan">
            </p>
        </form>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('.color-picker').wpColorPicker();
        
        // Show/hide fields based on display mode
        function toggleDisplayModeFields() {
            var mode = $('#zuidakker_updates_display_mode').val();
            
            if (mode === 'custom') {
                $('.custom-content-row').show();
                $('.posts-settings-row').hide();
            } else if (mode === 'posts') {
                $('.custom-content-row').hide();
                $('.posts-settings-row').show();
            } else if (mode === 'both') {
                $('.custom-content-row').show();
                $('.posts-settings-row').show();
            }
        }
        
        toggleDisplayModeFields();
        $('#zuidakker_updates_display_mode').on('change', toggleDisplayModeFields);
    });
    </script>
    <?php
}

/**
 * Enqueue color picker
 */
function zuidakker_updates_admin_scripts( $hook ) {
    if ( 'settings_page_zuidakker-updates' !== $hook ) {
        return;
    }
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'zuidakker_updates_admin_scripts' );
