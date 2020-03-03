<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fundamento\Fundamento
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
	</div><!-- .container -->
	<div class="container site-info">
		<div class="creator">
			Feito com ❤️ por <a href="https://douglasdemoura.github.io/">Douglas Moura</a>
		</div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
