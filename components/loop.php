<?php
/**
 * Loop template
 *
 * @package EngenhariaLivre\Fundamento
 */

if ( have_posts() ) :

	fundamento_archive_title();

	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		/*
		 * Include the Post-Type-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
		 */

		fundamento_template( 'article' );

		fundamento_post_navigation();

		if ( is_singular() && ( comments_open() || get_comments_number() ) ) :
			comments_template();
		endif;

	endwhile;

	fundamento_the_posts_navigation();

else :
	fundamento_template( 'content-none' );
endif;
