<?php $tabs = get_field('product_tabs'); ?>

<div id="product-tabs">

	<ul class="tabs">
		<?php $i = 1; foreach($tabs as $tab) : ?>

		<li data-attr="<?php echo $i; ?>" class="tab <?php if($i == 1) : echo 'active'; endif; ?>"><?php echo $tab['tab'][0]['tab_label']; ?></li>
		<?php $i++; endforeach; ?>
	</ul>

	<div class="tabs-content">
		<?php $i = 1; foreach($tabs as $tab) :
		//	print_r($tab); ?>
		<div data-attr="<?php echo $i; ?>" <?php if($i == 1) : echo 'class="active"'; endif; ?>>
			<h5 class="tab-headline"><?php echo $tab['tab'][0]['tab_headline']; ?></h5>

			<?php foreach ($tab['tab'][0]['tab_content'] as $tab) : ?>
			<div class="tab-list">
				<?php echo $tab['list']; ?>
			</div>
		<?php endforeach; ?>

		</div>

		<?php $i++; endforeach; ?>

	</div>

</div>
