<?php

require_once('./assets/php/envars.php');

try {
    $dbc = new PDO(DBSN, DBUSER, DBPASS);
    $dbr = $dbc->prepare("SELECT * FROM works");
    $dbr->execute();
    $works = $dbr->fetchAll();
    // print_r($works);
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

if (!is_null($dbc)) {
    $dbc = null;
}

?>

<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-185638629-5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-185638629-5');
</script>

		<title>欢迎莅临卷积传媒！</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="google-site-verification" content="PX4E7Dd62r27rMbLLkvAq9_P-fA1125A6HFCqYVAvv4" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="/" class="logo">
									<span class="symbol"><img src="assets/iv/logo.png" alt="" /></span><span class="title">卷积传媒</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">导航</a></li>
									</ul>
								</nav>

						</div>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<h2>导航</h2>
						<ul>
							<li><a href="/">首页</a></li>
							<li><a href="/jobs">招贤纳士</a></li>
							<li><a href="/about">关于我们</a></li>
						</ul>
					</nav>
					
				<!-- Main -->
					<div id="main">
						<div class="inner">
							<header>
								<h1>视频导向的出版物，干货满满<br>立刻<a href="http://www.contentstore.cn/getapp">下载应用</a>体验</h1>
								<p>想和下面各位一样出版自己的作品并在各大平台迅速成为焦点，走上人生巅峰吗？成为卷积媒体作者，并从今天开始和我们一起立刻开始规划精彩人生吧！</p>
							</header>
							<h2>作品</h2>
							<section class="tiles">
							    <?php
							    foreach ($works as $swork) {
							    ?>
								<article class="style<?php echo $swork["stype"]; ?>">
									<span class="image">
										<img src="assets/iv/pic<?php echo $swork["id"]; ?>.jpg" alt="<?php echo $swork["title"]; ?>" />
									</span>
									<a href="/works/<?php echo $swork["id"]; ?>">
										<h2><?php echo $swork["title"]; ?></h2>
										<div class="content">
											<p><?php echo $swork["intro"]; ?></p>
										</div>
									</a>
								</article>
								<?php
							    }
							    ?>
							</section>
						</div>
					</div>

				<!-- Footer -->
<?php require_once("./assets/php/fcp.php")?>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>