<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link type="image/vnd.microsoft.icon" href="<?php echo get_template_directory_uri(); ?>/build/img/favicon.png" rel="shortcut icon">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/build/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="hfeed site">
    <header class="home-header header--clean">
        <div class="home-info-container">
            <a href="/">
                <h2><?php echo get_bloginfo('site_name')?></h2>
            </a>
            <h4><?php echo get_bloginfo('description');?></h4>
        </div>
    </header>
    <div id="main" class="content homepage">
        <?php if (is_singular()) :
            global $post;
            ?>
            <div class="page--clean">
                <div class="container">
                    <h2 class="post-page-title"><?php the_title();?></h2>
                    <div class="post-meta">
                        <time class="post-page-time"><?php echo get_the_date('M d,Y');?></time><span class="middotDivider"></span>
                        <span class="post-page-author"><a href="<?php echo get_author_posts_url($post->post_author);?>"><?php echo get_user_meta($post->post_author,'nickname',true);?></a></span></div>
                </div>
            </div>
        <?php elseif (is_archive()) :
            echo '<div class="archive-header--clean">';
            the_archive_title( '<h2 class="page-title">', '</h2>' );
            the_archive_description( '<h4 class="taxonomy-description">', '</h4>' );
            echo '</div>';
        elseif (is_search()) : ?>
            <div class="archive-header--clean">
                <h2 class="page-title"><?php echo get_search_query(); ?>的搜索结果</h2>
            </div>
        <?php endif;?>