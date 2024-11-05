<?php

if ( class_exists('Apus_Widget') ) {
	class ApusTumbas_Widget_Brands extends Apus_Tumbas_Widget {
	    public function __construct() {
	        parent::__construct(
	            // Base ID of your widget
	            'apus_brands',
	            // Widget name will appear in UI
	            esc_html__('Apus Brands Widget', 'apus-tumbas'),
	            // Widget description
	            array( 'description' => esc_html__( '', 'apus-tumbas' ), )
	        );
	        $this->widgetName = 'brands';
	    }

	    public function getTemplate() {
	        $this->template = 'brands.php';
	    }

	    public function widget( $args, $instance ) {
	        $this->display($args, $instance);
	    }

	    public function form( $instance ) {
	        $defaults = array(
	            'title' => 'Shop By Brand',
	            'hide_empty' => 'on',
	            'show_count' => 'on'
	        );
	        $instance = wp_parse_args((array) $instance, $defaults);
	        // Widget admin form
	        ?>
	        <p>
	            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:', 'apus-tumbas' ); ?></label>
	            <br>
	            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	        </p>
	        <p>
	        	<input class="checkbox" type="checkbox" <?php checked($instance['hide_empty'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('hide_empty')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_empty')); ?>" />
            	<label for="<?php echo esc_attr($this->get_field_id('hide_empty')); ?>"><?php echo esc_html__( 'Hide empty', 'apus-tumbas' ); ?></label>
	        </p>
	        <p>
	        	<input class="checkbox" type="checkbox" <?php checked($instance['show_count'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_count')); ?>" name="<?php echo esc_attr($this->get_field_name('show_count')); ?>" />
            	<label for="<?php echo esc_attr($this->get_field_id('show_count')); ?>"><?php echo esc_html__( 'Show Product Count', 'apus-tumbas' ); ?></label>
	        </p>
	<?php
	    }

	    public function update( $new_instance, $old_instance ) {
	        $instance = array();
	        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	        $instance['hide_empty'] = ( ! empty( $new_instance['hide_empty'] ) ) ? $new_instance['hide_empty'] : 'on';
	        $instance['show_count'] = ( ! empty( $new_instance['show_count'] ) ) ? $new_instance['show_count'] : 'on';
	        return $instance;
	    }
	}
	register_widget( 'ApusTumbas_Widget_Brands' );
}