<ul class="social">
	<?php if(get_field('facebook', 'options')) : ?>
		<li><a class="link-facebook" target="_blank" href="<?php the_field('facebook', 'options'); ?>"><span class="icon-facebook"></span></a></li>
	<?php endif; ?>
	<?php if(get_field('instagram', 'options')) : ?>
		<li><a class="link-instagram" target="_blank" href="<?php the_field('instagram', 'options'); ?>"><span class="icon-instagram"></span></a></li>
	<?php endif; ?>
	<?php if(get_field('twitter', 'options')) : ?>
		<li><a class="link-twitter" target="_blank" href="<?php the_field('twitter', 'options'); ?>"><span class="icon-twitter"></span></a></li>
	<?php endif; ?>
	<?php if(get_field('youtube', 'options')) : ?>
		<li><a class="link-youtube" target="_blank" href="<?php the_field('youtube', 'options'); ?>"><span class="icon-youtube"></span></a></li>
	<?php endif; ?>
</ul>