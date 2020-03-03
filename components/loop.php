<?php
/**
 * Loop template
 *
 * @package Fundamento
 */

if ( have_posts() ) :

	fundamento_archive_title();

	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		if ( is_singular() ) {
			set_query_var( 'thumbnail', 'single-feature' );
		} else {
			set_query_var( 'thumbnail', 'entry-summary' );
		}

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
