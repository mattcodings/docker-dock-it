<?php

/**
Plugin Name: WPD Author Publications
Description: Displays recent book
Version: 1.0.0
Author: Matthew Zwerlein
Text Domain: wpd-author-publications

 */

namespace MZ;

if( !defined( 'MZ_ABPLUGIN_VER' ) )
    define( 'MZ_ABPLUGIN_VER', '1.0.0' );

// Start up the engine

/*
 * ***** This class is not working. Left it in here to troubleshoot later, as it would be beneficial to use instead of the same shortcode for multiple functions *****
 */
class RecentBook
{

    /**
     * Static property to hold our singleton instance
     *
     */
    private static $instance = false;

    /**
     * This is our constructor
     *
     * @return void
     */
    private function __construct()
    {
        add_shortcode('recent-book', [$this, 'recentBookShortCode']);
    }

    private function __clone()
    {
    }

    /**
     * If an instance exists, this returns it.  If not, it creates one and
     * returns it.
     *
     * @return RecentBook
     */

    public static function getInstance()
    {
        if (!self::$instance)
//            static::$instance = new static();
            self::$instance = new self;
        return self::$instance;
    }

    public function recentBookShortCode($attributes)
    {
        $a = shortcode_atts([

            'order_url' => '',
        ], $attributes);
        $output = '';
        $recentPosts = new \WP_Query([
            'post_type' => 'book',
            'orderby' => 'publishedDate',

            'posts_per_page' => 1,
            'meta_query' => [[
                'key' => 'publishedDate',
            ]]
        ]);
        while ($recentPosts->have_posts()) {
            $recentPosts->the_post();
            $output = $output.'<div id="single-recent-book-container"><a href="'. get_the_permalink() .'"><div class="recent-books-image" id="single-recent-book-image">'. get_the_post_thumbnail() . '</div><div class="order-container"><p class="recent-book-title" id="single-recent-book-title">'.get_the_title().'</p><p class="out-now">Out Now. Order Today</p><a href="' . $a['order_url'] . '" target="_blank"><button class="order-button">Order on Amazon</button></a></div></a></div><br>';


        }

        return $output;
    }
}