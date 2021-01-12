<?php
	require_once 'components/ArticleCollector.php';
	require_once './vendor/tecnickcom/tcpdf/tcpdf.php';
	require_once './vendor/autoload.php';
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

		$query .= "ORDER BY title DESC";

		$stmt = $pdo -> prepare($query);
		$stmt -> execute($bind_param[0]);

		$articles = [];
		while($article = $stmt -> fetch(PDO::FETCH_ASSOC)){
			$articles[] = array(
				'id' 					=> $article['id'],
				'user_id' 		=> $article['user_id'],
				'title' 			=> $article['title'],
				'slug' 				=> $article['slug'],
				'body' 				=> $article['body'],
				'published' 	=> $article['published'],
				'created'			=> $article['created'],
				'modified' 		=> $article['modified'],
			);
		}
	} catch (Exception $e) {
		var_dump($e -> getMessage());
		die('データの取得に失敗しました.');
	}

	use setasign\Fpdi\TcpdfFpdi;

	$pdf = new TcpdfFpdi('P', 'mm', 'A4');
	// ヘッダーの出力を無効化
	$pdf->setPrintHeader(false);
	// フッターの出力を無効化
	$pdf->setPrintFooter(false);
	$pdf->SetMargins(0, 0, 0);
	$pdf->SetCellPadding(0);
	
	$pdf->setSourceFile('./img/base.pdf');
	$pdf->AddPage();
	$tpl = $pdf->importPage(1); // テンプレートPDFの1ページ目
	$pdf->useTemplate($tpl);

	$pdf->SetFont('kozminproregular', '', 11);

	// A4サイズの用紙にグリッドを引く
	// for ($x = 10; $x < 210; $x += 10) {
	// 	$pdf->Line($x, 0, $x, 297);
	// }
	// for ($y = 10; $y < 297; $y += 10) {
	// 	$pdf->Line(0, $y, 210, $y);
	// }

	foreach($articles as $key => $article) {
		$y = 50 + ($key * 6);
		$pdf -> SetXY(24.5, $y);
		$pdf -> Write(0, date('Y/m/d'));

		$pdf -> SetXY(53, $y);
		$pdf -> Write(0, $article['title']);

		$pdf -> SetXY(154, $y);
		$pdf->Cell(33, 6, $key.'円', 0, 0, 'R');
	}

	$image = __DIR__.'/img/stamp.gif';
	$pdf -> Image($image, 160, 90, 30, 0, 'GIF');
	$file_name = date('ymd').'_sample.pdf';
	$pdf->Output($file_name, 'I'); // 画面出力