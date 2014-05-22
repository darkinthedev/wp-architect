<?php
/**
 * Page
 *
 * The template for displaying all pages.
 *
 * @since           1.0.0
 *
 * @package         WordPress
 * @subpackage      wp_arch
 */

get_header(); ?>
		<section class="primary" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
					<?php comments_template( '', true ); ?>
				<?php endwhile; // end of the loop. ?>

		</section> <!-- .primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
