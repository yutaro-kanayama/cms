<?php

require 'model/OccupationLogic.php';
require 'model/CustomerLogic.php';

// 職業マスタ取得
$occupationLogic = new OccupationLogic();
$occupation_master = $occupationLogic->getOccupationList();

// セッションの顧客情報を初期化
session_start();
unset($_SESSION['customer']);

// データベースからIDに紐づく顧客情報を取得
$id = null;
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
$customerLogic = new CustomerLogic();
$customer = $customerLogic->get($id);

// セッションに顧客情報を保存
$_SESSION['customer'] = $customer;

// ビューの設定
$errors = array();
$main_view = 'view/input_view.php';
$heading = "顧客更新";
include 'view/layout_view.php';
