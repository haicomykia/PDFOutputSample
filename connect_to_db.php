<?php
	/**
	 * @see https://www.php.net/manual/ja/pdo.transactions.php
	 * @see https://qiita.com/mpyw/items/b00b72c5c95aac573b71
	 */
	try {
		$dsn= "mysql:dbname=cake_cms;host=localhost;charset=utf8mb4";	// DBの接続に必要な情報
		$user = "admin";																							// ユーザー名
		$password = "password";																				// パスワード
		$driver_option = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,								// 例外をスローする設定
			PDO::ATTR_EMULATE_PREPARES => false													// SQLインジェクション対策のため静的プレースホルダを使う
		];
		$pdo = new PDO($dsn, $user, $password);												// PDOを使ってDBに接続
		return $pdo;
	} catch (Exception $e) {
		die("接続出来ません". $e->getMessage());											// 接続に失敗したらエラーメッセージを出して終了
	}
?>