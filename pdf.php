<?php
	require_once 'components/ArticleCollector.php';
	require_once './components/vendor/autoload.php';
	require_once 'connect_to_db.php';

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	try {
		$query = "SELECT * FROM articles";
		// ユーザーの入力からSQLを組み立てる
		$conditions = [];
		$bind_param = [];

		if (!empty($_GET['id'])) {
			$ids = explode(",", $_GET['id']);
			$conditions[] = sprintf("id IN (%s)", substr(str_repeat(",?", count($ids)), 1));
			$bind_param[] = $ids;
		}

		if (count($conditions) > 0) {
			$query .= ' WHERE ' . join(' OR ', $conditions);
		}

		$query .= " ORDER BY id ASC";

		$stmt = $pdo -> prepare($query);
		if (count($conditions) > 0) {
			$stmt -> execute($bind_param[0]);
		} else {
			$stmt -> execute();
		}

		$articles = [];
		while($article = $stmt -> fetch(PDO::FETCH_ASSOC)){
			$articles[] = $article;
		}
	} catch (Exception $e) {
		var_dump($e -> getMessage());
		die('データの取得に失敗しました.');
	}

	$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./img/forms.xlsx');
	$worksheet = $spreadsheet->getActiveSheet();
	
	$worksheet->getCell('A5')->setValue(date('Y/m/d'));
	$worksheet->getCell('B5')->setValue($articles[0]['title']);
	
	// redirect output to client browser
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="written.xlsx"');
	header('Cache-Control: max-age=0');

	$writer = new Xlsx($spreadsheet);
	$writer->save('php://output');
	exit;
	