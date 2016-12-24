<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function threadedComments($comments, $singleCommentOptions) {
    $commentClass = '';
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';
    ?>
    <li class="comment">
        <div class="comment-body">
            <div class="comment-meta">
                <div class="comment-author vcard">
                    <?php $comments->gravatar( 42 , $singleCommentOptions->defaultAvatar);?>
                    <b class="fn"><?php $singleCommentOptions->beforeAuthor();$comments->author();$singleCommentOptions->afterAuthor();?></b>
                </div>
                <div class="comment-metadata">
                    <time><?php $singleCommentOptions->beforeDate();
                        $comments->date($singleCommentOptions->dateFormat);
                        $singleCommentOptions->afterDate();?></time>
                </div>
            </div>
            <div class="comment-content">
                <?php $comments->content();?>
            </div>
            <div class="reply">
                <?php $comments->reply($singleCommentOptions->replyWord);?>
            </div>
            <?php if ($comments->children) { ?>
                <ol class="children">
                    <?php $comments->threadedComments($singleCommentOptions);?>
                </ol>
            <?php } ?>
        </div>
    </li>
    <?php
}

function img_postthumb($cid) {
    $db = Typecho_Db::get();
    $rs = $db->fetchRow($db->select('table.contents.text')
        ->from('table.contents')
        ->where('table.contents.cid=?', $cid)
        ->order('table.contents.cid', Typecho_Db::SORT_ASC)
        ->limit(1));

    preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $rs['text'], $thumbUrl);  //通过正则式获取图片地址
    $img_src = $thumbUrl[1][0];  //将赋值给img_src
    $img_counter = count($thumbUrl[0]);  //一个src地址的计数器

    $options = Typecho_Widget::widget('Widget_Options');

    switch ($img_counter > 0) {
        case $allPics = 1:
            return $img_src;  //当找到一个src地址的时候，输出缩略图
            break;
        default:
            return $options->rootUrl . '/usr/themes/Jaguar/build/img/default.jpg';  //没找到(默认情况下)，不输出任何内容
    };
}
