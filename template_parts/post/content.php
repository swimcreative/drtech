<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package drtech
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header" <?php if ( is_single() && has_post_thumbnail() ) : ?> style="background-image: url(<?php the_post_thumbnail_url(); ?>); height: 60vh;"<?php endif; ?>>
		<?php
			if ( is_single() ) {

				//show category
				$category = get_the_category();
				if($category)
					echo '<a class="cat-link" href="' . get_category_link( $category[0]->term_id) . '">' . $category[0]->cat_name . '</a>';

				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {

				if ( '' != get_the_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					</div>
				<?php endif;
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<?php get_template_part( 'template_parts/post/content', 'meta' ); ?>
		<?php
		endif; ?>
	</header>
	<div class="entry-content">
		<?php

		//beer check
		if ( 'beer' === get_post_type() ) :
			$e .= '<span class="abv">ABV: ' . get_field('abv') . '%</span> &nbsp; | &nbsp; ';
			$e .= '<span class="ibu">IBU: ' . get_field('ibu') . '</span> &nbsp; | &nbsp; ';
			$e .= '<span class="srm">SRM: ' . get_field('srm') . '</span>';
			$e .= '<hr>';

			echo $e;
		endif;
		
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'drtech' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'drtech' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php get_template_part( 'template_parts/post/content', 'footer' ); ?>
</article><!-- #post-## -->
