<?php
/**
 * Register and Enqueue Scripts.
 *
 * http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 *
 * @since       1.0.0
 *
 * @package     WordPress
 * @subpackage  Functions (functions.php)
 */

/**
 * Registers and Enqueues scripts and styles.
 * @return various
 * @author ellm
 * @since  1.0.0
 */
function wp_arch_scripts_and_styles() {
    // If is NOT admin area...
    if (!is_admin()) {

        /*
         * Use jQuery from Google CDN - Faster load time for users that already have it cached.
         * */

            /**
             * Remove jQuery registered script.
             *
             * @return   VOID
             *
             * @param string $handle Name of the script handle to be removed
             */
            wp_deregister_script('jquery');

            /**
             * Register jQuery script with CDN
             *
             * @return   VOID
             *
             * @param string   [$handle]     Name of the script
             * @param string   [$src]        URL to the script
             * @param array    [$deps]       Array of the handles of all the registered scripts that this script depends on.
             * @param string   [$ver]        String specifying the script version number
             * @param boolean  [$in_footer]  Normally scripts are placed in the <head> section
             */
            wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', '1.10.2', false);

            /**
             * Enqueue jQuery script from CDN
             *
             * @return  VOID
             *
             * @param string   [$handle]     Name of the script
             * @param string   [$src]        URL to the script
             * @param array    [$deps]       Array of the handles of all the registered scripts that this script depends on.
             * @param string   [$ver]        String specifying the script version number
             * @param boolean  [$in_footer]  Normally scripts are placed in the <head> section
             */
            wp_enqueue_script('jquery');

        /**
         * Enqueue Modernizr Script
         *
         * @return  VOID
         *
         * @param string   [$handle]     Name of the script
         * @param string   [$src]        URL to the script
         * @param array    [$deps]       Array of the handles of all the registered scripts that this script depends on.
         * @param string   [$ver]        String specifying the script version number
         * @param boolean  [$in_footer]  Normally scripts are placed in the <head> section
         */
        wp_enqueue_script('wp_arch_modernizr', get_stylesheet_directory_uri() . '/library/js/dist/modernizr-custom.min.js', array('jquery'), NULL, false);

        /**
         * Enqueue Site Scripts
         *
         * @return  VOID
         *
         * @param string   [$handle]     Name of the script
         * @param string   [$src]        URL to the script
         * @param array    [$deps]       Array of the handles of all the registered scripts that this script depends on.
         * @param string   [$ver]        String specifying the script version number
         * @param boolean  [$in_footer]  Normally scripts are placed in the <head> section
         */
        wp_enqueue_script('wp_arch_scripts', get_stylesheet_directory_uri() . '/library/js/dist/common.min.js', array('jquery'), NULL, true);

        /**
         * Enqueue Font Awesome Styles from CDN
         *
         * @return  VOID
         *
         * @param string          [$handle]     Name of the script
         * @param string          [$src]        URL to the script
         * @param array           [$deps]       Array of the handles of all the registered scripts that this script depends on.
         * @param string          [$ver]        String specifying the script version number
         * @param string|boolean  [$media]      String specifying the media for which this stylesheet has been defined.
         */
        wp_enqueue_style('wp_arch_fontAwe', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), 'all' );

        /**
         * Enqueue Style
         *
         * @return  VOID
         *
         * @param string          [$handle]     Name of the script
         * @param string          [$src]        URL to the script
         * @param array           [$deps]       Array of the handles of all the registered scripts that this script depends on.
         * @param string          [$ver]        String specifying the script version number
         * @param string|boolean  [$media]      String specifying the media for which this stylesheet has been defined.
         */
        wp_enqueue_style('wp_arch_wpstyles', get_stylesheet_uri(), array(), 'all');

         /**
         * Enqueue Site Styles
         *
         * @return  VOID
         *
         * @param string          [$handle]     Name of the script
         * @param string          [$src]        URL to the script
         * @param array           [$deps]       Array of the handles of all the registered scripts that this script depends on.
         * @param string          [$ver]        String specifying the script version number
         * @param string|boolean  [$media]      String specifying the media for which this stylesheet has been defined.
         */
        wp_enqueue_style('wp_arch_styles', get_stylesheet_directory_uri() . '/library/css/dist/dist.min.css', array(), 'all');

        // If viewing local/development
        if ( $_SERVER["SERVER_ADDR"] == '192.168.50.4' ) {
            /**
             * Add LiveReload script
             *
             * @return  VOID
             *
             * @param string   [$handle]     Name of the script
             * @param string   [$src]        URL to the script
             * @param array    [$deps]       Array of the handles of all the registered scripts that this script depends on.
             * @param string   [$ver]        String specifying the script version number
             * @param boolean  [$in_footer]  Normally scripts are placed in the <head> section
             */
            wp_enqueue_script('wp_arch_livereload', '//192.168.50.4:35729/livereload.js?snipver=1', array(), true);
        }

    }
}

 ?>
