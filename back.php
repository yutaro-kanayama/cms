<?php

require 'model/OccupationLogic.php';

// セッションから顧客情報を取得
session_start();
$customer = $_SESSION['customer'];

// 職業マスタを取得
$occupationLogic = new OccupationLogic();
$occupation_master = $occupationLogic->getOccupationList();

// ビューの設定
$errors = array();
$main_view = 'view/input_view.php';
$heading = isset($customer['id']) ? "顧客更新" : "顧客登録";
include 'view/layout_view.php';

?>