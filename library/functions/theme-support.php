<?php
    function wp_arch_theme_support() {

        // Thumbnails & Custom Image Sizes
        // http://codex.wordpress.org/Function_Reference/add_image_size

        //optional: add_theme_support('post-thumbnails', array( 'custom-post-type'));
        add_theme_support('post-thumbnails');
        // default thumb size
        set_post_thumbnail_size(125, 125, true);

        // Custom thumb size
        add_image_size( 'big-thumb', 300, 300, true );
        // Make custom sizes selectable from WordPress admin
        add_filter( 'image_size_names_choose', 'wp_arch_custom_sizes' );

        function wp_arch_custom_sizes( $sizes ) {
            return array_merge( $sizes, array(
                'big-thumb' => __('Big Thumb'),
            ) );
        }

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list',
        ) );

        // rss thingy
        add_theme_support('automatic-feed-links');

        // adding post format support
        // add_theme_support( 'post-formats',
        //    array(
        //        'aside',             // title less blurb
        //        'gallery',           // gallery of images
        //        'link',              // quick link to other site
        //        'image',             // an image
        //        'quote',             // a quick quote
        //        'status',            // a Facebook like status update
        //        'video',             // video
        //        'audio',             // audio
        //        'chat'               // chat transcript
        //    )
        // );

        // wp menus
        add_theme_support( 'menus' );

        // registering wp3+ menus
        register_nav_menus(
            array(
                'main-nav' => __( 'The Main Menu', 'wp_arch' ),   // main nav in header
                'footer-links' => __( 'Footer Links', 'wp_arch' ) // secondary nav in footer
            )
        );

        add_editor_style( 'custom-editor-style.css' );

    } /* end wp_arch theme support */

    /*Register widgetized area and update sidebar with default widgets*/
    function wp_arch_widgets_init() {
        register_sidebar( array(
            'name' => __( 'Sidebar', 'wp_arch_A' ),
            'id' => 'sidebar-1',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ) );
    }
    add_action( 'widgets_init', 'wp_arch_widgets_init' );

?>
