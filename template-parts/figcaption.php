<?php
/**
 * Template part for displaying the figcaption
 *
 * @package Plum_Village
 */

?>
<figcaption>
    <?php if(wp_get_attachment_caption($image_id)) : ?>
        <h4><?php echo wp_get_attachment_caption($image_id); ?></h4>
    <?php endif; ?>
    <?php if(get_the_content(false, false, $image_id)) : ?>
        <p><?php echo get_the_content(false, false, $image_id); ?></p>
    <?php endif; ?>
    <?php 
        $credits = get_field('credits', $image_id); 
        $credits_url = get_field('credits_url', $image_id);
        $available = get_field('available_in', $image_id);
        $contact = get_field('contact_instructions', $image_id);

        if($credits || $available || $contact) : 
    ?>
        <div class="image-credits">
                <?php if($credits) : ?>
                    <p><?php _e('Photo Credits', 'plumvillage'); ?>: 
                        <?php if($credits_url) : ?>
                            <a href="<?php echo $credits_url; ?>"><?php echo $credits; ?></a>.
                        <?php else : ?>
                            <?php echo $credits; ?>.
                        <?php endif; ?>
                        <?php if($available) : ?>
                            <span class="for-press"><?php _e('Photo is available in', 'plumvillage'); ?>: <?php echo $available; ?></span>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>
                <div class="for-press">                                                    
                    <?php if($contact) : ?>
                        <?php echo $contact; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
</figcaption>
