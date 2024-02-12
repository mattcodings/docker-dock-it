<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My_First_Theme
 */

?>
</div> <!-- end .row -->
<footer id="colophon" class="site-footer container">
    <div class="subscribe-with-email"><p>Keep up to date with new book releases</p><div class="subscribe-input"><input type="text" placeholder="Your Email"/><button>Subscribe</button></div></div>
		<div class="row">
            <div class="col">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>
        </div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
