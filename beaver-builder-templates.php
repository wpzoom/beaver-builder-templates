<?php
/**
 * Plugin Name:         WPZOOM Beaver Builder Templates
 * Plugin URI:          https://wordpress.org/plugins/wpzoom-beaver-builder-templates/
 * Description:         This plugin provides a collection of custom Beaver Builder page builder templates for WordPress themes (especially for WPZOOM themes).
 * Version:             1.0.1
 * Author:              WPZOOM
 * Author URI:          https://www.wpzoom.com/
 * Text Domain:         bb-templates
 * License:             GNU General Public License v2
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Requires at least:   5.2
 * Tested up to:        5.7
 *
 * @package WPZOOM_Beaver_Builder_Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'WPZOOM_BB_TEMPLATES_FILE', __FILE__ );
define( 'WPZOOM_BB_TEMPLATES_PATH', plugin_dir_path( WPZOOM_BB_TEMPLATES_FILE ) );
define( 'WPZOOM_BB_TEMPLATES_URL', plugin_dir_url( WPZOOM_BB_TEMPLATES_FILE ) );

/**
 * Load plugin functionality.
 */
require WPZOOM_BB_TEMPLATES_PATH . 'includes/classes/class-wpzoom-beaver-builder-templates.php';
