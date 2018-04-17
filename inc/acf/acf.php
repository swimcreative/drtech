<?php //hide widget titles
function my_dynamic_sidebar_params( $params ) {

 // get widget name & id
 $widget_name = $params[0]['widget_name'];
 $widget_id = $params[0]['widget_id'];

 $hide = get_field('hide_widget_title','widget_' . $widget_id);
 if ( $hide ) {
     $params[0]['before_title'] = '<div class="sr-only">';
     $params[0]['after_title'] = '</div>';
 }

 if( $widget_name == 'Contact Info' ) {
   $logo = get_field('show_custom_logo','widget_' . $widget_id);
   if($logo) {
     $params[0]['after_title'] = $params[0]['after_title'] . get_custom_logo() . '<br>';
   }
 }

 // return
 return $params;

}

add_filter('dynamic_sidebar_params', 'my_dynamic_sidebar_params');

//add hide widget title field

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_585ae0406c903',
	'title' => 'Hide Widget Titles',
	'fields' => array (
		array (
			'key' => 'field_585ae04ee0206',
			'label' => '',
			'name' => 'hide_widget_title',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 0,
			'message' => 'Hide widget title?',
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'widget',
				'operator' => '==',
				'value' => 'all',
			),
		),
	),
	'menu_order' => 10,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;

// PAGE BUILDER
function drtech_block( $layout, $block_id ) {
  if(!get_sub_field('block_settings_is_active'))
    return;

 // WIDGET APPEARANCE
 $text_color = get_sub_field('block_appearance_text_color');
 $bkgd_color = get_sub_field('block_appearance_background_color');
 $link_color = get_sub_field('block_appearance_link_color');
 $bkgd_type  = get_sub_field('block_appearance_background_type');
 $bkgd_img   = get_sub_field('block_appearance_background_image');
 $bkgd_vid   = get_sub_field('block_appearance_background_video');
 $bkgd_style = get_sub_field('block_appearance_background_style');
 $size       = ( get_sub_field('block_appearance_size') == '' ? 'sm' : get_sub_field('block_appearance_size') );
 $fullwidth  = ( get_sub_field('block_appearance_fullwidth_content') ? 'block_fullwidth' : '');
 $content_width  = ( get_sub_field('block_appearance_content_width') ? get_sub_field('block_appearance_content_width') : 'normal' );

 //background image classes
 $bkgd_class;
 if( $bkgd_type == 'image' ) {
   // background style
   switch ($bkgd_style) {
    case 'fixed':
        $bkgd_class = 'bkgd_img bkgd_fixed';
        break;
    case 'tiled':
        $bkgd_class = 'bkgd_img bkgd_tiled';
        break;
    default:
        $bkgd_class = 'bkgd_img bkgd_normal';
        break;
   }
}

//block id & classes
$id         = get_sub_field('block_settings_id');
$classes    = 'block block_' . $block_id . ' ' . 'block_size_' . $size . ' ' . get_sub_field('block_settings_classes') . ' ' . $layout . ' ' . $bkgd_class . ' block_' . $content_width;


//main output
$html;

 ob_start(); ?>

 <section<?php if( $id ) { echo " id='$id'"; } ?> class="<?php echo $classes; ?>">
  <div class="block-inner container">
    <div class="row">
      <div class="block-content">
        <?php get_template_part( 'template_parts/acf/' . $layout ); ?>
      </div>
    </div>
  </div>
 </section>

 <?php $html .= ob_get_clean();

 //add background image, video and/or parallax
 if ( $bkgd_type == 'image' ) :
   if( get_sub_field('block_appearance_enable_parallax') ) {

     $html = str_replace( 'class="block ' , 'class="block drtech-parallax ' , $html );
     $html = str_replace( '</section>', '<div class="parallax-background"></div></section>', $html );

     $html .= '<style>';
     $html .= '.block_' . $block_id . ' .parallax-background {';
     $html .= 'background-image:url(' . $bkgd_img['url'] . ');';
     $html .= '}';
     $html .= '</style>';
   } else {
     $html .= '<style>';
     $html .= '.block_' . $block_id . '{';
     $html .= 'background-image:url(' . $bkgd_img['url'] . ');';
     $html .= '}';
     $html .= '</style>';
   }
 elseif ( $bkgd_type == 'video' ) :
      $html = str_replace( 'class="block ' , 'data-vid="' . $bkgd_vid . '" class="block video-background ' , $html );
 endif;


 if( $text_color != '' || $bkgd_color != '' || $link_color != '' ) {
     $html .= '<style>';
     $html .= '.block_' . $block_id . '{';
     $html .= ( $text_color != '' ? 'color:' . $text_color . ';' : '');
     $html .= ( $bkgd_color != '' ? 'background-color:' . $bkgd_color . ';' : '');
     $html .= '}';
     $html .= ( $link_color != '' ? '.block_' . $block_id . ' a:not(.btn) { color:' . $link_color . '; } .block_' . $block_id . ' a:not(.btn):hover { color:' . adjustBrightness($link_color, -25) . '; }' : '');
     $html .= '</style>';
 }

 print $html;

}

//ACF Google Map Key
function my_acf_google_map_api( $api ){

	$api['key'] = 'AIzaSyD2JXGb9Yd04ByPErUXKcmUOosRnPMStFo';

	return $api;

}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

//FLEXIBLE CONTENT UI LABELS
function blocks_layout_title( $title, $field, $layout, $i ) {

	// store and remove layout title from text
  $default = $title;
	$title = '';

	if( $label = get_sub_field('block_settings_admin_label') ) {

		$title .= '<span style="color:#82878c;">' . $default . ': </span>' . $label;

	} else {
    $title .= $default;
  }

  if( !$label = get_sub_field('block_settings_is_active') ) {
    $title .= ' <span style="display: inline-block; padding: 2px 4px; border-radius: 3px; background-color:#FDBC40; color: white; font-weight:bold;">Inactive</span>';
  }

	// return
	return $title;

}

// name
add_filter('acf/fields/flexible_content/layout_title/name=blocks', 'blocks_layout_title', 10, 4);
