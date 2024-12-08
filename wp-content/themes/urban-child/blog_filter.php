<?php
/* Template Name: blog filter template*/
get_header();

$trem_cat = get_terms( array(

    'taxonomy'   => 'category',

) );

$term_content = get_terms( array(

    'taxonomy'   => 'content-type',

) );

$args = array(
    'post_type' => 'blog',
    'posts_per_page' => -1,
);

$query = new WP_Query($args);


?>

<div class="banner_title">
                <div class="container">
                   <h2>Blogs</h2>
                </div>
            </div>

            <div class="blogs_main">
                <div class="container">
                    <div class="filtersblog">
                        <div class="more_filter">
                            <a role="button" tabindex="0">More filters</a>
                        </div>
                        <div class="searchform">

                            <input type="search" id="filter-search-id"  placeholder="Search by keyword, topic ...">

                            <button type="submit" class="search_submit" id="search_select">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14.5426 13.2024L19.5359 18.1517C19.9243 18.5368 19.9256 19.1598 19.5326 19.5493C19.1424 19.9361 18.504 19.9305 18.1226 19.5525L13.1294 14.6032C9.99314 17.0225 5.45663 16.8035 2.57393 13.9461C-0.54808 10.8516 -0.54808 5.83438 2.57393 2.73985C5.69593 -0.354688 10.7577 -0.354688 13.8797 2.73985C16.7624 5.59719 16.9834 10.0938 14.5426 13.2024ZM12.4665 12.5454C14.808 10.2245 14.808 6.46154 12.4665 4.14063C10.125 1.81973 6.32866 1.81973 3.98715 4.14063C1.64565 6.46154 1.64565 10.2245 3.98715 12.5454C6.32866 14.8663 10.125 14.8663 12.4665 12.5454Z"
                                        fill="inherit"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="filter_type" data-type="select">

                            <select class="selectiteme" name="" id="categorySelect" data-taxonomy="category">
                                <option selected disabled value="">Select Category</option>
								<?php
								   if(!empty($trem_cat)){

									foreach($trem_cat as $cat_te){
								?>
                                <option value="<?php echo $cat_te->term_id; ?>">
								<?php echo $cat_te->name; ?>
                                </option>
								<?php } } ?>
                               
                            </select>

                            <span class="dropdown-icon"></span>
                        </div>
                        <div class="filter_type" data-type="select">

                            <select class="selectiteme" name="" id="contenttype" data-taxonomy="category">
                                <option selected disabled value="">Select Content type</option>
								<?php
								   if(!empty($term_content))
								   {

									foreach($term_content as $term_con_t)
									{
								?>
                                <option value="<?php echo $term_con_t->term_id; ?>">
								<?php echo $term_con_t->name; ?>
                                </option>
								<?php } 
							} ?>
                            </select>

                            <span class="dropdown-icon"></span>
                        </div>
                        <div class="filtersgroupwrapper">
                            <div class="activetag">
                                <div class="activetaginner">
                        
                                </div>
                            </div>
                            <div class="resetfilter">
                                <button>
                                    Reset all filters
                                </button>
                            </div>
                        </div>
                    </div>
                   <input type="hidden" name="cat_id" id="cat_id" value="">
				   <input type="hidden" name="cont_type_id" id="cont_type_id" value="">
				   <input type="hidden" name="search_id" id="search_id" value="">
                    <div class="card_listed">

                        <div class="card_listed_inner">

						<?php if ($query->have_posts()) {

                                  while ($query->have_posts()) {

                                   $query->the_post(); 

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
								   
								   ?>

								   <div class="card_listed_item">
                                             <a href="<?php echo $gst_the_perm; ?>">
                                            <div class="img_pro">
                                                <img src="<?php echo $thumb; ?>" alt="">
                                            </div>
                                    <div class="content_pro">
                                        <div class="boxes__group_wrapper">
                                            <div class="box_term">
                                                <?php echo implode(',', $term_names); ?>
                                            </div>
                                            <div class="box_date">
                                                <span class="date"><?php echo $formatted_date; ?></span>
                                            </div>
                                        </div>
                                        <h2>
                                            <?php echo $title; ?>
                                        </h2>
                                        <div class="read_time">
                                            <?php echo $reading_time; ?> min read
                                        </div>
                                        <div class="readmore_btn">
                                            <span>Get started</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                        
								<?php }
						}?>
                       </div>    
                    </div>
                </div>
            </div>
          <?php  wp_reset_query(); ?>


<?php 
		/*while (have_posts()) : the_post();

		echo do_shortcode(the_content());

		endwhile;*/
 	?>
	
<?php
get_footer();?>
