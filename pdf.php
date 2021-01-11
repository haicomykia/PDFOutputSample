<?php
	require_once 'components/ArticleCollector.php';

	$ArticleCollector = new Article_Collector();

	$articles = $ArticleCollector -> fetchAll();

	$html_doc = <<< EOD
	<!DOCTYPE html>
		<html lang="ja">
		<head>
			<meta charset="UTF-8">
			<link rel="stylesheet" href="./css/normalize.css" media="all">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		</head>
		<body>
			<h1>PDF出力のテスト</h1>	
			<p>こちらはテスト用のHTMLページです。特に意味はありません。</p>
			<table>
				<thead>
					<tr><th>タイトル</th><th>本文</th></tr>
				</thead>
				<tbody>
	EOD;
	foreach($articles as $key => $article){
		$html_doc .= '<tr><td>'.$article['title'].'</td>';
		$html_doc .= '<td>'.$article['body'].'</td></tr>';
	}
	$html_doc .= <<< EOD
				</tbody>
			</table>
		</body>
		</html>
	EOD;
	
	try {
		require_once __DIR__.'/vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf([
			'fontdata' => [
				'ipa' => [
					'R' => 'ipaexm.ttf'
				],
				'format' => 'A4',
				'orientation' => 'P',
				'mode' 	=> 'ja'
			]
		]);
	
		$css = file_get_contents('./css/style.css');
	
		$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf -> WriteHTML($html_doc, \Mpdf\HTMLParserMode::HTML_BODY);
	
		$file = __DIR__.'/test.pdf';
		$mpdf -> Output($file, 'I');
	} catch(\Mpdf\MpdfException $e){
		echo $e -> getMessage();
	}