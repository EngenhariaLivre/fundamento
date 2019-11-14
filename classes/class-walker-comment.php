<?php
/**
 * Custom comment walker
 *
 * @package EngenhariaLivre\Fundamento
 * @since 1.0.0
 */

namespace EngenhariaLivre\Fundamento;

/**
 * Custom comment walker for this theme.
 */
class Walker_Comment extends \Walker_Comment {

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @see wp_list_comments()
	 * @see https://developer.wordpress.org/reference/functions/get_comment_author_url/
	 * @see https://developer.wordpress.org/reference/functions/get_comment_author/
	 * @see https://developer.wordpress.org/reference/functions/get_avatar/
	 * @see https://developer.wordpress.org/reference/functions/get_comment_reply_link/
	 * @see https://developer.wordpress.org/reference/functions/get_edit_comment_link/
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	public function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
		<<?php echo esc_html( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
					<footer class="comment-meta">
						<div class="comment-author vcard">
							<div class="avatar-container">	
								<?php
								if ( 0 !== $args['avatar_size'] ) {
									echo get_avatar( $comment, $args['avatar_size'] );
								}
								?>
							</div>
							<div class="comment-metadata">
								<?php 
									printf( 
										/* translators: Author says: */
										__( '%s <span class="says">says:</span>', 'fundamento' ),
										sprintf( '<b class="fn">%s</b>',
											get_comment_author_link( $comment )
										)
									);
								?>
								<span class="bull">&bull;</span>
								<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
									<time datetime="<?php comment_time( 'c' ); ?>">
										<?php echo esc_html( get_comment_date( '', $comment ) ); ?>
									</time>
								</a>
								<?php edit_comment_link( __( 'Edit', 'fundamento' ), '<span class="edit-link">', '</span>' ); ?>
							</div><!-- .comment-metadata -->
						</div><!-- .comment-author -->

						<?php if ( '0' === $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fundamento' ); ?></p>
						<?php endif; ?>
					</footer><!-- .comment-meta -->

					<div class="comment-content">
						<?php comment_text(); ?>
						<?php
							comment_reply_link( array_merge(
								$args,
								array(
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<span class="reply">',
									'after'     => '</span>',
								)
							) );
						?>
					</div><!-- .comment-content -->
			</article><!-- .comment-body -->
		<?php
	}
}
