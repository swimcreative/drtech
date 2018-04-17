<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package drtech
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'drtech' ); ?></a>

	<header id="masthead" class="site-header scroll-nav" role="banner">

		<div class="upper-header">

				<div class="container">

				<?php get_template_part( 'template_parts/header/site', 'branding' ); ?>

				</div>

		</div>

		<div class="lower-header">

		<div class="container">

		<?php get_template_part( 'template_parts/header/site', 'navigation' ); ?>

		</div>
	</div>

	</header>

	<div id="content-wrapper">

	<?php do_action('before_content'); ?>

	<div id="content" class="site-content">
		<?php if( ! is_page_template('page-builder.php') ) {
			echo '<div class="container"><div class="row">';
		} ?>
