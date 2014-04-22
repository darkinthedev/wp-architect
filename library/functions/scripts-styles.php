<?php

// Register and Enqueue Scripts ///////////////////////////////////////////////////////////////////
//http://codex.wordpress.org/Function_Reference/wp_enqueue_script
function wp_arch_scripts_and_styles() {
    if (!is_admin()) {

        // Use jQuery from Google CDN - Faster load time for users that already have it cached.
        wp_deregister_script('jquery');
        wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2');
        wp_enqueue_script('jquery');

        // modernizr-custom.js | @Dependents: jQuery
        wp_enqueue_script('wp_arch_modernizr', get_stylesheet_directory_uri() . '/library/build/js/modernizr-custom.min.js', array('jquery'), "1", false);

        // enqueue site.min.js | @Dependents: jQuery
        wp_enqueue_script('wp_arch_scripts', get_stylesheet_directory_uri() . '/library/build/js/site.min.js', array('jquery'), "1", true);

        // enqueue font-awesome.css
        wp_enqueue_style('wp_arch_fontAwe', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), '', 'all' );

        // enqueue style.css // http://codex.wordpress.org/Function_Reference/wp_register_style
        wp_enqueue_style('wp_arch_wpstyles', get_stylesheet_uri(), array(), '01', 'all');

        // enqueue /css/style.css
        wp_enqueue_style('wp_arch_styles', get_stylesheet_directory_uri() . '/library/build/css/dist/dist.min.css', array(), '01', 'all');
    }
}

 ?>
