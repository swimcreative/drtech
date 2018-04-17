
        <?php the_sub_field('media_block_description');

        // settings
        $images    = get_sub_field('media_block_gallery');
        $display   = get_sub_field('media_block_display');
        $items     = get_sub_field('media_block_items');

        $html = '';

        // The Loop
        if( $images ):
          //$html .= ( $display == 'carousel' ? '<div class="media-block media-block-' . $display . '" data-flickity=\'{ "cellAlign": "left", "contain": true }\'>' : '<div class="media-block media-block-' . $display . '">' );
          $html .= ( $display == 'carousel' ? '<div class="media-block media-block-' . $display . ' media-block-slide-' . $items . '">' : '<div class="media-block media-block-' . $display . ' media-block-slide-' . $items . '">' );
          // add grid rows
          $html .= ( $display == 'grid' ? '<div class="media-block-row">' : '');

          $row = 1;
        	foreach( $images as $image ):
            //var_dump($image);

            // item image
            $html .= '<div class="media-block-item media-block-col-' . $items . '">';
            $html .= '<a href="javascript:void(0)" data-img="' . $image['url'] . '" data-width="' . $image['width'] . '" data-height="' . $image['height'] . '">';
            $html .= '<img src="' . $image['sizes']['large'] . '" width="' . $image['sizes'][ 'large-width' ] . '" height="' . $image['sizes'][ 'large-height' ] . '" alt="' . $image['alt'] .'" />';
            $html .= '</a>';// ..item
            $html .= '</div>';

            // close/add grid rows
            $html .= ( $display == 'grid' && $row > 1 && $row % $items == 0 ? '</div><div class="media-block-row">' : '');

            $row++;
        	endforeach;
          // close grid rows
          $html .= ( $display == 'grid' ? '</div>' : ''); //..row
          $html .= '</div>';// ..media-block..

        else :
        	$html = 'No posts found.';
        endif;

        echo $html;

        ?>

    <div class="block-lightbox close"><a id="close" href="#"><span>+</span></a></div>
