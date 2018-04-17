        <?php the_sub_field('toggle_block_description');

        // settings
        $toggles    = get_sub_field('toggle_block_content');
        $display   = get_sub_field('toggle_block_display');

        $html = '';

        // The Loop
        if( $toggles ):
          $html .= ( $display != '' ? '<ul class="toggle-block toggle-block-' . $display . '">' : '<ul class="toggle-block toggle-block-expander">' );

          $row = 1;
        	foreach( $toggles as $toggle ):
            $html .= '<li class="toggle-block-item">';

            $html .= ( $row == 1 && $display == 'tabs' ? '<a href="javascript:void(0)" class="is-active tab-link"><span>' . $toggle['toggle_label'] . '</span></a>' : '<a href="javascript:void(0)" class="tab-link"><span>' . $toggle['toggle_label'] . '</span></a>' );
            $html .= '<div class="tab-content">' . $toggle['toggle_panel'] . '</div>';

            $html .= '</li>';// ..item


            $row++;
        	endforeach;

          $html .= '</ul>';// ..toggle-block..

        else :
        	//$html = 'No posts found.';
        endif;

        echo $html;

        ?>
