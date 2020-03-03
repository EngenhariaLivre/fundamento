<?php
/**
 * The meta template for a page or post
 *
 * @package Fundamento
 */

?>
<div class="entry-meta">
	<div class="avatar">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
	</div>
	<div class="info">
		<?php fundamento_posted_by(); ?><br>
		<?php fundamento_posted_on(); ?>
	</div>
</div><!-- .entry-meta -->
