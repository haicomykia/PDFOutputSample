<?php
	
	class Article_Collector {

		/**
		 * @see https://www.php.net/manual/ja/pdo.transactions.php
		 * @see https://qiita.com/mpyw/items/b00b72c5c95aac573b71
		 */
		private function pdo() {
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
		}

		public function fetchAll():array
		{
			$books = [];
			try {
				$pdo = $this->pdo();
				$stmt = $pdo -> prepare("SELECT * FROM articles;");
				$stmt -> execute();
				while($book = $stmt -> fetch(PDO::FETCH_ASSOC)){
					$books[] = array(
						'id' 					=> $book['id'],
						'user_id' 		=> $book['user_id'],
						'title' 			=> $book['title'],
						'slug' 				=> $book['slug'],
						'body' 				=> $book['body'],
						'published' 	=> $book['published'],
						'created'			=> $book['created'],
						'modified' 		=> $book['modified']
					);
				}
			} catch (Exception $e) {
				var_dump($e -> getMessage());
			}
			return $books;
		}

		public function tryDelete($del_posts_id):int
		{
			if (!isset($del_posts_id) || !is_array($del_posts_id)) {
				return 0;
			}

			$rowCount = 0;
			try {
				// $inClause = substr(str_repeat(', ?', count($del_posts_id)), 1);
				// $query = sprintf("UPDATE articles SET published = 0 WHERE id IN (%s);", $inClause);

				$inClause = implode(",", array_fill(0, count($del_posts_id), '?')) ;
				$query = "UPDATE articles SET published = 0 WHERE published = 1 AND id IN ($inClause);";
				$stmt = $this -> pdo() -> prepare($query);
				$stmt -> execute($del_posts_id);
				$rowCount = $stmt -> rowCount();
			} catch (Exception $e) {
				var_dump($e -> getMessage());
			}
			return $rowCount;
		}
}