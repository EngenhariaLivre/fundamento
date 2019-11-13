<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EngenhariaLivre\Fundamento
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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'EngenhariaLivre\Fundamento' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="header-container container">
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				}
				
				if ( is_front_page() && is_home() ) :
					?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					else :
						?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
				endif;
					$_s_description = get_bloginfo( 'description', 'display' );
				
					if ( $_s_description || is_customize_preview() ) :
						/** TODO: remove text description with Theme Customization API */
						?>
				<p class="site-description"><?php echo $_s_description; /* phpcs:ignore */ ?></p>
					<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button 
					class="hamburger hamburger--spin menu-toggle"
					aria-label="<?php esc_html_e( 'Menu', 'EngenhariaLivre\Fundamento' ); ?>"
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
						'container_class' => false, // Must be the same id as aria-controls int the button above.
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
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container">
