<?php
if (post_password_required())
    return;
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php echo number_format_i18n(get_comments_number()); ?> 条评论
        </h2>
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 42,
                'format'            => 'html5'
            ));
            ?>
        </ol>
        <?php the_comments_pagination(array(
            'prev_text' => '上一页',
            'next_text' => '下一页',
            'prev_next' => false,
        )); ?>
    <?php endif; ?>
    <?php comment_form(); ?>
</div>