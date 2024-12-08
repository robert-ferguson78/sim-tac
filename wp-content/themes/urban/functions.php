<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (!isset($content_width)) {
    $content_width = 1170;
}

require_once(get_template_directory() . '/framework/include.php');

/*if (!session_id()) {
    session_start();
}*/

function theme_ajax_url(){
    echo '<script type="text/javascript">
    var ajaxurl = "' . admin_url('admin-ajax.php') . '";
    var siteurl = "' .site_url(). '";
    </script>';
}
add_action('wp_head', 'theme_ajax_url');


add_action('init', 'gg_register_blog_cpt', 1);

if (false === function_exists('gg_register_blog_cpt')) {
    /**
     * Register custom post type for Resources.
     */
    function gg_register_blog_cpt(): void
    {
        register_post_type('blog', [
            'labels' => [
                'menu_name' => esc_html__('Blogs', 'gravity-global'),
                'name_admin_bar' => esc_html__('Blog', 'gravity-global'),
                'add_new' => esc_html__('Add Blog', 'gravity-global'),
                'add_new_item' => esc_html__('Add new Blog', 'gravity-global'),
                'new_item' => esc_html__('New Blog', 'gravity-global'),
                'edit_item' => esc_html__('Edit Blog', 'gravity-global'),
                'view_item' => esc_html__('View Blog', 'gravity-global'),
                'update_item' => esc_html__('View Blog', 'gravity-global'),
                'all_items' => esc_html__('All Blogs', 'gravity-global'),
                'search_items' => esc_html__('Search Blogs', 'gravity-global'),
                'parent_item_colon' => esc_html__('Parent Blog', 'gravity-global'),
                'not_found' => esc_html__('No Blogs found', 'gravity-global'),
                'not_found_in_trash' => esc_html__('No Blogs found in Trash', 'gravity-global'),
                'name' => esc_html__('Blogs', 'gravity-global'),
                'singular_name' => esc_html__('Blog', 'gravity-global'),
            ],
            'public' => true,
            'menu_position' => 4,
            'menu_icon' => 'dashicons-welcome-write-blog',
            'supports' => [
                'title',
                'editor',
                'thumbnail',
                'excerpt',
            ],
            'taxonomies' => ['category'],
            'show_in_rest' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
        ]);
    }
}

\add_action('init', 'gg_register_content_type', 1);

if (false === \function_exists('gg_register_content_type')) {
    /**
     * Register Content-type taxonomy.
     *
     * @since 2.0.0
     */
    function gg_register_content_type(): void
    {
        register_taxonomy('content-type', ['blog'], [
            'labels' => [
                'name' => _x('Content type', 'gravity-global'),
                'singular_name' => _x('Content type', 'gravity-global'),
                'search_items' => __('Search Content type', 'gravity-global'),
                'all_items' => __('All Content types', 'gravity-global'),
                'parent_item' => \__('Parent Content type', 'gravity-global'),
                'parent_item_colon' => __('Parent Content types :', 'gravity-global'),
                'edit_item' => __('Edit Content type', 'gravity-global'),
                'update_item' => __('Update Content type', 'gravity-global'),
                'add_new_item' => __('Add New Content type', 'gravity-global'),
                'new_item_name' => __('New Content type Name', 'gravity-global'),
            ],
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'show_in_rest' => true,
            'has_archive' => false,
            'publicly_queryable' => false,
        ]);
    }
}


function filter_data()
{
  
  $argcat = array(

    'post_type' => 'blog',
    'post_status' => 'publish',

    'tax_query' => array(
      'relation' => 'AND',
    ),

  );

  if (!empty($_POST['cat_id'])) {

    $argcat['tax_query'][] = array(
      'taxonomy' => 'category',
      'field' => 'id',
      'terms' => $_POST['cat_id'],

    );
  }
  if (!empty($_POST['cont_type'])) {

    $argcat['tax_query'][] = array(
      'taxonomy' => 'content-type',
      'field' => 'id',
      'terms' => $_POST['cont_type'],

    );
  }
  if (!empty($_POST['keyword_search'])) {
    $argcat['s'] = $_POST['keyword_search'];
  }

  $argcat['posts_per_page'] = -1;
  
 
  $hot_query = new wp_query($argcat);



  $output='';
  
  if ($hot_query->have_posts()) {

    while ($hot_query->have_posts()) {

     $hot_query->the_post(); 

      $id = get_the_ID();
      $thumb = get_the_post_thumbnail_url($id);
      $short_desc = get_the_excerpt($id);
      $title = get_the_title($id);
      $terms = wp_get_post_terms($id , 'category');

      if (!empty($terms)) {
          
          $term_names = array_map(function($term) {
              return $term->name;
          }, $terms);
      }

      $post_date = get_post_field('post_date', $id);
      $timestamp = strtotime($post_date);
      $formatted_date = date('j F Y, H:i', $timestamp);
      $gst_the_perm = get_permalink($id);
        
      $post_content = get_the_content($id);
      $word_count = str_word_count(strip_tags($post_content));
      $reading_time = ceil($word_count / 200); 
     
     

      $output.='<div class="card_listed_item">
                    <a href="'.$gst_the_perm.'">
                        <div class="img_pro">
                            <img src="'.$thumb.'" alt="">
                        </div>
                        <div class="content_pro">
                            <div class="boxes__group_wrapper">
                                <div class="box_term">
                                    '.implode(',', $term_names).'
                                </div>
                                <div class="box_date">
                                    <span class="date">'.$formatted_date.'</span>
                                </div>
                            </div>
                            <h2>
                                '.$title.'
                            </h2>
                            <div class="read_time">
                                '.$reading_time.' min read
                            </div>
                            <div class="readmore_btn">
                                <span>Get started</span>
                            </div>
                        </div>
                    </a>
                    </div>

                    </div>';
   }
}else{
    $output.='No Record Found';
}



  wp_reset_query();



  $response = array('listing' =>  $output);

  echo json_encode($response);
  die();
}

add_action('wp_ajax_filter_data', 'filter_data');
add_action('wp_ajax_nopriv_filter_data', 'filter_data');

add_filter('wp_kses_allowed_html', 'allow_svg_in_admin', 10, 2);

function allow_svg_in_admin($tags, $context) {
    if ($context === 'post') {
        $tags['svg'] = array(
            'xmlns' => true,
            'class' => true,
            'width' => true,
            'height' => true,
            'viewbox' => true,
            'fill' => true
        );
        $tags['path'] = array(
            'd' => true,
            'fill' => true
        );
        $tags['g'] = array();
        $tags['circle'] = array(
            'cx' => true,
            'cy' => true,
            'r' => true,
            'fill' => true
        );
    }
    return $tags;
}