<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.philosophische-insel.ch/
 * @since             1.0.0
 * @package           Sva_Hall_Of_Fame
 *
 * @wordpress-plugin
 * Plugin Name:       SVA Hall of Fame
 * Plugin URI:        https://www.philosophische-insel.ch/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Sandro Räss
 * Author URI:        https://www.philosophische-insel.ch/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sva-hall-of-fame
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SVA_HALL_OF_FAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sva-hall-of-fame-activator.php
 */
function activate_sva_hall_of_fame() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sva-hall-of-fame-activator.php';
	Sva_Hall_Of_Fame_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sva-hall-of-fame-deactivator.php
 */
function deactivate_sva_hall_of_fame() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sva-hall-of-fame-deactivator.php';
	Sva_Hall_Of_Fame_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sva_hall_of_fame' );
register_deactivation_hook( __FILE__, 'deactivate_sva_hall_of_fame' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sva-hall-of-fame.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sva_hall_of_fame() {

	$plugin = new Sva_Hall_Of_Fame();
	$plugin->run();

}
run_sva_hall_of_fame();
