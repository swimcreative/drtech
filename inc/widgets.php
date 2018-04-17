<?php

//CONTACT INFO
class drtech_contact_info extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Contact Info' );
	}

	function widget( $args, $instance ) {

    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? 'Contact Info' : apply_filters('widget_title', $instance['title']);

    if ($title === ' ') {
      //do nothing
	} else {
		echo $before_title . $title . $after_title;
	}

  echo '<span class="contact-info-title">' . get_bloginfo('name') . '</span><br>';
	echo '<span class="contact-info-address">' . nl2br(get_theme_mod('drtech_address')) . '</span><br>';
	echo '<span class="contact-info-phone"><abbr title="Phone Number">PH</abbr>: ' . get_theme_mod('drtech_phone') . '</span><br>';
	echo '<span class="contact-info-email"><abbr title="Email Address">E</abbr>: ' . get_theme_mod('drtech_email') . '</span>';

	echo $after_widget;

    }

	function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

	 function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	  }
}


function drtech_register_widgets() {
	register_widget( 'drtech_contact_info' );
}

add_action( 'widgets_init', 'drtech_register_widgets' );


// SECONDARY NAV
function sawtooth_side_nav() {
	$string = '';
	global $post;
	$current = get_the_title();
  $link = get_the_permalink($post->ID);

	if ( is_page() && $post->post_parent )

	    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );
	else
	    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );

	if ( $childpages ) {

	    $string = '<h2 class="widget-title">'.$current.'</h2><ul>' . $childpages . '</ul>';

	} else {

	$children = get_pages( array( 'child_of' => $post->ID ) );

   if ( is_page() && ($post->post_parent || count( $children ) > 0  )) {

			$parent = wp_get_post_parent_id( $post->ID );
			$link = get_the_permalink($parent);
			$parent = get_the_title($parent);
			$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0&depth=1' );

			$string = '<h2 class="widget-title"><a href="'.$link.'">'.$parent.'</a></h2><ul>' . $childpages . '</ul>';

		} else {

				// nada, hide empty widget with CSS

		}
	}

	echo $string;

}

//SIDE NAV WIDGET
class sawtooth_sidenav extends WP_Widget {

	function  sawtooth_sidenav() {
		// Instantiate the parent object
		parent::__construct( false, 'Side Navigation' );
	}

	function widget( $args, $instance ) {

    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? 'Side Navigation' : apply_filters('widget_title', $instance['title']);

    if ($title === ' ') {
      //do nothing
	} else {
		//echo $before_title . $title . $after_title;
	}

  sawtooth_side_nav();

	echo $after_widget;

    }

	function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

	 function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	  }
}


function sawtooth_register_widgets() {
	register_widget( 'sawtooth_sidenav' );
}

add_action( 'widgets_init', 'sawtooth_register_widgets' );
