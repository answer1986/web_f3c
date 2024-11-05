<?php
/**
 * widget base for apus themer
 *
 * @package    apus-themer
 * @author     Team Apusthemes <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  2015-2016 Apus Themer
 */

abstract class Apus_Widget extends WP_Widget {
	
	public $template;
	abstract function getTemplate();

	public function display( $args, $instance ) {
		$this->getTemplate();
		extract($args);
		extract($instance);
		echo $before_widget;
			require apus_themer_get_widget_locate( $this->template );
		echo $after_widget;
	}
}