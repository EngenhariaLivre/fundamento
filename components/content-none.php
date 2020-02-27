<?php
/**
 * The 404/no results template
 *
 * @package EngenhariaLivre\Fundamento
 */

?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'fundamento' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'fundamento' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);
		else :
			if ( is_search() ) :
			?>

				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'fundamento' ); ?></p>
			<?php
			else :
			?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'fundamento' ); ?></p>
			<?php
			
			endif;

			get_search_form();
			?>
			<div class="widget-container">
			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

			<div class="widget widget_categories">
				<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'fundamento' ); ?></h2>
				<ul>
					<?php
					wp_list_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'show_count' => 1,
						'title_li'   => '',
						'number'     => 10,
					) );
					?>
				</ul>
			</div><!-- .widget -->

			<?php
			/* translators: %1$s: smiley */
			$_s_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'fundamento' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$_s_archive_content" );
			?>
			</div>
			<?php
			the_widget( 'WP_Widget_Tag_Cloud' );

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
