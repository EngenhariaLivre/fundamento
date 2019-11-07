<?php
get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php get_template_part( 'components/loop' ); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();