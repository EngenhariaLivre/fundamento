<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EngenhariaLivre\Fundamento
 */

?>

</div><!-- .container -->
</div><!-- #content -->

<footer id="colophon" class="site-footer">
	<div class="container">
		<?php
			dynamic_sidebar( 'footer-1' );
			dynamic_sidebar( 'footer-2' );
			dynamic_sidebar( 'footer-3' );
		?>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fundamento' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'fundamento' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'fundamento' ), 'fundamento', '<a href="https://douglasdemoura.github.io/">Douglas Moura</a>' );
			?>
		</div><!-- .site-info -->
	</div><!-- .container -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>