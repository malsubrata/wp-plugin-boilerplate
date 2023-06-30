<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @package StandaloneTech
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! class_exists( '%PLUGIN_SLUG%_FRONTEND' ) ) {
	/**
	 * Plugin %PLUGIN_SLUG%_FRONTEND Class.
	 */
	class %PLUGIN_SLUG%_FRONTEND {
		/**
		 * Initialize the class and set its properties.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Register the stylesheets for the frontend area.s
		 *
		 * @since    1.0.0
		 */
		public function enqueue_styles() {
			wp_enqueue_style( '%plugin_slug%-frontend', untrailingslashit( plugins_url( '/', %PLUGIN_SLUG%_PLUGIN_FILE ) ) . '/assets/css/%plugin_slug%-frontend.css', array(), '1.0.0', 'all' );
		}

		/**
		 * Register the JavaScript for the frontend area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_scripts() {
			wp_enqueue_script( '%plugin_slug%-frontend', untrailingslashit( plugins_url( '/', %PLUGIN_SLUG%_PLUGIN_FILE ) ) . '/assets/js/%plugin_slug%-frontend.js', array( 'jquery' ), '1.0.0', false );
		}
	}
}

new %PLUGIN_SLUG%_FRONTEND();

