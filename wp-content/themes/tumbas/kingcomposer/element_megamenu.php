<?php

$atts  = array_merge( array(
	'nav_slug' => '',
), $atts);

extract( $atts );

if ($nav_slug):
	$key = tumbas_random_key();
?>
	<div class="element-megamenu text-center">
		<?php
			$args = array(
                'menu' => $nav_slug,
                'container_class' => 'collapse navbar-collapse',
                'menu_class' => 'nav navbar-nav megamenu main-menu-v1',
                'fallback_cb' => '',
                'menu_id' => 'element-megamenu'.$key,
                'walker' => new Tumbas_Nav_Menu()
            );
            wp_nav_menu($args);
        ?>
	</div>
<?php endif; ?>