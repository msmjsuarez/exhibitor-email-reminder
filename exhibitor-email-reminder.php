<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://exhibitor-portal.uk
 * @since             1.0.0
 * @package           Exhibitor_Email_Reminder
 *
 * @wordpress-plugin
 * Plugin Name:       Exhibitor Email Reminder
 * Plugin URI:        https://exhibitor-portal.uk
 * Description:       This is to send an email reminder to exhibitors to complete forms. Sending is scheduled using WP-Cron.
 * Version:           1.0.0
 * Author:            MJ Layasan
 * Author URI:        https://exhibitor-portal.uk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       exhibitor-email-reminder
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
define( 'EXHIBITOR_EMAIL_REMINDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-exhibitor-email-reminder-activator.php
 */
function activate_exhibitor_email_reminder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-exhibitor-email-reminder-activator.php';
	Exhibitor_Email_Reminder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-exhibitor-email-reminder-deactivator.php
 */
function deactivate_exhibitor_email_reminder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-exhibitor-email-reminder-deactivator.php';
	Exhibitor_Email_Reminder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_exhibitor_email_reminder' );
register_deactivation_hook( __FILE__, 'deactivate_exhibitor_email_reminder' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-exhibitor-email-reminder.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_exhibitor_email_reminder() {

	$plugin = new Exhibitor_Email_Reminder();
	$plugin->run();

}
run_exhibitor_email_reminder();
