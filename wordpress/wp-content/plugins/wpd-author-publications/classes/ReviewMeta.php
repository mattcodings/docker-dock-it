<?php

namespace WpdAuthorPublications;

class ReviewMeta extends Singleton
{
    /**
     *
     */
    const NAME = 'name';
    /**
     *
     */
    const LOCATION = 'location';
    /**
     *
     */
    const RATING = 'rating';
    /**
     *
     */
    const BOOK = 'book';

    /**
     *
     */
    const LINK = 'link';
    /**
     * @var
     */
    protected static $instance;

    /**
     *
     */
    protected function __construct()
    {
        add_action('admin_init', [$this, 'registerMetaBox']);
        add_action('save_post_' . ReviewPostType::POST_TYPE, [$this, 'saveReviews']);
    }

    /**
     * @return void
     */
    public function registerMetaBox()
    {
        add_meta_box('review_reviews_meta',
            'Reviews',
            [$this, 'outputReviews'],
            ReviewPostType::POST_TYPE,
            'normal');
    }

    /**
     * @return void
     */
    public function outputReviews(){
        $post = get_post();
        $name = get_post_meta($post->ID, self::NAME, true);
        $location = get_post_meta($post->ID, self::LOCATION, true);
        $rating = get_post_meta($post->ID, self::RATING, true);
        $book = get_post_meta($post->ID, self::BOOK, true);
        $link = get_post_meta($post->ID, self::LINK, true)
        ?>
<p>
    <label>Name: <input type="text" name="name" value="<?= $name ?>"></label>
</p>
        <p>
            <label>Your Location: <input type="text" name="location" value="<?= $location ?>"></label>
        </p>
<!--        <p>-->
<!--            <label>Name: <input type="text" name="rating" value="--><?php //= $rating ?><!--"></label>-->
<!--        </p>-->
        <p>Rating:
            <select name="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </p>
        <p>Select a Book:
        <select name="book">
            <?php $query = new \WP_Query([
//                'author' => get_the_author('ID'),
                'post_type' => 'book'
            ]);
            while($query->have_posts()){
                $query->the_post();

                ?>

                <option value="<?php the_title() ?>"><?php the_title(); ?></option>
            <?php }
            ?>
                </select>
<!--            //wp_dropdown_pages( array(
//                'name' => 'whatever_page',
//                'show_option_none' => __( '— Select —' ),
//                'option_none_value' => '0',
//                'selected' => get_post('whatever_page'),
//            )); -->
<!--            <label>Name: <select type="text" name="book" ></select></label>-->
        </p>
<?php
    }

    /**
     * @return void
     */
    public function saveReviews(){
        $name = sanitize_text_field($_POST['name']);
        $location = sanitize_text_field($_POST['location']);
        $rating = sanitize_text_field($_POST['rating']);
        $book = sanitize_text_field($_POST['book']);
        $post = get_post();
        update_post_meta($post->ID, self::NAME, $name);
        update_post_meta($post->ID, self::LOCATION, $location);
        update_post_meta($post->ID, self::RATING, $rating);
        update_post_meta($post->ID, self::BOOK, $book);

    }
}