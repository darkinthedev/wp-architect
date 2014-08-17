<?php
/**
 * Initialize Theme Functions
 *
 * @since       1.0.0
 *
 * @package     WordPress
 * @subpackage  Functions (functions.php)
 */

/*************************************************************************************************
* Set the content width based on the theme's design and stylesheet.
*/
if ( ! isset( $content_width ) ) $content_width = 640; /* pixels */

/*************************************************************************************************
* We're firing all out initial functions at the start.
*/
add_action('after_setup_theme','wp_arch_start', 15);

function wp_arch_start() {
    // Head Clean Up
    add_action('init', 'wp_arch_head_cleanup');

    // Enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'wp_arch_scripts_and_styles', 999);

    // Launching this stuff after theme setup
    add_action('after_setup_theme','wp_arch_theme_support');
}


/**
 * Removes various nodes from the head element.
 *
 * @see     wp_arch_start()
 * @return  NULL
 * @author  ellm
 * @since   1.0.0
 */
function wp_arch_head_cleanup() {
    // category feeds
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    // post and comment feeds
    remove_action( 'wp_head', 'feed_links', 2 );
    // EditURI link
    remove_action( 'wp_head', 'rsd_link' );
    // windows live writer
    remove_action( 'wp_head', 'wlwmanifest_link' );
    // index link
    remove_action( 'wp_head', 'index_rel_link' );
    // previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    // start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    // links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    // WP version
    remove_action( 'wp_head', 'wp_generator' );

}

 ?>
