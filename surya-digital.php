<?php
/**
* Plugin Name: Test Surya Digital
* Author: Dezanni Alavi Hazan
* Author URI: 
* Description: -
* Version: 1.0.0
* Requires PHP: 8.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

define( 'SD_EXTENDER_VERSION', '1.0' );
define( 'SD_EXTENDER_URI', plugin_dir_url( __FILE__ ) );
define( 'SD_EXTENDER_PATH', plugin_dir_path( __FILE__ ) );
define( 'SD_EXTENDER_INC_URI', SD_EXTENDER_URI . 'inc' );
define( 'SD_EXTENDER_INC_PATH', SD_EXTENDER_PATH . 'inc' );

if( !function_exists(' sd_debug' ) ){
	function sd_debug( $debug_code = '' ){
		echo '<pre>'. print_r( $debug_code, true ) .'</pre>';
	}
}

foreach ( glob( SD_EXTENDER_INC_PATH . '/*/include.php' ) as $module ) {
	include_once $module;
}