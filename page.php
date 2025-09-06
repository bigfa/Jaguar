<?php get_header(); ?>
<div class="layoutSingleColumn u-paddingTop50">
    <?php while (have_posts()) : the_post(); ?>
        <article itemscope itemtype="https://schema.org/Article" class="jArticle">
            <header class="jArticle--header">
                <h2 class="jArticle--headline" itemprop="headline"><?php the_title(); ?></h2>
                <?php if (get_post_meta(get_the_ID(), '_subtitle', true)) : ?>
                    <div class="jArticle--subline" itemprop="description"><?php echo get_post_meta(get_the_ID(), '_subtitle', true); ?></div>
                <?php endif; ?>
            </header>
            <div class="jGraph jArticle--content" itemprop="articleBody">
                <?php the_content(); ?>
            </div>
        </article>
        <?php if (comments_open() || get_comments_number()) :
            comments_template();
        endif; ?>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>