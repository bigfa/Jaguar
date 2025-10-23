<?php
get_header();
global $jaguarSetting;
?>
<div class="layoutSingleColumn u-paddingTop50">
    <article itemscope itemtype="https://schema.org/Article">
        <?php while (have_posts()) : the_post(); ?>
            <header class="jArticle--header">
                <h2 class="jArticle--headline" itemprop="headline"><?php the_title(); ?></h2>
                <?php if (get_post_meta(get_the_ID(), '_subtitle', true)) : ?>
                    <div class="jArticle--subline" itemprop="description"><?php echo get_post_meta(get_the_ID(), '_subtitle', true); ?></div>
                <?php endif; ?>
                <div class="jArticle--meta">
                    <?php do_action('marker_pro_flag', get_the_ID()); ?>
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __(' ago', 'Jaguar'); ?></time>
                    <span class="middotDivider"></span>
                    <span itemprop="articleSection"><?php the_category(','); ?></span>
                    <span class="middotDivider"></span>
                    <span class="article--reading-time" itemprop="timeRequired"><?php echo jaguar_get_post_read_time_text(get_the_ID()); ?></span>
                    <?php if ($jaguarSetting->get_setting('post_views')) : ?>
                        <span class="middotDivider"></span>
                        <?php echo jaguar_get_post_views_text(false, false, false, get_the_ID()); ?>
                    <?php endif; ?>
                </div>
            </header>
            <div class="jGraph" itemprop="articleBody">
                <?php the_content(); ?>
            </div>
            <footer class="jArticle--footer">
                <div class="footerMeta">
                    <div class="jArticle--tags" itemprop="keywords"><?php the_tags('', '', ''); ?></div>
                </div>
            </footer>
            <?php if ($jaguarSetting->get_setting('post_navigation')) get_template_part('template-parts/post', 'navigation'); ?>
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            if ($jaguarSetting->get_setting('related')) get_template_part('template-parts/single', 'related');
            ?>
        <?php endwhile; ?>
    </article>
</div>
<?php get_footer(); ?>