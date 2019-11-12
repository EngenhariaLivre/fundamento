<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EngenhariaLivre
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
<?php
if ( have_comments() ) :
	?>
	<h2 class="comments-title">
		<?php
		$_s_comment_count = get_comments_number();
		if ( '1' === $_s_comment_count ) {
			printf(
				/* translators: 1: title. */
				esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'engenharia-livre' ),
				'<span>' . esc_html( get_the_title() ) . '</span>'
			);
		} else {
			printf( // phpcs:ignore Standard.Category.SniffName.ErrorCode
				/* translators: 1: comment count number, 2: title. */
				esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $_s_comment_count, 'comments title', 'engenharia-livre' ) ),
				number_format_i18n( $_s_comment_count ),
				'<span>' . esc_html( get_the_title() ) . '</span>'
			);
		}
		?>
	</h2><!-- .comments-title -->

	<?php the_comments_navigation(); ?>

	<ol class="comment-list">
		<?php
		wp_list_comments( array(
			'style'       => 'ol',
			'short_ping'  => true,
			'avatar_size' => 48,
			'walker'      => new EngenhariaLivre\Walker_Comment(),
		) );
		?>
	</ol><!-- .comment-list -->

	<?php
	the_comments_navigation();


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'engenharia-livre' ); ?></p>
		<?php
	endif;

endif; // Check for have_comments().
		comment_form();
?>
</div><!-- #comments -->
