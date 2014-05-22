<?php
/**
 * 404
 *
 * The template for displaying 404 pages (Not Found).
 *
 * @since           1.0.0
 *
 * @package         WordPress
 * @subpackage      wp_arch
 */

get_header(); ?>

	<section class="primary" role="main">

		<article id="post-0" class="post error404 not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'wp_arch' ); ?></h1>
			</header>  <!-- .entry-header -->
			<div class="entry-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp_arch' ); ?></p>
				<?php get_search_form(); ?>
			</div> <!-- .entry-content -->
		</article><!-- #post-0 .post .error404 .not-found -->

	</section><!-- .primary -->

<?php get_footer(); ?>
