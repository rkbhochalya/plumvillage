<?php

	// WP_Query arguments
	$args = array (
		'post_type'              => array( 'practice_centre' ),
		'post_status'            => array( 'publish' ),
		'nopaging'               => true,
		'order'                  => 'ASC',
		'post_parent'						 => 0,
		'orderby'                => 'menu_order',
		'posts_per_page' 				 => 100,
		'meta_query'=>array(
			'compare' => 'AND',
			 array(
			    'key' => 'hide_in_overview',
			    'compare' => 'EXISTS',
			 ),
			 array(
			    'key' => 'hide_in_overview',
			    'value' => true,
			    'compare' => '!='
			 )
			)				
	);

	// The Query
	$practice_centres = new WP_Query( $args );

	//The Loop
	if ($practice_centres->have_posts() ) {
		while ( $practice_centres->have_posts() ) {
			$practice_centres->the_post(); ?>
			<div class="<?php echo $col; ?> address" itemscope itemtype="http://schema.org/PostalAddress">
	    	<p class="address-name">
	    		<b>
	    			<?php if (get_field('url')) : ?><a href="<?php the_field('url'); ?>"><?php endif; ?>
	    				<?php the_title() ?>
	    			<?php if (get_field('url')) : ?></a><?php endif; ?>
	    		</b>
	    	</p>
	    	<p class="address-address"><?php if(get_field('address_street')) : ?>
	    		<span itemprop="streetAddress"><?php the_field('address_street'); ?></span>
	    	<?php endif;
	    	if(get_field('address_street_2')) : ?>
	    		<span itemprop="streetAddress"><?php the_field('address_street_2');?></span>
		    	<br />
	    	<?php endif; ?>
	    	<br />
	    	<?php if(get_field('address_postcode')) : ?>
		    	<span itemprop="postalCode"><?php the_field('address_postcode');?></span>
		    <?php endif;
	    	if(get_field('address_city')) : ?>
		    	<span itemprop="addressLocality"><?php the_field('address_city');?></span>
		    <?php endif; ?>
	    	<?php if(get_field('address_state')) : ?>
		    	<span itemprop="addressRegion"><?php the_field('address_state');?></span>
			    <br />
		    <?php endif;
	    	if(get_field('address_country')) : ?>
		    	<span itemprop="addressCountry"><?php the_field('address_country');?></span>
		    <?php endif; ?>
		  	</p>
    	</div>
		<?php }
	}
wp_reset_postdata();
