
<div class="row media-coverage to-right-edge">
	<?php if( have_rows('highlights') ): ?>
		<div class="col-md-4">
			<h4><?php _e('Recent Highlights', 'plumvillage'); ?></h4>
			<ul class="list-unstyled highlights">
			  <?php while ( have_rows('highlights') ) : the_row(); ?>
			    <?php 
			    	$link_type = get_sub_field('link_type');
			    	$postId = get_sub_field('post');
			    	$title = ($link_type == 'internal') ? get_the_title($postId) : get_sub_field('title');
			    	$url = ($link_type == 'internal') ? get_the_permalink($postId) : get_sub_field('url');
			    	$publication = ($link_type == 'internal') ? get_field('source', $postId) : get_sub_field('publication');
			    	$image = ($link_type == 'internal') ? get_the_post_thumbnail($postId, 'landscape') : (get_sub_field('image') ? get_image_tag(get_sub_field('image'), '', '', '', 'thumbnail') : false);
			    ?>
			  	<li class="<?php if($image) : ?>has-image<?php endif; ?>">
				    <a href="<?php echo $url; ?>"<?php if($link_type == 'external') : ?> target="_blank"<?php endif; ?>>
				    	<?php echo $image; ?><b><?php echo $publication; ?>:</b> "<?php echo $title; ?>"<?php if($link_type == 'external') : ?><span class="icon icon-external-link"></span><?php endif; ?></a>
			  	</li>
			  <?php endwhile; ?>
	  	</ul>
	  </div>
	<?php endif; ?>
	<?php if( have_rows('interview') ): ?>
		<div class="col-md-4">
			<h4><?php _e('Filmed Interviews', 'plumvillage'); ?></h4>
			<ul class="list-unstyled">
			  <?php while ( have_rows('interview') ) : the_row(); ?>
			  	<li>
				    <?php 
				    	$link_type = get_sub_field('link_type');
				    	$postId = get_sub_field('post');
				    	$title = ($link_type == 'internal') ? get_the_title($postId) : get_sub_field('title');
				    	$url = ($link_type == 'internal') ? get_the_permalink($postId) : get_sub_field('url');
				    	$publication = ($link_type == 'internal') ? get_field('source', $postId) : get_sub_field('publication');
				    	$image = ($link_type == 'internal') ? get_video_thumb_from_iframe(get_field('featured_video', $postId)) : get_image_tag(get_sub_field('image'), '', '', '', 'landscape');
				    	
				    ?>
				    <a href="<?php echo $url; ?>"<?php if($link_type == 'external') : ?> target="_blank"<?php endif; ?>>
				      <span class="play-middle">
      						<?php echo $image; ?><span class="icon icon-bg icon-play"></span>
      				</span>
				    	<span class="link-text"><?php echo $title; ?><?php if($link_type == 'external') : ?><span class="icon icon-external-link"></span> <?php endif; ?></span><i> - <?php echo $publication; ?></i>
				    </a>
			  	</li>
			  <?php endwhile; ?>
	  	</ul>
	  	<p><a href="<?php the_permalink(8321); ?>#filter=.types-video"><?php _e('See all', 'plumvillage'); ?></a></p>
	  </div>
	<?php endif; ?>
	<?php if( have_rows('press_archive') ): ?>
		<div class="col-md-4">
			<h4><?php _e('Press Archive', 'plumvillage'); ?></h4>
			<ul class="list-unstyled">
			  <?php while ( have_rows('press_archive') ) : the_row(); ?>
			  	<li>
				    <?php 
				    	$link_type = get_sub_field('link_type');
				    	$postId = get_sub_field('post');
				    	$title = ($link_type == 'internal') ? get_the_title($postId) : get_sub_field('title');
				    	$url = ($link_type == 'internal') ? get_the_permalink($postId) : get_sub_field('url');
				    	$publication = ($link_type == 'internal') ? get_field('source', $postId) : get_sub_field('publication');
				    	$image = ($link_type == 'internal') ? get_the_post_thumbnail($postId, 'landscape') : get_sub_field('image');
				    ?>
				    <a href="<?php echo $url; ?>">"<?php echo $title; ?>"<?php if($link_type == 'external') : ?><span class="icon icon-external-link"></span><?php endif; ?> <i>- <?php echo $publication; ?></i></a>
			  	</li>
			  <?php endwhile; ?>
	  	</ul>
	  	<p><a href="<?php the_permalink(8321); ?>#filter=.types-pdf"><?php _e('See all', 'plumvillage'); ?></a></p>
	  </div>
	<?php endif; ?>
</div>

