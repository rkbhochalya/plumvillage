<?php if( have_rows('audio') ): ?>
    <figure class="block block-audio align<?php echo $block['align']; if(isset($block['className'])){ echo ' ' . $block['className']; } ?>"">
        <div class="block-inside">
        <?php while ( have_rows('audio') ) : the_row(); ?>
            
            <?php $file = get_sub_field('file'); ?>
            <div class="audio-player">
              <div class="audio-wrapper" class="player-container" href="javascript:;">
                <audio class="player">
                  <source src="<?php echo $file['url']; ?>" type="audio/mp3">
                </audio>
              </div>
              <div class="player-controls scrubber">
                <div class="audio-content">
                    <h5><?php the_sub_field('title'); ?> <small class="end-time"></small></h5>
                    <p><?php the_sub_field('content'); ?></p>
                    <div class="buttons">
                        <a class="play-btn link-with-icon sunny-link" href="#" aria-label="<?php _e('Play Audio', 'plumvillage'); ?> - <?php the_sub_field('title'); ?>">
                            <span class="icon icon-play-small icon-sun"></span>
                            <span class="icon icon-pauze"></span>
                            <span class="text"><?php _e('Play', 'plumvillage'); ?></span>
                        </a>
                        <a class="link-with-icon earthy-link" href="<?php echo $file['url']; ?>" download="<?php echo $file['url']; ?>">
                            <span class="icon icon-download"></span>
                            <span class="text"><?php _e('Download', 'plumvillage'); ?></span>
                        </a>
    <!--                         <a class="link-with-icon earthy-link" href="#">
                            <span class="icon icon-transcript"></span>
                            <span class="text"><?php _e('Transcript', 'plumvillage'); ?></span>
                        </a>
    -->                    </div>
                </div>
                <span class="seek-obj-container">
                  <progress class="seek-obj" value="0" max="1"></progress>
                    <small class="start-time">00:00</small>
                    <small class="end-time"></small>
                </span>
              </div>
            </div>
        <?php endwhile; ?>
        </div>    
    </figure>
<?php endif; ?>


