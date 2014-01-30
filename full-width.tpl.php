<?php

/**
 *Template Name: Full Width 
 *Description: A Page Template for Full Width and No Sidebar
 *Codex: http://codex.wordpress.org/Page_Templates#Custom_Page_Template
 *
 *@package wp_arch
 *@since wp_arch 1.0
 *
 */

get_header(); ?>

        <section class="primary" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', 'page' ); ?>

                    <?php comments_template( '', true ); ?>

                <?php endwhile; // end of the loop. ?>

        </section><?php //.primary ?>

<?php get_footer(); ?>