<?php get_header(); ?>
<div class="layoutSingleColumn layoutSingleColumn--wide u-paddingTop50">
    <header class="jTerm--header">
        <?php if (get_term_meta(get_queried_object_id(), '_thumb', true)) : ?>
            <div class="jTerm--icon">
                <img src="<?php echo esc_url(get_term_meta(get_queried_object_id(), '_thumb', true)); ?>" alt="<?php single_cat_title(); ?>">
            </div>
        <?php endif; ?>
        <h1 class="jTerm--headline"><?php single_cat_title(); ?></h1>
        <?php if (get_the_archive_description()) : ?>
            <div class="jTerm--description"><?php echo get_the_archive_description(); ?></div>
        <?php endif; ?>
    </header>
    <?php if (have_posts()) : ?>
        <div class="jBlock--list">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', get_post_format()); ?>
            <?php endwhile; ?>
        </div>
        <?php the_posts_pagination(array(
            'prev_text'          =>  __('Previous page', 'Jaguar'),
            'screen_reader_text' =>  __('Posts navigation', 'Jaguar'),
            'next_text'          =>  __('Next page', 'Jaguar'),
            'before_page_number' => '',
            'prev_next'          => false
        )); ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>