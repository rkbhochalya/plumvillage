<?php require_once( ABSPATH . 'wp-admin/includes/media.php' ); ?>
<?php if( have_rows('audio_items') ): ?>
    <figure class="block block-audio align<?php echo $block['align']; if(isset($block['className'])){ echo ' ' . $block['className']; } ?>"">
        <div class="block-inside">
        <?php while ( have_rows('audio_items') ) : the_row(); ?>            
                <div class="audio-content audio-player-wrapper">
                    <?php $audioItem = get_sub_field('audio_item'); ?>
                    <?php $audioFile = get_field('audio_file', $audioItem->ID); ?>
                    <h5><?php echo $audioItem->post_title; ?> <small class="end-time"><?php echo wp_read_audio_metadata(get_attached_file(attachment_url_to_postid($audioFile['url'])))['length_formatted']; ?></small></h5>
                    <p><?php echo $audioItem->post_excerpt; ?></p>
                    <div class="buttons">
                        <a class="play-btn link-with-icon sunny-link fancybox-open-audio" href="<?php the_permalink($audioItem->ID); ?>" aria-label="<?php _e('Play Audio', 'plumvillage'); ?> - <?php the_sub_field('title'); ?>">
                            <span class="icon icon-play-small icon-sun"></span>
                            <span class="icon icon-pauze"></span>
                            <span class="text"><?php _e('Play', 'plumvillage'); ?></span>
                        </a>
                        <?php if(!get_field('disable_download', $audioItem->ID)) : ?>
                            <a class="link-with-icon earthy-link" href="<?php echo $audioFile['url']; ?>" download="<?php echo $audioFile['url']; ?>">
                                <span class="icon icon-download"></span>
                                <span class="text"><?php _e('Download', 'plumvillage'); ?></span>
                            </a>
                        <?php endif; ?>
                     </div>
            </div>
        <?php endwhile; ?>
        </div>    
    </figure>
<?php endif; ?>