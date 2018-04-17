<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package drtech
 */

/**
 * Assign the drtech version to a var
 */
$theme            = wp_get_theme();
$drtech_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
 $content_width = 1280; /* pixels */
}

$drtech = (object) array(
	'version' => $drtech_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-theme.php',
	'customizer' => require 'inc/customizer/class-customizer.php',
  'cpt'        => require 'inc/class-cpt.php',
);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load custom widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load custom shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load Jetpack compatibility file.
 */
if ( class_exists( 'Jetpack' ) ) {
	$drtech->jetpack = require 'inc/jetpack/class-jetpack.php';
}

/**
 * Load acf compatibility file.
 */
if ( class_exists( 'acf' ) ) {
	$drtech->acf = require 'inc/acf/acf.php';
}


// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

//add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Or just remove them all in one line
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );
