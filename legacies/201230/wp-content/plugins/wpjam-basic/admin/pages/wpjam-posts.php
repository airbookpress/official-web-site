<?php
add_filter('wpjam_basic_setting', function(){
	$fields	= [
		'post_list_set_thumbnail'	=> ['title'=>'缩略图',	'type'=>'checkbox',	'description'=>'在文章列表页显示和设置文章缩略图。'],
		'post_list_update_views'	=> ['title'=>'浏览数',	'type'=>'checkbox',	'description'=>'在文章列表页显示和修改文章浏览数。'],
		'post_list_author_filter'	=> ['title'=>'作者过滤',	'type'=>'checkbox',	'description'=>'在文章列表页支持通过作者进行过滤。'],
		'post_list_sort_selector'	=> ['title'=>'排序选择',	'type'=>'checkbox',	'description'=>'在文章列表页显示排序下拉选择框。'],
	];

	// $summary	= '文章类型扩展可以设置不同页面显示不同文章类型，详细介绍请点击：<a href="https://blog.wpjam.com/m/wpjam-posts-per-page/" target="_blank">文章类型扩展</a>。';

	return compact('fields', 'summary');
});

