<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Plum_Village
 */

require_once( ABSPATH . 'wp-admin/includes/media.php' );

$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

if(!$isAjax) {
	get_header();
} 
?>
	
	<div class="container audio-content">
		<div class="row justify-content-center align-items-center center-logo">
			<div class="col-md-9 col-lg-7 col-xxl-6">

				<?php
					while ( have_posts() ) :
						the_post();
          	$audioFile = get_field('audio_file');
				?>

					<h1><?php the_title(); ?></h1>
					<div class="audio-player audio-player-wrapper">
              <div class="buttons">
                  <a class="play-btn link-with-icon sunny-link" href="#" aria-label="<?php _e('Play Audio', 'plumvillage'); ?> - <?php the_sub_field('title'); ?>">
                      <span class="icon icon-play-small icon-sun"></span>
                      <span class="icon icon-pauze"></span>
                  </a>
              </div>
              <audio class="player" id="hyperplayer" style="z-index: 5000000; position:relative;" src="<?php echo $audioFile['url']; ?>" type="<?php echo $audioFile['mime_type']; ?>" controls></audio>
					    <span class="seek-obj-container">
                <progress class="seek-obj" value="0" max="1"></progress>
                <small class="start-time">00:00</small>
                <small class="end-time"><?php echo wp_read_audio_metadata(get_attached_file(attachment_url_to_postid($audioFile['url'])))['length_formatted']; ?></small>
              </span>
						</div>
						<?php the_content(); ?>

				<?php 
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>
		</div><!-- #primary -->
	</div>

<?php
if(!$isAjax){
	get_footer();
}