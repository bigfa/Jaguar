<?php
/**
 *
 *
 * @package Jaguar
 * @author bigfa
 * @version 1.0.0
 * @link https://fatesinger.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div class="content-area container">
    <div class="site-content">
        <?php while($this->next()): ?>
            <article class="post-item">
                <div class="post-image" style="background-image: url(<?php echo img_postthumb($this->cid);?>);">
                    <div class="info-mask">
                        <div class="mask-wrapper">
                            <h2 class="post-title">
                                <a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                            </h2>
                            <div class="post-info"><span class="post-time"><time><?php $this->date('M d, Y'); ?></time></span><span class="middotDivider"></span><span class="post-tags"><?php $this->category(','); ?></span></div>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
        <div class="nav-links">
            <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
        </div>
    </div>
</div>
<?php $this->need('footer.php'); ?>
