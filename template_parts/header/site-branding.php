
<div class="site-branding">
	<?php the_custom_logo(); ?>
	 <?php if ( has_custom_logo() ) : ?>
			<span class="site-title screen-reader-text"><?php bloginfo( 'name' ); ?></span>
		<?php elseif ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif;

	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) : ?>
		<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
	<?php
endif; ?>
</div><!-- .site-branding -->

<div class="secondary-nav">
	<ul>
		<?php
		wp_nav_menu( array(
				'theme_location'    => 'secondary-menu',
				'container_class'				=> 'main-menu',
				'depth'             => 2,
				'container'         => false,
				'items_wrap' 				=> '%3$s'
		) );
		 echo '<li id="site-search" class="search-toggle">' . get_search_form( false ) . '</li>'; ?>
		 		<li><a href="/quote" class="btn">Get A Quote</a></li>
				<li><button class="menu-toggle animated" aria-expanded="false" >
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'drtech' ); ?></span>
					&#9776;
				</button></li>
	</ul>
</div>
