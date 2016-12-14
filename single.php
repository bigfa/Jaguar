<?php get_header(); ?>
    <div class="content-area container">
        <div class="site-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <section class="post-content">
                    <div class="single-post-inner grap">
                        <?php the_content();?>
                    </div>
                </section>
                <?php echo get_the_tag_list('<div class="tag-list">','','</div>');?>
                <div class="author-field u-textAlignCenter">
                    <?php echo get_avatar(get_the_author_meta( 'user_email' ),64)?>
                    <h3><?php the_author();?></h3>
                    <p><?php echo get_the_author_meta( 'description' );?></p>
                </div>
                <?php the_post_navigation( array(
                    'next_text' => '<span class="meta-nav">Next</span><span class="post-title">%title</span>',
                    'prev_text' => '<span class="meta-nav">Previous</span><span class="post-title">%title</span>',
                ) );?>
                <?php comments_template(); ?>
            <?php endwhile; ?>
        </div>
    </div>
<?php get_footer(); ?>