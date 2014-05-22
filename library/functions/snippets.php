<?php
/**
 * Various Customizations and Options.
 *
 * @since       1.0.0
 *
 * @package     WordPress
 * @subpackage  Functions (functions.php)
 */

/*************************************************************************************************
* Remove Menu items from WP Admin Console
*/

/**
 * Remove Menu items from WP Admin Console
 * @param string    $hook              The name of the action to which $function_to_add is hooked.
 * @param callback  $function_to_add   The name of the function you wish to be hooked.
 */
// add_action( 'admin_menu', 'wp_arch_remove_menu_pages' );

/**
 * Menu Pages to be removed from the WP Admin
 * @return boolean
 * @author ellm
 * @since  1.0.0
 */
function wp_arch_remove_menu_pages() {
    /**
     * Remove Tools Menu item from WP Admin
     * @param  string    $menu_slug    The slug of the menu
     */
    remove_menu_page('tools.php');
}

/*************************************************************************************************
* Display navigation to next/previous pages when applicable.
*/

/**
 * Display navigation to next/previous pages when applicable.
 * @author ellm
 * @since 1.0.0
 */

// Function exists do...
if ( ! function_exists( 'wp_arch_content_nav' ) ) :

    /**
     * Customize post/page pagination
     * @param  string   $nav_id   ID of navigation menu
     * @return various
     * @author ellm
     * @since  1.0.0
     */
    function wp_arch_content_nav( $nav_id ) {

        // Access the global variables from within function
        global $wp_query, $post;

        // Don't print empty markup on single pages if there's nowhere to navigate.
        if ( is_single() ) {
            $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
            $next = get_adjacent_post( false, '', false );

            if ( ! $next && ! $previous )
                return;
        }

        // Don't print empty markup in archives if there's only one page.
        if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
            return;

        $nav_class = 'site-navigation paging-navigation';
        if ( is_single() )
            $nav_class = 'site-navigation post-navigation';

        ?>
        <nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
            <h1 class="assistive-text"><?php _e( 'Post navigation', 'wp_arch' ); ?></h1>

        <?php if ( is_single() ) : // navigation links for single posts ?>

            <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'wp_arch' ) . '</span> Older posts' ); ?>
            <?php next_post_link( '<div class="nav-next">%link</div>', 'Newer posts <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'wp_arch' ) . '</span>' ); ?>

        <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

            <?php if ( get_next_posts_link() ) : ?>
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'wp_arch' ) ); ?></div>
            <?php endif; ?>

            <?php if ( get_previous_posts_link() ) : ?>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'wp_arch' ) ); ?></div>
            <?php endif; ?>

        <?php endif; ?>

        </nav><?php //echo $nav_id; ?>
        <?php
    }
endif;

/*************************************************************************************************
* Prints HTML with meta information for the current post-date/time and author.
*/

// Function exists do...
if ( ! function_exists( 'wp_arch_posted_on' ) ) :
    /**
     * Print post meta information in custom format
     *
     * @return various
     * @author ellm
     * @since  [version]
     */
    function wp_arch_posted_on() {
        printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'wp_arch' ),
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'wp_arch' ), get_the_author() ) ),
        esc_html( get_the_author() )
        );
    }

endif;

/*************************************************************************************************
* Sets the post excerpt length to 40 words.
*/

add_filter( 'excerpt_length', 'wp_arch_excerpt_length' );
function wp_arch_excerpt_length( $length ) {
    return 40;
}

/*************************************************************************************************
* Returns a "Continue Reading" link for excerpts
*/
function wp_arch_continue_reading_link() {
    return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp_arch' ) . '</a>';
}

// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis
add_filter( 'excerpt_more', 'wp_arch_auto_excerpt_more' );
function wp_arch_auto_excerpt_more( $more ) {
    return ' &hellip;' . wp_arch_continue_reading_link();
}

// Adds a pretty "Continue Reading" link to custom post excerpts.
add_filter( 'get_the_excerpt', 'wp_arch_custom_excerpt_more' );
function wp_arch_custom_excerpt_more( $output ) {
    if ( has_excerpt() && ! is_attachment() ) {
        $output .= wp_arch_continue_reading_link();
    }
    return $output;
}

 ?>
