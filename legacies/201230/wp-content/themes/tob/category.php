<?php get_header(); ?>

<?php _the_focusbox( '', single_cat_title('', false), trim(strip_tags(category_description())), _hui('catpage_counts_s') ? '当前栏目共 '.$wp_query->found_posts.' 条数据' : '' ); ?>

<?php 
if( _hui('catpage_menus_s') ){
	global $wp_query;
	$cat_id = get_query_var('cat');
	$cat_root_id = _get_cat_root_id($cat_id);
	if( get_term_children($cat_id, 'category') || $cat_id !== $cat_root_id ){
?>
<div class="cat-menus">
	<div class="container">
        <ul>
            <?php 
                $catprm = 'child_of='. $cat_root_id .'&hide_empty=0&title_li=&orderby=name&order=ASC&depth=2';
                echo wp_list_categories($catprm); 
            ?>
        </ul>
	</div>
</div>
<?php }} ?>

<section class="container">
	<?php get_template_part( 'excerpt' ); ?>
</section>

<?php get_footer(); ?>