<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
require_once get_template_directory().'/framework/theme_core.php'; 
require_once get_template_directory().'/framework/enqueue.php';
require_once get_template_directory().'/framework/shortcode/wp_shortcode.php';
require_once get_template_directory().'/framework/shortcode/vc_shortcode.php';
require_once get_template_directory().'/framework/cleanup.php'; 
require_once get_template_directory().'/framework/translation/translation.php'; 
require_once get_template_directory().'/framework/disable-emoji.php';
?>