<?php

require 'model/OccupationLogic.php';

// 職業マスタを取得
$occupationLogic = new OccupationLogic();
$occupation_master = $occupationLogic->getOccupationList();

// 変数初期化
$errors = array();
$searchform['name'] = "";
$searchform['occupations'] = array();
$searchform['from_birthday'] = "";
$searchform['to_birthday'] = "";
$customers = array();

// ビューファイル設定
$main_view = 'view/search_view.php';
include 'view/layout_view.php';
