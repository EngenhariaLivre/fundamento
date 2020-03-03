<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fundamento\Fundamento
 */

if ( ! is_active_sidebar( 'sidebar-1' ) || is_404() || ! fundamento_is_search_has_results() ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php
		fundamento_display_ad( 'halfpage' );
		dynamic_sidebar( 'sidebar-1' );
	?>
</aside><!-- #secondary -->
