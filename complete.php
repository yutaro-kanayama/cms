<?php

require 'model/CustomerLogic.php';

// セッションから顧客情報を取得
session_start();
$customer = $_SESSION['customer'];

$customerLogic = new CustomerLogic();
if (isset($customer['id'])) {
	// 更新処理
	$customerLogic->edit(
			$customer['id'], 
			$customer['name'], 
			$customer['introduction'], 
			$customer['occupation_id'],
			$customer['birthday']
	);
} else {
	// 登録処理
	$customerLogic->register(
			$customer['name'], 
			$customer['introduction'], 
			$customer['occupation_id'],
			$customer['birthday']
	);
}

// セッションの顧客情報を削除
unset($_SESSION['customer']);

// ビューの設定
$main_view = 'view/complete_view.php';
include 'view/layout_view.php';
