<div class="block important-update align<?php echo $block['align']; if(isset($block['className'])){ echo ' ' . $block['className']; } ?>">
	<div class="block-inside">
		<p><?php _e('Important Update:', 'plumvillage'); ?> <a class="has-arrow-after" href="<?php echo get_field('link')['url']; ?>"><?php the_field('content'); ?></a></p>
	</div>
</div>
