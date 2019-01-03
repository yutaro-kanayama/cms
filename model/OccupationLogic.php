<?php

class OccupationLogic {

	public function getOccupationList() {
		$occupations = null;
		try {
			$con = new PDO('mysql:host=localhost;dbname=cms;charset=utf8', 'root', 'root');
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $con->prepare('SELECT * FROM occupation ORDER BY id ASC');
			$stmt->execute();
			$occupations = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			$stmt = null;
			$con = null;
		} catch (PDOException $e) {
			die('データベースに接続できません：' . $e->getMessage());
		}
		return $occupations;
	}
}
