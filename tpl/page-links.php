<?php
/*
Template Name: Links
Template Post Type: page

 * The Template for displaying blog links
 *
 * @package Bigfa
 * @subpackage Jaguar
 * @since Jaguar 3.0.4
*/
get_header();
?>


<main class="layoutSingleColumn u-paddingTop50">
    <article itemscope="itemscope" itemtype="http://schema.org/Article">
        <?php while (have_posts()) : the_post(); ?>
            <header class="article--header">
                <h2 class="article--headline" itemprop="headline"><?php the_title(); ?></h2>
            </header>
            <?php echo get_link_items(); ?>
        <?php endwhile; ?>
    </article>
</main>

<?php get_footer(); ?>