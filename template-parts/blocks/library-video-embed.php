<?php 

$videos = get_field('videos');

foreach ($videos as $video) { ?>

	<figure class="video-embed align<?php echo $block['align']; if(isset($block['className'])){ echo ' ' . $block['className']; } ?>"">
		
	    <?php beautifulVideoEmbed(get_field('featured_video', $video->ID), $video->ID, get_post_thumbnail_id($video), true); ?>
			<?php $monastics = get_field('many2many_video_monastics', $video->ID); ?>
			<?php $mi = 0; ?>
			<h4>
				<?php foreach ($monastics as $monastic) {
					if($mi != 0){
						echo ', ';
					}
					$mi++;
					echo get_the_title($monastic);
				} ?>
			</h4>
			<div class="index-meta"><?php echo get_the_date( 'F j, Y', $video->ID ); ?></div>
			<h2><?php echo $video->post_title; ?></h2>

	</figure>

<?php } ?>

