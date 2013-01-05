<?php 
/*
///REF: http://themeshaper.com/2012/10/22/the-themeshaper-wordpress-theme-tutorial-2nd-edition/
*/
 ?>
<!DOCTYPE html>
<?php // Paul Irish IE Conditional http://paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php // Always force latest IE rendering engine (even in intranet) & Chrome Frame // ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php //Adopted from Toolbox Theme
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
        echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

    ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php // XHTML Friends Network http://gmpg.org/xfn/ ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php /*The name Atom applies to a pair of related standards. The Atom Syndication Format is an XML language used for web feeds, while the Atom Publishing Protocol (AtomPub or APP) is a simple HTTP-based protocol for creating and updating web resources.*/ ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php //ADDED TO Styles functions.php Enqueue?>
<?php //MOVE TO functions.php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php // wp_head hook - http://codex.wordpress.org/Plugin_API/Action_Reference/wp_head ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php // Schema 'hfeed' http://microformats.org/wiki/hatom ?>
    <div id="page" class="hfeed site">

<?php //ARIA 'role' http://www.paciellogroup.com/blog/2012/06/html5-accessibility-chops-when-to-use-an-aria-role/ ?>
        <header id="branding" role="banner">
            <hgroup>
                <h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
            </hgroup>

            <nav id="access" role="navigation">
                <h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'wp_arch' ); ?></h1>
                <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'wp_arch' ); ?>"><?php _e( 'Skip to content', 'wp_archstarter' ); ?></a></div>
                <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </nav><!-- #access -->
        </header><!-- #branding -->

        <div id="main" class="group">