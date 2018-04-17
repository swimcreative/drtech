<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package drtech
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template_parts/post/content', get_post_format() );

			the_post_navigation();

			if( get_theme_mod('drtech_sidebar') == false ) {
				get_sidebar();
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main>
	</div>
<?php
// Add a sidebar layout
if( get_theme_mod('drtech_sidebar') == true ) {
	get_sidebar();
}
get_footer();
