<?php
/**
 * Plugin Name: %plugin_name%
 * Plugin URI: https://standalonetech.com/
 * Description: %plugin_description%
 * Author: StandaloneTech
 * Author URI: https://standalonetech.com/
 * Version: 1.0.0
 * Requires at least: 5.8
 * Tested up to: 6.1
 *
 * Text Domain: %plugin_slug%
 * Domain Path: /languages/
 *
 * @package StandaloneTech
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define %PLUGIN_SLUG%_PLUGIN_FILE.
if ( ! defined( '%PLUGIN_SLUG%_PLUGIN_FILE' ) ) {
	define( '%PLUGIN_SLUG%_PLUGIN_FILE', __FILE__ );
}

// Define %PLUGIN_SLUG%_ABSPATH.
if ( ! defined( '%PLUGIN_SLUG%_ABSPATH' ) ) {
	define( '%PLUGIN_SLUG%_ABSPATH', dirname( %PLUGIN_SLUG%_PLUGIN_FILE ) . '/' );
}

// Include the main class.
if ( ! class_exists( '%PLUGIN_SLUG%' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-%plugin_slug%.php';
}

if ( ! function_exists( '%PLUGIN_SLUG%' ) ) {
	/**
	 * Returns the main instance of WooWallet.
	 *
	 * @since  1.0.0
	 * @return %PLUGIN_SLUG%
	 */
	function %PLUGIN_SLUG%() { //// phpcs:ignore
		return %PLUGIN_SLUG%::instance();
	}
}

%PLUGIN_SLUG%();
