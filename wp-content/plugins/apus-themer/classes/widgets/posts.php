<?php

class Apus_Themer_Widget_Posts extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            // Base ID of your widget
            'apus_posts',
            // Widget name will appear in UI
            esc_html__('Apus Posts Widget', 'apus-themer'),
            // Widget description
            array( 'description' => esc_html__( '', 'apus-themer' ), )
        );
        $this->widgetName = 'posts';
    }

    public function getTemplate() {
        $this->template = 'posts.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }

    public function form( $instance ) {
        $defaults = array(
            'title' => 'List Posts',
            'layout' => 'default' ,
            'ids' => array(),
            'class'=>''
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $posts = get_posts( array('orderby'=>'title','posts_per_page'=>-1) );
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:', 'apus-themer' ); ?></label>
            <br>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'ids' )); ?>"><?php echo esc_html__( 'Posts:', 'apus-themer' ); ?></label>
            <br>
            <select multiple name="<?php echo esc_attr($this->get_field_name( 'ids' )); ?>[]" id="<?php echo esc_attr($this->get_field_id( 'ids' )); ?>" style="width:100%;height:250px;">
               <?php foreach( $posts as $value ){ ?>
                <?php
                    $selected = ( in_array($value->ID, $instance['ids'] ) )?' selected="selected"':'';
                ?>
                <option value="<?php echo esc_attr( $value->ID ); ?>" <?php echo trim($selected); ?>>
                    <?php echo esc_html( $value->post_title ); ?>
                </option>
               <?php } ?>
            </select>
        </p>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? $new_instance['layout'] : 'default';
        $instance['ids'] = $new_instance['ids'];
        return $instance;
    }
}
register_widget( 'Apus_Themer_Widget_Posts' );