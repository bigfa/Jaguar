<article class="post-item">
    <div class="post-image" style="background-image: url(<?php echo jaguar_get_background_image(get_the_ID(),740,340);?>);">
        <div class="info-mask">
            <div class="mask-wrapper">
                <h2 class="post-title">
                    <a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
                </h2>
                <div class="post-info"><span class="post-time"><time><?php echo get_the_date( 'M d,Y');?></time></span><span class="middotDivider"></span><span class="post-tags"><?php the_category(',');;?></span></div>
            </div>
        </div>
    </div>
</article>