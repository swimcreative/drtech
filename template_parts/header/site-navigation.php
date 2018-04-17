

<nav id="primary-nav" class="site-navigation" role="navigation">
		<ul class="main-menu menu">
		<?php
				wp_nav_menu( array(
						'theme_location'    => 'main-menu',
						'container_class'				=> 'main-menu',
						'depth'             => 2,
						'container'         => false,
						'items_wrap' 				=> '%3$s'
				) );
					?>

					<ul class="secondary-menu">
						<?php

						wp_nav_menu( array(
								'theme_location'    => 'secondary-menu',
								'container_class'				=> 'secondary-menu',
								'depth'             => 2,
								'container'         => false,
								'items_wrap' 				=> '%3$s'
						) );

						?>

					</ul>

					<ul>
						<?php
				//add search form search-toggle
				echo '<li id="site-search" class="search-toggle">' . get_search_form( false ) . '</li>';
				?>
			</ul>


	</ul>
</nav><!-- #site-navigation -->
