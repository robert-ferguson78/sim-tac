<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage urban
 * @since urban
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
get_header();
// Start the loop.
    while (have_posts()) : the_post();
        echo do_shortcode(the_content());
    endwhile;
    ?>
<?php get_footer(); ?>
