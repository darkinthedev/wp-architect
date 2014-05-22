<?php
/**
 * Theme Support Options
 *
 * @since       1.0.0
 *
 * @package     WordPress
 * @subpackage  Functions (functions.php)
 */

/**
 * Theme Support Function
 *
 * @see     wp_arch_start()
 * @return  NULL
 * @author  ellm
 * @since   1.0.0
 */
function wp_arch_theme_support() {

    /*************************************************************************************************
    * Thumbnails & Custom Image Sizes.
    * http://codex.wordpress.org/Function_Reference/add_image_size
    */

    add_theme_support('post-thumbnails');
    // Set default thumb size
    set_post_thumbnail_size(125, 125, true);
    // Set custom thumb size
    add_image_size( 'big-thumb', 300, 300, true );
    // Make custom sizes selectable from WordPress admin
    add_filter( 'image_size_names_choose', 'wp_arch_custom_sizes' );

    /**
     * Add custom size to WordPress admin
     * @param   array   $sizes  Custom image sizes
     * @return  array
     * @author  ellm
     * @since   1.0.0
     */
    function wp_arch_custom_sizes( $sizes ) {
        return array_merge( $sizes, array(
            'big-thumb' => __('Big Thumb'),
        ) );
    }

    /*************************************************************************************************
    * Allow the use of HTML5 markup for the comment forms, search forms and comment lists.
    */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
    ) );

    /*************************************************************************************************
    * Enable post and comment RSS feed links to head.
    */
    add_theme_support('automatic-feed-links');

    /*************************************************************************************************
    * Enable theme support for menus.
    */
    add_theme_support( 'menus' );

    // Register Menus
    register_nav_menus(
        array(
            'main-nav' => __( 'The Main Menu', 'wp_arch' ),   // main nav in header
            'footer-links' => __( 'Footer Links', 'wp_arch' ) // secondary nav in footer
        )
    );

    /*************************************************************************************************
    * Use custom stylesheet for WordPress Editor (WYSIWYG)
    */
    add_editor_style( 'custom-editor-style.css' );

} //wp_arch_theme_support

/*************************************************************************************************
* Register widgetized area and update sidebar with default widgets.
*/
add_action( 'widgets_init', 'wp_arch_widgets_init' );

/**
 * Register sidebar widgets within function.
 * @return NULL
 * @author ellm
 * @since  1.0.0
 */
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
?>
