<?php

final class SD_Widget_Maps {

	private static $_instance = null;

	public static function instance() {
		if ( ! isset( static::$_instance ) ) {
			static::$_instance = new static;
		}

		return static::$_instance;
	}

	protected function __construct() {
		$this->init();
	}

	public function on_plugins_loaded() {
		add_action( 'elementor/init', array( $this, 'init' ) );
	}

	public function init(){
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
	}
	
	public function includes() {
		require_once SD_EXTENDER_INC_PATH . '/widgets/maps/maps.php';
	}

	public function register_widgets() {
		$this->includes();
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\SD_Maps() );
	}

}
SD_Widget_Maps::instance();