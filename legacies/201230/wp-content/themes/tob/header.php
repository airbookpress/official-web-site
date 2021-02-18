<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="cache-control" content="no-siteapp">
<title><?php echo _title() ?></title>
<?php wp_head(); ?>
<!--[if lt IE 9]><script src="<?php echo get_stylesheet_directory_uri() ?>/js/html5.js"></script><![endif]-->
</head>
<body <?php body_class(_bodyclass()) ?>>
<header class="header">
	<div class="container">
		<?php _the_logo(); ?>
		<div class="sitenav">
			<ul><?php _the_menu('nav'); ?></ul>
		</div>
		<span class="sitenav-on"><i class="fa">&#xe605;</i></span>
		<span class="sitenav-mask"></span>
		<?php if( _hui('sign_s') ){
			if( is_user_logged_in() ){
				global $current_user;
			?>
				<div class="signuser-welcome">
					<a class="signuser-info" target="_blank" href="<?php echo get_admin_url() ?>"><?php echo _get_user_avatar( $current_user->user_email, true, 50); ?><strong><?php echo $current_user->display_name ?></strong></a>
					<a class="signuser-logout" href="<?php echo wp_logout_url() ?>">退出</a>
				</div>
			<?php }else{ ?>
				<div class="usersign">
					<a class="usersign-login" target="_blank" href="<?php echo wp_login_url( home_url() ) ?>">登陆</a>
					<?php if( get_option('users_can_register') ){ ?><a class="usersign-register" target="_blank" href="<?php echo wp_registration_url() ?>">注册</a><?php } ?>
				</div>
			<?php } ?>
		<?php } ?>
		<?php 
			$acsort = _hui('ac_sort');
			if( $acsort ){
				$acsort = trim($acsort);
				$acsort = explode(' ', $acsort);
			}
			if( _hui('ac_head_s') && $acsort ){ 
				echo '<div class="accounts">';
				foreach ($acsort as $key => $index) {
					switch ($index) {
						case '1':
							if( _hui('ac_weibo') ) echo '<a class="account-weibo" target="_blank" href="'._hui('ac_weibo').'" tipsy title="微博"><i class="fa">&#xe608;</i></a>';
							break;
						case '2':
							if( _hui('ac_tqq') )  echo '<a class="account-tqq" target="_blank" href="'._hui('ac_tqq').'" tipsy title="腾讯微博"><i class="fa">&#xe60c;</i></a>';
							break;
						case '3':
							if( _hui('ac_qq') )  echo '<a class="account-qq" href="tencent://AddContact/?fromId=50&fromSubId=1&subcmd=all&uin='._hui('ac_qq').'" tipsy title="QQ：'._hui('ac_qq').'"><i class="fa">&#xe609;</i></a>';
							break;
						case '4':
							if( _hui('ac_phone') )  echo '<a class="account-phone" href="tel:'._hui('ac_phone').'" tipsy title="电话：'._hui('ac_phone').'"><i class="fa">&#xe686;</i></a>';
							break;
						case '5':
							if( _hui('ac_aliwang') )  echo '<a class="account-aliwang" target="_blank" href="https://amos.alicdn.com/getcid.aw?charset=utf-8&site=cntaobao&uid='._hui('ac_aliwang').'" tipsy title="阿里旺旺：'._hui('ac_aliwang').'"><i class="fa">&#xe75c;</i></a>';
							break;
						case '6':
							if( _hui('ac_qzone') )  echo '<a class="account-qzone" target="_blank" href="'._hui('ac_qzone').'" tipsy title="QQ空间"><i class="fa">&#xe607;</i></a>';
							break;
						case '7':
							if( _hui('ac_twitter') )  echo '<a class="account-twitter" target="_blank" href="'._hui('ac_twitter').'" tipsy title="Twitter"><i class="fa">&#xe902;</i></a>';
							break;
						case '8':
							if( _hui('ac_facebook') )  echo '<a class="account-facebook" target="_blank" href="'._hui('ac_facebook').'" tipsy title="Facebook"><i class="fa">&#xe725;</i></a>';
							break;
						case '9':
							if( _hui('ac_instagram') )  echo '<a class="account-instagram" target="_blank" href="'._hui('ac_instagram').'" tipsy title="Instagram"><i class="fa">&#xe6c0;</i></a>';
							break;
						case '10':
							if( _hui('ac_weixin') )  echo '<a class="account-weixin" href="javascript:;"><i class="fa">&#xe60e;</i><div class="account-popover"><div class="account-popover-content"><img src="'._hui('ac_weixin').'"></div></div></a>';
							break;
						case '11':
							if( _hui('ac_qqun') )  echo '<a class="account-qqun" target="_blank" href="'._hui('ac_qqun').'" tipsy title="加入QQ群"><i class="fa">&#xe655;</i></a>';
							break;
						default:
							break;
					}
				}
				echo '</div>';
			}
		?>
		<?php if( _hui('nav_search') ){ ?>
			<span class="searchstart-on"><i class="fa">&#xe600;</i></span>
			<span class="searchstart-off"><i class="fa">&#xe606;</i></span>
			<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>" >
				<button tabindex="3" class="sbtn" type="submit"><i class="fa">&#xe600;</i></button><input tabindex="2" class="sinput" name="s" type="text" placeholder="输入关键字" value="<?php echo htmlspecialchars($s) ?>">
			</form>
		<?php } ?>
	</div>
</header>