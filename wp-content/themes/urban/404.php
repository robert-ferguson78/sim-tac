<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage niacet
 * @since 2024
 */

get_header(); 
?>
<main id="post-<?php the_ID(); ?>" class="site-main" role="main">
<div class="page-featured-img" style="background-image:url('<?php  echo site_url( ) ?>/wp-content/uploads/2021/01/smilelines.jpg')">
        <div class="container">
            <h3>Page Not Found</h3>
        </div>
    </div>
	<div class="container" style="padding: 30px 15px 180px">
    <h2>Sorry, this page has moved or no longer exists.</h2>
    <p>Please select another page from the top menu or <a href="/contact/">contact us</a> if the problem persists</p>

	</div>

</main>

<?php get_footer(); ?>

