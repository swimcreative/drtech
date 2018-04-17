<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all google fonts
 */
 class Google_Font_Dropdown_Custom_Control extends WP_Customize_Control
 {
    private $fonts = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->fonts = $this->get_fonts();
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
    {
        if(!empty($this->fonts))
        {

            ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                </label>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                    <select <?php $this->link(); ?>>
                        <option value="">Default</option>
                        <optgroup label="Web Fonts">
                          <option value="Helvetica">Helvetica</option>
                          <option value="Georgia">Georgia</option>
                          <option value="Courier">Courier</option>
                        </optgroup>
                        <optgroup label="Google Fonts">
                        <?php
                            foreach ( $this->fonts as $k => $v )
                            {
                                //printf('<option value="%s" %s>%s</option>', $k, selected($this->value(), $k, false), $v->family);
                                printf('<option value="%s" %s>%s</option>', $v->family, selected($this->value(), $k, false), $v->family);
                            }
                        ?>
                        </optgroup
                    </select>

            <?php
        }
    }

    /**
     * Get the google fonts from the API or in the cache
     *
     * @param  integer $amount
     *
     * @return String
     */
    public function get_fonts( $amount = 60 )
    {
        $selectDirectory = get_stylesheet_directory().'/inc/customizer/controls';
        $selectDirectoryInc = get_stylesheet_directory().'/inc/customizer/controls';

        $finalselectDirectory = '';

        if(is_dir($selectDirectory))
        {
            $finalselectDirectory = $selectDirectory;
        }

        if(is_dir($selectDirectoryInc))
        {
            $finalselectDirectory = $selectDirectoryInc;
        }

        $fontFile = $finalselectDirectory . '/cache/google-web-fonts.txt';

        //Total time the file will be cached in seconds, set to a week
        $cachetime = 86400 * 7;

        if(file_exists($fontFile) && $cachetime < filemtime($fontFile))
        {
            $content = json_decode(file_get_contents($fontFile));
        } else {

            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=trending&key=AIzaSyB6Lm8cX1uQPF7QGYG7JMApOa0d5F_dJdo';

            $fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );

            $fp = fopen($fontFile, 'w');
            fwrite($fp, $fontContent['body']);
            fclose($fp);

            $content = json_decode($fontContent['body']);
        }

        if($amount == 'all')
        {
            return $content->items;
        } else {
            return array_slice($content->items, 0, $amount);
        }
    }
 }
?>
