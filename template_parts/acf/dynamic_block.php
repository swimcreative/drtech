

        <?php the_sub_field('dynamic_block_description');

        // settings
        $type      = get_sub_field('dynamic_block_type');
        $display   = get_sub_field('dynamic_block_display');
        $thumbnail = get_sub_field('dynamic_block_thumbnail');
        $meta      = get_sub_field('dynamic_block_meta');
        $items     = get_sub_field('dynamic_block_items');

        $args = array(
         	'post_type' => $type
         );

        $html = '';
         // The Query
        $the_query = new WP_Query( $args );
        $count = $the_query->found_posts;

        // The Loop
        if ( $the_query->have_posts() ) {
          $html .= ( $display == 'carousel' ? '<div class="dynamic-block dynamic-block-' . $display . '">' : '<div class="dynamic-block dynamic-block-' . $display . '">' );
          // add grid rows
          $html .= ( $display == 'grid' ? '<div class="dynamic-block-row">' : '');

          $row = 1;
        	while ( $the_query->have_posts() ) {
        		$the_query->the_post();

            // item image
            $bkgd_img = ( $thumbnail == 'background' ? ' style="background-image: url(' . get_the_post_thumbnail_url() . '"' : '' );
            $html .= '<article class="hentry dynamic-block-item dynamic-block-col-' . $items . '"' . $bkgd_img . '>';
            $html .= ( $thumbnail == 'square' ? '<div class="dynamic-block-item-img square">' . get_the_post_thumbnail( $post_id, 'thumbnail') . '</div>' : '' );
            $html .= ( $thumbnail == 'large' ? '<div class="dynamic-block-item-img large">' . get_the_post_thumbnail( $post_id, 'large') . '</div>' : '' );
            $html .= '<div class="dynamic-block-item-text">';
            $html .= '<header class="entry-header"><h3 class="entry-title">' . get_the_title() . '</h3></header>';

            if(!empty($meta)) {
              foreach($meta as $m) {
                $html .= ( $m == 'author' ? '<span class="entry-author entry-meta">' . get_the_author_link() . '</span>' : '');
                $html .= ( $m == 'category' ? '<span class="entry-categories entry-meta">' . get_the_category_list(',') . '</span>' : '');
                $html .= ( $m == 'date' ? '<span class="entry-date entry-meta">' . get_the_date() . '</span>' : ''); //TODO: IF EVENT OR SIMILAR POST TYPE USE CUSTOM DATE FIELD
                $html .= ( $m == 'excerpt' ? '<div class="entry-descript entry-meta">' . get_the_excerpt() . '</div>' : '');
              }
            }

            $html .= '<footer class="entry-footer"><a class="btn" href="' . get_the_permalink() . '"><strong>Read More &raquo;</strong></a></footer>';
            $html .= '</div>';// ..item-text
            $html .= '</article>';// ..item

            // close/add grid rows
            $html .= ( $display == 'grid' && $row > 1 && $row < $count && $row % $items == 0 ? '</div><div class="dynamic-block-row">' : '');

            $row++;
        	}
          // close grid rows
          $html .= ( $display == 'grid' ? '</div>' : ''); //..row
          $html .= '</div>';// ..dynamic-block..


        	/* Restore original Post Data */
        	wp_reset_postdata();
        } else {
        	$html = 'No posts found.';
        }

        echo $html;

        ?>
