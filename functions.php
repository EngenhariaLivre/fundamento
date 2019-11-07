<?php
/**
 * Setup the theme
 */
require get_template_directory() . '/classes/Theme.php';

$theme = new Theme();
$theme->addNavMenus( [
	'menu-1' => esc_html__( 'Primary', 'engenharia-livre' ),
] );
$theme->contentWidth( 640 );
$theme->widget([
	'name'          => esc_html__( 'Sidebar', 'engenharia-livre' ),
	'id'            => 'sidebar-1',
	'description'   => esc_html__( 'Add widgets here.', 'engenharia-livre' ),
]);