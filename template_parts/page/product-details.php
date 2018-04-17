<?php $tabs = get_field('product_tabs');

if ($tabs) : ?>

<section id="product-details">
	<div class="container">
		<div class="product-details-wrapper">
			<?php get_template_part('template_parts/page/product-tabs'); ?>
		</div>
	</div>
	<img class="cheese" src="<?php echo get_stylesheet_directory_uri().'/assets/img/diced-shadow.png'; ?>"/>
</section>

<?php endif; ?>
