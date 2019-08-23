<div class="<?php if($block['align'] == 'right') : ?>block-outside<?php endif; ?>">
	<figure class="video-embed <?php if($block['align'] == 'right') : ?>col-lg-5 align-right<?php else : ?>center-with-border<?php endif; ?>"">

	    <?php beautifulVideoEmbed(get_field('video'), $block['id'], get_field('image'), true); ?>
	    <?php if(get_field('caption')) : ?>
	        <figcaption><?php the_field('caption'); ?></figcaption>
	    <?php endif; ?>

	</figure>
</div>