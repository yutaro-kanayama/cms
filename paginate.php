<?php

require 'model/OccupationLogic.php';
require 'model/CustomerLogic.php';

// 職業マスタを取得
$occupationLogic = new OccupationLogic();
$occupation_master = $occupationLogic->getOccupationList();

// セッションから検索条件を取得
session_start();
$searchform = $_SESSION['searchform'];

// 検索処理
$page = 1;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
$limit = 5;
$offset = ($limit * ($page - 1));

$customerLogic = new CustomerLogic();
$count = $customerLogic->count(
		$searchform['name'], 
		$searchform['occupations'], 
		$searchform['from_birthday'], 
		$searchform['to_birthday']
);
$customers = $customerLogic->search(
	$searchform['name'], 
	$searchform['occupations'], 
	$searchform['from_birthday'], 
	$searchform['to_birthday'], 
	$limit, 
	$offset
);

// ページネーション制御
$hasPrevious = ($page == 1) ? false : true;
$hasNext = false;
if ($count > $offset + $limit) {
	$hasNext = true;
}

// ビューファイル設定
$errors = array();
$main_view = 'view/search_view.php';
include 'view/layout_view.php';
