<?php
/**
 * Footer
 *
 * The template for displaying the footer.
 *
 * @since           1.0.0
 *
 * @package         WordPress
 * @subpackage      wp_arch
 */
?>
	</div><!-- .main-wrapper -->
	<footer class="page-footer" role="contentinfo">
		<div class="site-info">
			<p>Copyright &copy; <?php echo date("Y") ?> </p>
			<nav>
                <?php wp_nav_menu( array('theme_location' => 'footer-links') ); ?>
			</nav>
		</div><!-- .site-info -->
	</footer><!-- .page-footer -->
</div><!-- .page -->
<?php wp_footer(); ?>
</body>
</html>
