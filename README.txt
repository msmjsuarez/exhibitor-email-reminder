=== Exhibitor Email Reminder ===
Contributors: MJ Layasan    
Tags: exhibitor, email reminder, form status, cron job, post author  
Requires at least: 5.0  
Tested up to: 6.5  
Requires PHP: 7.4+  
Stable tag: 1.0.0  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

Sends reminder emails to post authors of `exhibitor_form` custom posts that have not been marked as "Completed" via taxonomy.

== Description ==

This plugin automatically checks all `exhibitor_form` posts and sends an email reminder to authors who have one or more posts without the taxonomy term `form_status = completed`.

Features:
* Weekly email reminders
* Sends one email per author with all their incomplete forms
* Custom post type and taxonomy aware
* Automatically runs via WordPress Cron
* Sends a test batch upon plugin activation

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/exhibitor-email-reminder` directory, or install it via the WordPress plugin repository.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Upon activation, the plugin will immediately check for incomplete `exhibitor_form` posts and send email reminders.
4. A scheduled weekly cron will continue to send reminders going forward.

== Usage ==

Make sure you have:
- A custom post type `exhibitor_form`
- A taxonomy `form_status`
- Term slug `completed` for completed forms

The plugin identifies posts missing the `completed` term and notifies their respective authors via email.

== Frequently Asked Questions ==

= Will this send duplicate emails? =  
No. It only sends emails for posts that do not have the `form_status` taxonomy term set to `completed`.

= Can I change the schedule? =  
Currently, the plugin uses a weekly schedule. You may modify the schedule in the plugin code (`Exhibitor_Email_Reminder_Activator` class).

= What if a post has no taxonomy set at all? =  
Those posts are considered incomplete and are included in the email reminder.

== Screenshots ==

1. Example email content sent to post author.

== Changelog ==

= 1.0.0 =
* Initial release with weekly cron support and immediate test email on activation.

== Upgrade Notice ==

= 1.0.0 =
Initial version of the plugin.

== License ==

This plugin is licensed under the GPLv2 or later.
