<footer class="footer">
	<?php if( _hui('flinks_s') && _hui('flinks_cat') && ((_hui('flinks_home_s') && is_home() && $paged<=1) || (!_hui('flinks_home_s'))) ){ ?>
		<div class="flinks">
			<?php 
				wp_list_bookmarks(array(
					'category'         => _hui('flinks_cat'),
					'category_orderby' => 'slug',
					'category_order'   => 'ASC',
					'orderby'          => 'rating',
					'order'            => 'DESC',
					'show_description' => false,
					'between'          => '',
					'title_before'     => '<dfn>',
					'title_after'      => '</dfn>',
					'category_before'  => '',
					'category_after'   => ''
				));
			?>
		</div>
	<?php } ?>
	<?php if( _hui('bomnav_s') ){ ?>
		<div class="bomnav">
			<ul><?php _the_menu('bomnav'); ?></ul>
		</div>
	<?php } ?>
    &copy; <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> &nbsp; 
    <?php echo get_option('zh_cn_l10n_icp_num') ? get_option('zh_cn_l10n_icp_num').' &nbsp; ' : ''; ?>
    <?php echo _hui('themecopyright') ? '本站主题由 <a href="http://themebetter.com" target="_blank">themebetter</a> 提供 &nbsp; ' : ''; ?>
    <?php echo _hui('trackcode') ?>
</footer>

<?php get_template_part( 'content', 'module-rewards' ); ?> 

<script>
	<?php  
		$ajaxpager = '0';
		if( ((!wp_is_mobile() &&_hui('ajaxpager_s')) || (wp_is_mobile() && _hui('ajaxpager_s_m'))) && _hui('ajaxpager') ){
			$ajaxpager = _hui('ajaxpager');
		}

		$shareimage = _hui('share_base_image') ? _hui('share_base_image') : '';
		if( is_single() || is_page() ){
			$thumburl = _get_post_thumbnail_url(false, '');
			if( $thumburl ){
				$shareimage = $thumburl; 
			}
		}

		$shareimagethumb = _hui('share_post_image_thumb') ? 1 : 0;

		$fullgallery = 0;
		if( (is_single() && _hui('full_gallery')) || (is_page() && _hui('page_full_gallery')) ){
			$fullgallery = 1;
		}

		$fullimage = 0;
		if( (is_single() && _hui('full_image')) || (is_page() && _hui('page_full_image')) ){
			$fullimage = 1;
		}

	?>
	window.TBUI = {
		uri             : '<?php echo get_stylesheet_directory_uri() ?>',
		ajaxpager       : '<?php echo $ajaxpager ?>',
		pagenum         : '<?php echo get_option('posts_per_page', 20) ?>',
		shareimage      : '<?php echo $shareimage ?>',
		shareimagethumb : '<?php echo $shareimagethumb ?>',
		fullgallery     : '<?php echo $fullgallery ?>',
		fullimage       : '<?php echo $fullimage ?>'
	}
</script>
<?php wp_footer(); ?>
<?php if( _hui('footcode') ) echo _hui('footcode') ?>
</body>
</html>