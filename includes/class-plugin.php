<?php
/**
 * Plugin main class file.
 *
 * @package StandaloneTech
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main plugin calss
 */
final class %PLUGIN_SLUG% {
	/**
	 * The single instance of the class.
	 *
	 * @var %PLUGIN_SLUG%
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Main instance
	 *
	 * @return class object
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->includes();
		$this->load_plugin_textdomain();
	}

	/**
	 * Check request
	 *
	 * @param string $type Type.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Load plugin files
	 */
	public function includes() {
		if ( $this->is_request( 'admin' ) ) {
			include_once %PLUGIN_SLUG%_ABSPATH . 'includes/class-%plugin_slug%-admin.php';
		}

		if ( $this->is_request( 'frontend' ) ) {
			include_once %PLUGIN_SLUG%_ABSPATH . 'includes/class-%plugin_slug%-frontend.php';
		}

		if ( $this->is_request( 'ajax' ) ) {
			include_once %PLUGIN_SLUG%_ABSPATH . 'includes/class-%plugin_slug%-ajax.php';
		}
	}

	/**
	 * Text Domain loader
	 */
	public function load_plugin_textdomain() {
		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, '%plugin_slug%' );

		unload_textdomain( '%plugin_slug%' );
		load_textdomain( '%plugin_slug%', WP_LANG_DIR . '/%plugin_slug%/%plugin_slug%-' . $locale . '.mo' );
		load_plugin_textdomain( '%plugin_slug%', false, plugin_basename( dirname( %PLUGIN_SLUG%_PLUGIN_FILE ) ) . '/languages' );
	}

	/**
	 * Load template
	 *
	 * @param string $template_name Tempate Name.
	 * @param array  $args args.
	 * @param string $template_path Template Path.
	 * @param string $default_path Default path.
	 */
	public function get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		if ( $args && is_array( $args ) ) {
			extract( $args ); // phpcs:ignore
		}
		$located = $this->locate_template( $template_name, $template_path, $default_path );
		include $located;
	}

	/**
	 * Locate template file
	 *
	 * @param string $template_name template_name.
	 * @param string $template_path template_path.
	 * @param string $default_path default_path.
	 * @return string
	 */
	public function locate_template( $template_name, $template_path = '', $default_path = '' ) {
		$default_path = apply_filters( '%plugin_slug%_template_path', $default_path );
		if ( ! $template_path ) {
			$template_path = '%plugin_slug%';
		}
		if ( ! $default_path ) {
			$default_path = %PLUGIN_SLUG%_ABSPATH . 'templates/';
		}
		// Look within passed path within the theme - this is priority.
		$template = locate_template( array( trailingslashit( $template_path ) . $template_name, $template_name ) );
		// Add support of third perty plugin.
		$template = apply_filters( '%plugin_slug%_locate_template', $template, $template_name, $template_path, $default_path );
		// Get default template.
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}
		return $template;
	}

}
