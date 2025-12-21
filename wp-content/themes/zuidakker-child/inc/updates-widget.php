<?php
/**
 * Updates Widget - Alternative approach using WordPress Widget
 * Allows content administrators to add updates via Widgets
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Zuidakker_Updates_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'zuidakker_updates_widget',
            '📢 Homepage Updates',
            array( 'description' => 'Updates sectie voor de homepage' )
        );
    }
    
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Laatste Updates';
        $content = ! empty( $instance['content'] ) ? $instance['content'] : '';
        
        if ( empty( $content ) ) {
            return;
        }
        
        ?>
        <div class="updates-section">
            <div class="updates-container">
                <h2 class="updates-title"><?php echo esc_html( $title ); ?></h2>
                <div class="updates-content">
                    <?php echo wpautop( wp_kses_post( $content ) ); ?>
                </div>
            </div>
        </div>
        <?php
    }
    
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Laatste Updates';
        $content = ! empty( $instance['content'] ) ? $instance['content'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Titel:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
                   type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>">Inhoud:</label>
            <textarea class="widefat" rows="10" 
                      id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>" 
                      name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>"><?php echo esc_textarea( $content ); ?></textarea>
        </p>
        <?php
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['content'] = ( ! empty( $new_instance['content'] ) ) ? wp_kses_post( $new_instance['content'] ) : '';
        return $instance;
    }
}

function zuidakker_register_updates_widget() {
    register_widget( 'Zuidakker_Updates_Widget' );
}
add_action( 'widgets_init', 'zuidakker_register_updates_widget' );
