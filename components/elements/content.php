<div class="entry-content">
	<?php
	the_content( sprintf(
		wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '_s' ),
			[
				'span' => array(
					'class' => array(),
				),
			]
		),
		get_the_title()
	) );

	wp_link_pages( [
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
		'after'  => '</div>',
	] );
	?>
</div>