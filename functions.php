<?php
/**
 * Fundamento functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fundamento
 */

/**
 * Require classes
 */
require get_template_directory() . '/classes/class-theme.php';
require get_template_directory() . '/classes/class-walker-comment.php';
require get_template_directory() . '/classes/class-svg-icons.php';

$theme = new Fundamento\Theme();
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
$theme->add_script( 'tiny-slider', get_template_directory_uri() . '/assets/js/tiny-slider.js' );
$theme->add_script( 'fundamento-scripts', get_template_directory_uri() . '/assets/js/scripts.js' );

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
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_404() && fundamento_is_search_has_results() ) {
		$classes[] = 'has-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}

	if ( null !== paginate_links() ) {
		$classes[] = 'is-paginated';
	}

	return $classes;
}
add_filter( 'body_class', 'fundamento_body_classes' );

/**
 * Custom post classes
 * 
 * @param string[] $classes An array of post class names.
 * @param string[] $class   An array of additional class names added to the post.
 * @param int      $post_id The post ID.
 */
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

		if ( $categories_list ) {
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
	if ( has_post_thumbnail() && ! post_password_required() ) :
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
	if ( is_attachment() ) {
		return;
	}

	if ( is_singular() ) :
		?>

		<div class="post-thumbnail">
			<?php fundamento_featured_image(); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

	<div class="post-thumbnail-container">
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
	</div>

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
			get_comment_time( 'U' ),
			date_timestamp_get( current_datetime() )
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
				'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'fundamento' ), '%title' ),
			)
		);
	} elseif ( is_singular( 'post' ) ) {
		// Previous/next post navigation.
		the_post_navigation(
			array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'fundamento' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'fundamento' ) . '</span> <br/>' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'fundamento' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'fundamento' ) . '</span> <br/>' .
					'<span class="post-title">%title</span>',
			)
		);
	}
}

/**
 * Posts pagination.
 */
function fundamento_the_posts_navigation() {
	the_posts_pagination(
		array(
			'mid_size'  => 2,
			'prev_text' => sprintf(
				'%s <span class="nav-prev-text">%s</span>',
				fundamento_the_theme_svg( 'chevron' ),
				__( 'Newer posts', 'fundamento' )
			),
			'next_text' => sprintf(
				'<span class="nav-next-text">%s</span> %s',
				__( 'Older posts', 'fundamento' ),
				fundamento_the_theme_svg( 'chevron' )
			),
		)
	);
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
function fundamento_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		$svg = Fundamento\SVG_Icons::get_social_link_svg( $item->url );
		if ( empty( $svg ) ) {
			$svg = fundamento_get_theme_svg( 'link' );
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
		Fundamento\SVG_Icons::get_svg( $svg_name, $group, $color ),
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

/**
 * Defines custom fields for all users.
 *
 * @return array $fields Array of custom user contact info fields.
 */
function fundamento_user_custom_fields() {
	return array(
		'facebook'  => __( 'Facebook', 'fundamento' ),
		'twitter'   => __( 'Twitter', 'fundamento' ),
		'instagram' => __( 'Instagram', 'fundamento' ),
		'linkedin'  => __( 'LinkedIn', 'fundamento' ),
	);
}

/**
 * Removes legacy contact fields and adds support for Facebook, Twitter, Instagram and LinkedIn.
 *
 * @param array $fields  Array of default contact fields.
 * @return array $fields Amended array of contact fields.
 */
function fundamento_custom_contact_info( $fields ) {
	// Remove the old, unused fields.
	unset( $fields['aim'] );
	unset( $fields['yim'] );
	unset( $fields['jabber'] );

	// Adds custom contact fields.
	foreach ( fundamento_user_custom_fields() as $key => $value ) {
		$fields[ $key ] = $value;
	}

	// Return the amended contact fields.
	return $fields;
}

add_filter( 'user_contactmethods', 'fundamento_custom_contact_info' );

/**
 * Return social links for the current author in the loop.
 */
function fundamento_author_contact_links() {
	foreach ( fundamento_user_custom_fields() as $key => $value ) {
		if ( get_the_author_meta( $key ) !== '' ) :
			?>
		<a href="<?php the_author_meta( $key ); ?>" class="author-social-link <?php echo esc_html( $key ); ?>" title="<?php echo esc_html( $value ); ?>">
			<span class="screen-reader-text"><?php echo esc_html( $value ); ?></span>
			<?php fundamento_the_theme_svg( $key, 'social' ); ?>
		</a>
			<?php
		endif;
	}
}

/**
 * Custom archive title.
 */
function fundamento_archive_title() {

	if ( is_singular() ) {
		return;
	}

	$archive_title    = '';
	$archive_subtitle = '';

	if ( is_search() ) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __( 'Search:', 'fundamento' ) . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ( $wp_query->found_posts ) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'fundamento'
				),
				number_format_i18n( $wp_query->found_posts )
			);
		} else {
			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'fundamento' );
		}
	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ( $archive_title || $archive_subtitle ) {
		?>
		<header class="archive-header has-text-align-center">
			<div class="archive-header-inner">
				<?php if ( $archive_title ) : ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php endif; ?>
				<?php if ( $archive_subtitle ) : ?>
					<div class="archive-subtitle"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
				<?php endif; ?>
			</div><!-- .archive-header-inner -->
		</header><!-- .archive-header -->
		<?php
	}
}

/**
 * Change the excerpt's length
 * 
 * @param int $length The maximum number of words. Default 55.
 */
function fundamento_custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'fundamento_custom_excerpt_length', 999 );

/**
 * Filter for the featured posts
 */
function fundamento_get_featured_posts() {
	return apply_filters( 'fundamento_get_featured_posts', array() );
}

/**
 * Check if has featured posts
 * 
 * @param int $minimum Number of posts that should be displayed.
 */
function fundamento_has_featured_posts( $minimum = 1 ) {
	if ( is_singular() ) {
		return false;
	}

	if ( is_paged() ) {
		return false;
	}

	$minimum        = absint( $minimum );
	$featured_posts = apply_filters( 'fundamento_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) ) {
		return false;
	}
		

	if ( $minimum > count( $featured_posts ) ) {
		return false;
	}

	return true;
}

/**
 * Custom markup for site name
 */
function fundamento_site_name() {
	$site_name = str_replace(
		array( 'Engenharia', 'Livre' ),
		array( '<span class="engenharia">Engenharia</span>', '<span class="livre">Livre</span>' ),
		get_bloginfo( 'name' )
	);

	echo wp_kses_post( $site_name );
}

/**
 * Add Google Fonts DNS prefetching
 */
function fundamento_google_fonts_dns_prefetching() {
	?>
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<?php

}
add_filter( 'wp_head', 'fundamento_google_fonts_dns_prefetching', 10, 2 );

/**
 * Template tag for featured posts
 */
function fundamento_display_featured_posts() {
	global $post;

	$featured_posts = fundamento_get_featured_posts();

	foreach ( (array) $featured_posts as $featured_post ) {
		$post = $featured_post; // phpcs:ignore

		setup_postdata( $featured_post );
		fundamento_template( 'article' );
	}

	wp_reset_postdata();
}

/**
 * Sanitize functions for ads
 * 
 * @param string $input Google Ads input to be displayed.
 */
function fundamento_sanitize_callback( $input ) {
	return $input;
}

/**
 * Create panel to add ads
 * 
 * @param WP_Customize_Manager $wp_customize WP_Customize_Manager instance.
 */
function fundamento_customize_register( $wp_customize ) {
	$wp_customize->add_section('ads',
		array(
			'title' => __( 'Ads', 'fundamento' ),
		)
	);
	
	$wp_customize->add_setting( 'leaderboard_code', array( 'sanitize_callback' => 'fundamento_sanitize_callback' ) );
	$wp_customize->add_setting( 'halfpage_code', array( 'sanitize_callback' => 'fundamento_sanitize_callback' ) );
	$wp_customize->add_setting( 'largerectangle_code', array( 'sanitize_callback' => 'fundamento_sanitize_callback' ) );
	
	
	$wp_customize->add_control( 'leaderboard',
		array(
			'label'    => __( 'Insert leaderboard (728 x 90 px)', 'fundamento' ),
			'type'     => 'textarea',
			'section'  => 'ads',
			'settings' => 'leaderboard_code',
		)
	);

	$wp_customize->add_control( 'halfpage',
		array(
			'label'    => __( 'Insert halfpage (300 x 600 px)', 'fundamento' ),
			'type'     => 'textarea',
			'section'  => 'ads',
			'settings' => 'halfpage_code',
		)
	);

	$wp_customize->add_control( 'largerectangle',
		array(
			'label'    => __( 'Insert large rectangle (336 x 280 px)', 'fundamento' ),
			'type'     => 'textarea',
			'section'  => 'ads',
			'settings' => 'largerectangle_code',
		)
	);
}
add_action( 'customize_register', 'fundamento_customize_register' );

/**
 * Display ads
 * 
 * @param string $ad_id ID of the desired ad.
 */
function fundamento_display_ad( $ad_id ) {
	$ad = get_theme_mod( $ad_id . '_code' );

	if ( '' !== $ad ) {
		?>
	<div class="ad <?php echo esc_html( $ad_id ); ?>">
		<?php echo $ad; // phpcs:ignore ?>
	</div>
		<?php
	}
}

/**
 * Check if search has results
 */
function fundamento_is_search_has_results() {
	return 0 !== $GLOBALS['wp_query']->found_posts;
}
