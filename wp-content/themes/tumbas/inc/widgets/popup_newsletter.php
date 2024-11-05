<?php

class Tumbas_Widget_Popup_Newsletter extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_popup_newsletter',
            esc_html__('Apus Popup Newsletter Widget', 'tumbas'),
            array( 'description' => esc_html__( 'Show Popup Newsletter', 'tumbas' ), )
        );
        $this->widgetName = 'popup_newsletter';
        add_action('admin_enqueue_scripts', array($this, 'scripts'));
    }
    
    public function scripts() {
        wp_enqueue_script( 'apus-upload-image', APUS_THEMER_URL . 'assets/upload.js', array( 'jquery', 'wp-pointer' ), APUS_THEMER_VERSION, true );
    }

    public function getTemplate() {
        $this->template = 'popup-newsletter.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array('title' => 'Newsletter', 'description' => "Put your content here", 'image' => '', 'facebook' => '', 'instagram' => '', 'twitter' => '', 'pinterest' => '');
        $instance = wp_parse_args( (array) $instance, $defaults );
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><strong><?php esc_html_e('Title:', 'tumbas');?></strong></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $instance['title'] ) ; ?>" class="widefat" />
        </p>
                

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php esc_html_e( 'Description:', 'tumbas' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>"  cols="20" rows="3"><?php echo trim( $instance['description'] ) ; ?></textarea>
        </p>

        <label for="<?php echo esc_attr($this->get_field_id( 'image' )); ?>"><?php esc_html_e( 'Image:', 'tumbas' ); ?></label>
        <div class="screenshot">
            <?php if ( $instance['image'] ) { ?>
                <img src="<?php echo esc_url($instance['image']); ?>" style="max-width:100%" alt=""/>
            <?php } ?>
        </div>
        <input class="widefat upload_image" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'image' )); ?>" type="hidden" value="<?php echo esc_attr($instance['image']); ?>" />
        <div class="upload_image_action">
            <input type="button" class="button add-image" value="Add">
            <input type="button" class="button remove-image" value="Remove">
        </div>
        <!-- social -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><strong><?php esc_html_e('Facebook:', 'tumbas');?></strong></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" value="<?php echo esc_attr( $instance['facebook'] ) ; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>"><strong><?php esc_html_e('Instagram:', 'tumbas');?></strong></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram' )); ?>" value="<?php echo esc_attr( $instance['instagram'] ) ; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><strong><?php esc_html_e('Twitter:', 'tumbas');?></strong></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" value="<?php echo esc_attr( $instance['twitter'] ) ; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>"><strong><?php esc_html_e('Pinterest:', 'tumbas');?></strong></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" value="<?php echo esc_attr( $instance['pinterest'] ) ; ?>" class="widefat" />
        </p>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
        $instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
        $instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
        $instance['pinterest'] = ( ! empty( $new_instance['pinterest'] ) ) ? strip_tags( $new_instance['pinterest'] ) : '';
        return $instance;

    }
}

register_widget( 'Tumbas_Widget_Popup_Newsletter' );