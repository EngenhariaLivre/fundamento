<?php
/**
 * The template for displaying content
 *
 * This is the template that displays the content of a page or post
 * for any singular page.
 *
 * @package EngenhariaLivre\Fundamento
 */

?>
<div class="entry-content">
	<?php
	the_content( sprintf(
		wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'EngenhariaLivre\Fundamento' ),
			array(
				'span' => array(
					'class' => array(),
				),
			)
		),
		get_the_title()
	) );

	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'EngenhariaLivre\Fundamento' ),
		'after'  => '</div>',
	) );
	?>
</div>
