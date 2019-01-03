<?php

require 'model/CustomerLogic.php';

// GETから削除する顧客IDを取得
$delete_id = null;
if (isset($_GET['id'])) {
	$delete_id = $_GET['id'];
}

// 削除処理
$customerLogic = new CustomerLogic();
$customerLogic->delete($delete_id);

// リダイレクトで再検索
header('Location: http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/paginate.php');
