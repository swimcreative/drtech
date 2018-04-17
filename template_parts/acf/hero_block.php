<?php
  if (get_sub_field('hero_block_type') == 'banner') :
    the_sub_field('hero_block_text');
  else : //slider
?>

  <div class="hero-slider">

    <?php // settings
    $slides    = get_sub_field('hero_block_slider');

    foreach( $slides as $slide ):

    $slide_id = uniqid();
    $text_color = $slide['text_color'];
    $bkgd_color = $slide['background_color'];
    $link_color = $slide['link_color'];
    $bkgd_img = $slide['background_image']; ?>


    <div id="<?php echo 'slide_' . $slide_id; ?>" class="hero-slider-item">
      <div class="container">
        <div class="row">
          <div class="slide-content">
            <?php echo $slide['hero_block_slide_content'];

            if($bkgd_img) {
              $html .= '<style>';
              $html .= '#slide_' . $slide_id . '{';
              $html .= 'background-image:url(' . $bkgd_img['url'] . ');';
              $html .= '}';
              $html .= '</style>';
            }
            if( $text_color != '' || $bkgd_color != '' || $link_color != '' ) {
                $html .= '<style>';
                $html .= '#slide_' . $slide_id . '{';
                $html .= ( $text_color != '' ? 'color:' . $text_color . ';' : '');
                $html .= ( $bkgd_color != '' ? 'background-color:' . $bkgd_color . ';' : '');
                $html .= '}';
                $html .= ( $link_color != '' ? '#slide_' . $slide_id . ' a:not(.btn) { color:' . $link_color . '; } #slide_' . $slide_id . ' a:not(.btn):hover { color:' . adjustBrightness($link_color, -25) . '; }' : '');
                $html .= '</style>';
            }
            echo $html;

            ?>
          </div>
        </div>
      </div>
    </div>

    <?php endforeach; ?>

  </div>


<?php
  endif;
?>
