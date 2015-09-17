<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package neptune
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<p class="copyright">&copy; <?php echo date( "Y" ); echo " "; bloginfo( 'name' ); ?></p>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
