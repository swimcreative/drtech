<div class="site-contact">
	<?php
  if(has_custom_logo()) {
  	echo get_custom_logo() . '<br>';
  } else {
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home"><span class="contact-info-title">' . get_bloginfo('name') . '</span></a><br>';
  }

	$address = nl2br(get_theme_mod('drtech_address'));
	if ($address != '') {
		echo '<span class="contact-info-address">' . $address . '</span><br>';
	}
	if (get_theme_mod('drtech_phone') != '') {
		echo '<span class="contact-info-phone"><abbr title="Phone Number">PH</abbr>: <a href="tel:' . get_theme_mod('drtech_phone'). '">' . get_theme_mod('drtech_phone') . '</a></span><br>';
	}
	if (get_theme_mod('drtech_email') !='' ) {
		echo '<span class="contact-info-email"><abbr title="Email Address">E</abbr>: <a href="mailto:' . get_theme_mod('drtech_email'). '">' . get_theme_mod('drtech_email') . '</a></span>';
	}
	?>
</div><!-- .site-contact -->

<?php

//GET ADDRESS LINE BY LINE
/*
$address = '';
$lines = explode("\n", get_theme_mod('drtech_address'));
$i = 1;
foreach ($lines as $line) {
  if($i == 1) {
    $address .= '<span>'.$line.'</span>';
  } else {
    $address .= '<br><span>'.$line.'</span>';
  }
  $i++;
}
*/

?>
