<?php 
/*
Author: Matthew Ell
URL: htp://matthewell.com

Admiration and lots of help from: 
Bones:      http://themble.com/bones/
_s:         https://github.com/Automattic/_s
html5bp:    http://html5boilerplate.com/
*/

/*// Glossary ////////////////////////////////////////////////////////////////////

1. Theme Set Up and Resets
2. Script and Styles Enqueuing
3. Theme Support and Functions 
4. Custom Functions
5. Shortcodes
*/

// Theme Set Up and Resets ///////////////////////////////////////////////////////////////////

 /* Set the content width based on the theme's design and stylesheet. 
http://wordpress.stackexchange.com/questions/11766/what-is-the-role-and-history-of-the-content-width-global-variable
 */
if ( ! isset( $content_width ) ) $content_width = 640; /* pixels */

// we're firing all out initial functions at the start
add_action('after_setup_theme','wp_arch_start', 15);

function wp_arch_start() {
    // 1A - Head Clean Up
    // http://codex.wordpress.org/Function_Reference/add_action
    add_action('init', 'wp_arch_head_cleanup');

    // 1B – remove WP version from RSS
    add_filter('the_generator', 'wp_arch_rss_version');

    // 1C - remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'wp_arch_remove_wp_widget_recent_comments_style', 1 );

    // 1D - clean up comment styles in the head
    add_action('wp_head', 'wp_arch_remove_recent_comments_style', 1);

    // 1E - clean up gallery output in wp
    // add_filter('gallery_style', 'wp_arch_gallery_style');

    // 2A - enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'wp_arch_scripts_and_styles', 999);

    // launching this stuff after theme setup
    add_action('after_setup_theme','wp_arch_theme_support');

    //Disable autop filter (WordPress will automatically insert <p> and </p> 
    //tags for you to separate content breaks within a post or page)
    //http://wordpress.stackexchange.com/questions/13798/remove-empty-paragraphs-from-the-content
    remove_filter('the_content', 'wpautop');
}


// 1A - Head Clean Up
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

// 1B – remove WP version from RSS
function wp_arch_rss_version() { return ''; }

// 1C – remove injected CSS for recent comments widget
function wp_arch_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// 1D - remove injected CSS from recent comments widget
function wp_arch_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }

/*
	1F Remove Menu Pages from Admin Console (uncomment function and action hook if needed)
	http://codex.wordpress.org/Function_Reference/remove_menu_page
*/
// 1F - Remove Menu items from WP Admin Console
//add_action( 'admin_menu', 'wp_arch_remove_menu_pages' );
// function wp_arch_remove_menu_pages() {
// 	remove_menu_page('link-manager.php');
// 	remove_menu_page('tools.php');	
// }
	
}

// 1E remove injected CSS from gallery
// function wp_arch_gallery_style($css) {
//   return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
// }
// Register and Enqueue Scripts ///////////////////////////////////////////////////////////////////
// wp_resgister_* not required before wp_enqueue_*
// wp_register_* is more useful for making available for the user to enqueue tw2113 @ 9:24
// but if you want to enqueue right away, just use wp_enqueue_* 9:24
// it'll register for you if it's not already registered
//http://codex.wordpress.org/Function_Reference/wp_enqueue_script
function wp_arch_scripts_and_styles() {
    if (!is_admin()) {

        wp_deregister_script('jquery');
        // http://css-tricks.com/snippets/wordpress/include-jquery-in-wordpress-theme/  
        wp_enqueue_script('wp_arch_jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js", array(), '1.8', true);

        // enqueue modernizr.js | @Dependents: jQuery
        wp_enqueue_script('wp_arch_modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr-2.0.6.min.js',array('wp_arch_jquery'), '2.0.6', false);

        // enqueue jquery.validate.min.js | @Dependents: JQuery
        // http://bassistance.de/jquery-plugins/jquery-plugin-validation/
        // wp_enqueue_script('wp_arch_validator', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js',array('wp_arch_jquery'), '1.10.0', false);
        
        // enqueue plugins.js | @Dependents: jQuery
        wp_enqueue_script('wp_arch_plugins', get_stylesheet_directory_uri() . '/library/js/plugins.js', array('wp_arch_jquery'), "1", true);
        
        // enqueue scripts.js | @Dependents: jQuery
        wp_enqueue_script('wp_arch_scripts', get_stylesheet_directory_uri() . '/library/js/script.js', array('wp_arch_jquery'), "1", true);
        
        // enqueue style.css // http://codex.wordpress.org/Function_Reference/wp_register_style
        wp_enqueue_style('wp_arch_wpstyles', get_stylesheet_uri(), array(), '01', 'all');

        // enqueue /css/style.css 
        wp_enqueue_style('wp_arch_styles', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '01', 'all');
    }
}

// 3 Theme Support  /////////////////////////////////////////////////////////////////// 
function wp_arch_theme_support() {

    // 3A - wp thumbnails
    add_theme_support('post-thumbnails');
    // default thumb size
    set_post_thumbnail_size(125, 125, true);

    

    // rss thingy
    add_theme_support('automatic-feed-links');

    // adding post format support
    add_theme_support( 'post-formats',
        array(
            'aside',             // title less blurb
            'gallery',           // gallery of images
            'link',              // quick link to other site
            'image',             // an image
            'quote',             // a quick quote
            'status',            // a Facebook like status update
            'video',             // video
            'audio',             // audio
            'chat'               // chat transcript
        )
    );

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

// 4 Custom Functions  /////////////////////////////////////////////////////////////////// 

// Display navigation to next/previous pages when applicable
if ( ! function_exists( 'wp_arch_content_nav' ) ) :
function wp_arch_content_nav( $nav_id ) {
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

    $nav_class = 'site-navigation paging-navigation group';
    if ( is_single() )
        $nav_class = 'site-navigation post-navigation group';

    ?>
    <nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
        <h1 class="assistive-text"><?php _e( 'Post navigation', 'wp_arch' ); ?></h1>

    <?php if ( is_single() ) : // navigation links for single posts ?>

        <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'wp_arch' ) . '</span> %title' ); ?>
        <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'wp_arch' ) . '</span>' ); ?>

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
endif; // wp_arch_content_nav

// Prints HTML with meta information for the current post-date/time and author.  
if ( ! function_exists( 'wp_arch_posted_on' ) ) :
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

// Returns true if a blog has more than 1 category
function wp_arch_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
        // Create an array of all the categories that are attached to posts
        $all_the_cool_cats = get_categories( array(
            'hide_empty' => 1,
        ) );

        // Count the number of categories that are attached to the posts
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'all_the_cool_cats', $all_the_cool_cats );
    }

    if ( '1' != $all_the_cool_cats ) {
        // This blog has more than 1 category so wp_arch_categorized_blog should return true
        return true;
    } else {
        // This blog has only 1 category so wp_arch_categorized_blog should return false
        return false;
    }
}

// Sets the post excerpt length to 40 words.
function wp_arch_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'wp_arch_excerpt_length' );

// Returns a "Continue Reading" link for excerpts
function wp_arch_continue_reading_link() {
    return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp_arch' ) . '</a>';
}

// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis 
function wp_arch_auto_excerpt_more( $more ) {
    return ' &hellip;' . wp_arch_continue_reading_link();
}
add_filter( 'excerpt_more', 'wp_arch_auto_excerpt_more' );

// Adds a pretty "Continue Reading" link to custom post excerpts.
function wp_arch_custom_excerpt_more( $output ) {
    if ( has_excerpt() && ! is_attachment() ) {
        $output .= wp_arch_continue_reading_link();
    }
    return $output;
}
add_filter( 'get_the_excerpt', 'wp_arch_custom_excerpt_more' );

if ( ! function_exists( 'wp_arch_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function wp_arch_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'wp_arch' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'wp_arch' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <footer>
                <div class="comment-author vcard">
                    <?php echo get_avatar( $comment, 40 ); ?>
                    <?php printf( __( '%s <span class="says">says:</span>', 'wp_arch' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                </div><!-- .comment-author .vcard -->
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', 'wp_arch' ); ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
                    <?php
                        /* translators: 1: date, 2: time */
                        printf( __( '%1$s at %2$s', 'wp_arch' ), get_comment_date(), get_comment_time() ); ?>
                    </time></a>
                    <?php edit_comment_link( __( '(Edit)', 'wp_arch' ), ' ' );
                    ?>
                </div><!-- .comment-meta .commentmetadata -->
            </footer>

            <div class="comment-content"><?php comment_text(); ?></div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->

    <?php
            break;
    endswitch;
}
endif; // ends check for wp_arch_comment()

// 5. Short Codes

/*
Blockquote Short Code
In WordPress: [blockquote cite="" quote="" author=""][/blockquote]
*/
function wp_arch_blockquote( $atts, $quote = null ) {
    extract(shortcode_atts( array(
        "cite" => '',
        "quote" => '',
        "author" => ''
        ), $atts));  
    return '<blockquote cite="'.$cite.'">'.'<p>'.$quote.'</p>'.'<footer><p>'.$author.'</p></footer>'.'</blockquote>';  
}
add_shortcode("blockquote", "wp_arch_blockquote"); 

/*
Paragraph Short Code
In WordPress: [p][/p]
*/
function wp_arch_paragraph($atts, $content = null ) {

    return '<p>'.$content.'</p>';
}
add_shortcode('p','wp_arch_paragraph');

/*
Header 1 Short Code
In WordPress: [h1][/h1]
*/
function wp_arch_header1($atts, $content = null ) {

    return '<h1>'.$content.'</h1>';
}
add_shortcode('h1','wp_arch_header1');

/*
Header 2 Short Code
In WordPress: [h2][/h2]
*/
function wp_arch_header2($atts, $content = null ) {

    return '<h2>'.$content.'</h2>';
}
add_shortcode('h2','wp_arch_header2');

/*
Header 3 Short Code
In WordPress: [h3][/h3]
*/
function wp_arch_header3($atts, $content = null ) {

    return '<h3>'.$content.'</h3>';
}
add_shortcode('h3','wp_arch_header3');

/// Bug Fixes
 
// Added 2013_06_25 MRE – Fixes conflict with Events Manager Plugin 
function my_em_disable_gallery(){
  remove_action('init','em_event_gallery_override_init', 1000);
}
add_action('init', 'my_em_disable_gallery');

 ?>