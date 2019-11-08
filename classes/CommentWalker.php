<?php

namespace EngenhariaLivre;

class CommentWalker extends \Walker_Comment {
    public function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
					<footer class="comment-meta">
						<div class="comment-author vcard">
							<div class="avatar-container">	
								<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
							</div>
							<div class="comment-metadata">
								<?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) ) ); ?>
								<span class="bull">&bull;</span>
								<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
									<time datetime="<?php comment_time( 'c' ); ?>">
									<?php
										/* translators: 1: comment date, 2: comment time */
										printf( __( '%1$s' ), get_comment_date( '', $comment ) );
									?>
									</time>
								</a>
								<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
							</div><!-- .comment-metadata -->
						</div><!-- .comment-author -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
						<?php endif; ?>
					</footer><!-- .comment-meta -->

					<div class="comment-content">
						<?php comment_text(); ?>
						<?php
							comment_reply_link( array_merge( $args, [
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<span class="reply">',
								'after'     => '</span>'
							] ) );
						?>
					</div><!-- .comment-content -->
			</article><!-- .comment-body -->
<?php
	}
}