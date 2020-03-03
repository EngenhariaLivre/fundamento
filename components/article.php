<?php
/**
 * The content template for a page or post
 *
 * @package Fundamento\Fundamento
 */

$content = is_singular() ? 'content' : 'summary';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'template-' . $content ); ?>>
	<?php
		fundamento_template( 'elements/entry-header' );
		fundamento_post_thumbnail();
		fundamento_template( 'elements/entry-' . $content );
		fundamento_template( 'elements/entry-footer' );

	if ( is_singular() ) {
		fundamento_display_ad( 'largerectangle' );
	}
	
		fundamento_template( 'elements/bio' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
