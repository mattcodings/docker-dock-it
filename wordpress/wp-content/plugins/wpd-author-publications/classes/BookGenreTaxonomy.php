<?php

namespace WpdAuthorPublications;

/**
 *
 */
class BookGenreTaxonomy extends Singleton
{
    /**
     *
     */
    const TAXONOMY = 'book_genre';
    //    redefine so each singleton has its own instance
    /**
     * @var
     */
    protected static $instance;
    protected function __construct(){
        add_action( 'init', [$this, 'registerTaxonomy'], 0 );
    }
// Register Custom Taxonomy
    function registerTaxonomy() {

        $labels = array(
            'name'                       => _x( 'Book Genres', 'Taxonomy General Name', 'wpd-books' ),
            'singular_name'              => _x( 'Book Genre', 'Taxonomy Singular Name', 'wpd-books' ),
            'menu_name'                  => __( 'Book Genres', 'wpd-books' ),
            'all_items'                  => __( 'All Genres', 'wpd-books' ),
            'parent_item'                => __( 'Parent Genre', 'wpd-books' ),
            'parent_item_colon'          => __( 'Parent Genre:', 'wpd-books' ),
            'new_item_name'              => __( 'New Genre Name', 'wpd-books' ),
            'add_new_item'               => __( 'Add New Genre', 'wpd-books' ),
            'edit_item'                  => __( 'Edit Genre', 'wpd-books' ),
            'update_item'                => __( 'Update Genre', 'wpd-books' ),
            'view_item'                  => __( 'View Genre', 'wpd-books' ),
            'separate_items_with_commas' => __( 'Separate genres with commas', 'wpd-books' ),
            'add_or_remove_items'        => __( 'Add or remove genres', 'wpd-books' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'wpd-books' ),
            'popular_items'              => __( 'Popular Genres', 'wpd-books' ),
            'search_items'               => __( 'Search Genres', 'wpd-books' ),
            'not_found'                  => __( 'Not Found', 'wpd-books' ),
            'no_terms'                   => __( 'No genres', 'wpd-books' ),
            'items_list'                 => __( 'Genres list', 'wpd-books' ),
            'items_list_navigation'      => __( 'Genres list navigation', 'wpd-books' ),
        );
//        $capabilities = array(
//            'manage_terms'               => 'manage_genres',
//            'edit_terms'                 => 'manage_genres',
//            'delete_terms'               => 'manage_genres',
//            'assign_terms'               => 'edit_posts',
//        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
//            'capabilities'               => $capabilities,
            'show_in_rest'               => true,
        );
        register_taxonomy( static::TAXONOMY, array( BooksPostType::POST_TYPE ), $args );

    }

}