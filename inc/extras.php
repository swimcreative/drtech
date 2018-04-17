<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package drtech
 */

 ///PHP HEX COLOR ADJUSTER
 function adjustBrightness($hex, $steps) {
     // Steps should be between -255 and 255. Negative = darker, positive = lighter
     $steps = max(-255, min(255, $steps));

     // Normalize into a six character long hex string
     $hex = str_replace('#', '', $hex);
     if (strlen($hex) == 3) {
         $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
     }

     // Split into three parts: R, G and B
     $color_parts = str_split($hex, 2);
     $return = '#';

     foreach ($color_parts as $color) {
         $color   = hexdec($color); // Convert to decimal
         $color   = max(0,min(255,$color + $steps)); // Adjust color
         $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
     }

     return $return;
 }

include 'acf/street-sign.php';


function page_banner() {
   if(is_page()) {
    get_template_part('template_parts/page/banner');
   }
}

add_action('before_content', 'page_banner');

function page_gallery($content) {
   ob_start();
   if(is_page_template('product-template.php')) {
    get_template_part('template_parts/page/gallery');
   }
   $pre = ob_get_clean();
   return $pre.$content;
}

//add_filter('the_content', 'page_gallery');

function page_quote() {
   if(is_page_template('product-template.php')) {
    get_template_part('template_parts/page/quote');
    get_template_part('template_parts/page/product-details');
   }
}

add_action('after_content', 'page_quote');

function home_machine() {
  global $post;
  if(is_front_page()) :
  echo '<div class="home-sidebar">';
  echo '<img src="'.get_field('sidebar_image', $post->ID)['sizes']['large'].'"/>';
  echo '<img src="'.get_stylesheet_directory_uri().'/assets/img/machine-shadow.png"/>';
  echo '</div>';
  if(get_field('show_badge', $post->ID)) :  //print_R(get_field('badge'));
  echo '<a target="_blank" href="'.get_field('badge', $post->ID)[0]['badge_link'].'"><img class="badge" src="'.get_field('badge', $post->ID)[0]['badge_image']['sizes']['large'].'"/></a>';
  endif;
  endif;
}

add_action('banner', 'home_machine');

function overview_top() {
if(is_page_template('overview-template.php')) {
  get_template_part('template_parts/page/overview-grid');
  }
}

add_action('before_content','overview_top');

function home_cheese() {
if(is_front_page()) {
  get_template_part('template_parts/page/home-cheese');
  }
}

add_action('before_content','home_cheese');


add_filter('gform_predefined_choices', 'add_predefined_choice');
/**
 * Add custom Bulk Predefined Choices to Gravity Forms for Regions
 *
 * @since  1.0.0
 *
 * @param array $choices 	Predefined choices array
 * @return array  		Amended array with our new choices added
 */
function add_predefined_choice($choices)
{
   //* (optional) Fetch the colors from somewhere in the database to avoid hard-coding

   //* Or just manually build it here

   $args = array(
    'post_type'  => 'page',
    'posts_per_page' => -1,
    'meta_query' => array(
       'relation' => 'OR',
        array(
            'key'   => '_wp_page_template',
            'value' => 'product-template.php'
        ),
        array(
            'key'   => '_wp_page_template',
            'value' => 'overview-template.php'
        )
    )
  );

  $query = new WP_Query($args);

  $choices2 = array();

  if ( $query->have_posts() ) {
	// The 2nd Loop
	while ( $query->have_posts() ) {
		$query->the_post();
    global $post;

    array_push($choices2, $post->post_title);

    // Restore original Post Data
    }
    wp_reset_postdata(); wp_reset_query();
}

   $colors['Dr Tech Products'] = $choices2;

   //* To avoid scrolling down the list when you open up the Bulk Choices,
   //* let's add it to the top of the $choices array.
   $choices = $colors + $choices;
   return $choices;
}

add_filter( 'init', 'my_custom_sizes' );

function my_custom_sizes() {

add_image_size( 'product-grid', 500, 420, true );

}
