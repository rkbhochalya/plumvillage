
<div class="<?php if($block['align'] == 'right') : ?>block-outside<?php endif; ?>">
	<div class="block text-inset <?php if(get_field('narrow') && ($block['align'] == 'right')) : ?>col-lg-4 block-narrow <?php elseif($block['align'] == 'right'): ?>col-lg-5<?php else : ?>center-with-border<?php endif; ?>  align-<?php echo $block['align']; ?>">
		<div class="block-inside text-inset-inside">
			<?php if(get_field('title')) : ?><h5><?php the_field('title'); ?></h5><?php endif; ?>
			<?php the_field('content'); ?>
		</div>
	</div>
</div>