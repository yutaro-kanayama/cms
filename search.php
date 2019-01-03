<?php

require 'model/OccupationLogic.php';
require 'model/CustomerLogic.php';

// 職業マスタを取得
$occupationLogic = new OccupationLogic();
$occupation_master = $occupationLogic->getOccupationList();

// 表示用に検索条件を設定
$searchform['name'] = $_POST['name'];
$searchform['occupations'] = array();
if (isset($_POST['occupations'])) {
	$searchform['occupations'] = $_POST['occupations'];
}
$searchform['from_birthday'] = $_POST['from_birthday'];
$searchform['to_birthday'] = $_POST['to_birthday'];

// バリデーション
$errors = array();
if (strlen($searchform['from_birthday']) && strlen($searchform['to_birthday'])) {
	$from_date = new DateTime($searchform['from_birthday']);
	$to_date = new DateTime($searchform['to_birthday']);
	if ($from_date > $to_date) {
		$errors[] = "生年月日の範囲を正しく入力してください";
	}
}
if (count($errors) > 0) {
	$customers = array();
	$main_view = 'view/search_view.php';
	include 'view/layout_view.php';
	exit();
}

// ページネーション用に検索条件をセッションに保存
session_start();
$_SESSION['searchform'] = $searchform;

// 検索処理
$page = 1;
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
$hasPrevious = false;
$hasNext = false;
if ($count > $offset + $limit) {
	$hasNext = true;
}

// ビューファイル設定
$main_view = 'view/search_view.php';
include 'view/layout_view.php';
