<?php
	$practise_centres = get_terms( array( 
		'taxonomy' => 'practise-centres',
		'hide_empty' => false,
		'parent' => 0
	) );
	if  ($practise_centres) {
		foreach ($practise_centres  as $practise_centre ) { ?>
			<div class="<?php echo $col; ?> address" itemscope itemtype="http://schema.org/PostalAddress">
	    	<p class="address-name">
	    		<b>
	    			<?php if (get_field('url', $practise_centre)) : ?><a href="<?php the_field('url', $practise_centre); ?>"><?php endif; ?>
	    				<?php echo $practise_centre->name; ?>
	    			<?php if (get_field('url', $practise_centre)) : ?></a><?php endif; ?>
	    		</b>
	    	</p>
	    	<p class="address-address"><?php if(get_field('address_street', $practise_centre)) : ?>
	    		<span itemprop="streetAddress"><?php the_field('address_street', $practise_centre); ?></span>
	    	<?php endif;
	    	if(get_field('address_street_2', $practise_centre)) : ?>
	    		<span itemprop="streetAddress"><?php the_field('address_street_2', $practise_centre);?></span>
		    	<br />
	    	<?php endif; ?>
	    	<?php if(get_field('address_postcode', $practise_centre)) : ?>
		    	<span itemprop="postalCode"><?php the_field('address_postcode', $practise_centre);?></span>
		    <?php endif;
	    	if(get_field('address_city', $practise_centre)) : ?>
		    	<span itemprop="addressLocality"><?php the_field('address_city', $practise_centre);?></span>
			    <br />
		    <?php endif; ?>
	    	<?php if(get_field('address_state', $practise_centre)) : ?>
		    	<span itemprop="addressRegion"><?php the_field('address_state', $practise_centre);?></span>
			    <br />
		    <?php endif;
	    	if(get_field('address_country', $practise_centre)) : ?>
		    	<span itemprop="addressCountry"><?php the_field('address_country', $practise_centre);?></span>
		    <?php endif; ?>
		  	</p>
    	</div>
	  <?php }
	} 