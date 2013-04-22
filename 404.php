<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package wp_arch
 * @since wp_arch 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'wp_arch' ); ?></h1>
				</header><?php //.entry-header ?>

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp_arch' ); ?></p>

					<?php get_search_form(); ?>

				</div><?php //.entry-content ?>
			</article><?php //#post-0 .post .error404 .not-found ?>

		</div><?php //#content .site-content ?>
	</div><?php //#primary .content-area ?>

<?php get_footer(); ?>