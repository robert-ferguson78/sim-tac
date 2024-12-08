<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if ( ! function_exists( 'urban_setup' ) ) :

function urban_setup() {
	
	load_theme_textdomain( 'urban', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_image_size('size_185_185',185,185, true);
	add_image_size('size_300_300',300,300, true);
	add_image_size('size_400_440',400,400, true);
	add_image_size('size_600_600',600,600, true);
	add_image_size( 'portfolio-thumb', 500, 9999 );
    
	register_nav_menus( array(
		'primary' => __( 'Primary Menu','urban' ),
		'footer' => __( 'Footer Menu','urban' ),
		'top' => __( 'top Menu','urban' ),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );
	
	//add_theme_support( 'woocommerce' );
	//add_theme_support( 'wc-product-gallery-zoom' );
	//add_theme_support( 'wc-product-gallery-lightbox' );
    //add_theme_support( 'wc-product-gallery-slider' );


}
endif;
add_action( 'after_setup_theme', 'urban_setup' );

function urban_init() {
	register_sidebar( array(
		'name'          => __( 'sidebar', 'urban' ),
		'id'            => 'footer-menu-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'urban' ),
		'before_widget' => '<aside id="%1$s" class="footer-nav-list footer-rhs widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widgetheading">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Imported Text', 'urban' ),
		'id'            => 'footer-menu-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'urban' ),
		'before_widget' => '<p class="textet_long" id="%1$s" class="footer-nav-list footer-rhs widget %2$s">',
		'after_widget'  => '</p>',
		'before_title'  => '<p class="textet">',
		'after_title'   => '</p>',
	) );
	
}
add_action( 'widgets_init', 'urban_init' );

/*if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}*/

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');