<?php if ( has_nav_menu( 'social' ) ) : ?>
	<div class="site-social">
		<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'social',
					'menu_class'     => 'social-links',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			?>
		</nav><!-- .social-navigation -->
	</div>
<?php endif; ?>
