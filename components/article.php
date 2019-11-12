<?php
/**
 * The content template for a page or post
 *
 * @package EngenhariaLivre
 */

?>
<?php
$content = is_singular() ? 'content' : 'summary';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		engenharia_livre_template( 'elements/entry-header' );
		engenharia_livre_post_thumbnail();
		engenharia_livre_template( 'elements/' . $content );
		engenharia_livre_template( 'elements/entry-footer' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
