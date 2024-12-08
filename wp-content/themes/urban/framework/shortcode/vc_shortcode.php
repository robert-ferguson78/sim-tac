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

add_action( 'vc_before_init', 'card_block_integrateWithVC' );

function card_block_integrateWithVC() {
  vc_map( array(
	  "name" => __( "Card Block", "urban" ),
	  "base" => "card_block_page",
	  "category" => __( "urban", "urban"),
	  
	  "params" => array(

		array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Add Title", "urban"),
			"param_name"  => "add_title",
			"value"       => "",
		  ),

		  array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Short Description', 'urban' ),
			'param_name' => 'single_card_description',
			
            ),
		  
		  array(
					  'type' => 'param_group',
					  'param_name' => 'box_repeater_items_column',
					  'params' => array(
																					   
									array(
											  "type"        => "textfield",
											  "heading"     => esc_html__( "Add Title", "urban"),
											  "param_name"  => "add_card_title",
											  "value"       => "",
											),
									array(
													  'type' => 'textarea',
													  'heading' => esc_html__( 'Short Description', 'urban' ),
													  'param_name' => 'add_card_description',
													  
										),
									array(
													"type"        => "attach_image",
													"heading"     => esc_html__( "Select card image", "urban" ),
													"param_name"  => "add_card_image",
													"value"       => "",
										  
										), 
									array(
										  "type"        => "vc_link",
										  "heading"     => esc_html__( "add Link", "urban" ),
										  "param_name"  => "add_card_links",
										  "value"       => "",
								
									),   
								 )
						 ),
	  ),
  ));
}

add_action( 'vc_before_init', 'help_block_integrateWithVC' );

function help_block_integrateWithVC() {
  vc_map( array(
	  "name" => __( "Help Block", "urban" ),
	  "base" => "help_block_page",
	  "category" => __( "urban", "urban"),
	  
	  "params" => array(

		array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Add Title", "urban"),
			"param_name"  => "help_add_title",
			"value"       => "",
		  ),

		  array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Short Description', 'urban' ),
			'param_name' => 'single_help_description',
			
            ),
		  
		  array(
					  'type' => 'param_group',
					  'param_name' => 'box_repeater_items_column_help',
					  'params' => array(
																					   
									array(
											  "type"        => "textfield",
											  "heading"     => esc_html__( "Add Title", "urban"),
											  "param_name"  => "add_help_title",
											  "value"       => "",
											),
									array(
													  'type' => 'textarea',
													  'heading' => esc_html__( 'Short Description', 'urban' ),
													  'param_name' => 'add_help_description',
													  
										),
									array(
													"type"        => "attach_image",
													"heading"     => esc_html__( "Select image", "urban" ),
													"param_name"  => "add_help_image",
													"value"       => "",
										  
										), 
									   
								 )
						 ),
	  ),
  ));
}


add_action('vc_before_init','video_block_box');

function video_block_box() {

  vc_map( array(
   "name" => __("Video Block", "urban"),
   "base" => "video_block",
    "category" => __( "urban", "urban"),
    "params" => array(

           array(
                  "type"        => "attach_image",
                  "heading"     => esc_html__( "Select vidoe thumb", "urban" ),
                  "param_name"  => "select_vidoe_thumb",
                  "value"       => "",
           ),
            array(
              'type' => 'textarea_html',
              'heading' => esc_html__( 'Add video ifram', 'urban' ),
              'param_name' => 'content',                                    
          ),
		  
 
    ),
  ));
}


add_action('vc_before_init','CTA_block_box');

function CTA_block_box() {

  vc_map( array(
   "name" => __("CTA Block", "urban"),
   "base" => "cta_block",
    "category" => __( "urban", "urban"),
    "params" => array(

		array(

            "type"          => "checkbox",
            "admin_label"   => true,
            "weight"        => 10,
            "heading"       => __("Image Left", "urban"),
            "value"         => array('image_left_cta'   => 'left'),
            "param_name"    => "image_left"
           ),
		   array(

            "type"          => "checkbox",
            "admin_label"   => true,
            "weight"        => 10,
            "heading"       => __("Is white Background", "urban"),
            "value"         => array('is_background_white'   => 'yes'),
            "param_name"    => "is_background_white"
           ),

           array(
                  "type"        => "attach_image",
                  "heading"     => esc_html__( "Select cta image", "urban" ),
                  "param_name"  => "select_cta_image",
                  "value"       => "",
           ),
            array(
              'type' => 'textarea_html',
              'heading' => esc_html__( 'Add description', 'urban' ),
              'param_name' => 'content',                                    
          ),
		  
 
    ),
  ));
}

add_action('vc_before_init','contact_us_block_box');

function contact_us_block_box() {

  vc_map( array(
   "name" => __("Contact us Block", "urban"),
   "base" => "contact_us_block",
    "category" => __( "urban", "urban"),
    "params" => array(

      array(
        'type'          => 'dropdown',
        'heading'       => __( 'Select Block Design', 'urban' ),
        'value'         => array(
          __( 'design one', 'urban' ) => 'design one',
          __( 'big image Left', 'urban' )  => 'big image Left',
          __( 'big image right', 'urban' ) => 'big image right',
          
        ),
        'param_name'    => 'select_block_design'
    ),

		array(

            "type"          => "checkbox",
            "admin_label"   => true,
            "weight"        => 10,
            "heading"       => __("Is Background", "urban"),
            "value"         => array('is_background'   => 'yes'),
            "param_name"    => "is_background"
           ),

           array(
                  "type"        => "attach_image",
                  "heading"     => esc_html__( "Select image", "urban" ),
                  "param_name"  => "select_contact_us_image",
                  "value"       => "",
           ),

            array(
              'type' => 'textarea_html',
              'heading' => esc_html__( 'Add description', 'urban' ),
              'param_name' => 'content',                                    
          ),
		  
 
    ),
  ));
}

add_action('vc_before_init','image_with_text_box');

function image_with_text_box() {

  vc_map( array(
   "name" => __("Image with Text", "urban"),
   "base" => "image_wit_text",
    "category" => __( "urban", "urban"),
    "params" => array(

           array(
                  "type"        => "attach_image",
                  "heading"     => esc_html__( "Select Block Image", "urban" ),
                  "param_name"  => "select_with_image",
                  "value"       => "",
           ),
		   array(

            "type"          => "checkbox",
            "admin_label"   => true,
            "weight"        => 10,
            "heading"       => __("Image Right", "niacet"),
            "value"         => array('image_right'   => 'right'),
            "param_name"    => "image_right"
           ),
            array(
              'type' => 'textarea_html',
              'heading' => esc_html__( 'Add Description', 'urban' ),
              'param_name' => 'content',
                                                    
          ),
		  
 
    ),
  ));
}

add_action('vc_before_init','simple_text_heading');

function simple_text_heading() {

  vc_map( array(
   "name" => __("Simple Text Heading banner", "urban"),
   "base" => "text_heading_banner",
    "category" => __( "urban", "urban"),
    "params" => array(
              
                array(
                  'type' => 'textarea',
                  'heading' => esc_html__( 'Add Heading', 'urban' ),
                  'description' => esc_html__( 'Add Heading with hedaing tag like  <h1>Cookie Policy</h1>', 'urban' ),
                  'param_name' => 'add_text_banner_heading',

                  
          ),
 
    ),
  ));
}

add_action('vc_before_init', 'faq_accordion_integrateWithVC');

function faq_accordion_integrateWithVC() {
  vc_map(array(
    "name" => __("FAQ Accordion", "urban"),
    "base" => "faq_accordion",
    "category" => __("urban", "urban"),
    "as_parent" => array('only' => 'faq_item'),
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "urban"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "urban")
      )
    ),
    "js_view" => 'VcColumnView'
  ));

  vc_map(array(
    "name" => __("FAQ Item", "urban"),
    "base" => "faq_item",
    "content_element" => true,
    "as_child" => array('only' => 'faq_accordion'),
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Question", "urban"),
        "param_name" => "question",
        "admin_label" => true
      ),
      array(
        "type" => "textarea_html",
        "heading" => __("Answer", "urban"),
        "param_name" => "content",
        "description" => __("Enter the FAQ answer here.", "urban")
      )
    )
  ));
}

if (class_exists('WPBakeryShortCodesContainer')) {
  class WPBakeryShortCode_faq_accordion extends WPBakeryShortCodesContainer {}
}
if (class_exists('WPBakeryShortCode')) {
  class WPBakeryShortCode_faq_item extends WPBakeryShortCode {}
}

add_action('vc_before_init', 'navigation_block_integrateWithVC');

function navigation_block_integrateWithVC() {
  vc_map(array(
    "name" => __("Navigation Block", "urban"),
    "base" => "navigation_block",
    "category" => __("urban", "urban"),
    "as_parent" => array('only' => 'navigation_link'),
    "content_element" => true,
    "show_settings_on_create" => true,
    "is_container" => true,
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Title", "urban"),
        "param_name" => "title",
        "description" => __("Enter the title for the navigation block.", "urban")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "urban"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "urban")
      )
    ),
    "js_view" => 'VcColumnView'
  ));

  vc_map(array(
    "name" => __("Navigation Link", "urban"),
    "base" => "navigation_link",
    "content_element" => true,
    "as_child" => array('only' => 'navigation_block'),
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Link Text", "urban"),
        "param_name" => "text",
        "admin_label" => true
      ),
      array(
        "type" => "textfield",
        "heading" => __("URL", "urban"),
        "param_name" => "url",
        "description" => __("Enter the URL for the link.", "urban")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Class Name", "urban"),
        "param_name" => "class_name",
        "description" => __("Enter Class Name for the link.", "urban")
      )
    )
  ));
}

if (class_exists('WPBakeryShortCodesContainer')) {
  class WPBakeryShortCode_navigation_block extends WPBakeryShortCodesContainer {}
}
if (class_exists('WPBakeryShortCode')) {
  class WPBakeryShortCode_navigation_link extends WPBakeryShortCode {}
}

add_action('vc_before_init', 'slider_block_integrateWithVC');

function slider_block_integrateWithVC() {
    vc_map(array(
        "name" => __("Slider Block", "urban"),
        "base" => "slider_block",
        "category" => __("urban", "urban"),
        "as_parent" => array('only' => 'slider_item'),
        "content_element" => true,
        "show_settings_on_create" => true,
        "is_container" => true,
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Slider Title", "urban"),
                "param_name" => "slider_title",
                "description" => __("Enter the main title for the slider.", "urban")
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "urban"),
                "param_name" => "el_class",
                "description" => __("Add an extra class for custom styling.", "urban")
            )
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("Slider Item", "urban"),
        "base" => "slider_item",
        "content_element" => true,
        "as_child" => array('only' => 'slider_block'),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Background Image", "urban"),
                "param_name" => "bg_image",
                "description" => __("Select background image for the slide.", "urban")
            ),
            array(
                "type" => "textfield",
                "heading" => __("Slide Title", "urban"),
                "param_name" => "title",
                "description" => __("Enter the slide title.", "urban")
            ),
            array(
                "type" => "textfield",
                "heading" => __("Subtitle", "urban"),
                "param_name" => "subtitle",
                "description" => __("Enter the subtitle for the slide.", "urban")
            ),
            array(
                'type' => 'textarea_html',
                'holder' => 'div',
                'heading' => 'Text Content',
                'param_name' => 'content',
                'value' => ''
            ),
            array(
                "type" => "vc_link",
                "heading" => __("CTA Button", "urban"),
                "param_name" => "cta_button",
                "description" => __("Set up the CTA button link.", "urban")
            ),
            array(
                "type" => "checkbox",
                "heading" => __("Show Overlay?", "urban"),
                "param_name" => "show_overlay",
                "value" => array('Yes' => 'yes'),
                "description" => __("Check to add a dark overlay over the slide.", "urban")
            )
        )
    ));
}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_slider_block extends WPBakeryShortCodesContainer {}
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_slider_item extends WPBakeryShortCode {}
}

function text_image_video_integrateWithVC() {
    // Move all your vc_map() calls inside this function
    
    // Your existing code goes here
    vc_map(array(
        'name' => 'Text Image Video Block',
        'base' => 'text_image_video_block',
        'category' => 'urban',
        'params' => array(
            array(
                'type' => 'textarea_html',
                'holder' => 'div',
                'heading' => 'Content',
                'param_name' => 'content',
                'value' => ''
            ),
            array(
                'type' => 'attach_image',
                'holder' => 'div',
                'heading' => 'Select Image',
                'param_name' => 'select_image',
                'value' => '',
                'description' => 'This image will be the video thumbnail'
            ),
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'heading' => 'YouTube Video ID',
                'param_name' => 'youtube_id',
                'value' => '',
                'description' => 'Enter only the video ID (e.g., dQw4w9WgXcQ)'
            )
        )
    ));
}
add_action('vc_before_init', 'text_image_video_integrateWithVC');

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
add_action('vc_before_init', 'text_image_video_listing_vc');

function package_list_block_vc() {
    // Parent Block
    vc_map(array(
        'name' => 'Package List Block',
        'base' => 'package_list_block',
        'category' => 'urban',
        'as_parent' => array('only' => 'package_list_item'),
        'content_element' => true,
        'show_settings_on_create' => true,
        'is_container' => true,
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => 'Block Title',
                'param_name' => 'block_title',
                'value' => ''
            )
        ),
        'js_view' => 'VcColumnView'
    ));

    // Child Block
    vc_map(array(
        'name' => 'Package List Item',
        'base' => 'package_list_item',
        'content_element' => true,
        'as_child' => array('only' => 'package_list_block'),
        'params' => array(
          array(
              'type' => 'textarea_raw_html', // Changed from 'textarea' to 'textarea_raw_html'
              'heading' => 'SVG Code',
              'param_name' => 'svg_code',
              'value' => '',
              'description' => 'Paste your SVG code here'
          ),
            array(
                'type' => 'textarea_html',
                'heading' => 'Content',
                'param_name' => 'content',
                'value' => ''
            ),
            array(
                'type' => 'vc_link',
                'heading' => 'Button Link',
                'param_name' => 'button_link',
                'value' => ''
            )
        )
    ));
}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_package_list_block extends WPBakeryShortCodesContainer {}
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_package_list_item extends WPBakeryShortCode {}
}

add_action('vc_before_init', 'package_list_block_vc');

// Pull comntent from another page
function vc_display_page_content() {
  vc_map(array(
      'name' => 'Display Page Content',
      'base' => 'vc_display_page_content',
      'category' => 'urban',
      'params' => array(
          array(
              'type' => 'dropdown',
              'heading' => 'Select Page',
              'param_name' => 'page_id',
              'value' => vc_get_page_titles(),
              'description' => 'Select the page to display its content.'
          ),
      ),
  ));
}
add_action('vc_before_init', 'vc_display_page_content');

// Helper function to get page titles
function vc_get_page_titles() {
  $pages = get_pages();
  $page_titles = array();
  foreach ($pages as $page) {
      $page_titles[$page->post_title] = $page->ID;
  }
  return $page_titles;
}