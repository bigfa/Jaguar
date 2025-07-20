<?php
$previou_post = get_previous_post();
$next_post = get_next_post();
?>
<nav class="navigation post-navigation" aria-label="<?php _e('Post', 'Jaguar'); ?>">
    <div class="nav-links">
        <?php if ($previou_post) : ?>
            <div class="nav-previous">
                <a href="<?php echo get_permalink($previou_post) ?>" rel="prev" title="<?php echo get_the_title($previou_post) ?>">
                    <span class="meta-nav"><?php _e('Previous', 'Jaguar'); ?></span>
                    <span class="post-title">
                        <?php echo get_the_title($previou_post) ?>
                    </span>
                    <img src="<?php echo jaguar_get_background_image($previou_post->ID, 800, 400); ?>" alt="<?php echo get_the_title($previou_post) ?>" class="post-thumbnail" />
                </a>
            </div>
        <?php endif ?>
        <?php if ($next_post) : ?>
            <div class="nav-next">
                <a href="<?php echo get_permalink($next_post) ?>" rel="next" title="<?php echo get_the_title($next_post) ?>">
                    <span class="meta-nav"><?php _e('Next', 'Jaguar'); ?></span>
                    <span class="post-title">
                        <?php echo get_the_title($next_post) ?>
                    </span>
                    <img src="<?php echo jaguar_get_background_image($next_post->ID, 800, 400); ?>" alt="<?php echo get_the_title($next_post) ?>" class="post-thumbnail" />
                </a>
            </div>
        <?php endif ?>
    </div>
</nav>