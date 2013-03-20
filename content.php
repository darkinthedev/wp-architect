<?php
/**
 * @package wp_arch
 * @since wp_arch 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp_arch' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php wp_arch_posted_on(); ?>
		</div><?php //.entry-meta ?>
		<?php endif; ?>
	</header><?php //.entry-header ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><?php //.entry-summary ?>
	<?php else : ?>
	<div class="entry-content group">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp_arch' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wp_arch' ), 'after' => '</div>' ) ); ?>
	</div><?php //.entry-content ?>
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'wp_arch' ) );
				if ( $categories_list && wp_arch_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'wp_arch' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'wp_arch' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'wp_arch' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'wp_arch' ), __( '1 Comment', 'wp_arch' ), __( '% Comments', 'wp_arch' ) ); ?></span>
		<span class="sep"> | </span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'wp_arch' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer><?php //.entry-meta ?>
</article><?php #post-<?php the_ID(); ?>
