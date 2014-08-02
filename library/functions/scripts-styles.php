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
        wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/assets/js/dist/vendor/modernizr.min.js', array(), null, false);

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
        wp_enqueue_script('common_scripts', get_stylesheet_directory_uri() . '/assets/js/dist/common.min.js', array('jquery'), null, true);

        /**
         * Enqueue Normalize.css
         *
         * @return  VOID
         *
         * @param string          [$handle]     Name of the script
         * @param string          [$src]        URL to the script
         * @param array           [$deps]       Array of the handles of all the registered scripts that this script depends on.
         * @param string          [$ver]        String specifying the script version number
         * @param string|boolean  [$media]      String specifying the media for which this stylesheet has been defined.
         */
        wp_enqueue_style('normalize', get_stylesheet_directory_uri()  . '/assets/vendor/normalize-css/normalize.css', array(), 'all');

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
        wp_enqueue_style('wpstyles', get_stylesheet_uri(), array(), 'all');

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
        wp_enqueue_style('styles', get_stylesheet_directory_uri() . '/assets/css/dist/global.min.css', array(), 'all');

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
