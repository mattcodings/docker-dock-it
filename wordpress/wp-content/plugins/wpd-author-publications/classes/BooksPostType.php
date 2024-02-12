<?php

namespace WpdAuthorPublications;

/**
 *
 */
class BooksPostType extends Singleton
{
    /**
     *
     */
    const POST_TYPE = 'book';
    /**
     * @var
     */
    protected static $instance;

    /**
     *
     */
    protected function __construct()
    {
        add_action('init', [$this, 'registerBookPostType'], 0);
        add_filter('the_content', [$this, 'bookContentTemplate']);
    }

// Register Custom Post Type

    /**
     * @return void
     */
    public function registerBookPostType()
    {

        $labels = array(
            'name' => _x('Books', 'Post Type General Name', 'wpd-books'),
            'singular_name' => _x('Book', 'Post Type Singular Name', 'wpd-books'),
            'menu_name' => __('Books', 'wpd-books'),
            'name_admin_bar' => __('Book', 'wpd-books'),
            'archives' => __('Book Archives', 'wpd-books'),
            'attributes' => __('Book Attributes', 'wpd-books'),
            'parent_item_colon' => __('Parent Book:', 'wpd-books'),
            'all_items' => __('All Books', 'wpd-books'),
            'add_new_item' => __('Add New Book', 'wpd-books'),
            'add_new' => __('Add New', 'wpd-books'),
            'new_item' => __('New Book', 'wpd-books'),
            'edit_item' => __('Edit Book', 'wpd-books'),
            'update_item' => __('Update Book', 'wpd-books'),
            'view_item' => __('View Book', 'wpd-books'),
            'view_items' => __('View Books', 'wpd-books'),
            'search_items' => __('Search Book', 'wpd-books'),
            'not_found' => __('Not found', 'wpd-books'),
            'not_found_in_trash' => __('Not found in Trash', 'wpd-books'),
            'featured_image' => __('Featured Image', 'wpd-books'),
            'set_featured_image' => __('Set featured image', 'wpd-books'),
            'remove_featured_image' => __('Remove featured image', 'wpd-books'),
            'use_featured_image' => __('Use as featured image', 'wpd-books'),
            'insert_into_item' => __('Insert into book', 'wpd-books'),
            'uploaded_to_this_item' => __('Uploaded to this book', 'wpd-books'),
            'items_list' => __('Books list', 'wpd-books'),
            'items_list_navigation' => __('Books list navigation', 'wpd-books'),
            'filter_items_list' => __('Filter books list', 'wpd-books'),
        );
        $args = array(
            'label' => __('Book', 'wpd-books'),
            'description' => __('Books by George R.R. Martin', 'wpd-books'),
            'labels' => $labels,
            'supports' => array('title', 'author', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-book',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => 'books',
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
            'show_in_rest' => true,
        );
        register_post_type(static::POST_TYPE, $args);

    }

    /**
     * @param $content
     * @return mixed|string
     */
    public function bookContentTemplate($content)
    {
        $post = get_post();
        if ($post->post_type == self::POST_TYPE) {
            $publisher = get_post_meta($post->ID, BookMeta::PUBLISHER, true);
            $publishedDate = get_post_meta($post->ID, BookMeta::PUBLISHED_DATE, true);
            $pageCount = get_post_meta($post->ID, BookMeta::PAGE_COUNT, true);
            $price = get_post_meta($post->ID, BookMeta::PRICE, true);
            $series = get_post_meta($post->ID, BookMeta::SERIES, true);
            $content = "<div class='book-info'><h2 class='single-post-title'>" . get_the_title() . "</h2><div>$content</div></div><div class='custom-fields-container'>
<div class='custom-fields-element'><p>Publisher </p><span>$publisher</span></div>
<div class='custom-fields-element'><p>Published Date </p><span class='publish-date'>$publishedDate</span></div>
<div class='custom-fields-element'><p>Page Count </p><span>$pageCount</span></div>
<div class='custom-fields-element'><p>Price </p><span>$$price</span></div>
<div class='custom-fields-element'><p>Series</p><span>$series</span></div></div>";

            $content .= '<div class="other-books-section"><h3>Other Books in this Series</h3>';
            $query = new \WP_Query([
                'author' => get_the_author(),
                'post_type' => self::POST_TYPE,
                'post__not_in' => [$post->ID],
                'posts_per_page' => 5,
                'meta_query' => [[
                    'key' => 'series',
                    'value' => $series,
                    'compare' => '='
                ]]]);
            if ($query->have_posts()) {
                $content .= '<ul class="other-books-list">';
                while ($query->have_posts()) {
                    $query->the_post();
                    $content .= '<li class="other-book">   <a href="' . get_the_permalink() . '"><div>'. get_the_post_thumbnail(get_the_ID()) .'</div>' . esc_html(get_the_title())  . '</li>';
                }
                $content .= '</ul></div>';
            }
//            else {
//                esc_html_e('Sorry, no posts matched your criteria.');
//            }
// Restore original Post Data.
            wp_reset_postdata();
        }
        return $content;

    }
}