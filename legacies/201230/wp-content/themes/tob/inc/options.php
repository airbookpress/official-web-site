<?php

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'tob';
}


/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {


	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	// $options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}



	$options_linkcats = array();
	$options_linkcats_obj = get_terms('link_category');
	foreach ( $options_linkcats_obj as $tag ) {
		$options_linkcats[$tag->term_id] = $tag->name;
	}



	// If using image radio buttons, define a directory path
	$adsdesc =  '可添加任意广告联盟代码或自定义代码';



	$qrcode = get_stylesheet_directory_uri() . '/img/qrcode.png';
	$logo = get_stylesheet_directory_uri() . '/img/logo.png';

	$options = array();












	
	$options[] = array(
		'name' => '基本',
		'type' => 'heading');


	$options[] = array(
		'name' => "主题风格",
		'desc' => "13种颜色供选择，点击选择你喜欢的颜色，保存后前端展示会有所改变。",
		'id' => "theme_skin",
		'std' => "#FF6651",
		'type' => "colorradio",
		'options' => array(
			'#FF6651' => 1,
			'#2CDB87' => 2,
			'#00D6AC' => 3,
			'#16C0F8' => 4,
			'#EA84FF' => 5,
			'#FDAC5F' => 6,
			'#FD77B2' => 7,
			'#76BDFF' => 8,
			'#C38CFF' => 9,
			'#FF926F' => 10,
			'#8AC78F' => 11,
			'#C7C183' => 12,
			'#384047' => 13
		)
	);

	$options[] = array(
		'name' => '始终单栏布局'.'(v0.9+)',
		'id' => 'onecolum',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启 （开启后网站所有页面始终保持单栏布局）');

	$options[] = array(
		'id' => 'theme_skin_custom',
		'std' => "",
		'desc' => '不喜欢上面提供的颜色，你好可以在这里自定义设置，如果不用自定义颜色清空即可（默认不用自定义）',
		'type' => "color");



	$options[] = array(
		'name' => 'Logo 电脑端',
		'id' => 'logo_src',
		'desc' => 'Logo不会做？去themebetter提交工单求助！Logo 最大高：40px；建议尺寸：180*40px 格式：png',
		'std' => $logo,
		'type' => 'upload');

	$options[] = array(
		'name' => 'Logo 手机端',
		'id' => 'logo_src_m',
		'desc' => 'Logo不会做？去themebetter提交工单求助！Logo 最大高：30px；建议尺寸：180*60px 格式：png',
		'std' => $logo,
		'type' => 'upload');


	$options[] = array(
		'name' => '全站连接符',
		'id' => 'connector',
		'desc' => '一经选择，切勿更改，对SEO不友好，一般为“-”或“_”',
		'std' => _hui('connector') ? _hui('connector') : '-',
		'type' => 'text',
		'class' => 'mini');

	$options[] = array(
		'name' => '已登录用户不显示广告'.'(v1.1+)',
		'id' => 'hide_for_logger',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启，开启后tob主题设置中的广告位和小工具-广告都将针对已登录用户关闭');

	$options[] = array(
		'name' => '评论整体关闭'.'(v1.0+)',
		'id' => 'kill_comment_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启，开启后全站的评论功能将关闭');

	$options[] = array(
		'name' => 'PC端导航栏登录注册'.'(v0.8+)',
		'id' => 'sign_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启');


	$options[] = array(
		'name' => 'PC端导航栏固定顶部'.'(v0.5+)',
		'id' => 'nav_fixed_top',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启');

	$options[] = array(
		'name' => '导航栏显示搜索框',
		'id' => 'nav_search',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	$options[] = array(
		'name' => '网站整体变灰',
		'id' => 'site_gray',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启'.'（支持IE、Chrome，基本上覆盖了大部分用户，不会降低访问速度）');

	$options[] = array(
		'name' => '分类url去除category字样',
		'id' => 'no_categoty',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启'.'（该功能和no-category插件作用相同，可停用no-category插件）');

	$options[] = array(
		'name' => '上传文件重命名',
		'id' => 'newfilename',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启'.'（该功能会针对上传的文件和图片重命名，如：2ab6537935def43.jpg）');

	$options[] = array(
		'name' => '网站底部“由themebetter提供”',
		'id' => 'themecopyright',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启'.'（开启不会对你的站有任何影响，这会让更多用户知道themebetter以促进主题发展和更新，感谢支持）');

	$options[] = array(
		'name' => '自动将文章中上传的第一张图片缩略图设为特色图像',
		'id' => 'set_postthumbnail',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启'.'（如果没有添加文章缩略图，将自动获取文章中的第一张图片的缩略图设置为特色图像，开启后只在保存和发布文章时有效）');

	$options[] = array(
		'name' => '自动将文章中的第一张图片设为特色图像',
		'id' => 'thumb_postfirstimg_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启'.'（如果文章没有缩略图，自动将文章中的第一张图片设为特色图像）');

	$options[] = array(
		'id' => 'thumb_postfirstimg_lastname',
		'std' => '',
		'desc' => '缩略图后缀，如：-240x180 或 !240x180',
		'type' => 'text');

	$options[] = array(
		'id' => 'thumb_postfirstimg_lastname_next',
		'type' => "checkbox",
		'std' => false,
		'desc' => '缩略图后缀在图片扩展名之后，如：图片地址 aaa.jpg，选择此项后，缩略图地址为 aaa.jpg+缩略图后缀（如：aaa.jpg!240x180），一般情况下各大图床需要的是这种'.'(v1.1+)');

	


	


	$options[] = array(
		'name' => '底部友情链接'.'(v0.5+)',
		'id' => 'flinks_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启'.'（开启后会在页面底部增加一个链接模块）');

	$options[] = array(
		'id' => 'flinks_home_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => '只在首页开启');

	$options[] = array(
		'id' => 'flinks_cat',
		'options' => $options_linkcats,
		'desc' => '选择一个底部友情链接的链接分类',
		'type' => 'select');

	$options[] = array(
		'name' => '底部菜单'.'(v0.8+)',
		'id' => 'bomnav_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启（开启后可以在外观-菜单中创建新的菜单并选择菜单位置为“底部菜单”），注：该菜单不显示二级');


	$options[] = array(
		'name' => '后台登录页 Logo'.' (v1.2+)',
		'id' => 'login_logo_src',
		'desc' => 'Logo不会做？去themebetter提交工单求助！建议尺寸：200*60px',
		'std' => '',
		'type' => 'upload');

	

	












	
	$options[] = array(
		'name' => 'SEO',
		'type' => 'heading');


	$options[] = array(
		'name' => '首页关键字(keywords)',
		'id' => 'keywords',
		'std' => '123,12345',
		'desc' => '关键字有利于SEO优化，建议个数在5-10之间，用英文逗号隔开',
		'settings' => array(
			'rows' => 4
		),
		'type' => 'textarea');

	$options[] = array(
		'name' => '首页描述(description)',
		'id' => 'description',
		'std' => '123 一个高端大气上档次的网站',
		'desc' => '描述有利于SEO优化，建议字数在30-70之间',
		'settings' => array(
			'rows' => 4
		),
		'type' => 'textarea');

	$options[] = array(
		'name' => '网站自动添加关键字和描述',
		'id' => 'site_keywords_description_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启'.'（开启后所有页面将自动使用主题配置的关键字和描述，具体规则可以自行查看页面源码得知）');

	$options[] = array(
		'name' => '文章关键字和描述自定义',
		'id' => 'post_keywords_description_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启'.'（开启后你需要在编辑文章的时候书写关键字和描述，如果为空，将自动使用主题配置的关键字和描述；开启这个必须开启上面的“网站自动添加关键字和描述”开关）');









	




	$options[] = array(
		'name' => '列表',
		'type' => 'heading');


	$options[] = array(
		'name' => "列布局",
		'desc' => '检测到本站缩略图尺寸为：'. get_option('thumbnail_size_w') .' x '. get_option('thumbnail_size_h') .'，请根据缩略图尺寸（设置-多媒体中可设置）合理选择列布局',
		'id' => "list_cols",
		'std' => "5",
		'type' => "radio",
		'options' => array(
			'5' => '5列布局（建议缩略图宽小于300）',
			'4' => '4列布局（建议缩略图宽介于300-399之间）',
			'3' => '3列布局（建议缩略图宽介于400-619之间）',
			'2' => '2列布局（建议缩略图宽大于620）',
		)
	);

	$options[] = array(
		'name' => '列布局：图文一体',
		'id' => 'list_imagetext',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启 （开启后文字会显示在图片上方）');

	$options[] = array(
		// 'name' => '列布局：小部件触显',
		'id' => 'list_hover_plugin',
		'type' => "checkbox",
		'std' => false,
		'desc' => 'PC端开启小部件触显 （开启后鼠标触发的时候显示小部件）');

	$options[] = array(
		'name' => '列布局：小部件开启',
		'id' => 'post_plugin',
		'std' => array(
			'view' => 1,
			'like' => 1,
			'comm' => 1
		),
		'type' => "multicheck",
		'options' => array(
			'view' => ' 阅读量（无需安装插件） ',
			'like' => ' 点赞（无需安装插件） ',
			'comm' => ' 评论数 '
		));

	$options[] = array(
		'name' => '手机端列表布局'.'(v1.0+)',
		'id' => 'phone_list',
		'std' => 'two',
		'type' => "radio",
		'options' => array(
			'news' => ' 新闻列表 ',
			'one' => ' 一行一图 ',
			'two' => ' 一行两图 '
		));

	$options[] = array(
		'name' => '列表图片鼠标触发放大效果',
		'id' => 'list_thumb_hover_action',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');


	$options[] = array(
		'name' => '默认文章缩略图',
		'id' => 'post_default_thumb',
		'std' => get_stylesheet_directory_uri() . '/img/thumb.png',
		'desc' => '用于：文章默认缩略图的展示。图片尺寸为：'. get_option('thumbnail_size_w') .' x '. get_option('thumbnail_size_h'),
		'type' => 'upload');


	$options[] = array(
		'name' => '新窗口打开列表文章',
		'id' => 'target_blank',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启');

	

	$options[] = array(
		'name' => '分页模式',
		'id' => 'paging_type',
		'std' => "next",
		'type' => "radio",
		'options' => array(
			'next' => ' 上一页 和 下一页',
			'multi' => ' 显示页码，如：上一页 1 2 3 4 5 下一页'
		));

	

	$options[] = array(
		'name' => 'PC端分页无限加载',
		'id' => 'ajaxpager_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	$options[] = array(
		'name' => '手机端分页无限加载',
		'id' => 'ajaxpager_s_m',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	$options[] = array(
		'name' => '分页无限加载页数',
		'id' => 'ajaxpager',
		'std' => 10,
		'desc' => '为0时表示不开启分页无限加载功能，默认为10',
		'type' => 'text');





	


	













	
	$options[] = array(
		'name' => '首页',
		'type' => 'heading');

	$options[] = array(
		'name' => '首页置顶文章标记文字',
		'id' => 'sticky_text',
		'std' => '热门推荐',
		'type' => 'text');

	$options[] = array(
		'name' => '首页不显示这些分类的文章'.'(v0.5+)',
		'id' => 'notinhome',
		'options' => $options_categories,
		'desc' => '',
		'type' => 'multicheck');


	$options[] = array(
		'name' => '首页标语栏',
		'id' => 'focusbox_s',
		'std' => true,
		'desc' => '开启',
		'type' => 'checkbox');

	$options[] = array(
		'name' => '首页标语栏：标题',
		'id' => 'focusbox_title',
		'std' => '国内最有趣的知识自媒体',
		'type' => 'text');

	$options[] = array(
		'name' => '首页标语栏：描述',
		'id' => 'focusbox_text',
		'std' => '你好，欢迎来到themebetter主题世界，这是最有趣的媒体',
		'type' => 'text');










	$options[] = array(
		'name' => '分类',
		'type' => 'heading');

	$options[] = array(
		'name' => '二级分类菜单'.'(v0.8+)',
		'id' => 'catpage_menus_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	$options[] = array(
		'name' => '分类显示当前栏目数据条数'.'(v1.2+)',
		'id' => 'catpage_counts_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');








	
	$options[] = array(
		'name' => '文章',
		'type' => 'heading');

	$options[] = array(
		'name' => '文章中图片自动增加alt和title属性'.'(v0.7+)',
		'id' => 'post_alt_title_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启，开启后自动给文章中所有的图片增加alt和title（不论之前有无alt或title），alt为文章标题，title为文章标题+网站标题');


	$options[] = array(
		'name' => '文章来源',
		'id' => 'post_from_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');
	
	$options[] = array(
		'id' => 'post_from_h1',
		'std' => '来源：',
		'desc' => '文章来源显示字样',
		'type' => 'text');

	$options[] = array(
		'id' => 'post_from_link_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '文章来源加链接');



	$options[] = array(
		'name' => '文章阅读数',
		'id' => 'post_post_views',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");


	$options[] = array(
		'name' => '文章页尾版权',
		'id' => 'post_copyright_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	$options[] = array(
		'name' => '文章页尾版权：提示字符',
		'id' => 'post_copyright',
		'std' => '未经允许不得转载：',
		'type' => 'text');


	$options[] = array(
		'name' => '全屏查看相册模式',
		'id' => 'full_gallery',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");


	$options[] = array(
		'name' => '全屏查看图片模式',
		'id' => 'full_image',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");


	$options[] = array(
		'name' => '移动端缩放展示图片'.'(v0.9+)',
		'id' => 'zoom_image',
		'desc' => '开启 （此项开启后优先级最高，且全屏查看图片模式的功能将在移动端失效）',
		'std' => false,
		'type' => "checkbox");



	$options[] = array(
		'name' => '文章标签',
		'id' => 'post_tags_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");



	$options[] = array(
		'name' => '公众号',
		'id' => 'post_wechats_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '公众号：二维码',
		'id' => 'post_wechat_1_image',
		'desc' => '',
		'std' => $qrcode,
		'type' => 'upload');

	$options[] = array(
		'name' => '公众号：标题',
		'id' => 'post_wechat_1_title',
		'std' => '微信公众号：这是个测试',
		'type' => 'text');

	$options[] = array(
		'name' => '公众号：描述',
		'id' => 'post_wechat_1_desc',
		'std' => '关注我们，每天分享更多有趣的事儿，有趣有料！',
		'type' => 'text');

	$options[] = array(
		'name' => '公众号：关注数',
		'id' => 'post_wechat_1_users',
		'std' => '12000人已关注',
		'type' => 'text');







	$options[] = array(
		'name' => '打赏',
		'id' => 'post_rewards_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '打赏：显示文字',
		'id' => 'post_rewards_text',
		'std' => '打赏',
		'type' => 'text');

	$options[] = array(
		'name' => '打赏：弹出层标题',
		'id' => 'post_rewards_title',
		'std' => '觉得文章有用就打赏一下文章作者',
		'type' => 'text');

	$options[] = array(
		'name' => '打赏：支付宝收款二维码',
		'id' => 'post_rewards_alipay',
		'desc' => '',
		'std' => $qrcode,
		'type' => 'upload');

	$options[] = array(
		'name' => '打赏：微信收款二维码',
		'id' => 'post_rewards_wechat',
		'desc' => '',
		'std' => $qrcode,
		'type' => 'upload');


	$options[] = array(
		'name' => '点赞',
		'id' => 'post_like_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");


	$options[] = array(
		'name' => '上一篇和下一篇文章',
		'id' => 'post_prevnext_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");


	$options[] = array(
		'name' => '相关文章',
		'id' => 'post_related_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	$options[] = array(
		'name' => '相关文章：标题',
		'id' => 'related_title',
		'std' => '相关推荐',
		'type' => 'text');

	$options[] = array(
		'name' => '相关文章：显示数量',
		'id' => 'post_related_n',
		'std' => 8,
		'type' => 'text');


	






	$options[] = array(
		'name' => '页面',
		'type' => 'heading');

	$options[] = array(
		'name' => '全屏查看相册模式',
		'id' => 'page_full_gallery',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '全屏查看图片模式',
		'id' => 'page_full_image',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '点赞',
		'id' => 'page_like_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '页面模板：7天热门',
		'id' => 'page_week_count',
		'std' => 50,
		'desc' => '显示数量',
		'type' => "text");

	$options[] = array(
		'name' => '页面模板：30天热门',
		'id' => 'page_month_count',
		'std' => 50,
		'desc' => '显示数量',
		'type' => "text");


	$options[] = array(
		'name' => '页面模板：点赞排行',
		'id' => 'page_lieks_count',
		'std' => 50,
		'desc' => '显示数量',
		'type' => "text");

	$options[] = array(
		'name' => '页面模板：热门标签',
		'id' => 'page_tags_count',
		'std' => 50,
		'desc' => '显示数量',
		'type' => "text");


	$options[] = array(
		'name' => '页面模板：友情链接 链接分类',
		'id' => 'page_links_cat',
		'options' => $options_linkcats,
		'type' => 'multicheck');











	$options[] = array(
		'name' => '分享',
		'type' => 'heading');

	$options[] = array(
		'name' => '文章内容底部分享模块',
		'id' => 'post_share_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '页面内容底部分享模块',
		'id' => 'page_share_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '排序',
		'id' => 'share_sort',
		'std' => '1 2 3 4 5 6 7',
		'desc' => '将以下序号填入其中，使用空格隔开即可排序，默认：1 2 3 4 5 6 7
			<div class="optionsframework-ols">
				<ol>
					<li>微信</li>
					<li>微博</li>
					<li><del>腾讯微博</del>，删除原因：开发平台api一直403</li>
					<li>QQ</li>
					<li>QQ空间</li>
					<li>人人网</li>
					<li>豆瓣网</li>
					<li>Line</li>
					<li>Twitter</li>
					<li>Facebook</li>
				</ol>
			</div>
		',
		'type' => 'text');



	$options[] = array(
		'name' => '被分享时优先选择文章特色图像',
		'id' => 'share_post_image_thumb',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	$options[] = array(
		'name' => '被分享时的默认图片',
		'id' => 'share_base_image',
		'desc' => '主要用于：分享。建议图片尺寸为：200*200',
		'type' => 'upload');

	

	















	$options[] = array(
		'name' => '社交',
		'type' => 'heading');

	$options[] = array(
		'name' => '网站顶部右侧社交',
		'id' => 'ac_head_s',
		'std' => true,
		'desc' => '开启',
		'type' => 'checkbox');

	$options[] = array(
		'name' => '网站顶部右侧社交排序',
		'id' => 'ac_sort',
		'std' => '10 1 2 3 4',
		'desc' => '将以下社交地址前的序号填入其中，使用空格隔开即可排序，默认：10 1 2 3 4',
		'type' => 'text');

	$options[] = array(
		'name' => '1、微博地址',
		'id' => 'ac_weibo',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '2、腾讯微博地址',
		'id' => 'ac_tqq',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '3、QQ号码'.'(v0.5+)',
		'id' => 'ac_qq',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '4、电话号码'.'(v0.8+)',
		'id' => 'ac_phone',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '5、阿里旺旺用户名'.'(v0.8+)',
		'id' => 'ac_aliwang',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '6、QQ空间网址'.'(v0.8+)',
		'id' => 'ac_qzone',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '7、Twitter 网址'.'(v0.8+)',
		'id' => 'ac_twitter',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '8、Facebook 网址'.'(v0.8+)',
		'id' => 'ac_facebook',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '9、Instagram 网址'.'(v0.8+)',
		'id' => 'ac_instagram',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '10、微信二维码',
		'id' => 'ac_weixin',
		'desc' => '用于：网站顶部社交账号区域的微信展示。建议图片尺寸为：200*200',
		'std' => $qrcode,
		'type' => 'upload');

	$options[] = array(
		'name' => '11、QQ群 网址'.'(v1.2+)',
		'id' => 'ac_qqun',
		'std' => '',
		'type' => 'text');













	
	$options[] = array(
		'name' => '评论',
		'type' => 'heading');

	$options[] = array(
		'name' => '评论标题',
		'id' => 'comment_title',
		'std' => '评论',
		'type' => 'text');

	$options[] = array(
		'name' => '评论框默认字符',
		'id' => 'comment_text',
		'std' => '你的评论可以一针见血',
		'type' => 'text');

	$options[] = array(
		'name' => '评论提交按钮字符',
		'id' => 'comment_submit_text',
		'std' => '提交评论',
		'type' => 'text');















	$options[] = array(
		'name' => '广告位',
		'type' => 'heading' );

	$ads = array(
		'ad_home_header' => '首页列表头部 (v1.1+)',
		'ad_home_footer' => '首页列表底部 (v1.1+)',
		'ad_list_header' => '列表页头部',
		'ad_list_footer' => '列表页底部',
		'ad_post_header' => '文章页内容上',
		'ad_post_footer' => '文章页内容下',
		'ad_post_pager_header' => '文章页内容分页上 (v1.1+)',
		'ad_post_pager_footer' => '文章页内容分页下 (v1.1+)',
		'ad_post_comment' => '文章页评论上',
		'ad_page_header' => '页面内容上',
		'ad_page_footer' => '页面内容下',
	);

	foreach ($ads as $key => $adtit) {
		$options[] = array(
			'name' => $adtit,
			'id' => $key.'_s',
			'std' => false,
			'desc' => '开启',
			'type' => 'checkbox');
		$options[] = array(
			'desc' => '非手机端'.' '.$adsdesc,
			'id' => $key,
			'std' => '',
			'settings'=>array('rows'=>6),
			'type' => 'textarea');
		$options[] = array(
			'id' => $key.'_m',
			'std' => '',
			'desc' => '手机端'.' '.$adsdesc,
			'settings'=>array('rows'=>6),
			'type' => 'textarea');
	}













	
	$options[] = array(
		'name' => '自定义代码',
		'type' => 'heading' );

	$options[] = array(
		'name' => '自定义CSS样式',
		'desc' => '位于&lt;/head&gt;之前，直接写样式代码，不用添加&lt;style&gt;标签',
		'id' => 'csscode',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => '自定义头部代码',
		'desc' => '位于&lt;/head&gt;之前，这部分代码是在主要内容显示之前加载，通常是CSS样式、自定义的<meta>标签、全站头部JS等需要提前加载的代码',
		'id' => 'headcode',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => '自定义底部代码',
		'desc' => '位于&lt;/body&gt;之前，这部分代码是在主要内容加载完毕加载，通常是JS代码',
		'id' => 'footcode',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => '网站统计代码',
		'desc' => '位于底部，用于添加第三方流量数据统计代码，如：Google analytics、百度统计、CNZZ、51la，国内站点推荐使用百度统计，国外站点推荐使用Google analytics',
		'id' => 'trackcode',
		'std' => '',
		'type' => 'textarea');
		
	return $options;
}