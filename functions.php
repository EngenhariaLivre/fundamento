<?php
/**
 * Setup the theme
 */
require get_template_directory() . '/classes/Theme.php';
require get_template_directory() . '/classes/CommentWalker.php';

$theme = new EngenhariaLivre\Theme();
$theme->addNavMenus( [
	'menu-1' => esc_html__( 'Primary', 'engenharia-livre' ),
] );
$theme->contentWidth( 640 );
$theme->widget([
	'name'          => esc_html__( 'Sidebar', 'engenharia-livre' ),
	'id'            => 'sidebar-1',
	'description'   => esc_html__( 'Add widgets here.', 'engenharia-livre' ),
]);

function engenharia_livre_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'engenharia_livre_body_classes' );

function template( $file ) {
	include( locate_template( 'components/' . $file . '.php' ) );
}

function engenharia_livre_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'engenharia-livre' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
}

function engenharia_livre_posted_by() {
	$byline = sprintf(
	/* translators: %s: post author. */
	esc_html_x( 'by %s', 'post author', 'engenharia-livre' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	
	echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}

function engenharia_livre_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'engenharia-livre' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'engenharia-livre' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'engenharia-livre' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'engenharia-livre' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'engenharia-livre' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				get_the_title()
			)
		);
		echo '</span>';
	}
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'engenharia-livre' ),
				[
					'span' => [
						'class' => [],
					],
				]
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}

function engenharia_livre_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	if ( is_singular() ) :
		?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php
		the_post_thumbnail( 'post-thumbnail', array(
			'alt' => the_title_attribute( array(
				'echo' => false,
			) ),
		) );
		?>
	</a>

	<?php
	endif; // End is_singular().
}

function pressfore_comment_time_output($date, $d, $comment){
	return sprintf(
		_x( '%s ago', '%s = human-readable time difference', 'engenharia-livre' ),
		human_time_diff(
			get_comment_time( 'U' ),
			current_time( 'timestamp' )
		)
	);
}
add_filter('get_comment_date', 'pressfore_comment_time_output', 10, 3);