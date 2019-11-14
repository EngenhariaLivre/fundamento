<?php
/**
 * The content template for a page or post
 *
 * @package EngenhariaLivre\Fundamento
 */

$content = is_singular() ? 'content' : 'summary';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		fundamento_template( 'elements/entry-header' );
		fundamento_post_thumbnail();
		fundamento_template( 'elements/' . $content );
		fundamento_template( 'elements/entry-footer' );
		fundamento_template( 'elements/author-data' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
