<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fundamento
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fundamento' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="header-container container">
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				}
				
				if ( is_front_page() && is_home() ) :
					?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php fundamento_site_name(); ?></a></h1>
					<?php
					else :
						?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php fundamento_site_name(); ?></a></p>
						<?php
				endif;
					$fundamento_description = get_bloginfo( 'description', 'display' );
				
					if ( $fundamento_description || is_customize_preview() ) :
						/** TODO: remove text description with Theme Customization API */
						?>
				<p class="site-description"><?php echo $fundamento_description; /* phpcs:ignore */ ?></p>
					<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button 
					class="hamburger hamburger--spin menu-toggle"
					aria-label="<?php esc_html_e( 'Menu', 'fundamento' ); ?>"
					aria-controls="site-links"
					aria-expanded="false"
				>
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
				<div class="site-links is-not-active">
				<?php
					wp_nav_menu( array(
						'container_class' => false,
						'depth'           => 1,
						'menu_id'         => 'primary-menu',
						'theme_location'  => 'menu-1',
					) );

					dynamic_sidebar( 'menu-1' );
					dynamic_sidebar( 'menu-2' );
					dynamic_sidebar( 'menu-3' );
					?>
				</div>
			</nav><!-- #site-navigation -->

			<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'fundamento' ); ?>">
				<?php
				if ( has_nav_menu( 'social' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>' . fundamento_get_theme_svg( 'link' ),
							'depth'          => 1,
						)
					);
				endif;
				?>

				<?php echo get_search_form(); ?>
			</nav><!-- .social-navigation -->
		</div>
	</header><!-- #masthead -->

	<?php fundamento_display_ad( 'leaderboard' ); ?>

	<div id="content" class="site-content">
		<?php
		if ( is_front_page() && fundamento_has_featured_posts() ) {
			get_template_part( 'components/featured-content' );
		}
		?>
		<div class="container">
