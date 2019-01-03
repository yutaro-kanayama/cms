<?php

require 'model/OccupationLogic.php';

// セッション初期化
session_start();
unset($_SESSION['customer']);

// 職業マスタの取得
$occupationLogic = new OccupationLogic();
$occupation_master = $occupationLogic->getOccupationList();

// ビュー設定
$errors = array();
$customer['name'] = "";
$customer['introduction'] = "";
$customer['occupation_id'] = "";
$customer['birthday'] = "";
$main_view = 'view/input_view.php';
$heading = "顧客登録";
include 'view/layout_view.php';

?>
