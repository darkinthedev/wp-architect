<?php 
/*
Author: Matthew Ell
URL: htp://matthewell.com

With lots of help from: 
Bones:		http://themble.com/bones/
_s:			https://github.com/Automattic/_s
Toolbox: 	http://wordpress.org/extend/themes/toolbox
html5bp:	http://html5boilerplate.com/


*/

/*// Glossary ////////////////////////////////////////////////////////////////////

1. Theme Set Up and Resets
2. Script and Styles Enqueuing
3. Theme Support and Functions 
4. Custom Tweaks and Functions
*/

// Theme Set Up and Resets ///////////////////////////////////////////////////////////////////

 /* Set the content width based on the theme's design and stylesheet. 
http://wordpress.stackexchange.com/questions/11766/what-is-the-role-and-history-of-the-content-width-global-variable
 */
if ( ! isset( $content_width ) ) $content_width = 640; /* pixels */


// 1A - Head Clean Up
// http://codex.wordpress.org/Function_Reference/add_action
add_action('init', 'mre_head_cleanup');

// 1B – remove WP version from RSS
add_filter('the_generator', 'mre_rss_version');

// 1C - remove pesky injected css for recent comments widget
add_filter( 'wp_head', 'mre_remove_wp_widget_recent_comments_style', 1 );

// 1D - clean up comment styles in the head
add_action('wp_head', 'mre_remove_recent_comments_style', 1);

// 1E - clean up gallery output in wp
add_filter('gallery_style', 'mre_gallery_style');

// 2A - enqueue base scripts and styles
add_action('wp_enqueue_scripts', 'mre_scripts_and_styles', 999);

// launching this stuff after theme setup
add_action('after_setup_theme','mre_theme_support');



// 1A - Head Clean Up
function mre_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
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
function mre_rss_version() { return ''; }

// 1C – remove injected CSS for recent comments widget
function mre_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// 1D - remove injected CSS from recent comments widget
function mre_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// 1E remove injected CSS from gallery
function mre_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}
// Register and Enqueue Scripts ///////////////////////////////////////////////////////////////////
// wp_resgister_* not required before wp_enqueue_*
// wp_register_* is more useful for making available for the user to enqueue tw2113 @ 9:24
// but if you want to enqueue right away, just use wp_enqueue_* 9:24
// it'll register for you if it's not already registered
//http://codex.wordpress.org/Function_Reference/wp_enqueue_script
function mre_scripts_and_styles() {
	if (!is_admin()) {

		wp_deregister_script('jquery');
		// http://css-tricks.com/snippets/wordpress/include-jquery-in-wordpress-theme/  
   		wp_enqueue_script('mre_jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js", array(), '1.8', true);

		// enqueue modernizr.js | @Dependents: jQuery
		wp_enqueue_script('mre_modernizr', get_stylesheet_directory_uri() . '/js/libs/modernizr-2.0.6.min.js',array('mre_jquery'), '2.0.6', false);

		// enqueue jquery.validate.min.js | @Dependents: JQuery
		// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
		// wp_enqueue_script('mre_validator', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js',array('mre_jquery'), '1.10.0', false);
		
		// enqueue plugins.js | @Dependents: jQuery
		wp_enqueue_script('mre_plugins', get_stylesheet_directory_uri() . '/js/plugins.js', array('mre_jquery'), "1", true);
		
		// enqueue scripts.js | @Dependents: jQuery
		wp_enqueue_script('mre_scripts', get_stylesheet_directory_uri() . '/js/script.js', array('mre_jquery'), "1", true);
		
		// enqueue style.css // http://codex.wordpress.org/Function_Reference/wp_register_style
		wp_enqueue_style('mre_wpstyles', get_stylesheet_uri(), array(), '01', 'all');

		// enqueue /css/style.css 
		wp_enqueue_style('mre_styles', get_stylesheet_directory_uri() . '/css/style.css', array(), '01', 'all');
	}
}

// 3 Theme Support and Functions /////////////////////////////////////////////////////////////////// 
function mre_theme_support() {

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
			'main-nav' => __( 'The Main Menu', 'mrestarter' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'mrestarter' ) // secondary nav in footer
		)
	);
} /* end mre theme support */  

/************* THUMBNAIL SIZE OPTIONS *************/

// 3A Thumbnail sizes
add_image_size( 'mre-thumb-600', 600, 150, true );
add_image_size( 'mre-thumb-300', 300, 100, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'mre-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'mre-thumb-600' ); ?>
*/

/*Register widgetized area and update sidebar with default widgets*/
function mre_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'mre_A' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'mre_widgets_init' );

// Display navigation to next/previous pages when applicable

if ( ! function_exists( 'mre_content_nav' ) ) :

function mre_content_nav( $nav_id ) {
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
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'mre_s' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'mre_s' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'mre_s' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'mre' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mre' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // mre_content_nav

if ( ! function_exists( 'mre_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since mre_s 1.0
 */
function mre_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'mre_s' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'mre_s' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since mre_s 1.0
 */
function mre_categorized_blog() {
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
		// This blog has more than 1 category so mre_s_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so mre_s_categorized_blog should return false
		return false;
	}
}


// 4 Custom Tweaks and Functions /////////////////////////////////////////////////////////////////// 

/// @ twentyeleven Tweaks////

/** 
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function mre_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'mre_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function mre_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mre' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function mre_auto_excerpt_more( $more ) {
	return ' &hellip;' . mre_continue_reading_link();
}
add_filter( 'excerpt_more', 'mre_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function mre_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= mre_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'mre_custom_excerpt_more' );
    

 ?>