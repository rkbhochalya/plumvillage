<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header"> 
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
		<div class="wp-block-image"><figure class="alignright"><?php the_post_thumbnail('landscape'); ?></figure></div>

		<div class="entry-meta">
					<b class="entry-date">
						<?php $startDate = new DateTime(get_field('start_date', get_the_ID(), false));?>
						<?php $endDate = new DateTime(get_field('end_date', get_the_ID(), false));?>
						<?php echo $startDate->format('M j') . ' - ' . $endDate->format('M j, Y'); ?> 
					</b>
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
					<?php 
						$terms = wp_get_post_terms(get_the_ID(), 'language');
						if(!empty($terms)){
							echo '<br />' . __('Languages', 'plumvillage') . ': ';
							$i = 0;
							foreach($terms as $term) {
								if($i != 0){
									echo ', ';
								}
								echo $term->name; 
								$i++;
							} 
						}
					?>

		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'plumvillage' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'plumvillage' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

			
</article><!-- #post-<?php the_ID(); ?> -->
