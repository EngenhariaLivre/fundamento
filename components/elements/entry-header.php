<?php
/**
 * The header template for a page or post
 *
 * @package Fundamento\Fundamento
 */

?>
<header class="entry-header">
	<?php
	if ( is_singular() ) :
		the_title( '<h1 class="entry-title">', '</h1>' );
	else :
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	endif;
	
	if ( 'post' === get_post_type() ) {
		fundamento_template( 'elements/entry-meta' );
	}
	?>
</header><!-- .entry-header -->
