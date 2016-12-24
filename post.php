<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <div class="content-area container">
        <div class="site-content">
            <section class="post-content">
                <div class="single-post-inner grap">
                    <?php $this->content(); ?>
                </div>
            </section>
            <div class="tag-list"><?php $this->tags(', ', true, ''); ?></div>
            <?php $this->need('comments.php'); ?>
        </div>
    </div>
<?php $this->need('footer.php'); ?>