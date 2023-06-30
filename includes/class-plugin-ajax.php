<?php
/**
 * The ajax functionality of the plugin.
 *
 * @package StandaloneTech
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! class_exists( '%PLUGIN_SLUG%_AJAX' ) ) {
	/**
	 * Plugin %PLUGIN_SLUG%_AJAX Class.
	 */
	class %PLUGIN_SLUG%_AJAX {
		/**
		 * Initialize the class and set its properties.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			// Your ajax hooks here.
		}
	}
}

new %PLUGIN_SLUG%_AJAX();
