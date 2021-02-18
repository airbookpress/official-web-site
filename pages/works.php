<?php

require_once('../assets/php/envars.php');

try {
    $dbc = new PDO(DBSN, DBUSER, DBPASS);
    if (isset($_GET['id'])) {
        $dbr = $dbc->prepare("SELECT * FROM works WHERE id=" .  $_GET['id']);
        $dbr->execute();
        $welems = $dbr->fetchAll();
        if (empty($welems)){
            header("location: /");
        } else {
            $welems = $welems[0];
        }
    } else {
        $dbr = $dbc->prepare("SELECT id FROM works ORDER BY RAND() LIMIT 1");
        $dbr->execute();
        $welems = $dbr->fetchAll();
        header("location: " . (empty($welems) ? '/' : '/works/'.$welems[0]['id']));
    }
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
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-185638629-5');
</script>
		<title>卷积传媒 - <?php 
		    switch (intval($welems['stype'])) {
		        case 1: echo '出版精品'; break;
		        default: echo '出版作品'; break;
		    }
        ?> - 《<?php echo $welems["title"]; ?>》</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="/" class="logo">
									<span class="symbol"><img src="../assets/iv/logo.png" alt="" /></span><span class="title">卷积传媒</span>
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
							<li><a href="/about">企业简介</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<h1><?php echo $welems["title"]; ?></h1>
							<h2><?php echo $welems["intro"]; ?></h2>
							<?php echo $welems["desc"]; ?>
						</div>
					</div>

				<!-- Footer -->
<?php require_once("../assets/php/fcp.php")?>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>