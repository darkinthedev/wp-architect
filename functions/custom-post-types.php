<?php
/**
 * Custom Post Types.
 *
 * http://codex.wordpress.org/custom_post_types
 *
 * @since       1.0.0
 *
 * @package     WordPress
 * @subpackage  Functions (functions.php)
 */

/**
 * Returns the name of Post type from the Object.
 * @return string    Name of Post Type
 * @author ellm
 * @since  1.0.0
 */
function wp_arch_get_post_type_name() {
   $obj = get_post_type_object( get_post_type() );
   echo $obj->labels->name;
};

/* Initialize Custom Post Types */
add_action('init', 'wp_arch_cpts');


/**
 * Registers Custom Post Types
 * @return various
 * @author ellm
 * @since  1.0.0
 */
function wp_arch_cpts() {
    /**
    * Registers a new post type
    * @uses $wp_post_types Inserts new post type object into the list
    *
    * @param string  Post type key, must not exceed 20 characters
    * @param array|string  See optional args description above.
    * @return object|WP_Error the registered post type object, or an error object
    */
    register_post_type( 'wp_arch_testimonial',
        array(
            'labels' => array(
                'name' => _x('Testimonials', 'post type general name'),
                'singular_name' => _x('Testimonial', 'post type singular name'),
                'add_new' => _x('Add New', 'testimonial'),
                'add_new_item' => __('Add New Testimonial'),
                'edit_item' => __('Edit Testimonial'),
                'new_item' => __('New Testimonial'),
                'view_item' => __('View Testimonial'),
                'search_items' => __('Search Testimonial'),
                'not_found' =>  __('No testimonials found'),
                'not_found_in_trash' => __('No testimonials found in Trash'),
                'parent_item_colon' => ''
            ),
            'public' => true,
            'description'  => 'Our Testimonials',
            'exclude_from_search' => true,
               'has_archive' => true,
               'rewrite' => array('slug' => 'testimonials'),
            'hierarchical' => true,
            'supports' => array(
                'title',
                'editor'
            ),
        )
    );
}

?>
