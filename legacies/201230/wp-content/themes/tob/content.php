<section class="container">
    <div class="content-wrap">
    	<div class="content">
    		<?php while (have_posts()) : the_post(); ?>

    		<header class="article-header">
    			<h1 class="article-title"><?php the_title(); ?></h1>
    			<div class="article-meta">
    				<span class="item item-1"><?php echo get_the_date().' '.get_the_time(); ?></span>
                    <?php $from = _get_post_from(); if( _hui('post_from_s') && $from ){ ?><span class="item item-6"><?php echo $from ?></span><?php } ?>
    				<span class="item item-2">作者：<?php echo get_the_author() ?></span>
    				<span class="item item-3"><?php echo '分类：';the_category(' / '); ?></span>
                    <?php if( _hui('post_post_views') ){ ?>
    				    <span class="item item-4"><?php echo _get_post_views() ?></span>
                    <?php } ?>
    				<span class="item item-5"><?php edit_post_link('[编辑]'); ?></span>
    			</div>
    		</header>

            <?php _the_ads('ad_post_header', 'single-header') ?>

    		<article class="article-content">
                <?php the_content(); ?>
            </article>

            <?php _the_ads('ad_post_pager_header', 'pager-header') ?>
            <?php wp_link_pages('link_before=<span>&link_after=</span>&before=<div class="article-paging">&after=</div>&next_or_number=number'); ?>
            <?php _the_ads('ad_post_pager_footer', 'pager-footer') ?>

            <?php if( _hui('post_copyright_s') ){
                echo '<div class="article-copyright">'._hui('post_copyright').'<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a> &raquo; <a href="'.get_permalink().'">'.get_the_title().'</a></div>';
            } ?>

    		<?php endwhile;  ?>
            
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
            
            <?php if( _hui('post_related_s') ){ ?>
                <div class="postitems">
                    <h3><?php echo _hui('related_title', '相关推荐') ?></h3>
                    <ul>
                        <?php _posts_related( _hui('post_related_n') ) ?>
                    </ul>
                </div>
            <?php } ?>

            <?php _the_ads('ad_post_comment', 'single-comment') ?>

            <?php comments_template('', true); ?>

    	</div>
    </div>
	<?php get_sidebar(); ?>
</section>