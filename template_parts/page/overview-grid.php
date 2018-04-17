<section id="overview-grid">
	<div class="container">
		<div class="item-wrapper">
		<?php

			global $post;
			$wp_query = new WP_Query();
			$sub_pages = $wp_query->query(array('orderby' => 'title', 'post_type' => 'page', 'depth' => 1, 'posts_per_page' => '-1'));
			$pages = get_page_children($post->ID, $sub_pages);
			//print_R($pages);
			$html = '';
			foreach($pages as $page) {
				$html .= '<div class="item">';
				$html .= '<a href="'.get_the_permalink($page->ID).'">';
				if(get_the_post_thumbnail($page->ID)) :
				$html .= get_the_post_thumbnail($page->ID, 'medium');
				else:

					$images = array();

					$gallery = get_field('gallery', $page->ID);

					if($gallery) :

					foreach($gallery as $image) :

						if($image['acf_fc_layout'] == 'image') {
							$images[] = $image['gallery_image']['ID'];
						}

				 	endforeach; endif;

				 	//print_R($images);

					$image = array_shift($images);

					if($image) :

						$pic = wp_get_attachment_image_url($image, 'product-grid');

						$html .= '<img src="'.$pic.'"/>';

						else :

					$html .= '<img src="'.get_stylesheet_directory_uri().'/assets/img/machine.png'.'"/>';

					endif;
				endif;
				$html .= '</a>';
				$html .= '<a href="'.get_the_permalink($page->ID).'"><h5>'.$page->post_title.'</h5></a>';
				$html .= '<a href="'.get_the_permalink($page->ID).'" class="btn">Learn More</a>';
				$html .= '</div>';
			}
			echo $html;
			wp_reset_query();
		?>

		</div>
	</div>
</section>
