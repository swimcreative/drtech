<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package drtech
 */

?>
<?php if( ! is_page_template('page-builder.php') ) {
	echo '</div></div>';
} ?>
	</div>
	<?php do_action('after_content'); ?>
</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
		<?php get_template_part( 'template_parts/footer/site', 'morefoot' ); ?>
		<!-- <p class="top-link">
  		<a href="#">Back to top</a>
  	</p> -->
		<?php get_template_part( 'template_parts/footer/site', 'contact' ); ?>
		<?php get_template_part( 'template_parts/footer/site', 'social' ); ?>

		</div>
		<div class="footer-bottom">
			<div class="container">
				<ul>
				<?php wp_nav_menu( array(
						'theme_location'    => 'main-menu',
						'container_class'				=> 'main-menu',
						'depth'             => 1,
						'container'         => false,
						'items_wrap' 				=> '%3$s'
				) ); ?>
			</ul>
			<br><br>

					<?php get_template_part( 'template_parts/footer/site', 'info' ); ?>
			</div>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>

<!-- Lightbox for video -->

	<div class="lightbox" style="display:none">
		<a href="#" class="close"><span></span><span></span></i></a>
		<div class="video-box">
		</div>
	</div>

	<?php global $post;



	if(isset($_GET['interest'])) : ?>

	<script>

		var $ = jQuery;

		var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
	};

		var box = $('.ginput_container_checkbox');

		var interest = decodeURIComponent(getUrlParameter('interest'));

		console.log(interest);

		var mybox = box.find('input[value*="'+interest+'"]');

		mybox.attr('checked','checked');

	</script>

	<?php
 endif; ?>

</body>
</html>
