<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package drtech
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header" <?php if ( has_post_thumbnail() ) : ?> style="background-image: url(<?php the_post_thumbnail_url(); ?>); height: 60vh;"<?php endif; ?>>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<div class="entry-content">
		<?php
		if(is_page_template('product-template.php')) :
			get_template_part('template_parts/page/gallery');
			global $post;
			$content = get_the_content();
			remove_filter( $content, 'page_gallery' );
			if(strpos($content, '<span id="more-'.$post->ID.'"></span>')) :
			$split = explode('<span id="more-'.$post->ID.'"></span>', $content, 2);
			$after = apply_filters('the_content', $split[1]);
			$before = apply_filters('the_content', $split[0]).'<a class="read-more" href="#">Read More <span>▼</span></a>';

			echo $before;
			echo '<div class="overflow-content">';
			echo $after;
			echo '</div>';

		 else :

			the_content();

		endif;
		else :

			the_content();

		endif;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'drtech' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'drtech' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer>
</article><!-- #post-## -->
