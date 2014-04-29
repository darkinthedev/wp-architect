<?php
/**
 * Footer
 *
 * The template for displaying the footer.
 *
 * @since 1.0.0
 *
 * @package wp_arch
 */
?>

	</div><?php //.main-wrapper ?>

	<footer class="page-footer" role="contentinfo">
		<div class="site-info">
			<p>Copyright &copy; <?php echo date("Y") ?> </p>
			<nav>
			<?php wp_nav_menu( array('theme_location' => 'footer-links') ); ?>
			</nav>
		</div><?php //.site-info ?>
	</footer><?php // .page-footer ?>

</div><?php //.page .hfeed .site ?>

<?php wp_footer(); ?>

</body>
</html>
