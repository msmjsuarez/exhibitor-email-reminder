<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Exhibitor_Email_Reminder_Schedule {

    public function __construct() {
        // Hook the method to the scheduled event
        add_action('exhibitor_email_reminder_sched', array($this, 'check_and_send_exhibitor_form_posts'));
    }

    public function check_and_send_exhibitor_form_posts() {
        if ( ! function_exists( 'wp_mail' ) ) {
            error_log( 'wp_mail function does not exist.' );
            return;
        }

        error_log( 'check_and_send_exhibitor_form_posts function triggered.' );

        // Check if there are any posts with the post type 'exhibitor_form' that do not have form_status set to completed
        $args = array(
            'post_type' => 'exhibitor_form',
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'form_status',
                    'field'    => 'slug',
                    'terms'    => 'completed',
                    'operator' => 'NOT IN',
                ),
                array(
                    'taxonomy' => 'form_status',
                    'operator' => 'NOT EXISTS',
                ),
            ),
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) {
            error_log( 'Posts found: ' . $query->found_posts );

            $authors_posts = array();

            // Loop through the posts and group them by author
            while ($query->have_posts()) {
                $query->the_post();
                $author_id = get_the_author_meta('ID');
                $post_title = get_the_title();
                $post_link = get_permalink();
                error_log( "Author ID: $author_id, Post Title: $post_title, Post Link: $post_link" );
                $authors_posts[$author_id][] = array('title' => $post_title, 'link' => $post_link);
            }

            // Send an email to each author with their post links
            foreach ($authors_posts as $author_id => $posts) {
                $author = get_userdata($author_id);
                $author_email = $author->user_email;
                $subject = 'Your Exhibitor Forms To Complete';
                $message = 'Hi '. $author->display_name . ', please complete the following forms:' . "\n\n";
                foreach ($posts as $post) {
                    $message .= '<a href="' . $post['link'] . '">' . $post['title'] . '</a>' . "\n";
                }

                $headers = array('Content-Type: text/html; charset=UTF-8');
                if (wp_mail($author_email, $subject, nl2br($message), $headers)) {
                    error_log( 'Email sent to: ' . $author_email );
                } else {
                    error_log( 'Failed to send email to: ' . $author_email );
                }
            }

            // Reset post data
            wp_reset_postdata();
        } else {
            error_log( 'No posts found.' );
        }

        // Reschedule the event for the next week
        if (!wp_next_scheduled('exhibitor_email_reminder_sched')) {
            wp_schedule_event(time() + 604800, 'weekly', 'exhibitor_email_reminder_sched'); // 604800 seconds = 1 week
        }
    }
}
