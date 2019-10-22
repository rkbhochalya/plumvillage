<ul class="social">
	<?php if(get_field('facebook', 'options')) : ?>
		<li><a class="link-facebook" aria-label="Plum Village Facebook" target="_blank" href="<?php the_field('facebook', 'options'); ?>"><span class="icon-facebook"></span></a></li>
	<?php endif; ?>
	<?php if(get_field('instagram', 'options')) : ?>
		<li><a class="link-instagram" aria-label="Plum Village Instagram" target="_blank" href="<?php the_field('instagram', 'options'); ?>"><span class="icon-instagram"></span></a></li>
	<?php endif; ?>
	<?php if(get_field('twitter', 'options')) : ?>
		<li><a class="link-twitter" aria-label="Plum Village Twitter" target="_blank" href="<?php the_field('twitter', 'options'); ?>"><span class="icon-twitter"></span></a></li>
	<?php endif; ?>
	<?php if(get_field('youtube', 'options')) : ?>
		<li><a class="link-youtube" aria-label="Plum Village Youtube" target="_blank" href="<?php the_field('youtube', 'options'); ?>"><span class="icon-youtube"></span></a></li>
	<?php endif; ?>
</ul>