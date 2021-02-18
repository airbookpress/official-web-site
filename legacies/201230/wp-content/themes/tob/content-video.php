<?php _the_focusbox( '', get_the_title(), $post->post_excerpt ); ?>

<section class="container">

	<?php while (have_posts()) : the_post(); ?>

	<article class="article-content">
		<?php the_content(); ?>
	</article>

	<?php _the_ads('ad_post_pager_header', 'pager-header') ?>
    <?php wp_link_pages('link_before=<span>&link_after=</span>&before=<div class="article-paging">&after=</div>&next_or_number=number'); ?>
    <?php _the_ads('ad_post_pager_footer', 'pager-footer') ?>

	<?php endwhile; ?>

	<?php if( _hui('post_tags_s') ){ ?>
        <?php the_tags('<div class="article-tags">','','</div>'); ?>
    <?php } ?>

    <?php get_template_part( 'content', 'module-wechats' ); ?> 
    
    <?php get_template_part( 'content', 'module-share' ); ?>

    <?php if( _hui('post_prevnext_s') ){ ?>
        <nav class="article-nav">
            <span class="article-nav-prev"><?php previous_post_link('上一篇<br>%link'); ?></span>
            <span class="article-nav-next"><?php next_post_link('下一篇<br>%link'); ?></span>
        </nav>
    <?php } ?>
    
    <?php _the_ads('ad_post_footer', 'single-footer') ?>

    <?php _the_ads('ad_post_comment', 'single-comment') ?>

    <?php comments_template('', true); ?>

</section>