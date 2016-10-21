<?php
/**
 * Plugin Name: Post Type Echo
 * Description: Echo any Post Type by widget
 * Version: 1.0
 * Author: Unnamed
 *
 * @package PT_Echo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PT_ECHO_DIR', plugin_dir_path( __FILE__ ) );
define( 'PT_ECHO_URL', plugin_dir_url( __FILE__ ) );


include_once( PT_ECHO_DIR . 'includes/pt-echo-core-functions.php' );
include_once( PT_ECHO_DIR . 'class.pt-echo.php' );
include_once( PT_ECHO_DIR . 'class.pt-echo-widget.php' );


/**
 * Main instance of PT_Echo.
 *
 * Returns the main instance of PTEcho to prevent the need to use globals.
 *
 * @return PT_Echo
 */
function pt_eco() {
	return PT_Echo::instance();
}

add_action( 'init', 'pt_eco' );