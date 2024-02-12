<?php

namespace WpdAuthorPublications;

class ReviewPostType extends Singleton
{
    /**
     *
     */
    const POST_TYPE = 'review';

    /**
     *
     */
    public function __construct()
    {
        add_action( 'init', [$this, 'registerReviewPostType'], 0 );
        add_filter('the_content', [$this, 'reviewContentTemplate']);
    }

    // Register Custom Post Type

    /**
     * @return void
     */
    public function registerReviewPostType() {

        $labels = array(
            'name'                  => _x( 'Reviews', 'Post Type General Name', 'wpd-reviews' ),
            'singular_name'         => _x( 'Review', 'Post Type Singular Name', 'wpd-reviews' ),
            'menu_name'             => __( 'Reviews', 'wpd-reviews' ),
            'name_admin_bar'        => __( 'Review', 'wpd-reviews' ),
            'archives'              => __( 'Review Archives', 'wpd-reviews' ),
            'attributes'            => __( 'Review Attributes', 'wpd-reviews' ),
            'parent_item_colon'     => __( 'Parent Review:', 'wpd-reviews' ),
            'all_items'             => __( 'All Reviews', 'wpd-reviews' ),
            'add_new_item'          => __( 'Add New Review', 'wpd-reviews' ),
            'add_new'               => __( 'Add New', 'wpd-reviews' ),
            'new_item'              => __( 'New Review', 'wpd-reviews' ),
            'edit_item'             => __( 'Edit Review', 'wpd-reviews' ),
            'update_item'           => __( 'Update Review', 'wpd-reviews' ),
            'view_item'             => __( 'View Review', 'wpd-reviews' ),
            'view_items'            => __( 'View Reviews', 'wpd-reviews' ),
            'search_items'          => __( 'Search Review', 'wpd-reviews' ),
            'not_found'             => __( 'Not found', 'wpd-reviews' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'wpd-reviews' ),
            'featured_image'        => __( 'Featured Image', 'wpd-reviews' ),
            'set_featured_image'    => __( 'Set featured image', 'wpd-reviews' ),
            'remove_featured_image' => __( 'Remove featured image', 'wpd-reviews' ),
            'use_featured_image'    => __( 'Use as featured image', 'wpd-reviews' ),
            'insert_into_item'      => __( 'Insert into Review', 'wpd-reviews' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Review', 'wpd-reviews' ),
            'items_list'            => __( 'Reviews list', 'wpd-reviews' ),
            'items_list_navigation' => __( 'Reviews list navigation', 'wpd-reviews' ),
            'filter_items_list'     => __( 'Filter Reviews list', 'wpd-reviews' ),
        );
        $args = array(
            'label'                 => __( 'Review', 'wpd-reviews' ),
            'description'           => __( 'Book Reviews', 'wpd-reviews' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor' ),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-star-filled',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'reviews',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'review', $args );

    }

    /**
     * @param $content
     * @return mixed|string
     */
    public function reviewContentTemplate($content){
        $post = get_post();
        if ($post->post_type == self::POST_TYPE) {
            $name = get_post_meta($post->ID, ReviewMeta::NAME, true);
            $location = get_post_meta($post->ID, ReviewMeta::LOCATION, true);
            $rating = get_post_meta($post->ID, ReviewMeta::RATING, true);
            $book = get_post_meta($post->ID, ReviewMeta::BOOK, true);

            $content = "<h3 class='border-bottom'>Description</h3><div>$content</div><h3>Fields</h3><p>Name: $name</p>
<p>Location: $location</p>
<p>Rating: $rating</p>
<p>Book:" . get_permalink($post->ID) . "$book</p>";


        }
        return $content;
    }

}