<?php
/**
 * Plugin Name:         Beaver Builder Templates by WPZOOM
 * Plugin URI:          http://wordpress.org/plugins/beaver-builder-templates-by-wpzoom/
 * Description:         This plugin provides a collection of custom Beaver Builder page builder templates for WordPress themes (especially the accessibility ready themes by WPZOOM).
 * Version:             1.0.0
 * Author:              WPZOOM
 * Author URI:          http://wpzoom.com/
 * Text Domain:         bb-templates
 * License:             GNU General Public License v3
 * License URI:         http://www.gnu.org/licenses/gpl-3.0.txt
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
