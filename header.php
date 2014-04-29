<?php
/**
 * Header
 *
 * The header containing the head of the document.
 *
 * @since 1.0.0
 *
 * @package wp_arch
 */
 ?>
<!doctype html>
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes() ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
 <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' /><![endif]-->
<title><?php //Adopted from toolbox Theme
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    wp_title( '|', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'wp_arch' ), max( $paged, $page ) );

    ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
<!--[if (gte IE 6)&(lte IE 8)]>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
<![endif]-->
</head>
<body <?php body_class(); ?>>
   <!--[if lt IE 8]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
   <![endif]-->
    <div class="hfeed page">
        <header role="banner">
            <h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <h2><?php bloginfo( 'description' ); ?></h2>
            <div class="dropdown-menu">
                <a class="menu-link" href="#"> &#9776; Menu</a>
                <nav role="navigation">
                    <h1 class="assistive-text section-heading visuallyhidden"><?php _e( 'Main menu', 'wp_arch' ); ?></h1>
                    <div class="skip-link screen-reader-text visuallyhidden"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'wp_arch' ); ?>"><?php _e( 'Skip to content', 'wp_archstarter' ); ?></a></div>
                    <?php wp_nav_menu( array(
                    'theme_location' => 'main-nav',
                    'depth' => 2,
                    'items_wrap' => '<ul class="%1$s">%3$s</ul>') ); ?>
                </nav>
            </div>
        </header>

        <div id="content" class="main-wrapper">
