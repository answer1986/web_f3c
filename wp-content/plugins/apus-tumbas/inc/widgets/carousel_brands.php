<?php

if ( class_exists('Apus_Widget') ) {
	class ApusTumbas_Widget_Carousel_Brands extends Apus_Tumbas_Widget {
	    public function __construct() {
	        parent::__construct(
	            // Base ID of your widget
	            'apus_carousel_brands',
	            // Widget name will appear in UI
	            esc_html__('Apus Carousel Brands Widget', 'apus-tumbas'),
	            // Widget description
	            array( 'description' => esc_html__( '', 'apus-tumbas' ), )
	        );
	        $this->widgetName = 'carousel_brands';
	    }

	    public function getTemplate() {
	        $this->template = 'carousel-brands.php';
	    }

	    public function widget( $args, $instance ) {
	        $this->display($args, $instance);
	    }

	    public function form( $instance ) {
	        $defaults = array(
	            'title' => 'Brands',
	            'hide_empty' => 'on',
	            'number' => '10',
	            'columns' => '5',
	            'autoplay' => 'on',
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
	            <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php echo esc_html__( 'Number:', 'apus-tumbas' ); ?></label>
	            <br>
	            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
	        </p>
	        <p>
	            <label for="<?php echo esc_attr($this->get_field_id( 'columns' )); ?>"><?php echo esc_html__( 'Columns:', 'apus-tumbas' ); ?></label>
	            <br>
	            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'columns' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'columns' )); ?>" type="text" value="<?php echo esc_attr( $instance['columns'] ); ?>" />
	        </p>
	        <p>
	        	<input class="checkbox" type="checkbox" <?php checked($instance['autoplay'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" />
            	<label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>"><?php echo esc_html__( 'Autoplay', 'apus-tumbas' ); ?></label>
	        </p>
	<?php
	    }

	    public function update( $new_instance, $old_instance ) {
	        $instance = array();
	        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	        $instance['hide_empty'] = ( ! empty( $new_instance['hide_empty'] ) ) ? $new_instance['hide_empty'] : 'on';
	        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? $new_instance['number'] : '10';
	        $instance['columns'] = ( ! empty( $new_instance['columns'] ) ) ? $new_instance['columns'] : '5';
	        $instance['autoplay'] = ( ! empty( $new_instance['autoplay'] ) ) ? $new_instance['autoplay'] : 'on';
	        return $instance;
	    }
	}
	register_widget( 'ApusTumbas_Widget_Carousel_Brands' );
}