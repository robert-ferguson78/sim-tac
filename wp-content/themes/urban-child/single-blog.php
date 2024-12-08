<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage urban
 * @since urban 2024
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header();
$id = get_the_ID();
$thumb = get_the_post_thumbnail_url($id);
$short_desc = get_the_excerpt($id);
$title = get_the_title($id);
$terms = wp_get_post_terms($id , 'category');
if (!empty($terms)) {
    // Loop through each term and display its name
    $term_names = array_map(function($term) {
        return $term->name;
    }, $terms);
}

$terms_content = wp_get_post_terms($id , 'content-type');

if (!empty($terms_content)) {
    $term_names_con = array_map(function($terms_content) {
        return $terms_content->name;
    }, $terms_content);
}

$author_id = get_post_field('post_author', $id);
$author_name = get_the_author_meta('display_name', $author_id);
$post_date = get_post_field('post_date', $id);
$timestamp = strtotime($post_date);
$formatted_date = date('j F Y, H:i', $timestamp);
$gst_the_perm = get_permalink($id);
$post = get_post($id);

if($post){

$post_content = $post->post_content;
$word_count = str_word_count(strip_tags($post_content));

$reading_time = ceil($word_count / 200); 
}

?>
 
 <div class="main_banner blog_banner">
     <img src="<?php echo $thumb; ?>" alt="">
     <div class="container">
         <div class="biginner">
            <div class="breadcrumb_">
              <div class="list">
                 <span>
                     <a href="<?php echo site_url();?>/blog">Blogs</a>
                 </span>
                 <span>
                     <?php echo $title; ?>
                 </span>
              </div>
            </div>
            <div class="sub_head">
              <h3>
                 <?php echo implode(' ', $term_names); ?>
              </h3>
            </div>
            <h1>
            <?php echo $title; ?>
            </h1>
            <div class="data_detail">
              <span>
                 <?php echo $formatted_date; ?>
              </span>
              <span>
                 <?php echo $reading_time; ?> mins read
              </span>
              <div class="authores">
                 <div class="authorename"><?php echo $author_name; ?></div>
              </div>
              <div class="blogcat">
                 <span>
                 <?php echo implode(' ', $term_names_con); ?>
                 </span>
              </div>
            </div>
         </div>
     </div>
 </div>
 <div class="blog_detail_outer">
     <div class="container">
         <div class="blog_details">
             <div class="shairng">
                 <div class="sharing_icon icon">
                     <button class="collapse_icon">
                         <svg class="gravity-block-share-icons__svg" viewBox="0 0 26 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path
                                 d="M8.45333 17.0132L17.56 22.3198M17.5467 7.67984L8.45333 12.9865M25 5.6665C25 7.87564 23.2091 9.6665 21 9.6665C18.7909 9.6665 17 7.87564 17 5.6665C17 3.45736 18.7909 1.6665 21 1.6665C23.2091 1.6665 25 3.45736 25 5.6665ZM9 14.9998C9 17.209 7.20914 18.9998 5 18.9998C2.79086 18.9998 1 17.209 1 14.9998C1 12.7907 2.79086 10.9998 5 10.9998C7.20914 10.9998 9 12.7907 9 14.9998ZM25 24.3332C25 26.5423 23.2091 28.3332 21 28.3332C18.7909 28.3332 17 26.5423 17 24.3332C17 22.124 18.7909 20.3332 21 20.3332C23.2091 20.3332 25 22.124 25 24.3332Z"
                                 stroke="currentColor" stroke-width="1.77778" stroke-linecap="round" stroke-linejoin="round"></path>
                         </svg>
                     </button>
                     <div class="sharing_icon_list">
                         <ul>
                             <li>
                                 <a href="https://www.facebook.com/sharer.php?u=<?php echo $gst_the_perm; ?>" target="_blank">
                                     <svg class="gravity-block-share-icons__svg" viewBox="0 0 20 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path
                                             d="M18.6895 21.2136L19.726 14.3883H13.242V9.96117C13.242 8.09345 14.1461 6.27184 17.0502 6.27184H20V0.461165C20 0.461165 17.3242 0 14.7671 0C9.42466 0 5.93607 3.26966 5.93607 9.18641V14.3883H0V21.2136H5.93607V37.7141C7.12785 37.9032 8.34703 38 9.58904 38C10.8311 38 12.0502 37.9032 13.242 37.7141V21.2136H18.6895Z"
                                             fill="currentColor"></path>
                                     </svg>
                                 </a>
                             </li>
                             <li>
                                 <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $gst_the_perm; ?>&Title=<?php echo $title; ?>" target="_blank">
                                     <svg class="gravity-block-share-icons__svg" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path
                                             d="M37.0472 0H2.95278C2.16965 0 1.4186 0.311096 0.864849 0.864849C0.311096 1.4186 0 2.16965 0 2.95278V37.0472C0 37.8303 0.311096 38.5814 0.864849 39.1352C1.4186 39.6889 2.16965 40 2.95278 40H37.0472C37.8303 40 38.5814 39.6889 39.1352 39.1352C39.6889 38.5814 40 37.8303 40 37.0472V2.95278C40 2.16965 39.6889 1.4186 39.1352 0.864849C38.5814 0.311096 37.8303 0 37.0472 0ZM11.9222 34.075H5.90833V14.9722H11.9222V34.075ZM8.91111 12.325C8.22894 12.3212 7.56319 12.1153 6.99789 11.7335C6.43259 11.3516 5.99307 10.8109 5.7348 10.1795C5.47652 9.54808 5.41108 8.85432 5.54672 8.18576C5.68236 7.5172 6.013 6.90379 6.49693 6.42297C6.98085 5.94214 7.59636 5.61544 8.26578 5.4841C8.9352 5.35276 9.62852 5.42266 10.2583 5.68498C10.888 5.9473 11.4259 6.39028 11.8041 6.95802C12.1823 7.52576 12.3839 8.19282 12.3833 8.875C12.3898 9.33172 12.3042 9.78506 12.1317 10.208C11.9592 10.6309 11.7033 11.0148 11.3793 11.3368C11.0553 11.6587 10.6697 11.9121 10.2457 12.0819C9.82167 12.2517 9.36778 12.3344 8.91111 12.325ZM34.0889 34.0917H28.0778V23.6556C28.0778 20.5778 26.7694 19.6278 25.0806 19.6278C23.2972 19.6278 21.5472 20.9722 21.5472 23.7333V34.0917H15.5333V14.9861H21.3167V17.6333H21.3944C21.975 16.4583 24.0083 14.45 27.1111 14.45C30.4667 14.45 34.0917 16.4417 34.0917 22.275L34.0889 34.0917Z"
                                             fill="currentColor"></path>
                                     </svg>
                                 </a>
                             </li>
                             <li>
                                 <a href="https://twitter.com/share?url=<?php echo $gst_the_perm; ?>&Title=<?php echo $title; ?>">
                                     <svg class="gravity-block-share-icons__svg" viewBox="0 0 38 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path
                                             d="M34.095 7.96792C34.1105 8.31992 34.1105 8.65593 34.1105 9.00793C34.1259 19.68 26.2851 32 11.9464 32C7.7173 32 3.56539 30.736 0 28.368C0.617384 28.448 1.23477 28.48 1.85215 28.48C5.35581 28.48 8.76686 27.264 11.5297 25.008C8.19578 24.944 5.2632 22.688 4.24452 19.392C5.41755 19.632 6.62145 19.584 7.76361 19.248C4.13647 18.512 1.52803 15.1999 1.51259 11.3439C1.51259 11.3119 1.51259 11.2799 1.51259 11.2479C2.59301 11.8719 3.81235 12.2239 5.04712 12.2559C1.63607 9.88793 0.571081 5.16791 2.63932 1.4719C6.60601 6.52792 12.4403 9.58393 18.7067 9.91993C18.0739 7.11992 18.9383 4.17591 20.9602 2.1919C24.0934 -0.864105 29.0325 -0.704105 31.9959 2.54391C33.7401 2.1919 35.4224 1.5199 36.9504 0.575899C36.3639 2.44791 35.1446 4.03191 33.524 5.03991C35.0674 4.84791 36.58 4.41591 38 3.77591C36.9504 5.40792 35.6231 6.81592 34.095 7.96792Z"
                                             fill="currentColor"></path>
                                     </svg>
                                 </a>
                             </li>
                             <li>
                                 <a href="https://api.whatsapp.com/send?text=<?php echo $title; ?>">
                                     <svg class="gravity-block-share-icons__svg" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" clip-rule="evenodd"
                                             d="M3.42692 29.3917L0.695312 39.3061L10.8863 36.6446C13.6943 38.1655 16.8558 38.9734 20.0745 38.9734H20.084C30.6762 38.9734 39.3104 30.3898 39.3104 19.8385C39.3104 14.7244 37.3142 9.91451 33.6848 6.30234C30.0554 2.69017 25.2321 0.69397 20.084 0.69397C9.48232 0.69397 0.857681 9.27762 0.84813 19.829C0.84813 23.194 1.73638 26.4925 3.42692 29.3917ZM13.9898 10.6749C14.3431 10.6844 14.7347 10.7034 15.1072 11.5304C15.3459 12.0623 15.7424 13.029 16.0747 13.8392C16.3542 14.5204 16.5882 15.0911 16.645 15.1996C16.7691 15.4468 16.8455 15.7319 16.6832 16.0646C16.664 16.1039 16.6459 16.1415 16.6284 16.1777C16.4982 16.4478 16.4055 16.6402 16.1865 16.8916C16.0969 16.9946 16.0035 17.1074 15.9105 17.2199C15.7457 17.419 15.5819 17.6169 15.4415 17.7567C15.1932 18.0038 14.9353 18.27 15.2218 18.7643C15.5084 19.2586 16.5112 20.884 17.9917 22.1958C19.5832 23.6127 20.9672 24.2097 21.6668 24.5115C21.8027 24.5701 21.9128 24.6176 21.9936 24.6578C22.4902 24.905 22.7863 24.8669 23.0728 24.5342C23.3594 24.2015 24.3145 23.0894 24.6488 22.5951C24.9735 22.1008 25.3078 22.1863 25.7663 22.3479C26.2247 22.519 28.6698 23.7167 29.1664 23.9639C29.2643 24.0126 29.3559 24.0565 29.4408 24.0972C29.7867 24.2631 30.0219 24.3758 30.1216 24.5437C30.2457 24.7529 30.2457 25.7415 29.835 26.9011C29.4148 28.0608 27.3804 29.173 26.473 29.2586C26.3862 29.2667 26.2999 29.2772 26.211 29.2879C25.3706 29.3896 24.3041 29.5186 20.5036 28.0228C15.8214 26.1817 12.7304 21.614 12.1048 20.6896C12.0554 20.6165 12.0213 20.5662 12.0031 20.5418L11.9926 20.5277C11.7082 20.1472 9.96875 17.8198 9.96875 15.4183C9.96875 13.1209 11.1006 11.9247 11.6168 11.3793C11.6495 11.3447 11.6797 11.3127 11.707 11.2833C12.1655 10.789 12.7004 10.6654 13.0346 10.6654C13.3689 10.6654 13.7032 10.6654 13.9898 10.6749Z"
                                             fill="currentColor"></path>
                                     </svg>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <div class="icon">
                     <a href="#" id="printButton">
                         <svg viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path
                                 d="M23.0013 8.33317V5.93317C23.0013 4.4397 23.0013 3.69296 22.7107 3.12253C22.455 2.62076 22.047 2.21282 21.5453 1.95715C20.9748 1.6665 20.2281 1.6665 18.7346 1.6665H11.268C9.77449 1.6665 9.02776 1.6665 8.45733 1.95715C7.95556 2.21282 7.54761 2.62076 7.29195 3.12253C7.0013 3.69296 7.0013 4.4397 7.0013 5.93317V8.33317M7.0013 22.9998C5.76134 22.9998 5.14136 22.9998 4.63269 22.8635C3.25232 22.4937 2.17413 21.4155 1.80427 20.0351C1.66797 19.5264 1.66797 18.9065 1.66797 17.6665V14.7332C1.66797 12.493 1.66797 11.3729 2.10394 10.5172C2.48744 9.76456 3.09936 9.15264 3.85201 8.76914C4.70765 8.33317 5.82776 8.33317 8.06797 8.33317H21.9346C24.1748 8.33317 25.2949 8.33317 26.1506 8.76914C26.9032 9.15264 27.5152 9.76456 27.8987 10.5172C28.3346 11.3729 28.3346 12.493 28.3346 14.7332V17.6665C28.3346 18.9065 28.3346 19.5264 28.1983 20.0351C27.8285 21.4155 26.7503 22.4937 25.3699 22.8635C24.8612 22.9998 24.2413 22.9998 23.0013 22.9998M19.0013 12.9998H23.0013M11.268 28.3332H18.7346C20.2281 28.3332 20.9748 28.3332 21.5453 28.0425C22.047 27.7869 22.455 27.3789 22.7107 26.8771C23.0013 26.3067 23.0013 25.56 23.0013 24.0665V21.9332C23.0013 20.4397 23.0013 19.693 22.7107 19.1225C22.455 18.6208 22.047 18.2128 21.5453 17.9572C20.9748 17.6665 20.2281 17.6665 18.7346 17.6665H11.268C9.77449 17.6665 9.02776 17.6665 8.45733 17.9572C7.95556 18.2128 7.54761 18.6208 7.29195 19.1225C7.0013 19.693 7.0013 20.4397 7.0013 21.9332V24.0665C7.0013 25.56 7.0013 26.3067 7.29195 26.8771C7.54761 27.3789 7.95556 27.7869 8.45733 28.0425C9.02776 28.3332 9.77449 28.3332 11.268 28.3332Z"
                                 stroke="white" stroke-width="1.77778" stroke-linecap="round" stroke-linejoin="round"></path>
                         </svg>
                   </a>
                 </div>
                 <div class="icon">
                     <a href="mailto:?subject=<?php echo $title; ?>=&body=<?php echo $title; ?>">
                         <svg class="gravity-block-share-icons__svg" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M2.32813 3L12.9993 9.66667L23.6594 3" stroke="currentColor" stroke-width="1.77778" stroke-linecap="round"
                                 stroke-linejoin="round"></path>
                             <path fill-rule="evenodd" clip-rule="evenodd"
                                 d="M2.86276 20.3337C1.83183 20.3337 0.996094 19.5908 0.996094 18.6744V3.32625C0.996094 2.40987 1.83183 1.66699 2.86276 1.66699H23.1274C24.1583 1.66699 24.9941 2.40987 24.9941 3.32625V18.6744C24.9941 19.5908 24.1583 20.3337 23.1274 20.3337H2.86276Z"
                                 stroke="currentColor" stroke-width="1.77778" stroke-linecap="round" stroke-linejoin="round"></path>
                         </svg>
                     </a>
                 </div>
                 <div class="icon">
                     <a href="#">
                         <svg class="gravity-block-share-icons__svg" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path
                                 d="M14.9421 22.4846L13.0565 24.3702C10.453 26.9737 6.2319 26.9737 3.6284 24.3702C1.02491 21.7667 1.02491 17.5456 3.6284 14.9421L5.51402 13.0565M22.4846 14.9421L24.3702 13.0565C26.9737 10.453 26.9737 6.2319 24.3702 3.6284C21.7667 1.02491 17.5456 1.02491 14.9421 3.6284L13.0565 5.51402M9.33264 18.6659L18.666 9.33261"
                                 stroke="currentColor" stroke-width="1.77778" stroke-linecap="round" stroke-linejoin="round"></path>
                         </svg>
                       </a>
                 </div>
             </div>
             <div class="detail_" id="content">
                 
             <?php  
                    echo do_shortcode($post_content);
            ?>

             </div>
         </div>
     </div>
 </div>

 <?php 
get_footer();
?>

<script>
document.getElementById("printButton").addEventListener("click", function() {
    var content = document.getElementById("content").innerHTML;
    window.print(content);
});
</script>