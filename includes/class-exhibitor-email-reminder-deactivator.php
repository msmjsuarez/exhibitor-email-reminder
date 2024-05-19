<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://exhibitor-portal.uk
 * @since      1.0.0
 *
 * @package    Exhibitor_Email_Reminder
 * @subpackage Exhibitor_Email_Reminder/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Exhibitor_Email_Reminder
 * @subpackage Exhibitor_Email_Reminder/includes
 * @author     MJ Layasan <msmjsuarez@gmail.com>
 */
class Exhibitor_Email_Reminder_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		wp_clear_scheduled_hook('exhibitor_email_reminder_sched');
	}

}
