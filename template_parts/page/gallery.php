<?php

$gallery = get_field('gallery');
if( have_rows('gallery')) : ?>

<section id="gallery">
	<div class="container">
		<div class="gallery-content-wrapper">

		<?php
		$i = 1;

    while ( have_rows('gallery') ) : the_row();

		if($i == 1) : ?>

		<div class="main-content">

			<?php if( get_row_layout() == 'image' ): ?>
			<li class="image main item"><a index="<?php echo $i; ?>" href="<?php echo get_sub_field('gallery_image')['url']; ?> ?>"><img src="<?php echo get_sub_field('gallery_image')['sizes']['large']; ?>"/></a></li>
			<?php else : ?>
			<?php $video_url = get_sub_field('gallery_video', false, false);
			preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video_url, $matches);
			$id = $matches[1];
			 ?>
			<li class="video main item"><a index="<?php echo $i; ?>"href="#" data-attr="<?php echo $id; ?>"><img src="<?php echo 'https://img.youtube.com/vi/'.$id.'/hqdefault.jpg' ?>"/></a></li>

			<?php endif; ?>
		</div>

		<?php $i++; endif; endwhile; ?>

		<ul class="select-content">

			<?php
			$i = 1; while ( have_rows('gallery') ) : the_row();
			 if($i > 1) : ?>
			 <?php if( get_row_layout() == 'video' ): ?>
				<?php $video_url = get_sub_field('gallery_video', false, false);
				preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video_url, $matches);
				$id = $matches[1];
				?>
			<li class="video item"><a index="<?php echo $i; ?>"href="#" data-attr="<?php echo $id; ?>"><img src="<?php echo 'https://img.youtube.com/vi/'.$id.'/default.jpg' ?>"/></a></li>
			<?php else : ?>
			<li class="image item"><a index="<?php echo $i; ?>" href="<?php echo get_sub_field('gallery_image')['url'];  ; ?>"><img src="<?php echo get_sub_field('gallery_image')['sizes']['thumbnail'];  ?>"/></a></li>
		<?php endif; endif; $i++; endwhile; ?>

		</ul>

	</div>
	</div>
</section>

<?php endif; ?>
