<?php
/**
 * The PHP class which helps to register Beaver Builder templates.
 *
 * @package WPZOOM_Beaver_Builder_Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The main PHP class for Beaver Builder Templates.
 */
final class WPZOOM_Beaver_Builder_Templates {
	/**
	 * This plugin's instance.
	 *
	 * @var WPZOOM_Beaver_Builder_Templates
	 * @since 1.0.0
	 */
	private static $instance;

	/**
	 * Templates path
	 *
	 * @var string
	 */
	public static $templates_path;

	/**
	 * Theme name
	 *
	 * @var string
	 */
	private static $theme;

	/**
	 * Main WPZOOM_Beaver_Builder_Templates Instance.
	 *
	 * Insures that only one instance of WPZOOM_Beaver_Builder_Templates exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.0.0
	 * @static
	 * @return object|WPZOOM_Beaver_Builder_Templates The one true WPZOOM_Beaver_Builder_Templates
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new WPZOOM_Beaver_Builder_Templates();
		}
		return self::$instance;
	}

	/**
	 * Plugin constructor.
	 *
	 * @since 1.0.0
	 */
	private function __construct() {
		// Check Beaver Builder is active.
		if ( ! is_callable( 'FLBuilder::register_templates' ) ) {
			return;
		}

		/**
		 * Filter 'wpzoom/bb-templates/theme' to help developers to determine for which theme to get templates.
		 *
		 * By default the name of the current theme
		 *
		 * Accepted value are the folder name from ./templates and should be string (e.g. 'inspiro')
		 *
		 * @since 1.0.0
		 */
		self::$theme = apply_filters( 'wpzoom/bb-templates/theme', get_template() );

		self::$templates_path = trailingslashit( WPZOOM_BB_TEMPLATES_PATH . 'templates/' );

		self::register_templates();
	}

	/**
	 * Register template files with Beaver Builder
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public static function register_templates() {
		$global_templates = self::get_template_files( 'global' );
		$theme_templates  = self::get_template_files( 'theme' );

		/**
		 * Filter before register Beaver Builder Templates globally.
		 *
		 * @since 1.0.0
		 * @param array $global_templates The templates files to be registerd
		 */
		$global_templates = apply_filters( 'wpzoom/bb-templates/global/before-register-templates', $global_templates );

		if ( self::global_supports() && ! empty( $global_templates ) ) {
			foreach ( $global_templates as $file ) {
				$file = trailingslashit( self::$templates_path . 'global' ) . $file;
				$file = apply_filters( 'wpzoom/bb-templates/global/template_file', $file );

				if ( file_exists( $file ) ) {
					/* @phpstan-ignore-next-line */
					FLBuilder::register_templates( $file );
				}
			}
		}

		/**
		 * Filter before register Beaver Builder Templates for specified theme.
		 *
		 * @since 1.0.0
		 * @param array $theme_templates The templates files to be registerd
		 */
		/* @phpstan-ignore-next-line */
		$theme_templates = apply_filters( 'wpzoom/bb-templates/theme/before-register-templates', $theme_templates, self::$theme );

		if ( ! empty( $theme_templates ) ) {
			foreach ( $theme_templates as $file ) {
				$file = trailingslashit( self::$templates_path . self::$theme ) . $file;
				/* @phpstan-ignore-next-line */
				$file = apply_filters( 'wpzoom/bb-templates/theme/template_file', $file, self::$theme );

				if ( file_exists( $file ) ) {
					/* @phpstan-ignore-next-line */
					FLBuilder::register_templates( $file );
				}
			}
		}
	}

	/**
	 * Get template files array
	 *
	 * By default returns template files array globally.
	 *
	 * @since 1.0.0
	 * @param string $scope The theme name to get templates for.
	 * @return array
	 */
	public static function get_template_files( $scope = '' ) {
		$template_files        = array();
		$folder_name           = 'theme' === $scope ? self::$theme : 'global';
		$theme_setup_file_path = apply_filters( "wpzoom/bb-templates/{$scope}/theme_setup_file_path", trailingslashit( self::$templates_path . $folder_name ) . 'setup.php' );

		if ( file_exists( $theme_setup_file_path ) ) {
			// This file has to contain some `$template_files = array(...);` code!
			include $theme_setup_file_path;
		}

		return array_filter( (array) $template_files );
	}

	/**
	 * Check global theme support Beaver Builder Templates
	 *
	 * @return bool
	 */
	public static function global_supports() {
		$return          = true;
		$theme_templates = self::get_template_files( 'theme' );

		if ( ! empty( $theme_templates ) && ! current_theme_supports( 'wpzoom-beaver-builder-templates' ) ) {
			$return = false;
		}

		return $return;
	}
}

add_action( 'init', 'WPZOOM_Beaver_Builder_Templates::instance' );
