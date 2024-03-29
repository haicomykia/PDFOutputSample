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

	use setasign\Fpdi\TcpdfFpdi;

	$pdf = new TcpdfFpdi('P', 'mm', 'A4');

	define('NUMBER_OF_PRODUCTS_PER_PAGE', 5);

	// ページごとの処理
	for ($i = 0; $i < ceil(count($articles) / NUMBER_OF_PRODUCTS_PER_PAGE); $i++) { 
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(0, 0, 0);
		$pdf->SetCellPaddings(2, 0, 2, 0);

		$pdf->setSourceFile('./img/base.pdf');
		$pdf->AddPage();
		$tpl = $pdf->importPage(1); // テンプレートPDFの1ページ目
		$pdf->useTemplate($tpl);
		$pdf->SetFont('kozminproregular', '', 11);

		// A4サイズの用紙にグリッドを引く
		for ($x = 10; $x < 210; $x += 10) {
			$pdf->Line($x, 0, $x, 297);
		}
		for ($y = 10; $y < 297; $y += 10) {
			$pdf->Line(0, $y, 210, $y);
		}
		
		// 明細に出力
		$sliced = array_slice($articles, NUMBER_OF_PRODUCTS_PER_PAGE * $i, NUMBER_OF_PRODUCTS_PER_PAGE);
		foreach ($sliced as $key => $value) {
			$y = 51 + ($key * 8);
			$pdf -> SetXY(20, $y);
			$pdf->setCellHeightRatio(2);  
			$pdf -> Cell(32, 2, date('Y-m-d'), 0, 0, 'C');
			$pdf -> SetXY(52, $y);
			$pdf -> Cell(105, 2, $value['title'], 0, 0, 'L');
		}

		$here_doc = <<< EOM
		この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れてい
		EOM;
		$pdf -> SetXY(54, $y);
		$pdf -> MultiCell(170, 55, $here_doc, 0, 'J', false, 0 ,20,125, true, 0, false, true, 55, 'T', false);

		// ページ数
		$pdf -> SetXY(20, 272.5);
		$pdf->SetCellPaddings(0, 0, 0, 0);
		$pdf->setCellHeightRatio(1); 
		$pdf -> Cell(20, 2, sprintf("%d/%d", ($i + 1), ceil(count($articles) / NUMBER_OF_PRODUCTS_PER_PAGE)), 0, 0, 'L');

		$pdf -> lastPage();
	}
	// $image = __DIR__.'/img/stamp.gif';
	// $pdf -> Image($image, 160, 90, 30, 0, 'GIF');
	$file_name = date('ymd').'_sample.pdf';
	$pdf->Output($file_name, 'I'); // 画面出力