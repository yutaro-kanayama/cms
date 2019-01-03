<?php

class CustomerLogic {

	/**
	 * 顧客登録
	 */
	public function register($name, $introduction, $occupation_id, $birthday) {
		try {
			$con = new PDO('mysql:host=localhost;dbname=cms;charset=utf8', 'root', 'root');
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO customer (id, name, introduction, occupation_id, birthday, created_at, updated_at) VALUES (NULL, :name, :introduction, :occupation_id, :birthday, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
			$stmt = $con->prepare($sql); 
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':introduction', $introduction);
			$stmt->bindParam(':occupation_id', $occupation_id, PDO::PARAM_INT);
			$stmt->bindParam(':birthday', $birthday);
			$stmt->execute();
			$stmt = null;
			$con = null;
		} catch (PDOException $e) {
			die('データベースに接続できません：' . $e->getMessage());
		}
	}

	/**
	 * 顧客取得
	 */
	public function get($id) {
		$customer = null;
		try {
			$con = new PDO('mysql:host=localhost;dbname=cms;charset=utf8', 'root', 'root');
			$stmt = $con->prepare('SELECT * FROM customer WHERE id = :id'); 
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$customer = $stmt -> fetch(PDO::FETCH_ASSOC);
			$stmt = null;
			$con = null;
		} catch (PDOException $e) {
			die('データベースに接続できません：' . $e->getMessage());
		}
		return $customer;
	}

	/**
	 * 顧客カウント
	 */
	public function count($name, $occupations, $from_birthday, $to_birthday) {
		$count = 0;
		try {
			$con = new PDO('mysql:host=localhost;dbname=cms;charset=utf8', 'root', 'root');
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// SQL作成
			$sql = "SELECT COUNT(id) as count FROM customer WHERE 1";
			if (isset($name) && strlen($name) > 0) {
				$sql .= " AND customer.name LIKE :name";
			}
			if (isset($occupations) && count($occupations) > 0) {
				$bindQuery = "";
				foreach ($occupations as $key => $value) {
					$bindQuery .= ":occupation" . $key . ", ";
				}
				$bindQuery = rtrim($bindQuery, ", ");
				$sql .= " AND customer.occupation_id IN ($bindQuery)";
			}
			if (isset($from_birthday) && strlen($from_birthday) > 0) {
				$sql .= " AND customer.birthday >= :from_birthday";
			}
			if (isset($to_birthday) && strlen($to_birthday) > 0) {
				$sql .= " AND customer.birthday <= :to_birthday";
			}
			$stmt = $con->prepare($sql); 

			if (isset($name) && strlen($name) > 0) {
				$name = "%" . $name . "%";
				$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			}	
			if (isset($occupations) && count($occupations) > 0) {
				foreach ($occupations as $key => $value) {
					$stmt->bindParam(":occupation" . $key, $occupations[$key], PDO::PARAM_INT);
				}
			}
			if (isset($from_birthday) && strlen($from_birthday) > 0) {
				$stmt->bindParam(':from_birthday', $from_birthday, PDO::PARAM_STR);
			}
			if (isset($to_birthday) && strlen($to_birthday) > 0) {
				$stmt->bindParam(':to_birthday', $to_birthday, PDO::PARAM_STR);
			}
			$stmt->execute();
			$count = $stmt -> fetch(PDO::FETCH_ASSOC);
			$stmt = null;
			$con = null;
		} catch (PDOException $e) {
			die('データベース接続できません：' . $e->getMessage());
		}
		return $count['count'];
	}

	/**
	 * 顧客検索
	 */
	public function search($name, $occupations, $from_birthday, $to_birthday, $limit, $offset) {
		$customers = array();
		try {
			$con = new PDO('mysql:host=localhost;dbname=cms;charset=utf8', 'root', 'root');
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// SQL作成
			$sql = "
				SELECT 
					customer.id as customer_id, 
					customer.name as customer_name, 
					occupation.name as occupation_name, 
					customer.birthday as customer_birthday 
				FROM customer 
				INNER JOIN occupation ON customer.occupation_id = occupation.id 
				WHERE 1
			";

			if (isset($name) && strlen($name) > 0) {
				$sql .= " AND customer.name LIKE :name";
			}
			if (isset($occupations) && count($occupations) > 0) {
				$bindQuery = "";
				foreach ($occupations as $key => $value) {
					$bindQuery .= ":occupation" . $key . ", ";
				}
				$bindQuery = rtrim($bindQuery, ", ");
				$sql .= " AND customer.occupation_id IN ($bindQuery)";
			}
			if (isset($from_birthday) && strlen($from_birthday) > 0) {
				$sql .= " AND customer.birthday >= :from_birthday";
			}
			if (isset($to_birthday) && strlen($to_birthday) > 0) {
				$sql .= " AND customer.birthday <= :to_birthday";
			}
			$sql .= " ORDER BY customer.id DESC LIMIT :limit OFFSET :offset";
			// var_dump($sql);exit();
			$stmt = $con->prepare($sql); 

			if (isset($name) && strlen($name) > 0) {
				$name = "%" . addcslashes($name, '\_%') . "%";
				$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			}	
			if (isset($occupations) && count($occupations) > 0) {
				foreach ($occupations as $key => $value) {
					$stmt->bindParam(":occupation" . $key, $occupations[$key], PDO::PARAM_INT);
				}
			}
			if (isset($from_birthday) && strlen($from_birthday) > 0) {
				$stmt->bindParam(':from_birthday', $from_birthday, PDO::PARAM_STR);
			}
			if (isset($to_birthday) && strlen($to_birthday) > 0) {
				$stmt->bindParam(':to_birthday', $to_birthday, PDO::PARAM_STR);
			}
			$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
			$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
			$stmt->execute();

			while ($customer = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				$customers[] = $customer;
			}
			$stmt = null;
			$con = null;
		} catch (PDOException $e) {
			die('データベース接続できません：' . $e->getMessage());
		}

		return $customers;
	}

	/**
	 * 顧客更新
	 */
	public function edit($id, $name, $introduction, $occupation_id, $birthday) {
		try {
			$con = new PDO('mysql:host=localhost;dbname=cms;charset=utf8', 'root', 'root');
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE customer SET name = :name , introduction = :introduction, occupation_id = :occupation_id, birthday = :birthday, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
			$stmt = $con->prepare($sql); 
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':introduction', $introduction);
			$stmt->bindParam(':occupation_id', $occupation_id, PDO::PARAM_INT);
			$stmt->bindParam(':birthday', $birthday);
			$stmt->execute();
			$stmt = null;
			$con = null;
		} catch (PDOException $e) {
			die('データベースに接続できません：' . $e->getMessage());
		}
	}

	/**
	 * 顧客削除
	 */
	public function delete($id) {
		try {
			// データベースに接続
			$con = new PDO('mysql:host=localhost;dbname=cms;charset=utf8', 'root', 'root');
			$stmt = $con->prepare('DELETE FROM customer WHERE id = :id'); 
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$stmt = null;
			$con = null;
		} catch (PDOException $e) {
			die('データベースに接続できません：' . $e->getMessage());
		}
	}

}