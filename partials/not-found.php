<?php
/**
 * Not Found
 *
 * Loaded when a the loop returns no results
 *
 * @since           1.0.0
 *
 * @package         WordPress
 * @subpackage      wp_arch
 */
 ?>
<article id="post-0" class="post no-results not-found">
    <header class="entry-header">
        <h1 class="entry-title"><?php _e( 'Nothing Found', 'mre_s' ); ?></h1>
    </header>

    <div class="entry-content">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mre_s' ), admin_url( 'post-new.php' ) ); ?></p>

        <?php elseif ( is_search() ) : ?>

            <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mre_s' ); ?></p>
            <?php get_search_form(); ?>

        <?php else : ?>

            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mre_s' ); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>
    </div>
</article>
