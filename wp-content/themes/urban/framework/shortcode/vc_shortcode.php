<?php 
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

add_action('vc_before_init','top_banner_box');

function top_banner_box() {

  vc_map( array(
   "name" => __("Top Banner", "urban"),
   "base" => "top_banner_image",
    "category" => __( "urban", "urban"),
    "params" => array(

           array(
                  "type"        => "attach_image",
                  "heading"     => esc_html__( "Select Block Image", "urban" ),
                  "param_name"  => "select_block_image",
                  "value"       => "",
           ),
            array(
              'type' => 'textarea_html',
              'heading' => esc_html__( 'Add Description', 'urban' ),
              'param_name' => 'content',
                                                    
          ),
		  
 
    ),
  ));
}

add_action('vc_before_init', 'header_13_box');

function header_13_box() {
    vc_map(array(
        "name" => __("Header 13", "urban"),
        "base" => "header_13",
        "category" => __("urban", "urban"),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Video Placeholder Image", "urban"),
                "param_name" => "placeholder_image_id",
                "description" => __("Select image to show before video plays", "urban")
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("YouTube Video ID", "urban"),
                "param_name"  => "youtube_video_id",
                "value"       => "",
                "description" => esc_html__("Enter the YouTube video ID (e.g., dQw4w9WgXcQ)", "urban"),
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Heading", "urban"),
                "param_name"  => "heading",
                "value"       => "",
            ),
            array(
                "type"        => "textarea_html",
                "heading"     => esc_html__("Content", "urban"),
                "param_name"  => "content",
                "value"       => "",
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Primary Button Text", "urban"),
                "param_name"  => "primary_button_text",
                "value"       => "",
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Secondary Button Text", "urban"),
                "param_name"  => "secondary_button_text",
                "value"       => "",
            ),
        ),
    ));}

add_action('vc_before_init','layout_253_integrateWithVC');

function layout_253_integrateWithVC() {
    // Register parent shortcode
    vc_map(array(
        "name" => __("Layout 253", "urban"),
        "base" => "layout_253",
        "as_parent" => array('only' => 'layout_253_item,layout_253_content'), // Use only `layout_253_item` and `layout_253_content` as children
        "content_element" => true,
        "show_settings_on_create" => true,
        "category" => __("urban", "urban"),
        "params" => array(
           array(
                  "type"        => "textfield",
                  "heading"     => esc_html__( "Tagline", "urban" ),
                  "param_name"  => "tagline",
                  "value"       => "",
           ),
           array(
                  "type"        => "textfield",
                  "heading"     => esc_html__( "Heading", "urban" ),
                  "param_name"  => "heading",
                  "value"       => "",
           ),
           array(
                  "type"        => "textfield",
                  "heading"     => esc_html__( "Primary Button Text", "urban" ),
                  "param_name"  => "primary_button_text",
                  "value"       => "",
           ),
           array(
                  "type"        => "textfield",
                  "heading"     => esc_html__( "Secondary Button Text", "urban" ),
                  "param_name"  => "secondary_button_text",
                  "value"       => "",
           ),
           array(
                  "type"        => "attach_image",
                  "heading"     => esc_html__( "Secondary Button Icon", "urban" ),
                  "param_name"  => "secondary_button_icon",
                  "value"       => "",
           ),
        ),
        "js_view" => 'VcColumnView'
    ));

    // Register child shortcode for list items
    vc_map(array(
        "name" => __("Layout 253 Item", "urban"),
        "base" => "layout_253_item",
        "content_element" => true,
        "as_child" => array('only' => 'layout_253'), // Only allowed in `layout_253`
        "params" => array(
            array(
                "type"        => "attach_image",
                "heading"     => esc_html__( "Icon", "urban" ),
                "param_name"  => "icon",
                "value"       => "",
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__( "List Item Heading", "urban" ),
                "param_name"  => "list_item_heading",
                "value"       => "",
            ),
            array(
                "type"        => "textarea_html",
                "heading"     => esc_html__( "List Item Content", "urban" ),
                "param_name"  => "content",
                "value"       => "",
            ),
            array(
              "type"        => "textfield",
              "heading"     => esc_html__( "Primary Button Text", "urban" ),
              "param_name"  => "item_primary_button_text",
              "value"       => "",
            ),
        ),
    ));

    // Register child shortcode for content
    vc_map(array(
        "name" => __("Layout 253 Content", "urban"),
        "base" => "layout_253_content",
        "content_element" => true,
        "as_child" => array('only' => 'layout_253'), // Only allowed in `layout_253`
        "params" => array(
            array(
                "type"        => "textarea_html",
                "heading"     => esc_html__( "Content", "urban" ),
                "param_name"  => "content",
                "value"       => "",
            ),
        ),
    ));
}

// Add parent-child relationship
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Layout_253 extends WPBakeryShortCodesContainer {}
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Layout_253_Item extends WPBakeryShortCode {}
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Layout_253_Content extends WPBakeryShortCode {}
}

add_action('vc_before_init', 'text_image_video_listing_vc');

function text_image_video_listing_vc() {
    // Parent container shortcode
    vc_map(array(
        'name' => 'Text Image Video Listing Block',
        'base' => 'text_image_video_listing_block',
        'category' => 'urban',
        'as_parent' => array('only' => 'text_image_video_listing_item, text_image_video_listing_content'),
        'content_element' => true,
        'show_settings_on_create' => true,
        'js_view' => 'VcColumnView'
    ));
  
    // Text content child shortcode
    vc_map(array(
        'name' => 'Content Section',
        'base' => 'text_image_video_listing_content',
        'category' => 'urban',
        'as_child' => array('only' => 'text_image_video_listing_block'),
        'params' => array(
            array(
                'type' => 'textarea_html',
                'holder' => 'div',
                'heading' => 'Content',
                'param_name' => 'content',
                'value' => ''
            )
        )
    ));
  
    // Video item child shortcode
    vc_map(array(
        'name' => 'Video List Item',
        'base' => 'text_image_video_listing_item',
        'category' => 'urban',
        'as_child' => array('only' => 'text_image_video_listing_block'),
        'params' => array(
            array(
                'type' => 'attach_image',
                'holder' => 'div',
                'heading' => 'Select Image',
                'param_name' => 'select_image',
                'value' => ''
            ),
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'heading' => 'YouTube Video ID',
                'param_name' => 'youtube_id',
                'value' => ''
            )
        )
    ));
  }

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_text_image_video_listing_block extends WPBakeryShortCodesContainer {}
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_text_image_video_listing_content extends WPBakeryShortCode {}
    class WPBakeryShortCode_text_image_video_listing_item extends WPBakeryShortCode {}
}

// new shortcode

add_action('vc_before_init', 'gallery_block_vc');

function gallery_block_vc() {
    vc_map(array(
        'name' => 'Gallery Block',
        'base' => 'gallery_block',
        'category' => 'Layout',
        'as_parent' => array('only' => 'content_block, gallery_image'),
        'content_element' => true,
        'show_settings_on_create' => true,
        'js_view' => 'VcColumnView',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => 'Title',
                'param_name' => 'title',
                'value' => 'Gallery Title',
            ),
        ),
    ));
}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_gallery_block extends WPBakeryShortCodesContainer {}
}

add_action('vc_before_init', 'content_block_vc');

function content_block_vc() {
    vc_map(array(
        'name' => 'Content Block',
        'base' => 'content_block',
        'category' => 'Components',
        'as_child' => array('only' => 'gallery_block'),
        'content_element' => true,
        'params' => array(
            array(
                'type' => 'textarea_html',
                'heading' => 'Content',
                'param_name' => 'content',
                'value' => '',
            ),
        ),
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_content_block extends WPBakeryShortCode {}
}

add_action('vc_before_init', 'gallery_image_vc');

function gallery_image_vc() {
    vc_map(array(
        'name' => 'Gallery Image',
        'base' => 'gallery_image',
        'category' => 'Components',
        'as_child' => array('only' => 'gallery_block'),
        'params' => array(
            array(
                'type' => 'attach_image',
                'heading' => 'Image',
                'param_name' => 'image',
            ),
        ),
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_gallery_image extends WPBakeryShortCode {}
}