<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My_First_Theme
 */

get_header();
?>

	<main id="primary" class="site-main col-12 col-md-9">

		<?php
//		if ( have_posts() ) :
//
//			if ( is_home() && ! is_front_page() ) :
//				?>
<!--				<header>-->
<!--					<h1 class="page-title screen-reader-text">--><?php //single_post_title(); ?><!--</h1>-->
<!--				</header>-->
<!--				--><?php
//			endif;
//
//			/* Start the Loop */
//			while ( have_posts() ) :
//				the_post();
//
//				/*
//				 * Include the Post-Type-specific template for the content.
//				 * If you want to override this in a child theme, then include a file
//				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
//				 */
//				get_template_part( 'template-parts/content', get_post_type() );
//
//			endwhile;
//
//			the_posts_navigation();
//
//		else :
//
//			get_template_part( 'template-parts/content', 'none' );
//
//		endif;

        $bookPosts = new WP_Query([
            'posts_per_page' => 4,
            'post_type' => 'book',
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1
        ]);
        while($bookPosts->have_posts()):
            $bookPosts->the_post()?>

                <div class="flex-book-container">
                    <p class="thumbnail-img"><?php the_post_thumbnail(); ?></p>

<div>
            <h5 class="book-post"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
            <p><?php if(has_excerpt()) {
                the_excerpt();
                } else {
                    echo wp_trim_words(get_the_content(), 18);
                }

                ?></p>
    <a href="<?php the_permalink();?>"><button class="btn continue-reading">Continue Reading</button></a>
</div>

                </div>

            <?php
            endwhile;
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $bookPosts->max_num_pages
            ) );

            wp_reset_postdata();




            ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
