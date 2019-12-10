<?php
/**
 * The template for displaying featured content
 *
 * @package EngenhariaLivre\Fundamento
 */
?>
<div class="featured-content">
	<?php
		$featured_posts = fundamento_get_featured_posts();

		foreach ( (array) $featured_posts as $order => $post ) {
			setup_postdata( $post );
			fundamento_template( 'article' );
		}

		wp_reset_postdata();
	?>
</div>