<?php
/**
 * Index
 *
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since           1.0.0
 *
 * @package         WordPress
 * @subpackage      wp_arch
 */
get_header(); ?>
		<section class="primary" role="main">
			<?php if ( have_posts() ) : ?>
				<?php if (is_category()) {  // is Category...?>
    				<header class="page-header">
    					<h1 class="page-title"><?php
    						printf( __( 'Category Archives: %s', 'wp_arch' ), '<span>' . single_cat_title( '', false ) . '</span>' );
    					?></h1>
    					<?php
    						$category_description = category_description();
    						if ( ! empty( $category_description ) )
    							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
    					?>
    				</header><!-- .page-header -->

				<?php } elseif (is_archive()) {  // is Archive...?>
					<header class="page-header">
    					<h1 class="page-title">
    						<?php
    							if ( is_day() ) :
    								printf( __( 'Daily Archives: %s', 'wp_arch' ), '<span>' . get_the_date() . '</span>' );
    							elseif ( is_month() ) :
    								printf( __( 'Monthly Archives: %s', 'wp_arch' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
    							elseif ( is_year() ) :
    								printf( __( 'Yearly Archives: %s', 'wp_arch' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
    							elseif ( is_post_type_archive() ) :
    								wp_arch_get_post_type_name();
                                elseif ( is_tag() ) :
                                    echo 'Tag Archives: '; echo('<span>' . single_tag_title() . '</span>' );
    							else :
    								_e( 'Archives', 'wp_arch' );
    							endif;
    						?>
    					</h1>
				    </header> <!-- .page-header -->
				<?php } ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Type-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_type() );
					?>

				<?php endwhile; ?>

				<?php wp_arch_content_nav( 'nav-below' ); ?>

				<?php if( is_single() || is_page() ) {
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
					}
				?>

			<?php else : // No Posts Found ?>
                <?php get_template_part( 'partials/not-found'); ?>
			<?php endif; ?>
		</section><!-- .primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
