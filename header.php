<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
        <link type="image/vnd.microsoft.icon" href="<?php $this->options->themeUrl('build/img/favicon.png'); ?>" rel="shortcut icon">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('build/css/app.css'); ?>">
    <?php $this->header(); ?>
</head>
<body<?php if ( $this->is('post') ) echo ' class="single"' ?>>
<header id="header" class="home-header blog-background banner-mask">
    <div class="nav-header container">
        <div class="nav-header-container">
            <a class="back-home" href="<?php $this->options->siteUrl(); ?>">Home</a>
        </div>
    </div>
    <div class="header-wrap">
        <div class="container">
            <?php if ( $this->is('post') || $this->is('page') ) : ?>
                <div class="header-wrap">
                    <div class="post-info-container">
                        <h2 class="post-page-title "><?php $this->title() ?></h2>
                        <time class="post-page-time"><?php $this->date('F j, Y'); ?><span class="middotDivider"></span>
                            <span class="post-page-author"><?php $this->author(); ?></span>
                    </div>
                </div>
            <?php elseif ( $this->is('archive') ) : ?>
                <div class="home-info-container">
                    <h2>
                        <?php $this->archiveTitle( '', '', ''); ?>
                    </h2>
                </div>
            <?php else : ?>
                <div class="home-info-container">
                    <a href="<?php $this->options->siteUrl(); ?>">
                        <h2><?php $this->options->title() ?></h2>
                    </a>
                    <h4><?php $this->options->description() ?></h4>
                </div>
            <?php endif;?>
        </div>
    </div>
</header>
<div id="main" class="content homepage">