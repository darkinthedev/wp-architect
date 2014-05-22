<?php
/**
 * Search
 *
 * The template for displaying Search Results pages.
 *
 * @since           1.0.0
 *
 * @package         WordPress
 * @subpackage      wp_arch
 */
get_header(); ?>
		<section class="primary" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wp_arch' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header> <!-- .page-header -->

				<?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', 'search' ); ?>
				<?php endwhile; ?>

				<?php wp_arch_content_nav( 'nav-below' ); ?>

			<?php else : ?>
                <?php get_template_part( 'library/partials/not-found'); ?>
			<?php endif; ?>

		</section><!-- .primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
