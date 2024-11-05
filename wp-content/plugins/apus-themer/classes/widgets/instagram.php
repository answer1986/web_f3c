<?php

class Apus_Themer_Widget_Instagram extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_instagram',
            esc_html__('Apus Instagram Widget', 'apus-themer'),
            array( 'description' => esc_html__( 'Show instagram', 'apus-themer' ), )
        );
        $this->widgetName = 'instagram';
    }

    public function getTemplate() {
        $this->template = 'instagram.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'Instagram',
            'username' => '',
            'number' => '',
            'size' => '',
            'target' => '',
            'columns' => 4
        );
        $instance = wp_parse_args((array) $instance, $defaults);

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'apus-themer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'username' )); ?>"><?php esc_html_e( 'Username:', 'apus-themer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'username' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'username' )); ?>" type="text" value="<?php echo esc_attr( $instance['username'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number:', 'apus-themer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
        </p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Photo size', 'apus-themer' ); ?>:</label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" class="widefat">
                <option value="thumbnail" <?php selected( 'thumbnail', $instance['size'] ) ?>><?php esc_html_e( 'Thumbnail', 'apus-themer' ); ?></option>
                <option value="small" <?php selected( 'small', $instance['size'] ) ?>><?php esc_html_e( 'Small', 'apus-themer' ); ?></option>
                <option value="large" <?php selected( 'large', $instance['size'] ) ?>><?php esc_html_e( 'Large', 'apus-themer' ); ?></option>
                <option value="original" <?php selected( 'original', $instance['size'] ) ?>><?php esc_html_e( 'Original', 'apus-themer' ); ?></option>
            </select>
        </p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open links in', 'apus-themer' ); ?>:</label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">
                <option value="_self" <?php selected( '_self', $instance['target'] ) ?>><?php esc_html_e( 'Current window (_self)', 'apus-themer' ); ?></option>
                <option value="_blank" <?php selected( '_blank', $instance['target'] ) ?>><?php esc_html_e( 'New window (_blank)', 'apus-themer' ); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'columns' )); ?>"><?php esc_html_e( 'Columns:', 'apus-themer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'columns' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'columns' )); ?>" type="text" value="<?php echo esc_attr( $instance['columns'] ); ?>" />
        </p>
<?php
    }

    function scrape_instagram( $username ) {

        $username = strtolower( $username );
        $username = str_replace( '@', '', $username );

        if ( false === ( $instagram = get_transient( 'instagram-a5-'.sanitize_title_with_dashes( $username ) ) ) ) {

            $remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

            if ( is_wp_error( $remote ) )
                return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'apus-themer' ) );

            if ( 200 != wp_remote_retrieve_response_code( $remote ) )
                return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'apus-themer' ) );

            $shards = explode( 'window._sharedData = ', $remote['body'] );
            $insta_json = explode( ';</script>', $shards[1] );
            $insta_array = json_decode( $insta_json[0], TRUE );
            
            if ( ! $insta_array )
                return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'apus-themer' ) );

            if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
                $images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
            } else {
                return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'apus-themer' ) );
            }

            if ( ! is_array( $images ) )
                return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'apus-themer' ) );

            $instagram = array();

            foreach ( $images as $dimage ) {
                $image = $dimage['node'];

                $image['thumbnail_src'] = preg_replace( '/^https?\:/i', '', $image['thumbnail_src'] );
                $image['display_src'] = preg_replace( '/^https?\:/i', '', $image['display_url'] );

                // handle both types of CDN url
                if ( ( strpos( $image['thumbnail_src'], 's640x640' ) !== false ) ) {
                    $image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
                    $image['small'] = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
                } else {
                    $urlparts = wp_parse_url( $image['thumbnail_src'] );
                    $pathparts = explode( '/', $urlparts['path'] );
                    array_splice( $pathparts, 3, 0, array( 's160x160' ) );
                    $image['thumbnail'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
                    $pathparts[3] = 's320x320';
                    $image['small'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
                }
                if ( is_array($image['thumbnail_resources']) ) {
                    foreach ($image['thumbnail_resources'] as $resource) {
                        if ( $resource['config_width'] == 150 ) {
                            $image['small'] = $resource['src'];
                        } elseif( $resource['config_width'] == 480 ) {
                            $image['thumbnail'] = $resource['src'];
                        }
                    }
                }

                $image['large'] = $image['thumbnail_src'];
                if ( empty($image['small']) ) {
                    $image['small'] = $image['thumbnail_src'];
                }
                if ( empty($image['thumbnail']) ) {
                    $image['thumbnail'] = $image['thumbnail_src'];
                }

                if ( $image['is_video'] == true ) {
                    $type = 'video';
                } else {
                    $type = 'image';
                }

                $caption = esc_html__( 'Instagram Image', 'apus-themer' );
                if ( ! empty( $image['caption'] ) ) {
                    $caption = $image['caption'];
                }
        
                $instagram[] = array(
                    'description'   => $caption,
                    'link'          => trailingslashit( '//instagram.com/p/' . $image['shortcode'] ),
                    'time'          => $image['taken_at_timestamp'],
                    'comments'      => $image['edge_media_to_comment']['count'],
                    'likes'         => $image['edge_liked_by']['count'],
                    'thumbnail'     => $image['thumbnail'],
                    'small'         => $image['small'],
                    'large'         => $image['large'],
                    'original'      => $image['display_src'],
                    'type'          => $type
                );
            }
            // do not set an empty transient - should help catch private or empty accounts
            if ( ! empty( $instagram ) ) {
                $instagram = base64_encode( serialize( $instagram ) );
                set_transient( 'instagram-a5-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
            }
        }

        if ( ! empty( $instagram ) ) {
            return unserialize( base64_decode( $instagram ) );
        } else {
            return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'apus-themer' ) );
        }
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['username'] = ( ! empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        $instance['size'] = ( ! empty( $new_instance['size'] ) ) ? strip_tags( $new_instance['size'] ) : '';
        $instance['target'] = ( ! empty( $new_instance['target'] ) ) ? strip_tags( $new_instance['target'] ) : '';
        $instance['columns'] = ( ! empty( $new_instance['columns'] ) ) ? strip_tags( $new_instance['columns'] ) : '';
        return $instance;

    }

    function images_only( $media_item ) {
        if ( $media_item['type'] == 'image' )
            return true;
        return false;
    }
}

register_widget( 'Apus_Themer_Widget_Instagram' );