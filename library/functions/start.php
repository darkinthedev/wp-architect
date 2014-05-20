<?php
/**
 * Initialize Theme Functions
 *
 * @since 1.0.0
 *
 * @package WordPress
 * @subpackage Functions (functions.php)
 */

/* Set the content width based on the theme's design and stylesheet.
http://wordpress.stackexchange.com/questions/11766/what-is-the-role-and-history-of-the-content-width-global-variable
 */
if ( ! isset( $content_width ) ) $content_width = 640; /* pixels */

// we're firing all out initial functions at the start
add_action('after_setup_theme','wp_arch_start', 15);

function wp_arch_start() {
    // Head Clean Up
    // http://codex.wordpress.org/Function_Reference/add_action
    add_action('init', 'wp_arch_head_cleanup');

    // Remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'wp_arch_remove_wp_widget_recent_comments_style', 1 );

    // Clean up comment styles in the head
    add_action('wp_head', 'wp_arch_remove_recent_comments_style', 1);

    // Enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'wp_arch_scripts_and_styles', 999);

    // Launching this stuff after theme setup
    add_action('after_setup_theme','wp_arch_theme_support');

    //Disable autop filter (WordPress will automatically insert <p> and </p>
    //tags for you to separate content breaks within a post or page)
    // WARNING: Breaks WYSIWYG Editor
    //http://wordpress.stackexchange.com/questions/13798/remove-empty-paragraphs-from-the-content
    //remove_filter('the_content', 'wpautop');
}


// Head Clean Up
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

// Remove injected CSS for recent comments widget
function wp_arch_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// Remove injected CSS from recent comments widget
function wp_arch_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}
 ?>
