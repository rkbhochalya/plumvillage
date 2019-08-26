<div class="menu-block-container">
	<div class="menu-block">
		<?php 
		wp_nav_menu(
			array(
				'theme_location' => 'mega-menu',
				'menu_id' => 'block-menu',
				'sub_menu' => true,
				'show_parent' => true,
				'depth' => 2,
			)
		);
	?>				
	</div>
</div>