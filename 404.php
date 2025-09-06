<?php get_header(); ?>
<div class="layoutSingleColumn">
    <div class="jError--header">
        <?php _e('Oops! That page can\'t be found.', 'Jaguar'); ?>
    </div>
    <section class="jRelated--section">
        <h3 class="jRelated--heroTitle"><?php _e('Random Posts', 'Jaguar'); ?></h3>
        <div class="jRelated--list">
            <?php
            global $jaguarSetting;
            // get same format related posts
            $the_query = new WP_Query(array(
                'post_type' => 'post',
                'post__not_in' => array(get_the_ID()),
                'posts_per_page' => 6,
                'orderby' => 'rand',
            ));
            while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <div class="jRelated--item" itemscope itemtype="https://schema.org/Article">
                    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>" class="jRelated--link" itemprop="url" title="<?php the_title(); ?>">
                        <div class="jRelated--image">
                            <img src="<?php echo jaguar_get_background_image(get_the_ID(), 800, 400); ?>" class="cover" alt="<?php the_title(); ?>" itemprop="image" />
                        </div>
                        <div class="jRelated--content">
                            <div class="jRelated--title" itemprop="headline">
                                <?php the_title(); ?>
                            </div>
                            <div class="jRelated--meta">
                                <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                                    <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __(' ago', 'Jaguar'); ?>
                                </time>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </section>
</div>
<?php get_footer(); ?>