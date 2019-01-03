<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>CMS - 顧客管理システム</title>
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
<!-- header -->
<header class="header">
	<div class="header-inner clearfix">
		<div class="header-logo">顧客管理システム</div>
		<nav class="header-nav">
			<ul class="clearfix">
				<li><a href="index.php">顧客検索</a></li>
				<li><a href="create.php">新規登録</a></li>
			</ul>
		</nav>
	</div>
</header>
<!-- main -->
<main class="main">
	<div class="main-inner">
		<?php include($main_view) ?>
	</div>
</main>
</body>
</html>