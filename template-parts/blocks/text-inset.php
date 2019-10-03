<div class="block text-inset <?php if(get_field('narrow') && ($block['align'] == 'right')) : ?>block-narrow<?php endif; ?>  align<?php echo $block['align']; ?>">
	<div class="block-inside text-inset-inside">
		<?php if(get_field('title')) : ?><h5><?php the_field('title'); ?></h5><?php endif; ?>
		<?php the_field('content'); ?>
	</div>
</div>
