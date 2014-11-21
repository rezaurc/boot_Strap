<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package boot_Strap
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer text-center" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'boot_Strap_credits' ); ?>
			<a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'boot_Strap' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'boot_Strap' ), 'boot_Strap', '<a href="http://www.rezaur.com" rel="author">Rezaur Chowdhury</a>' ); ?>
		</div><!-- .site-info -->
            <a href="#" class="back-to-top"><i class="glyphicon glyphicon-chevron-up"></i><?php _e (' Back to Top','boot_Strap');?></a>
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
