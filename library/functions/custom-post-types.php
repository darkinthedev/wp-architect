<?php
// Custom Post Type Snippet Example
//http://codex.wordpress.org/custom_post_types

// Initialize Custom Post Types
add_action('init', 'wp_arch_cpts');

function wp_arch_cpts() {
    // Put All Custom Post Types in Here
    // Testimonials
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

//Function to get Current Post Type Name
function wp_arch_get_post_type_name() {
   $obj = get_post_type_object( get_post_type() );
   echo $obj->labels->name;
};

?>
