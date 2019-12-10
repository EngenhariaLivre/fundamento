<?php
/**
 * The footer template for a page or post
 *
 * @package EngenhariaLivre\Fundamento
 */

if ( ! is_singular() ) {
    return;
}
?>

<div class="author-box">
    <div class="author-data">
        <h3><?php the_author_meta( 'display_name' ); ?></h3>

        <div class="author-description">
            <?php the_author_meta( 'description' ); ?><br>
            <a rel="author" href="<?php the_author_meta( 'user_url' ); ?>" class="author-more">
                <?php
                    _e( 'More', 'fundamento' );
                ?>
            </a>
        </div>

        <div class="author-links">
            <?php fundamento_author_contact_links(); ?>
        </div>
    </div>

    <div class="author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 175 ); ?>
    </div>
</div>