<?php


if ( ! class_exists( 'PT_Echo' ) ) :

	/**
	 * Main Post Type Echo Class.
	 *
	 * @class PT_Echo
	 * @version    1.0.0
	 */

	class PT_Echo {
		/**
		 * The single instance of the class.
		 *
		 * @var PT_Echo
		 */
		protected static $_instance = null;


		/**
		 * Main PTEcho Instance.
		 *
		 *
		 * @static
		 * @see PT_Echo()
		 * @return PT_Echo - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}


		/**
		 * PT_Echo Constructor.
		 */
		private function __construct() {
			$this->init_hooks();
			do_action( 'pt_echo_loaded' );
		}

		/**
		 * Hook into actions and filters.
		 */
		private function init_hooks() {
			register_activation_hook( __FILE__, 'activate' );
			register_deactivation_hook( __FILE__, 'deactivate' );

			add_action('wp_enqueue_scripts', array($this, 'register_pt_styles'));
		}

		/**
		 * Register styles
		 */
		function register_pt_styles() {
			wp_enqueue_style('pt-echo-style', PT_ECHO_URL . 'assets/css/pt-echo-styles.css', array(), '1.0.1');
		}

		/**
		 * Activate plugin function.
		 */
		public static function activate() {

		}

		/**
		 * Deactivate plugin function.
		 */
		public static function deactivate() {

		}

	}

endif;