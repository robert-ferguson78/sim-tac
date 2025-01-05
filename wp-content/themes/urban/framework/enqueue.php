<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

function optimize_jquery() {
    if (!is_admin()) {
        global $post;

        wp_deregister_script('wp-embed');

        wp_register_style('mainstyle', get_template_directory_uri() . '/style.css','','6.0.3');
        wp_enqueue_style('mainstyle');

        wp_register_script('jquerymain','https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js', false, '', true);
        wp_enqueue_script('jquerymain');

        wp_register_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), null, true);
        wp_enqueue_script('gsap');
        
        wp_register_script('gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), null, true);
        wp_enqueue_script('gsap-scroll-trigger');

        wp_register_script('customjs', get_template_directory_uri() . '/assets/js/main.js', array('gsap', 'gsap-scroll-trigger'), '6.0.3', true);
        wp_enqueue_script('customjs');
    }
}
add_action('wp_enqueue_scripts', 'optimize_jquery');

?>
