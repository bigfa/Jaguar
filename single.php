<?php get_header('simple'); ?>
    <div class="content-area container">
        <div class="site-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <section class="post-content">
                    <div class="single-post-inner grap">
                        <?php the_content();?>
                    </div>
                </section>
                <div class="post-actions">
                    <?php if(function_exists('wp_postlike')) wp_postlike(get_the_ID(),'<svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"><path d="M533.504 268.288q33.792-41.984 71.68-75.776 32.768-27.648 74.24-50.176t86.528-19.456q63.488 5.12 105.984 30.208t67.584 63.488 34.304 87.04 6.144 99.84-17.92 97.792-36.864 87.04-48.64 74.752-53.248 61.952q-40.96 41.984-85.504 78.336t-84.992 62.464-73.728 41.472-51.712 15.36q-20.48 1.024-52.224-14.336t-69.632-41.472-79.872-61.952-82.944-75.776q-26.624-25.6-57.344-59.392t-57.856-74.24-46.592-87.552-21.504-100.352 11.264-99.84 39.936-83.456 65.536-61.952 88.064-35.328q24.576-5.12 49.152-1.536t48.128 12.288 45.056 22.016 40.96 27.648q45.056 33.792 86.016 80.896z"></path></svg>');?>
                </div>
                <?php echo get_the_tag_list('<div class="tag-list">','','</div>');?>
                <div class="author-field u-textAlignCenter">
                    <?php echo get_avatar(get_the_author_meta( 'user_email' ),64)?>
                    <h3><a href="<?php echo get_author_posts_url( get_the_author_meta('ID') );?>"><?php the_author();?></a></h3>
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