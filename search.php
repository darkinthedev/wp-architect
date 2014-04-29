<?php
/**
 * Search
 *
 * The template for displaying Search Results pages.
 *
 * @since 1.0.0
 *
 * @package wp_arch
 */

get_header(); ?>

		<section class="primary" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wp_arch' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php wp_arch_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php wp_arch_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'wp_arch' ); ?></h1>
					</header><?php //entry-header ?>

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wp_arch' ); ?></p>
						<?php get_search_form(); ?>
					</div><?php //entry-content ?>
				</article><?php //post-0 ?>

			<?php endif; ?>

		</section><?php //.primary ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
