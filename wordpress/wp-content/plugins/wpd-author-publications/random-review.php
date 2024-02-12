<?php

/**
Plugin Name: WPD Author Publications
Description: Displays a random review
Version: 1.0.0
Author: Matthew Zwerlein
Text Domain: wpd-author-publications

*/

namespace MZ;

if( !defined( 'MZ_ABPLUGIN_VER' ) )
    define( 'MZ_ABPLUGIN_VER', '1.0.0' );

// Start up the engine
class WpdAuthorPublications
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
add_shortcode('wpd-author-publications', [$this, 'reviewShortCode']);
    }

    private function __clone(){}

    /**
     * If an instance exists, this returns it.  If not, it creates one and
     * returns it.
     *
     * @return WpdAuthorPublications
     */

    public static function getInstance()
    {
        if (!self::$instance)
//            static::$instance = new static();
            self::$instance = new self;
        return self::$instance;
    }
    public function reviewShortCode($attributes){

$reviewPosts = new \WP_Query([
    'post_type' => 'review',
    'orderby' => 'rand',
    'posts_per_page' => '1'
]);
while($reviewPosts->have_posts()){
$reviewPosts->the_post();

?>
<h5 class="book-post"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>

<?php
}
    }
}

WpdAuthorPublications::getInstance();