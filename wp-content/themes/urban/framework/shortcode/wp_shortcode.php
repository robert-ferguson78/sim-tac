<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

function top_banner_image($attr, $content = null) {
    extract(shortcode_atts(array(
        'select_block_image' => '',
    ), $attr));

    // Remove leading and trailing <p> and </p> tags
    $content = preg_replace('/^<\/p>/', '', $content);
    $content = preg_replace('/<p>$/', '', $content);

    $output = '';

    $select_block_image = wp_get_attachment_image_src($select_block_image, "Full");
    $output .= '<div class="main_banner"><img src="' . $select_block_image[0] . '" alt=""><div class="container"><div class="content" data-aos="fade-right">' . $content . '</div></div></div>';

    return $output;
}
add_shortcode("top_banner_image", "top_banner_image");
function header_13_shortcode($attr, $content = null) {
    extract(shortcode_atts(array(
        'youtube_video_id' => '',
        'heading' => '',
        'primary_button_text' => '',
        'secondary_button_text' => '',
        'video_quality' => 'hd1080',
        'placeholder_image_id' => '' // New parameter
    ), $attr));

    $unique_id = uniqid('header13Video_');

    $content = preg_replace('/^<\/p>/', '', $content);
    $content = preg_replace('/<p>$/', '', $content);

    $output = '';
    $output .= '<div class="header-13">';
    $output .= '<div class="video-height">';
    $output .= '<div class="video-container">';
    
    // Place placeholder image as direct child of video-container
    if ($placeholder_image_id) {
        $output .= wp_get_attachment_image(
            $placeholder_image_id,
            'full',
            false,
            array(
                'class' => 'placeholder-image',
                'decoding' => 'async'
            )
        );
    }
    
    // YouTube player container as sibling
    $output .= '<div id="' . esc_attr($unique_id) . '" 
        class="youtube-player" 
        data-video-id="' . esc_attr($youtube_video_id) . '" 
        data-quality="' . esc_attr($video_quality) . '">
    </div>';
    
    $output .= '<div class="video-overlay"></div>';
    $output .= '</div></div></div>';

    $output .= '<div class="section site-width multi-column">';
    $output .= '<div class="column">';
    $output .= '<h1 class="medium-length-hero-headline-goes-here headingdesktoph1">' . esc_html($heading) . '</h1>';
    $output .= '</div>';
    $output .= '<div class="column">';
    $output .= '<p class="lorem-ipsum-dolor-si textmediumnormal">' . $content . '</p>';
    $output .= '<div class="actions-2">';
        // Primary button
        if ($primary_button_text) {
            $output .= '<div class="style-secondary-smal-1">';
            $output .= '<div class="button button-4 textregularnormal">' . esc_html($primary_button_text) . '</div>';
            $output .= '</div>';
        }
        // Secondary button
        if ($secondary_button_text) {
            $output .= '<div class="style-link-small-fal">';
            $output .= '<div class="button-1 button-4 textregularnormal">' . esc_html($secondary_button_text) . '</div>';
            $output .= '<img class="icon" src="'.get_template_directory_uri().'/assets/img/icon---chevron-right-1.svg" alt="Icon / chevron-right">';
            $output .= '</div>';
        }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    wp_enqueue_script('youtube-api', 'https://www.youtube.com/iframe_api', array(), null, true);
    wp_enqueue_script('video-handler', get_template_directory_uri() . '/assets/js/video-loader.js', array('youtube-api'), '1.0', true);

    return $output;
}
add_shortcode("header_13", "header_13_shortcode");
function layout_253_shortcode($attr, $content = null) {
    extract(shortcode_atts(array(
        'tagline' => '',
        'heading' => '',
        'primary_button_text' => '',
        'secondary_button_text' => '',
    ), $attr));

    // Separate content for layout_253_item and layout_253_content
    $item_content = '';
    $main_content = '';

    // Extract the content for layout_253_item and layout_253_content
    if (preg_match_all('/\[layout_253_item[^\]]*\](.*?)\[\/layout_253_item\]/s', $content, $matches)) {
        foreach ($matches[0] as $match) {
            $main_content .= do_shortcode($match);
        }
    }

    if (preg_match_all('/\[layout_253_content[^\]]*\](.*?)\[\/layout_253_content\]/s', $content, $matches)) {
        foreach ($matches[0] as $match) {
            $item_content .= do_shortcode($match);
        }
    }

    $output = '';

    $output .= '<div class="layout-253 section">';
    $output .= '<div class="site-width columns">';
    $output .= '<div class="section-title">';
    $output .= '<div class="frame-112">';
    $output .= '<div class="tagline-wrapper"><div class="tagline headingdesktoptagline">' . esc_html($tagline) . '</div></div>';
    $output .= '<div class="content-2 content-8">';
    $output .= '<div class="heading-1 headingdesktoph1">' . esc_html($heading) . '</div>';
    $output .= $item_content; // This will output layout_253_item_shortcode here 
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="actions-2">';
    $output .= '<div class="style-secondary-smal-1 style-secondary-smal-4 reverse">';
    $output .= '<div class="button-1 button-4 textregularnormal">' . esc_html($primary_button_text) . '</div>';
    $output .= '</div>';
    $output .= '<div class="style-link-small-fal">';
    $output .= '<div class="button-1 button-4 textregularnormal">' . esc_html($secondary_button_text) . '</div>';
    $output .= '<img class="icon" src="'.get_template_directory_uri().'/assets/img/icon---chevron-right-1.svg" alt="Icon / chevron-right">';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="content-wrap">';
    $output .= $main_content; // This will output layout_253_content_shortcode here
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode("layout_253", "layout_253_shortcode");

function layout_253_item_shortcode($attr, $content = null) {
    extract(shortcode_atts(array(
        'icon' => '',
        'list_item_heading' => '',
        'item_primary_button_text' => '',
    ), $attr));

    $icon_image = wp_get_attachment_image_src($icon, 'size_400_440');

    // Remove leading and trailing <p> and </p> tags
    $content = preg_replace('/^<\/p>/', '', $content);
    $content = preg_replace('/<p>$/', '', $content);

    $output = '';

    $output .= '<div class="list-item">';
    $output .= '<h3 class="heading headingdesktoph4">' . esc_html($list_item_heading) . '</h3>';
    $output .= '<div class="image-title-wrapper">';
    $output .= '<img class="icon-relume" src="' . $icon_image[0] . '" alt="Icon / Relume">';
    $output .= '</div>';
    $output .= '<p class="text-1 text-7 textregularnormal">' . $content . '</p>';
    $output .= '<div class="style-secondary-smal-1 style-secondary-smal-4"><div class="button-1 button-4 textregularnormal">' . esc_html($item_primary_button_text) . '</div></div>';
    $output .= '</div>';

    return $output;
}
add_shortcode("layout_253_item", "layout_253_item_shortcode");

function layout_253_content_shortcode($attr, $content = null) {
    // Remove leading and trailing <p> and </p> tags
    $content = preg_replace('/^<\/p>/', '', $content);
    $content = preg_replace('/<p>$/', '', $content);

    $output = '';

    $output .= '<div class="text text-7 textmediumnormal">' . $content . '</div>';

    return $output;
}
add_shortcode("layout_253_content", "layout_253_content_shortcode");

function text_image_video_listing_block($attr, $content = null) {
    extract(shortcode_atts(array(), $attr));
    ob_start();
    ?>
    <div class="text-image-video-listing-block section site-width">
        <div class="container">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    add_action('wp_footer', 'load_video_modal_once');
    return ob_get_clean();
}

function text_image_video_listing_content($attr, $content = null) {
    return '<div class="section-title-1">
        <div class="heading-3 headingdesktoph1">Game Highlights</div>
        ' . wpautop($content) . '
    </div>';
}

function text_image_video_listing_item($attr) {
    extract(shortcode_atts(array(
        'select_image' => '',
        'youtube_id' => '',
    ), $attr));

    $image_id = $select_image;
    $image = wp_get_attachment_image_src($image_id, "Full");
    $image_srcset = wp_get_attachment_image_srcset($image_id);
    $image_sizes = wp_get_attachment_image_sizes($image_id, 'full');

    ob_start();
    ?>
    <div class="content-6 content-8">
        <div class="video-trigger placeholder-image-1" data-video-id="<?php echo esc_attr($youtube_id); ?>">
            <img src="<?php echo $image[0]; ?>"
                srcset="<?php echo esc_attr($image_srcset); ?>"
                sizes="<?php echo esc_attr($image_sizes); ?>"
                alt="">
            <div class="play-button">
                <svg class="video-play-icon" width="100%" height="100%" viewBox="0 0 576 512">
                    <path d="M549.7,124.1C543.4,100.4 524.9,81.8 501.4,75.5C458.8,64 288,64 288,64C288,64 117.2,64 74.6,75.5C51.1,81.8 32.6,100.4 26.3,124.1C14.9,167 14.9,256.4 14.9,256.4C14.9,256.4 14.9,345.8 26.3,388.7C32.6,412.4 51.1,430.2 74.6,436.5C117.2,448 288,448 288,448C288,448 458.8,448 501.4,436.5C524.9,430.2 543.4,412.3 549.7,388.7C561.1,345.8 561.1,256.4 561.1,256.4C561.1,256.4 561.1,167 549.7,124.1ZM232.2,337.6L232.2,175.2L374.9,256.4L232.2,337.6Z"/>
                </svg>
            </div>
        </div>
        <div class="column">
            <div class="row row-3">
                <div class="video-trigger placeholder-image" data-video-id="<?php echo esc_attr($youtube_id); ?>">
                    <img src="<?php echo $image[0]; ?>" alt="">
                    <div class="play-button">
                        <svg class="video-play-icon" width="100%" height="100%" viewBox="0 0 576 512">
                            <path d="M549.7,124.1C543.4,100.4 524.9,81.8 501.4,75.5C458.8,64 288,64 288,64C288,64 117.2,64 74.6,75.5C51.1,81.8 32.6,100.4 26.3,124.1C14.9,167 14.9,256.4 14.9,256.4C14.9,256.4 14.9,345.8 26.3,388.7C32.6,412.4 51.1,430.2 74.6,436.5C117.2,448 288,448 288,448C288,448 458.8,448 501.4,436.5C524.9,430.2 543.4,412.3 549.7,388.7C561.1,345.8 561.1,256.4 561.1,256.4C561.1,256.4 561.1,167 549.7,124.1ZM232.2,337.6L232.2,175.2L374.9,256.4L232.2,337.6Z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="row-1 row-3">
                <div class="video-trigger placeholder-image" data-video-id="<?php echo esc_attr($youtube_id); ?>">
                    <img src="<?php echo $image[0]; ?>" alt="">
                    <div class="play-button">
                        <svg class="video-play-icon" width="100%" height="100%" viewBox="0 0 576 512">
                            <path d="M549.7,124.1C543.4,100.4 524.9,81.8 501.4,75.5C458.8,64 288,64 288,64C288,64 117.2,64 74.6,75.5C51.1,81.8 32.6,100.4 26.3,124.1C14.9,167 14.9,256.4 14.9,256.4C14.9,256.4 14.9,345.8 26.3,388.7C32.6,412.4 51.1,430.2 74.6,436.5C117.2,448 288,448 288,448C288,448 458.8,448 501.4,436.5C524.9,430.2 543.4,412.3 549.7,388.7C561.1,345.8 561.1,256.4 561.1,256.4C561.1,256.4 561.1,167 549.7,124.1ZM232.2,337.6L232.2,175.2L374.9,256.4L232.2,337.6Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// new shortcode

function gallery_block($attr, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
    ), $attr));

    ob_start();
    ?>
    <div class="gallery-block section">
        <h2 class="heading-1 headingdesktoph1 text-center"><?php echo esc_html($title); ?></h2>
        <?php
        // Ensure the child shortcodes render here
        $rendered_content = do_shortcode($content);

        // Separate the description block and the gallery images dynamically
        if (strpos($rendered_content, 'gallery-description') !== false) {
            // Extract the gallery description if it exists
            preg_match('/<div class="gallery-description">(.*?)<\/div>/s', $rendered_content, $matches);
            if (!empty($matches)) {
                echo $matches[0]; // Render the gallery description
            }
        }
        ?>
        <div class="gallery-content">
            <?php
            // Render the rest of the gallery images
            echo preg_replace('/<div class="gallery-description">(.*?)<\/div>/s', '', $rendered_content);
            ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('gallery_block', 'gallery_block');

function content_block($attr, $content = null) {
    return '<div class="gallery-description">' . wpautop($content) . '</div>';
}
add_shortcode('content_block', 'content_block');

function gallery_image($attr) {
    extract(shortcode_atts(array(
        'image' => '',
    ), $attr));

    // Get the counter to determine if this is the first image
    $is_first_image = !isset($GLOBALS['gallery_item_counter']);

    // Determine the size for the first image and others
    $size = $is_first_image ? 'full' : 'medium'; // First image uses 'large', others use 'medium'
    
    // Get image attributes
    $img_src = wp_get_attachment_image_src($image, $size);
    $img_srcset = wp_get_attachment_image_srcset($image, $size);
    $img_sizes = wp_get_attachment_image_sizes($image, $size);

    ob_start();
    ?>
    <div class="gallery-item<?php echo $is_first_image ? ' first-image' : ''; ?>">
        <img 
            src="<?php echo esc_url($img_src[0]); ?>" 
            srcset="<?php echo esc_attr($img_srcset); ?>" 
            sizes="<?php echo esc_attr($img_sizes); ?>" 
            alt="Gallery Image" />
    </div>
    <?php

    // Increment the global counter
    if (!isset($GLOBALS['gallery_item_counter'])) {
        $GLOBALS['gallery_item_counter'] = 1;
    } else {
        $GLOBALS['gallery_item_counter']++;
    }

    return ob_get_clean();
}
add_shortcode('gallery_image', 'gallery_image');