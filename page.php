<?php get_header(); ?>
    <div class="content-area container">
        <div class="site-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <section class="post-content">
                    <div class="single-post-inner grap">
                        <?php the_content();?>
                    </div>
                </section>
                <?php comments_template(); ?>
            <?php endwhile; ?>
        </div>
    </div>
<?php get_footer(); ?>