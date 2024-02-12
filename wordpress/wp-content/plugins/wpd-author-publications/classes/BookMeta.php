<?php

namespace WpdAuthorPublications;

class BookMeta extends Singleton
{

    /**
     *
     */
    const PUBLISHER = 'publisher';
    /**
     *
     */
    const PUBLISHED_DATE = 'publishedDate';
    /**
     *
     */
    const PAGE_COUNT = 'pageCount';
    /**
     *
     */
    const PRICE = 'price';
    /**
     *
     */
    const SERIES = 'series';

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
        add_action('save_post_' . BooksPostType::POST_TYPE, [$this, 'saveFields']);
    }

    /**
     * @return void
     */
    public function registerMetaBox()
    {
        add_meta_box('book_fields_meta',
            'Fields',
            [$this, 'outputFields'],
            BooksPostType::POST_TYPE,
            'normal');
    }

    /**
     * @return void
     */
    public function outputFields()
    {
        $post = get_post();
        $publisher = get_post_meta($post->ID, self::PUBLISHER, true);
        $publishedDate = get_post_meta($post->ID, self::PUBLISHED_DATE, true);
        $pageCount = get_post_meta($post->ID, self::PAGE_COUNT, true);
        $price = get_post_meta($post->ID, self::PRICE, true);
        $series = get_post_meta($post->ID, self::SERIES, true);
        ?>
        <p>
            <label>Publisher: <input type="text" name="publisher" value="<?= $publisher ?>"></label>
        </p>
        <p>
            <label>Published Date: <input type="date" name="publishedDate" value="<?= $publishedDate ?>"></label>
        </p>
        <p>
            <label>Page Count: <input type="text" name="pageCount" value="<?= $pageCount ?>"></label>
        </p>
        <p>
            <label>Price: <input type="text" name="price" value="<?= $price ?>"></label>
        </p>
        <p>
            <label>Series: <input type="text" name="series" value="<?= $series ?>"></label>
        </p>
        <p>

        </p>
<?php
    }

    /**
     * @return void
     */
    public function saveFields()
    {
        $publisher = sanitize_text_field($_POST['publisher']);
        $publishedDate = sanitize_text_field($_POST['publishedDate']);
        $pageCount = sanitize_text_field($_POST['pageCount']);
        $price = sanitize_text_field($_POST['price']);
        $series = sanitize_text_field($_POST['series']);
        $post = get_post();
        update_post_meta($post->ID, self::PUBLISHER, $publisher);
        update_post_meta($post->ID, self::PUBLISHED_DATE, $publishedDate);
        update_post_meta($post->ID, self::PAGE_COUNT, $pageCount);
        update_post_meta($post->ID, self::PRICE, $price);
        update_post_meta($post->ID, self::SERIES, $series);
    }
}