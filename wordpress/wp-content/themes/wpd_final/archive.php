<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My_First_Theme
 */

get_header();
?>

	<main id="primary" class="site-main col-12 col-md-9">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
                ?>
                <div class="filter-container">

                <div>
                    <form method="GET">
                        <select class="dropdown-filter" name="order-books" id="order-books">
                            <option value="title">Alphabetical</option>
                            <option value="date">Newest to Oldest</option>
                            <option value="series">Series</option>
                        </select>
                        <button class="filter-button" type="submit">Filter</button>
                    </form>
                </div>

                <?php
				the_archive_description( '<div class="archive-description">', '</div></div>' );
				?>

			</header><!-- .page-header -->

        <div class="flex-book-container">

			<?php
            $bookPosts = new \WP_Query([
                'post_type'=>'book',
                'orderby' => 'title',
                'order' => 'ASC',
                'paged' => get_query_var('paged')

            ]);



            $select_order = isset($_GET['order-books']) ? sanitize_text_field($_GET['order-books']) : "";
            if(!empty($select_order) && "title" == $select_order):
                $bookPosts = new \WP_Query([
                    'post_type'=>'book',
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'paged' => get_query_var('paged')

                ]);
            endif;
            if(!empty($select_order) && "date" == $select_order):
                $bookPosts = new \WP_Query([
                    'post_type'=>'book',
                    'orderby' => 'publishedDate',

                    'paged' => get_query_var('paged')

                ]);
            endif;
            if(!empty($select_order) && "series" == $select_order):
                $bookPosts = new \WP_Query([
                    'post_type'=>'book',
                    'orderby' => 'series',
                    'order' => 'ASC',
                    'paged' => get_query_var('paged')

                ]);
            endif;

			/* Start the Loop */
			while ( $bookPosts->have_posts() ) :
				$bookPosts->the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */

                ?> <a href="<?php the_permalink();?>"><?php get_template_part( 'template-parts/post-card', get_post_type() );  ?></a> <?php

            endwhile;
            wp_reset_query();
            ?>
            </div>
            <?php

			the_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;


		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
