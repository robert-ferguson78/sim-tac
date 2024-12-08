<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage urban
 * @since urban 2024
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header();
$id = get_the_ID();
$thumb = get_the_post_thumbnail_url($id);
$short_desc = get_the_excerpt($id);
$title = get_the_title($id);
?>

<?php while (have_posts()) : the_post();

 echo do_shortcode(the_content());

 endwhile; ?>
 
 <?php 
get_footer();
?>

