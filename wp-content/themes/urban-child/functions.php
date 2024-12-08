<?php 
function apptek_child_enqueue_styles() {
	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'apptek_child_enqueue_styles' );

function get_url_as_class() {
    $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $url_path = str_replace('/', '-', $url_path);
    return $url_path ? $url_path : '';
}
