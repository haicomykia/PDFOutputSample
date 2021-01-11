<?php
	require_once './vendor/tecnickcom/tcpdf/tcpdf.php';
	require_once './vendor/autoload.php';

	use setasign\Fpdi\TcpdfFpdi;

	try {
		$pdf = new TcpdfFpdi('P', 'mm', 'A4');
		// ヘッダーの出力を無効化
    $pdf->setPrintHeader(false);
		// フッターの出力を無効化
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(0, 0, 0);
		$pdf->SetCellPadding(0);
		
		$pdf->SetFont('kozminproregular'); // 日本語フォント
		$pdf->setSourceFile('base.pdf');
		$pdf->AddPage();
		$tpl = $pdf->importPage(1); // テンプレートPDFの1ページ目
		$pdf->useTemplate($tpl);
		// グリッドを引く
		// for ($x = 10; $x < 210; $x += 10) {
		// 	$pdf->Line($x, 0, $x, 297);
		// }
		// for ($y = 10; $y < 297; $y += 10) {
		// 	$pdf->Line(0, $y, 210, $y);
		// }

		// 1行目
		$pdf -> SetXY(24, 50);
		$pdf -> Write(0, date('Y/m/d'));
		$pdf -> SetXY(75, 50);
		$pdf -> Write(0, '東山奈央のラジオ@リビング');

		// 2行目
		$pdf -> SetXY(24, 56);
		$pdf -> Write(0, date('Y/m/d'));
		$pdf -> SetXY(75, 56);
		$pdf -> Write(0, 'Pyxisの夜空の下deMeeting');

		// 3行目
		$pdf -> SetXY(24, 62);
		$pdf -> Write(0, date('Y/m/d'));
		$pdf -> SetXY(75, 62);
		$pdf -> Write(0, '内田真礼とお話しません？');

		// 4行目
		$pdf -> SetXY(24, 68);
		$pdf -> Write(0, date('Y/m/d'));
		$pdf -> SetXY(75, 68);
		$pdf -> Write(0, '石原夏織のCarry up?!');

		$file_name = date('ymd').'_sample.pdf';
		$pdf->Output($file_name, 'I'); // 画面出力

	} catch(\Mpdf\MpdfException $e){
		echo $e -> getMessage();
	}