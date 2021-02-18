<?php
add_filter('term_updated_messages', function($messages){
	global $taxonomy;

	if($taxonomy == 'post_tag' || $taxonomy == 'category'){
		return $messages;
	}

	$labels		= get_taxonomy_labels(get_taxonomy($taxonomy));
	$label_name	= $labels->name;

	$messages[$taxonomy]	= array_map(function($message) use ($label_name){
		if($message == $label_name) return $message;

		return str_replace(
			['项目', 'Item'], 
			[$label_name, ucfirst($label_name)], 
			$message
		);
	}, $messages['_item']);

	return $messages;
});

add_filter('taxonomy_parent_dropdown_args', function($args, $taxonomy, $action_type){
	$tax_obj	= get_taxonomy($taxonomy);
	$levels		= $tax_obj->levels ?? 0;

	if($levels > 1){
		$args['depth']	= $levels - 1;

		if($action_type == 'edit'){
			$term_id		= $args['exclude_tree'];
			$term_levels	= count(get_ancestors($term_id, $taxonomy, 'taxonomy'));
			$child_levels	= $term_levels;

			$children	= get_term_children($term_id, $taxonomy);
			if($children){
				$child_levels = 0;

				foreach($children as $child){
					$new_child_levels	= count(get_ancestors($child, $taxonomy, 'taxonomy'));
					if($child_levels	< $new_child_levels){
						$child_levels	= $new_child_levels;
					}
				}
			}

			$redueced	= $child_levels - $term_levels;

			if($redueced < $args['depth']){
				$args['depth']	-= $redueced;
			}else{
				$args['parent']	= -1;
			}
		}
	}

	return $args;
}, 10, 3);

add_filter('wpjam_term_options', function($term_options, $taxonomy){
	if($thumbnail_field	= wpjam_get_term_thumbnail_field($taxonomy)){
		$term_options['thumbnail']	= $thumbnail_field;
	}
	return $term_options;
},99,2);

add_filter($taxonomy.'_row_actions', function($row_actions){
	if(isset($row_actions['set_thumbnail'])){
		unset($row_actions['set_thumbnail']);
	}
	return $row_actions;
});

add_action('wpjam_'.$taxonomy.'_terms_actions', function($actions, $taxonomy){
	if($thumbnail_field	= wpjam_get_term_thumbnail_field($taxonomy)){
		$actions['set_thumbnail']	= ['title'=>'设置',	'page_title'=>'设置缩略图',	'tb_width'=>'500',	'tb_height'=>'400'];
	}
	return $actions;
}, 10, 2);

add_filter('wpjam_'.$taxonomy.'_terms_list_action', function($result, $list_action, $term_id, $data){
	if($list_action == 'set_thumbnail'){
		$thumbnail	= $data['thumbnail'] ?? '';
		if($thumbnail){
			return update_term_meta($term_id, 'thumbnail', $thumbnail);
		}else{
			return delete_term_meta($term_id, 'thumbnail');
		}
	}

	return $result;
}, 10, 4);

add_filter('wpjam_'.$taxonomy.'_terms_fields', function($fields, $action_key, $term_id, $taxonomy){
	if($action_key == '' || $action_key == 'add' || $action_key == 'edit'){
		$term_fields	= wpjam_get_term_options($taxonomy) ?: [];
		
		if($term_fields){
			if($action_key == ''){
				$term_fields	= array_filter($term_fields, function($field){ return !empty($field['show_admin_column']); });
			}

			$fields	= array_merge($fields, $term_fields);
		}
	}elseif($action_key == 'set_thumbnail'){
		if($thumbnail_field	= wpjam_get_term_thumbnail_field($taxonomy)){
			$thumbnail_field['value']	= get_term_meta($term_id, 'thumbnail', true);

			return [
				'thumbnail'	=> $thumbnail_field
			];
		}
	}

	return $fields;
}, 10, 4);

add_action('admin_enqueue_scripts', function(){
	$taxonomy	= get_current_screen()->taxonomy;
	$tax_obj	= get_taxonomy($taxonomy);
	$supports	= $tax_obj->supports ?? ['slug', 'description', 'parent'];
	$levels		= $tax_obj->levels ?? 0;

	$style		= '.fixed th.column-slug{width:16%;}
.fixed th.column-description{width:22%;}
td.column-name img.wp-term-image{float:left; margin:0px 10px 10px 0;}
.form-field.term-parent-wrap p{display: none;}
.form-field span.description{color:#666;}
';

	if($levels == 1){
		$supports	= array_diff($supports, ['parent']);
	}
		
	foreach (['slug', 'description', 'parent'] as $key) { if(!in_array($key, $supports)){ 
		$style	.= '.form-field.term-'.$key.'-wrap{display: none;}'."\n";
	} }

	wp_add_inline_style('list-tables', $style);
});

add_filter('wpjam_html', function($html){
	$taxonomy	= get_current_screen()->taxonomy;

	if($thumbnail_field	= wpjam_get_term_thumbnail_field($taxonomy)){
		if(!wp_doing_ajax() || (wp_doing_ajax() && $_POST['action'] == 'inline-save-tax')){
			return wpjam_terms_single_row_html_replace($html);
		}elseif(wp_doing_ajax() && $_POST['action'] == 'wpjam-list-table-action'){
			$response	= wpjam_json_decode($html);
			if(isset($response['data'])){
				if(is_array($response['data'])){
					$response['data']	= array_map('wpjam_terms_single_row_html_replace', $response['data']);
				}else{
					$response['data']	= wpjam_terms_single_row_html_replace($response['data']);
				}

				return wpjam_json_encode($response);
			}
		}
	}

	return $html;
});

function wpjam_terms_single_row_html_replace($html){
	if(preg_match_all('/<tr id="tag-(\d+)" class=".*?">.*?<\/tr>/is', $html, $matches)){
		$search	= $replace = $matches[0];

		foreach ($matches[1] as $i => $term_id){
			$thumbnail	= wpjam_get_term_thumbnail($term_id, [50,50]);
			$taxonomy	= get_term($term_id)->taxonomy;
			$capability	= get_taxonomy($taxonomy)->cap->edit_terms;

			if(current_user_can($capability)){
				$thumbnail = wpjam_get_list_table_row_action('set_thumbnail',[
					'id'	=> $term_id,
					'title'	=> $thumbnail ?: '<span class="no-thumbnail">暂无图片</span>',
				]);
			}

			$replace[$i]	= str_replace('<a class="row-title"', $thumbnail.'<a class="row-title"', $replace[$i]);
		}

		$html	= str_replace($search, $replace, $html);
	}

	return $html;
}

function wpjam_get_term_thumbnail_field($taxonomy){
	static $thumbnail_field;

	if(isset($thumbnail_field)){
		return $thumbnail_field;
	}

	$thumbnail_field	= [];

	$term_thumbnail_taxonomies	= wpjam_cdn_get_setting('term_thumbnail_taxonomies');

	if($term_thumbnail_taxonomies && in_array($taxonomy, $term_thumbnail_taxonomies)){
		$thumbnail_field	= ['title'=>'缩略图'];

		if(wpjam_cdn_get_setting('term_thumbnail_type') == 'img'){
			$thumbnail_field['type']		= 'img';
			$thumbnail_field['item_type']	= 'url';

			$width	= wpjam_cdn_get_setting('term_thumbnail_width') ?: 200;
			$height	= wpjam_cdn_get_setting('term_thumbnail_height') ?: 200;

			if($width || $height){
				$thumbnail_field['size']		= $width.'x'.$height;
				$thumbnail_field['description']	= '尺寸：'.$width.'x'.$height;
			}
		}else{
			$thumbnail_field['type']	= 'image';
		}
	}

	return $thumbnail_field;	
}