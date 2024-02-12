<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My_First_Theme
 */

?>
<div class="col" id="post-<?php the_ID();?>" <?php post_class();?>>
    <div class="card">
        <?php if(has_post_thumbnail()): ?>
        <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="...">
        <?php endif; ?>
        <div class="card-body">
            <?php the_title( '<h5 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
            ?>
            <div class="card-text"><?php the_excerpt() ?></div>
        </div>
    </div>
</div>
