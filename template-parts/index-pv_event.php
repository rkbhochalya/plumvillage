<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('index-event index-item center-with-border'); ?>>
	<div class="row">
		<?php if(has_post_thumbnail()) : ?>
		<div class="col-12"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('landscape'); ?></a></div>
		<div class="col-12">
		<?php else : ?>
		<div class="col-md-12">
		<?php endif; ?>
			<header class="entry-header"> 
					<div class="entry-meta">
						<a href="<?php the_permalink(); ?>" class="entry-date">
							<?php $startDate = new DateTime(get_field('start_date', get_the_ID(), false));?>
							<?php $endDate = new DateTime(get_field('end_date', get_the_ID(), false));?>
							<?php echo $startDate->format('M j') . ' - ' . $endDate->format('M j, Y'); ?> 
						</a>
						<?php 
							$terms = wp_get_post_terms(get_the_ID(), 'practise-centres', array('orderby' => 'parent', 'order' => 'DESC'));
							if(!empty($terms)){
								echo __('at', 'plumvillage') . ' ';
								foreach($terms as $term) {
									if($term->parent == 0){
										echo $term->name; //do something here
									}
								} 
							} else {
								echo 'On Tour';
							}
						?>
					</div><!-- .entry-meta -->
				<?php
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

				if ( 'post' === get_post_type() ) :
					?>
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php echo get_the_limited_excerpt(get_the_ID(), 50); ?></p>
			</div><!-- .entry-content -->			

			<?php if(get_comments_number() > 0) : ?>
				<footer class="entry-footer">
					<a href="<?php the_permalink(); ?>#comments"><span class="icon icon-reply"></span><?php echo get_comments_number() . ' ' . __('responses', 'plumvillage'); ?></a>			
				</footer>
			<?php endif; ?>			
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
