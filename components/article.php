<?php
$content = is_singular() ? 'content': 'summary';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		template( 'elements/entry-header' );
		engenharia_livre_post_thumbnail();
		template( 'elements/' . $content );
		template( 'elements/entry-footer' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->