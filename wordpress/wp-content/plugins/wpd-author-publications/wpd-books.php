<?php
/**
 * Author Publications Plugin
 *
 * @wordpress-plugin
 * Plugin Name: Author Publications Plugin
 * Description: Displays the author's publications
 * Version: 1.0.0
 * Author: Matthew Zwerlein
 * Text Domain: wpd-author-publications
 */

namespace WpdAuthorPublications;

use MZ\RandomReview;
use MZ\RecentBook;
use MZ\RecentBooks;

const TEXT_DOMAIN = 'wpd-books';

require_once __DIR__ . '/classes/Singleton.php';
require_once __DIR__ . '/classes/BooksPostType.php';
require_once __DIR__ . '/classes/BookGenreTaxonomy.php';
require_once __DIR__ . '/classes/BookMeta.php';
require_once __DIR__ . '/classes/ReviewPostType.php';
require_once __DIR__ . '/classes/ReviewMeta.php';
require_once __DIR__ . '/classes/RecentBook.php';
require_once __DIR__ . '/classes/RecentBooks.php';
require_once __DIR__ . '/classes/RandomReview.php';


BooksPostType::getInstance();
BookGenreTaxonomy::getInstance();
BookMeta::getInstance();
ReviewPostType::getInstance();
ReviewMeta::getInstance();
RecentBook::getInstance();
RecentBooks::getInstance();
RandomReview::getInstance();


function activate_plugin(){
    BooksPostType::getInstance()->registerBookPostType();
    BookGenreTaxonomy::getInstance()->registerTaxonomy();

    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'WpdAuthorPublications\activate_plugin');

function deactivate_plugin(){
    unregister_post_type('book');

    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'WpdAuthorPublications\deactivate_plugin');