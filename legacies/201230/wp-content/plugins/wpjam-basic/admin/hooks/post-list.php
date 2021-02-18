<?php
add_action('wpjam_'.$post_type.'_posts_actions', function($actions, $post_type){
	if($post_type == 'page' || $post_type == 'attachment'){
		return $actions;
	}
	
	$actions['update_views']	= ['title'=>'修改',	'page_title'=>'修改浏览数',	'tb_width'=>'500',	'capability'=>get_post_type_object($post_type)->cap->edit_others_posts];
	$actions['set_thumbnail']	= ['title'=>'设置',	'page_title'=>'设置特色图片',	'tb_width'=>'500',	'tb_height'=>'400'];

	return $actions;
}, 9, 2);

add_filter('post_row_actions', function($row_actions, $post){
	foreach (['update_views', 'set_thumbnail'] as $action_key){
		if(isset($row_actions[$action_key])){
			unset($row_actions[$action_key]);	
		}
	}

	return $row_actions;
}, 10, 2);

add_filter('wpjam_'.$post_type.'_posts_fields', function($fields, $action_key, $post_id, $post_type){
	if($action_key == ''){
		if($post_fields	= wpjam_get_post_fields($post_type)){
			$post_fields	= array_filter($post_fields, function($field){ return !empty($field['show_admin_column']); });
			$fields			= array_merge($fields, $post_fields);
		}

		if($post_type == 'page'){
			$fields['template']		= ['title'=>'模板',	'type'=>'view',	'column_callback'=>'get_page_template_slug'];
		}elseif($post_type != 'attachment' && wpjam_basic_get_setting('post_list_update_views')){
			if(is_post_type_viewable($post_type)){
				$fields['views']	= ['title'=>'浏览',	'type'=>'view',	'column_callback'=>'wpjam_get_admin_post_list_views',	'sortable_column'=>'views'];
			}
		}
	}elseif($action_key == 'update_views'){
		$fields['views']			= ['title'=>'浏览数',	'type'=>'number',	'value'=>wpjam_get_post_views($post_id, false),	'class'=>''];
	}elseif($action_key == 'set_thumbnail'){
		$fields['_thumbnail_id']	= ['title'=>'缩略图',	'type'=>'img',		'value'=>get_post_thumbnail_id($post_id),		'size'=>'600x0'];
	}

	return $fields;
}, 10, 4);

function wpjam_get_admin_post_list_thumbnail($post_id){
	$post_thumbnail	= wpjam_get_post_thumbnail($post_id, [50,50]);

	if(!post_type_supports(get_post($post_id)->post_type, 'thumbnail') || !current_user_can('edit_post', $post_id)){
		return $post_thumbnail; 
	}

	return wpjam_get_list_table_row_action('set_thumbnail',[
		'id'	=> $post_id,
		'title'	=> $post_thumbnail ?: '<span class="no-thumbnail">暂无图片</span>',
	]);
}

function wpjam_get_admin_post_list_views($post_id){
	$post_views	= wpjam_get_post_views($post_id, false);

	$post_type	= get_post($post_id)->post_type;

	if(!current_user_can(get_post_type_object($post_type)->cap->edit_others_posts)){
		return $post_views;
	}

	return wpjam_get_list_table_row_action('update_views',[
		'id'	=> $post_id,
		'title'	=> $post_views ?: 0,
	]);
}

add_filter('wpjam_'.$post_type.'_posts_list_action', function($result, $list_action, $post_id, $data){
	if($list_action == 'update_views'){
		if(isset($data['views'])){
			return update_post_meta($post_id, 'views', $data['views']);
		}

		return true;
	}elseif($list_action == 'set_thumbnail'){
		if(!empty($data['_thumbnail_id'])){
			return update_post_meta($post_id, '_thumbnail_id', $data['_thumbnail_id']);
		}else{
			return delete_post_meta($post_id, '_thumbnail_id');
		}
	}

	return $result;
}, 10, 4);

add_filter('disable_categories_dropdown', '__return_true');

add_action('restrict_manage_posts', function($post_type){
	if($taxonomies	= get_object_taxonomies($post_type, 'objects')){
		foreach($taxonomies as $taxonomy) {

			if(empty($taxonomy->show_admin_column)){
				continue;
			}

			if($taxonomy->name == 'category'){
				if(isset($taxonomy->filterable) && !$taxonomy->filterable){
					continue;
				}

				$taxonomy_key	= 'cat';
			}else{
				if(empty($taxonomy->filterable)){
					continue;
				}

				if($taxonomy->name == 'post_tag'){
					$taxonomy_key	= 'tag_id';
				}else{
					$taxonomy_key	= $taxonomy->name.'_id';
				}
			}

			$selected	= 0;

			if(!empty($_REQUEST[$taxonomy_key])){
				$selected	= intval($_REQUEST[$taxonomy_key]);
			}elseif(!empty($_REQUEST['taxonomy']) && ($_REQUEST['taxonomy'] == $taxonomy->name) && !empty($_REQUEST['term'])){
				if($term	= get_term_by('slug', $_REQUEST['term'], $taxonomy->name)){
					$selected	= $term->term_id;
				}
			}elseif(!empty($taxonomy->query_var) && !empty($_REQUEST[$taxonomy->query_var])){
				if($term	= get_term_by('slug', $_REQUEST[$taxonomy->query_var], $taxonomy->name)){
					$selected	= $term->term_id;
				}
			}

			if($taxonomy->hierarchical){
				wp_dropdown_categories(array(
					'taxonomy'			=> $taxonomy->name,
					'show_option_all'	=> $taxonomy->labels->all_items,
					'show_option_none'	=> '没有设置',
					'hide_if_empty'		=> true,
					'hide_empty'		=> 0,
					'hierarchical'		=> 1,
					'show_count'		=> 0,
					'orderby'			=> 'name',
					'name'				=> $taxonomy_key,
					'selected'			=> $selected
				));
			}else{
				echo wpjam_get_field_html([
					'title'			=> '',
					'key'			=> $taxonomy_key,
					'type'			=> 'text',
					'class'			=> '',
					'value'			=> $selected ?: '',
					'placeholder'	=> '请输入'.$taxonomy->label,
					'data_type'		=> 'taxonomy',
					'taxonomy'		=> $taxonomy->name
				]);
			}
		}
	}

	if($post_type != 'attachment'){
		if(wpjam_basic_get_setting('post_list_author_filter') && post_type_supports($post_type, 'author')){
			wp_dropdown_users([
				'name'						=> 'author',
				'who'						=> 'authors',
				'show_option_all'			=> '所有作者',
				'hide_if_only_one_author'	=> true,
				'selected'					=> wpjam_get_parameter('author', ['method'=>'REQUEST', 'sanitize_callback'=>'intval'])
			]);
		}

		if(wpjam_basic_get_setting('post_list_sort_selector')){

			global $wp_list_table;

			if (empty($wp_list_table)) {
				$wp_list_table = _get_list_table('WP_Posts_List_Table', ['screen'=>$post_type]);
			}

			$orderby_options	= [
				''			=> '排序',
				'date'		=> '日期', 
				'modified'	=> '修改时间',
				'ID'		=> get_post_type_object($post_type)->labels->name.'ID',
				'title'		=> '标题', 
			];

			if(post_type_supports($post_type, 'comments')){
				$orderby_options['comment_count']	= '评论';
			}

			if(is_post_type_hierarchical($post_type)){
				// $orderby_options['parent']	= '父级';
			}

			list($columns, $hidden, $sortable_columns, $primary) = $wp_list_table->get_column_info();

			$default_sortable_columns	= $wp_list_table->get_sortable_columns();

			foreach($sortable_columns as $sortable_column => $data){
				if(isset($default_sortable_columns[$sortable_column])){
					continue;
				}

				if(isset($columns[$sortable_column])){
					$orderby_options[$sortable_column]	= $columns[$sortable_column];
				}
			}

			echo wpjam_get_field_html([
				'title'		=>'',
				'key'		=>'orderby',
				'type'		=>'select',
				'value'		=>wpjam_get_parameter('orderby', ['method'=>'REQUEST', 'sanitize_callback'=>'sanitize_key']),
				'options'	=>$orderby_options
			]);

			echo wpjam_get_field_html([
				'title'		=>'',
				'key'		=>'order',
				'type'		=>'select',
				'value'		=>wpjam_get_parameter('order', ['method'=>'REQUEST', 'sanitize_callback'=>'sanitize_key', 'default'=>'DESC']),
				'options'	=>['desc'=>'降序','asc'=>'升序']
			]);
		}
	}
}, 99);

add_filter('posts_clauses', function ($clauses, $wp_query){
	if($wp_query->is_main_query() && $wp_query->is_search()){
		global $wpdb;

		$search_term	= $wp_query->query['s'];

		if(is_numeric($search_term)){
			$clauses['where'] = str_replace('('.$wpdb->posts.'.post_title LIKE', '('.$wpdb->posts.'.ID = '.$search_term.') OR ('.$wpdb->posts.'.post_title LIKE', $clauses['where']);
		}elseif(preg_match("/^(\d+)(,\s*\d+)*\$/", $search_term)){
			$clauses['where'] = str_replace('('.$wpdb->posts.'.post_title LIKE', '('.$wpdb->posts.'.ID in ('.$search_term.')) OR ('.$wpdb->posts.'.post_title LIKE', $clauses['where']);
		}

		if($search_metas = $wp_query->get('search_metas')){
			$clauses['where']	= preg_replace_callback('/\('.$wpdb->posts.'.post_title LIKE (.*?)\) OR/', function($matches) use($search_metas){
				global $wpdb;
				$search_metas	= "'".implode("', '", $search_metas)."'";

				return "EXISTS (SELECT * FROM {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id={$wpdb->posts}.ID AND meta_key IN ({$search_metas}) AND meta_value LIKE ".$matches[1].") OR ".$matches[0];
			}, $clauses['where']);
		}
	}

	return $clauses;
}, 2, 2);

add_action('add_inline_data', function($post, $post_type_object){
	$post_type	= $post->post_type;

	if($post_type != 'attachment' && (is_post_type_viewable($post_type) || post_type_supports($post_type, 'thumbnail'))){
		echo '<div class="post_thumbnail">' . wpjam_get_admin_post_list_thumbnail($post->ID) . '</div>';
	}
}, 10, 2);

add_action('admin_enqueue_scripts', function(){
	wp_add_inline_style('list-tables', 'td.column-title img.wp-post-image{float:left; margin:0px 10px 10px 0;}
th.manage-column.column-views{width:72px;}
.fixed .column-categories, .fixed .column-tags{width:12%;}');
});

add_action('admin_head', function(){
	if(wpjam_basic_get_setting('post_list_set_thumbnail')){
	?>
	<script type="text/javascript">
	jQuery(function($){
		$.extend({
			wpjam_prepend_post_thumbnail: function(id){
				$('#inline_'+id).prev('strong').prepend($('#inline_'+id+' div.post_thumbnail').html());
			}
		});

		$('td.column-title').each(function(index, item){
			let id = $(this).find('div.hidden').attr('id').replace('inline_', '');
			$.wpjam_prepend_post_thumbnail(id);
		});

		$('body').on('list_table_action_success', function(event, response){
			if(response.list_action_type != 'form'){
				if(response.bulk){
					$.each(response.ids, function(index, id){
						$.wpjam_prepend_post_thumbnail(id);
					});
				}else{
					$.wpjam_prepend_post_thumbnail(response.id);
				}
			}
		});

		// let wp_inline_edit_save = inlineEditPost.save;
		
		// inlineEditPost.save = function(id){
		// 	if(typeof(id) === 'object'){
		// 		id = this.getId(id);
		// 	}

		// 	$.when(wp_inline_edit_save.apply(this, arguments)).done(function(data){
		// 		console.log(data);
		// 		if(id > 0){
		// 			$.wpjam_prepend_post_thumbnail(id);
		// 		}
		// 	});

		// 	if(id > 0){
		// 		setTimeout(function(){
		// 			$.wpjam_prepend_post_thumbnail(id);
		// 		}, 1000);
		// 	}
		// }
	});
	</script>
	<?php
	}
});

if(wpjam_basic_get_setting('post_list_set_thumbnail') && wp_doing_ajax() && $_POST['action'] == 'inline-save'){
	if($post_type != 'attachment' && (is_post_type_viewable($post_type) || post_type_supports($post_type, 'thumbnail'))){	
		add_filter('wpjam_html', function($html){
			if(preg_match_all('/<tr id="post-(\d+)" class=".*?">.*?<\/tr>/is', $html, $matches)){
				$search	= $replace = $matches[0];

				foreach ($matches[1] as $i => $post_id){
					$replace[$i]	= str_replace('<a class="row-title"', wpjam_get_admin_post_list_thumbnail($post_id).'<a class="row-title"', $replace[$i]);
				}

				$html	= str_replace($search, $replace, $html);
			}

			return $html;
		});
	}	
}