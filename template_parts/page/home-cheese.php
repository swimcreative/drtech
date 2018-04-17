<?php
$cats = get_field('product_categories');
if($cats) : ?>
<section id="home-cheese">
	<div class="container">
		<div class="item-wrapper">
			<?php $header = get_field('product_category_header');
			if($header) : ?>
		 <h2><big><?php echo $header; ?></big></h2>
	 	<?php endif; ?>

		 <?php foreach($cats as $cat) : ?>
		 <div class="item">
			 <a href="<?php echo get_the_permalink($cat['category_page']->ID); ?>">
			 <h3><?php echo get_the_title($cat['category_page']->ID); ?></h3>
			 <p><?php echo $cat['category_short_description']; ?></p>
			 	<div><img class="cheese" src="<?php echo $cat['category_image']['sizes']['medium']; ?>"/></div>
			</a>
		 </div>

	 	<?php endforeach; ?>

	 	</div>
	</div>
</section>

<?php endif; ?>
