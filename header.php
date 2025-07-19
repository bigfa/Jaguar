<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link type="image/vnd.microsoft.icon" href="<?php echo get_template_directory_uri(); ?>/build/images/favicon.png" rel="shortcut icon">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="surface--content">
        <header class="metabar metabar--bordered">
            <div class="metabar--block" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                <h1 class="metabar--headline" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                    <a href="<?php echo home_url(); ?>" class="metabar--logo" title="<?php echo get_bloginfo('name', 'display'); ?>">
                        <?php echo get_bloginfo('name', 'display'); ?>
                    </a>
                </h1>
                <meta itemprop="name" content="<?php echo get_bloginfo('name', 'display'); ?>">
                <meta itemprop="url" content="<?php echo home_url(); ?>">
                <nav class="site--nav">
                    <span class="u-xs-show nav--copyright"><?php echo get_bloginfo('name', 'display'); ?> <?php echo date("Y") ?></span>
                </nav>
                <svg class="menu--icon" width="1em" height="1em" viewBox="0 0 24 14" fill="currentColor" aria-hidden="true">
                    <line x1="24" y1="1" y2="1" stroke="currentColor" stroke-width="2"></line>
                    <line x1="24" y1="7" x2="4" y2="7" stroke="currentColor" stroke-width="2"></line>
                    <line x1="24" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2"></line>
                </svg>
            </div>
        </header>
        <div class="mask"></div>
        <div class="content homepage">