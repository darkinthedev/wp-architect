<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package wp_arch
 * @since wp_arch 1.0
 */
?>

	</div><?php //.main-wrapper ?>

	<footer class="page-footer" role="contentinfo">
		<div class="site-info">
			<p>Testing</p>
			<nav>
			<?php wp_nav_menu( array('theme_location' => 'footer-links') ); ?>
			</nav>
		</div><?php //.site-info ?>
	</footer><?php // .page-footer ?>

</div><?php //.page .hfeed .site ?>

<?php wp_footer(); ?>

</body>
</html>