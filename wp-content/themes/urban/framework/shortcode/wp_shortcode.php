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

function card_block_page($attr)
{

   extract(shortcode_atts(array(

        'add_title' => '',
        'single_card_description' => '',
        'add_card_title' => '',
		'add_card_description' =>'',
        'add_card_image' =>'',
        'add_card_links' =>'',

    ), $attr,'box_repeater_items_column'));

   $items_colum_info = vc_param_group_parse_atts($attr['box_repeater_items_column']);

    $output='';
    $output.='<div class="cards">
    <div class="heaidng_dd" data-aos="fade-up">
        <div class="container">
            <h2 class="">
                '.$add_title.'
            </h2>
            <p>
                '.$single_card_description.'
            </p>
        </div>
    </div>';
   $output.='<div class="container">
   <div class="cardslist">';
    foreach ($items_colum_info as  $item_inp) 
    {

    	 
    	 $add_product_title = $item_inp['add_card_title'];
    	 $add_product_description = $item_inp['add_card_description'];
		 $add_product_links = @vc_build_link($item_inp['add_card_links']);
         $add_product_image = wp_get_attachment_image_src($item_inp['add_card_image'], "full");
       
         $output.='<div class="carditem" data-aos="fade-up">
         <div class="cardinner">
             <figure>
                 <img src="'.$add_product_image[0].'" alt="">
             </figure>
             <div class="content">
                 <h3>
                     '.$add_product_title.'
                 </h3>
                 '.$add_product_description.'
                
                 <a href="'.$add_product_links['url'].'" class="btn">'.$add_product_links['title'].'</a>
             </div>
         </div>
     </div>';

    }
    $output.='</div></div>';
    $output.='</div>';

    return $output;

}
add_shortcode("card_block_page","card_block_page");

function help_block_page($attr)
{

   extract(shortcode_atts(array(

        'help_add_title' => '',
        'single_help_description' => '',
        'add_help_title' => '',
		'add_help_description' =>'',
        'add_help_image' =>'',

    ), $attr,'box_repeater_items_column_help'));

   $items_colum_info = vc_param_group_parse_atts($attr['box_repeater_items_column_help']);

    $output='';
    $output.='<div class="icon_cards">
    <div class="heaidng_dd" data-aos="fade-up">
        <div class="container">
            <h2>
                '.$help_add_title.'
            </h2>
            <p>
              '.$single_help_description.'
            </p>
        </div>
    </div>';
   $output.='<div class="container">
   <h4 class="" data-aos="fade-up">
       urban helps:
   </h4>
   <div class="icon_cards_inner">';
    foreach ($items_colum_info as  $item_inp) 
    {

    	 
    	 $add_help_title = $item_inp['add_help_title'];
    	 $add_card_description = $item_inp['add_help_description'];
         $add_help_image = wp_get_attachment_image_src($item_inp['add_help_image'], "full");
       
         $output.='<div class="icon_card_item" data-aos="fade-up">
         <figure>
             <img src="'.$add_help_image[0].'" alt="">
         </figure>
         <h3>
            '.$add_help_title.'
         </h3>
         <p>
             '.$add_card_description.'
         </p>
     </div>';

    }
    $output.='</div>
    </div>';
    $output.='</div>';

    return $output;

}
add_shortcode("help_block_page","help_block_page");


function video_block($attr, $content = null)
{

   extract(shortcode_atts(array(

	'select_vidoe_thumb' =>'',


    ), $attr));

    $output='';

    $select_block_image = wp_get_attachment_image_src($select_vidoe_thumb, "Full");



    $output.='<div class="vid_blk" >
    <div class="block_cover">
        <img src="'.get_template_directory_uri().'/assets/img/block_cover.svg" alt="">
        <div class="container">
            <div class="vid_inner fade-in-up">
                <div class="video-container">
                    <div class="js-video ng-isolate-scope">
                        <div class="video-poster" style="background: url('.$select_block_image[0].');">
                        </div>
                        <div class="play">
                            <img src="'.get_template_directory_uri().'/assets/img/vid_btn.svg" alt="">
                        </div>
                        <div class="js-video" style="display: none;">
                            ' . do_shortcode($content) . '
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

    return $output;

}
add_shortcode("video_block","video_block");


function cta_block($attr, $content = null)
{

   extract(shortcode_atts(array(

	'select_cta_image' =>'',
    'image_left' =>'',
    'is_background_white' =>'',
    ), $attr));

    $output='';

    $select_block_image = wp_get_attachment_image_src($select_cta_image, "Full");
    
    if($image_left == 'left')
    {
        $imagleft="right";
    }else{
        $imagleft="";
    }
    
    if($is_background_white == 'yes')
    {
        $white_bg="contactus_ right";
    }else{
        $white_bg="img_with_content";
    }

    $output.='<div class=" '.$white_bg.' '.$imagleft.'">';
    if($is_background_white == 'yes'){
          $output.='<div class="container">
          <figure>
              <img src="'.$select_block_image[0].'" alt="">
          </figure>
          <div class="content">
              '.$content.'
          </div>
      </div>';
    }else{
        $output.='<img src="'.$select_block_image[0].'" alt="">
    <div class="container">
        <div class="content">
            <div class="content_inner">
               '.$content.' 
            </div>
        </div>
    </div>'; 
    }
    
    $output.='</div>';

    return $output;

}
add_shortcode("cta_block","cta_block");

function contact_us_block($attr, $content = null)
{

   extract(shortcode_atts(array(
	'select_contact_us_image' =>'',
    'is_background' =>'',
    'select_block_design' =>'',
    ), $attr));

    $output='';

    $select_block_image = wp_get_attachment_image_src($select_contact_us_image, "Full");
    
    if($is_background == 'yes'){

        $isbg="bg_Color";

    }else{
        $isbg="";
    }
     
    
    
    if($select_block_design == 'big image Left')
    {

        $output.='<div class="contactus_fullimg right">
        <img src="'.$select_block_image[0].'" alt="">
        <div class="container">
            <div class="content">
                <div class="content_inner">
                    '.$content.'
                </div>
            </div>
        </div>
    </div>';
    }
    else if($select_block_design == 'big image right')
    {
        $output.='<div class="contactus_fullimg ">
        <img src="'.$select_block_image[0].'" alt="">
        <div class="container">
            <div class="content">
                <div class="content_inner">
                '.$content.'
                </div>
            </div>
        </div>
    </div>';
           
    }
    
    else{

                $output.='<div class="contactus_ '.$isbg.'">
                <div class="container">
                    <figure>
                        <img src="'.$select_block_image[0].'" alt="">
                    </figure>
                    <div class="content">
                    '.$content.'
                    </div>
                </div>
            </div>';
    }

    return $output;

}
add_shortcode("contact_us_block","contact_us_block");


function image_wit_text($attr, $content = null)
{

   extract(shortcode_atts(array(
	'select_with_image' =>'',
    'image_right' =>'',
    ), $attr));

    $output='';
    
    $select_block_image = wp_get_attachment_image_src($select_with_image, "Full");

    if($image_right == 'right'){
       $imag_rig="right";
    }else{
        $imag_rig="";
    }

    $output.='<div class="imgtext_section '.$imag_rig.'">
    <div class="container">
        <div class="imgtext_section_inner">
            <div class="image_di">
                <img src="'.$select_block_image[0].'" alt="">
            </div>
            <div class="content">
               '.$content.'
            </div>
        </div>
    </div>
</div>';

    return $output;

}
add_shortcode("image_wit_text","image_wit_text");


function text_heading_banner($attr, $content = null)
{

   extract(shortcode_atts(array(
	'add_text_banner_heading' =>'',
    ), $attr));

    $output='';
    
    $output.='<div class="banner_text">
                <div class="container">
                   '.$add_text_banner_heading.'
                </div>
            </div>';
   
    return $output;

}
add_shortcode("text_heading_banner","text_heading_banner");

function faq_accordion_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
      'el_class' => ''
    ), $atts));
  
    $output = '<div class="faq-accordion ' . esc_attr($el_class) . '">';
    $output .= do_shortcode($content);
    $output .= '</div>';
  
    return $output;
  }
  add_shortcode('faq_accordion', 'faq_accordion_shortcode');
  
  function faq_item_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
      'question' => ''
    ), $atts));
  
    $output = '<div class="faq-item">';
    $output .= '<div class="faq-question">' . esc_html($question) . '</div>';
    $output .= '<div class="faq-answer">' . wpautop(do_shortcode($content)) . '</div>';
    $output .= '</div>';
  
    return $output;
  }
  add_shortcode('faq_item', 'faq_item_shortcode');

  // Parent Shortcode
function navigation_block_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'el_class' => '',
    ), $atts));

    $output = '<div class="navigation-block ' . esc_attr($el_class) . '"><div class="container">';
    $output .= '<h2>' . esc_html($title) . '</h2>';
    $output .= '<div class="navigation-links">' . do_shortcode($content) . '</div>';
    $output .= '</div></div>';

    return $output;
}
add_shortcode('navigation_block', 'navigation_block_shortcode');

// Child Shortcode
function navigation_link_shortcode($atts) {
    extract(shortcode_atts(array(
        'text' => '',
        'url' => '',
        'class_name' => '',
    ), $atts));

    $output = '<a href="' . esc_url($url) . '" class="'. esc_html($class_name
    ) .'">' . esc_html($text) . '</a><span class="seperator"></span>';

    return $output;
}
add_shortcode('navigation_link', 'navigation_link_shortcode');

// Flag to check if the slick assets are already enqueued
function enqueue_slick_slider_assets() {
    // Register and enqueue the Slick Slider CSS and JS files
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.8.1', 'all');
    wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), '1.8.1', 'all');
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.8.1', true);

    // Add inline script to initialize the Slick slider
    wp_add_inline_script('slick-js', "
        jQuery(document).ready(function($) {
            if ($('.slick-slider-container').length) {
                $('.slick-slider-container').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 10000,
                    adaptiveHeight: false,
                });
            }
        });
    ");
}

function load_slick_once() {
    static $is_slick_loaded = false; // Flag to ensure it's only loaded once
    if (!$is_slick_loaded) {
        $is_slick_loaded = true;
        enqueue_slick_slider_assets();
    }
}

// Parent Shortcode (Slider Block)
function slider_block_shortcode($atts, $content = null) {
    // Ensure that Slick Slider is loaded only once
    load_slick_once();

    extract(shortcode_atts(array(
        'slider_title' => '',
        'el_class' => '',
    ), $atts));

    $output = '<div class="slider-block ' . esc_attr($el_class) . '">';
    $output .= '<div class="slick-slider-container">'; // Initialize Slick Slider container
    $output .= do_shortcode($content); // Render the child shortcodes (slides)
    $output .= '</div></div>';

    return $output;
}
add_shortcode('slider_block', 'slider_block_shortcode');

// Child Shortcode (Slider Item)
function slider_item_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'bg_image' => '',
        'title' => '',
        'subtitle' => '',
        'cta_button' => '',
        'show_overlay' => '',
    ), $atts));

    // Get the background image URL
    $bg_image_url = wp_get_attachment_image_src($bg_image, 'full')[0];

    // Build the CTA button link
    $cta_link = vc_build_link($cta_button);
    $cta_html = '<a href="' . esc_url($cta_link['url']) . '" class="cta-button">' . esc_html($cta_link['title']) . '</a>';

    // Optional overlay
    $overlay_html = $show_overlay == 'yes' ? '<div class="polygon-background"><div class="slider-content"><div class="text-content">'.$content.'</div><div class="cta-button-wrap">'.$cta_html.'</div></div></div><svg width="0" height="0">
    <defs>
        <clipPath id="polygon-clip" clipPathUnits="objectBoundingBox">
            <!-- Define the polygon shape -->
            <polygon points="0,0 1,0 0.7,1 0,1" />
        </clipPath>
    </defs>
</svg>' : '<div class="slider-background-colour"><div class="slider-content"><div class="text-content">'.$content.'</div><div class="cta-button-wrap">'.$cta_html.'</div></div></div>';

    // Build the output for the individual slide
    $output = '<div class="slider-item" style="background-image: url(' . esc_url($bg_image_url) . ');">';
    $output .= $overlay_html;
    $output .= '</div>';

    return $output;
}
add_shortcode('slider_item', 'slider_item_shortcode');

// Load the modal only once for the video blocks
function load_video_modal_once() {
    static $is_modal_loaded = false;
    if (!$is_modal_loaded) {
        $is_modal_loaded = true;
        echo '<div class="video-modal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <div class="video-container"></div>
            </div>
        </div>';
    }
}
add_action('wp_footer', 'load_video_modal_once');

function text_image_video_block($atts, $content = null) {
    extract(shortcode_atts(array(
        'select_image' => '',
        'youtube_id' => '',
    ), $atts));

    // Clean up the content to remove unnecessary whitespace and line breaks
    $content = trim($content);
    $content = preg_replace('/\s+/', ' ', $content);

    // Remove leading and trailing <p> and </p> tags
    $content = preg_replace('/^<\/p>/', '', $content);
    $content = preg_replace('/<p>$/', '', $content);

    ob_start();
    ?>
    <div class="text-image-video-block">
        <div class="container">
            <div class="content"><?php echo wp_kses_post(shortcode_unautop($content)); ?></div>
            <?php if($select_image || $youtube_id): ?>
                <div class="video-wrapper">
                    <?php if($select_image): ?>
                        <div class="video-trigger" data-video-id="<?php echo esc_attr($youtube_id); ?>">
                            <div class="play-button">
                            <svg class="video-play-icon" width="100%" height="100%" viewBox="0 0 576 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                                <path d="M549.7,124.1C543.4,100.4 524.9,81.8 501.4,75.5C458.8,64 288,64 288,64C288,64 117.2,64 74.6,75.5C51.1,81.8 32.6,100.4 26.3,124.1C14.9,167 14.9,256.4 14.9,256.4C14.9,256.4 14.9,345.8 26.3,388.7C32.6,412.4 51.1,430.2 74.6,436.5C117.2,448 288,448 288,448C288,448 458.8,448 501.4,436.5C524.9,430.2 543.4,412.3 549.7,388.7C561.1,345.8 561.1,256.4 561.1,256.4C561.1,256.4 561.1,167 549.7,124.1ZM232.2,337.6L232.2,175.2L374.9,256.4L232.2,337.6Z" style="fill:rgb(255,0,51);fill-rule:nonzero;"/>
                                <path d="M232.2,337.6L232.2,175.2L374.9,256.4L232.2,337.6Z" style="fill:white;"/>
                            </svg>
                            </div>
                            <img src="<?php echo wp_get_attachment_image_url($select_image, 'full'); ?>" alt="Video thumbnail">
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('text_image_video_block', 'text_image_video_block');

function text_image_video_listing_block($attr, $content = null) {
    extract(shortcode_atts(array(), $attr));

    ob_start();
    ?>
    <div class="text-image-video-listing-block">
        <div class="container">
            <?php
            // Process the content to separate text and video items
            $all_content = do_shortcode($content);
            $content_parts = preg_split('/<div class="video-list-item">/', $all_content);
            $text_content = $content_parts[0];
            
            $video_content = '';
            if (count($content_parts) > 1) {
                array_shift($content_parts);
                $video_content = '<div class="video-list-wrapper"><div class="video-list-item">' . implode('<div class="video-list-item">', $content_parts) . '</div></div>';
            }
            ?>
            <?php echo $text_content; ?>
            <?php echo $video_content; ?>
        </div>
    </div>
    <?php
    
    add_action('wp_footer', 'load_video_modal_once');
    return ob_get_clean();
}

function text_image_video_listing_content($attr, $content = null) {
    return '<div class="text-content">' . wpautop($content) . '</div>';
}

function text_image_video_listing_item($attr) {
    extract(shortcode_atts(array(
        'select_image' =>'',
        'youtube_id' =>'',
    ), $attr));

    $image_id = $select_image;
    $image = wp_get_attachment_image_src($image_id, "Full");
    $image_srcset = wp_get_attachment_image_srcset($image_id);
    $image_sizes = wp_get_attachment_image_sizes($image_id, 'full');

    ob_start();
    ?>
    <div class="video-list-item">
        <div class="video-trigger" data-video-id="<?php echo esc_attr($youtube_id); ?>">
            <img src="<?php echo $image[0]; ?>" 
                 srcset="<?php echo esc_attr($image_srcset); ?>" 
                 sizes="<?php echo esc_attr($image_sizes); ?>" 
                 alt="">
            <div class="play-button">
                <svg class="video-play-icon" width="100%" height="100%" viewBox="0 0 576 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M549.7,124.1C543.4,100.4 524.9,81.8 501.4,75.5C458.8,64 288,64 288,64C288,64 117.2,64 74.6,75.5C51.1,81.8 32.6,100.4 26.3,124.1C14.9,167 14.9,256.4 14.9,256.4C14.9,256.4 14.9,345.8 26.3,388.7C32.6,412.4 51.1,430.2 74.6,436.5C117.2,448 288,448 288,448C288,448 458.8,448 501.4,436.5C524.9,430.2 543.4,412.3 549.7,388.7C561.1,345.8 561.1,256.4 561.1,256.4C561.1,256.4 561.1,167 549.7,124.1ZM232.2,337.6L232.2,175.2L374.9,256.4L232.2,337.6Z" style="fill:rgb(255,0,51);fill-rule:nonzero;"/>
                    <path d="M232.2,337.6L232.2,175.2L374.9,256.4L232.2,337.6Z" style="fill:white;"/>
                </svg>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('text_image_video_listing_block', 'text_image_video_listing_block');
add_shortcode('text_image_video_listing_content', 'text_image_video_listing_content');
add_shortcode('text_image_video_listing_item', 'text_image_video_listing_item');

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_text_image_video_listing_block extends WPBakeryShortCodesContainer {}
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_text_image_video_listing_content extends WPBakeryShortCode {}
    class WPBakeryShortCode_text_image_video_listing_item extends WPBakeryShortCode {}
}

function package_list_block_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'block_title' => ''
    ), $atts));

    ob_start(); // Start output buffering
    ?>
    <div class="package-list-block">
        <?php if ($block_title): ?>
            <div class="container">
                <div class="heading">
                    <h2><?php echo esc_html($block_title); ?></h2>
                </div>
            </div>
        <?php endif; ?>
        <div class="container">
            <div class="package-items">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean(); // Return the buffered content
}

function package_list_item_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'svg_code' => '',
        'button_link' => '',
    ), $atts));

    // Decode and make SVG unique
    $svg_decoded = rawurldecode(base64_decode($svg_code));
    $unique_id = uniqid();
    $svg_decoded = str_replace('id="', 'id="' . $unique_id . '_', $svg_decoded);
    $svg_decoded = str_replace('#', '#' . $unique_id . '_', $svg_decoded);
    $svg_decoded = str_replace('<svg', '<svg preserveAspectRatio="xMidYMid meet"', $svg_decoded);

    $link = vc_build_link($button_link);

    $output = '<div class="package-item">';
    if ($svg_decoded) {
        $output .= '<div class="package-icon">' . $svg_decoded . '</div>';
    }

    $output .= '<div class="package-content">' . wpb_js_remove_wpautop($content) .'';
    if ($link['url']) {
        $output .= sprintf(
            '<a href="%s" class="package-button btn" title="%s" target="%s">%s</a>',
            esc_url($link['url']), 
            esc_attr($link['title']),
            esc_attr($link['target']),
            esc_html($link['title'])
        );
    }
    $output .= '</div></div>';

    return $output;
}

add_shortcode('package_list_block', 'package_list_block_shortcode');
add_shortcode('package_list_item', 'package_list_item_shortcode');

function display_page_content_shortcode($atts) {
    // Extract the attributes passed to the shortcode
    $atts = shortcode_atts(array(
        'page_id' => '', // Page ID
    ), $atts, 'vc_display_page_content');

    // Get the page content by ID
    $page = get_post($atts['page_id']);

    // Check if the page exists
    if ($page) {
        // Return the page content
        return apply_filters('the_content', $page->post_content);
    } else {
        return '<p>Page not found.</p>';
    }
}
add_shortcode('vc_display_page_content', 'display_page_content_shortcode');