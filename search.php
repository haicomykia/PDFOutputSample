<?php

	require_once 'connect_to_db.php';
	
	try {

		$query = "SELECT * FROM articles";
		// ユーザーの入力からSQLを組み立てる
		$conditions = [];
		$bind_param = [];

		if (isset($_GET['id'])) {
			$ids = explode(",", $_GET['id']);
			$conditions[] = sprintf("id IN (%s)", substr(str_repeat(",?", count($ids)), 1));
			$bind_param[] = $ids;
		}

		if (count($conditions) > 0) {
			$query .= ' WHERE ' . join(' OR ', $conditions);
		}

		$stmt = $pdo -> prepare($query);
		$stmt -> execute($bind_param[0]);

		$bookList = [];
		while($book = $stmt -> fetch(PDO::FETCH_ASSOC)){
			$bookList[] = array(
				'id' 					=> $book['id'],
				'user_id' 		=> $book['user_id'],
				'title' 			=> $book['title'],
				'slug' 				=> $book['slug'],
				'body' 				=> $book['body'],
				'published' 	=> $book['published'],
				'created'			=> $book['created'],
				'modified' 		=> $book['modified'],
			);
		}
		header('Content-type: application/json');
		echo json_encode($bookList);
		die;
	} catch (Exception $e) {
		var_dump($e -> getMessage());
		die('データの取得に失敗しました.');
	}