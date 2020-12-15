<?php

	require_once 'connect_to_db.php';
	
	try {

		$query = "SELECT id, title, author, publisher, date, price FROM books";
		// ユーザーの入力からSQLを組み立てる
		$conditions = [];
		$bind_param = [];

		if (!empty($_POST['id'])) {
				$conditions[] = "id LIKE ?";
				$bind_param[] = '%'.$_POST['id'].'%';
		}

		if (!empty($_POST['title'])) {
			$conditions[] = "title LIKE ?";
			$bind_param[] = '%'.$_POST['title'].'%';
		}

		if (count($conditions) > 0) {
				$query .= ' WHERE ' . join(' OR ', $conditions);
		}

		$stmt = $pdo -> prepare($query);
		$stmt -> execute($bind_param);

		$bookList = [];
		while($book = $stmt -> fetch(PDO::FETCH_ASSOC)){
			$bookList[] = array(
				'id' 				=> $book['id'],
				'title' 		=> $book['title'],
				'author' 		=> $book['author'],
				'publisher' => $book['publisher'],
				'date' 			=> $book['date'],
				'price' 		=> $book['price']
			);
		}
		header('Content-type: application/json');
		echo json_encode($bookList);
		die;
	} catch (Exception $e) {
		var_dump($e -> getMessage());
		die('データの取得に失敗しました.');
	}