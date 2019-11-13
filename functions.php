<?php
/**
 * Engenharia Livre functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package EngenhariaLivre\Fundamento
 */

/**
 * Require classes
 */
require get_template_directory() . '/classes/class-theme.php';
require get_template_directory() . '/classes/class-walker-comment.php';
require get_template_directory() . '/classes/class-svg-icon.php';

$theme = new EngenhariaLivre\Fundamento\Theme();
$theme->register_nav_menus( array(
	'menu-1' => esc_html__( 'Primary', 'fundamento' ),
	'social' => esc_html__( 'Social', 'fundamento' ),
) );
$theme->content_width( 640 );
$theme->widget( array(
	'name'        => esc_html__( 'Sidebar', 'fundamento' ),
	'id'          => 'sidebar-1',
	'description' => esc_html__( 'Add widgets here.', 'fundamento' ),
) );
$theme->widget( array(
	'name'          => esc_html__( 'Menu - column 1', 'fundamento' ),
	'id'            => 'menu-1',
	'description'   => esc_html__( 'Add widgets here.', 'fundamento' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
) );
$theme->widget( array(
	'name'          => esc_html__( 'Menu - column 2', 'fundamento' ),
	'id'            => 'menu-2',
	'description'   => esc_html__( 'Add widgets here.', 'fundamento' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
) );
$theme->widget( array(
	'name'          => esc_html__( 'Menu - column 3', 'fundamento' ),
	'id'            => 'menu-3',
	'description'   => esc_html__( 'Add widgets here.', 'fundamento' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
) );
$theme->widget( array(
	'name'          => esc_html__( 'Footer - column 1', 'fundamento' ),
	'id'            => 'footer-1',
	'description'   => esc_html__( 'Add widgets here.', 'fundamento' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
) );
$theme->widget( array(
	'name'          => esc_html__( 'Footer - column 2', 'fundamento' ),
	'id'            => 'footer-2',
	'description'   => esc_html__( 'Add widgets here.', 'fundamento' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
));
$theme->widget(array(
	'name'          => esc_html__( 'Footer - column 3', 'fundamento' ),
	'id'            => 'footer-3',
	'description'   => esc_html__( 'Add widgets here.', 'fundamento' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
));
$theme->widget( array(
	'name'          => esc_html__( 'Footer - column 4', 'fundamento' ),
	'id'            => 'footer-4',
	'description'   => esc_html__( 'Add widgets here.', 'fundamento' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
));
$theme->add_script( 'engenharia-livre-scripts', get_template_directory_uri() . '/assets/js/scripts.js' );

/**
 * Custom body classes for the theme
 * 
 * @param string|array $classes CSS classes to add on the <body>.
 */
function fundamento_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_singular() ) {
		$classes[] = 'singular';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'fundamento_body_classes' );

function fundamento_post_class( $classes, $class, $post_id ) {
	if ( has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}
	return $classes;
}
add_filter( 'post_class', 'fundamento_post_class', 10, 3 );

/**
 * Template file loader
 * 
 * @param string $file File to be included.
 */
function fundamento_template( $file ) {
	include locate_template( 'components/' . $file . '.php' );
}

/**
 * Template tag to display post/page publication date
 */
function fundamento_posted_on() {
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
		esc_html_x( 'at %s', 'post date', 'fundamento' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore
}

/**
 * Template tag to display the author
 */
function fundamento_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'Written by %s', 'post author', 'fundamento' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	
	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore
}

/**
 * Template tag to display the entry footer
 */
function fundamento_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'fundamento' ) );

		if ( $categories_list ) {;
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . fundamento_get_theme_svg( 'bookmark' ) . __('<span class="screen-reader-text">Posted in</span> %1$s', 'fundamento' ) . '</span>', $categories_list ); // phpcs:ignore
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'fundamento' ) );
		
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . fundamento_get_theme_svg( 'tag' ) . __('<span class="screen-reader-text">Tagged</span> %1$s', 'fundamento' ) . '</span>', $tags_list ); // phpcs:ignore
		}
	}
	/*
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					// translators: %s: post title
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'fundamento' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}
	*/
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'fundamento' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Template tag to display the featured image or a placeholder
 * 
 * @param string|array $size A valid the_post_thumbnail() size.
 * @param string|array $attr Valid attributes for the_post_thumbnail().
 */
function fundamento_featured_image( $size = 'post-thumbnail', $attr = '' ) {
	if ( has_post_thumbnail() ) :
		the_post_thumbnail( $size, $attr );
	else :
		?>
	<div class="no-thumbnail">
	</div>
		<?php
	endif;
}

/**
 * Template tag to display the post thumbnail
 */
function fundamento_post_thumbnail() {
	if ( post_password_required() || is_attachment() ) {
		return;
	}
	if ( is_singular() ) :
		// TODO: Change this div below to a <figure>.
		?>

		<div class="post-thumbnail">
			<?php fundamento_featured_image(); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php
		fundamento_featured_image( 'post-thumbnail',
			array(
				'alt' => the_title_attribute(
					array(
						'echo' => false,
					)
				),
			)
		);
		?>
	</a>

		<?php
	endif; // End is_singular().
}

/**
 * Displays comments publishing date in human readable format
 * 
 * @param string         $date    Valid date.
 * @param string         $d       Valid date.
 * @param int|WP_Comment $comment WP_Comment or comment ID.
 */
function fundamento_comment_time_output( $date, $d, $comment ) {
	return sprintf(
		/* translators: time ago */
		_x( '%s ago', '%s = human-readable time difference', 'fundamento' ),
		human_time_diff(
			get_comment_time( 'U' ),    // TODO: Refactor those lines
			current_time( 'timestamp' )
		)
	);
}
add_filter( 'get_comment_date', 'fundamento_comment_time_output', 10, 3 );

/**
 * Post navigation for this theme
 */
function fundamento_post_navigation() {
	if ( is_singular( 'attachment' ) ) {
		// Parent post navigation.
		the_post_navigation(
			array(
				/* translators: %s: parent post link */
				'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'engenharia-livre' ), '%title' ),
			)
		);
	} elseif ( is_singular( 'post' ) ) {
		// Previous/next post navigation.
		the_post_navigation(
			array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'engenharia-livre' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'engenharia-livre' ) . '</span> <br/>' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'engenharia-livre' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'engenharia-livre' ) . '</span> <br/>' .
					'<span class="post-title">%title</span>',
			)
		);
	}
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function fundamento_nav_menu_social_icons( $item_output, $item, $depth, $args )
{
	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		$svg = EngenhariaLivre\Fundamento\SVG_Icons::get_social_link_svg( $item->url );
		if (empty($svg)) {
			$svg = fundamento_get_theme_svg('link');
		}
		$item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'fundamento_nav_menu_social_icons', 10, 4 );

/**
 * Output and Get Theme SVG.
 * Output and get the SVG markup for an icon in the TwentyTwenty_SVG_Icons class.
 *
 * @param string $svg_name The name of the icon.
 * @param string $group The group the icon belongs to.
 * @param string $color Color code.
 */
function fundamento_the_theme_svg( $svg_name, $group = 'ui', $color = '' ) {
	echo fundamento_get_theme_svg( $svg_name, $group, $color ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in twentytwenty_get_theme_svg();.
}

/**
 * Get information about the SVG icon.
 *
 * @param string $svg_name The name of the icon.
 * @param string $group The group the icon belongs to.
 * @param string $color Color code.
 */
function fundamento_get_theme_svg( $svg_name, $group = 'ui', $color = '' ) {
	// Make sure that only our allowed tags and attributes are included.
	$svg = wp_kses(
		EngenhariaLivre\Fundamento\SVG_Icons::get_svg( $svg_name, $group, $color ),
		array(
			'svg'     => array(
				'class'       => true,
				'xmlns'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'role'        => true,
				'focusable'   => true,
			),
			'path'    => array(
				'fill'      => true,
				'fill-rule' => true,
				'd'         => true,
				'transform' => true,
			),
			'polygon' => array(
				'fill'      => true,
				'fill-rule' => true,
				'points'    => true,
				'transform' => true,
				'focusable' => true,
			),
		)
	);
	if ( ! $svg ) {
		return false;
	}
	return $svg;
}