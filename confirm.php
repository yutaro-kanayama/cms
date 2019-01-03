<?php

require 'model/OccupationLogic.php';

// 職業マスタを取得
$occupationLogic = new OccupationLogic();
$occupation_master = $occupationLogic->getOccupationList();

// セッションから顧客情報を取得
session_start();
$customer = array();
if (isset($_SESSION['customer'])) $customer = $_SESSION['customer'];

// フォーム内容を取得
$customer['name'] = $_POST['name'];
$customer['introduction'] = $_POST['introduction'];
$customer['occupation_id'] = $_POST['occupation_id'];
$customer['birthday'] = $_POST['birthday'];

// セッションに顧客情報を保存
$_SESSION['customer'] = $customer;

// バリデーション
$errors = array();
if (!strlen($_POST['name'])) {
	$errors[] = "氏名を入力してください";
} else if (mb_strlen($_POST['name']) > 20) {
	$errors[] = "氏名を２０文字以内でしてください";
}
if (!strlen($_POST['introduction'])) {
	$errors[] = "自己紹介を入力してください";
} else if (mb_strlen($_POST['introduction']) > 200) {
	$errors[] = "自己紹介を２００文字以内でしてください";
}
if (!strlen($_POST['occupation_id'])) {
	$errors[] = "職業を選択してください";
}
if (!strlen($_POST['birthday'])) {
	$errors[] = "生年月日を入力してください";
} else {
	$now_Date = new DateTime();
	$input_date = new DateTime($_POST['birthday']);
	if ($input_date > $now_Date) {
		$errors[] = "本日より過去の生年月日を入力してください";
	}	
}

// バリデーションエラーの場合は再度入力画面へ
if (count($errors) > 0)  {
	$main_view = 'view/input_view.php';
	$heading = isset($customer['id']) ? "顧客更新" : "顧客登録";
	include 'view/layout_view.php';
	exit();
} else {
	$main_view = 'view/confirm_view.php';
	$heading = isset($customer['id']) ? "顧客更新確認" : "顧客登録確認";
	include 'view/layout_view.php';
}