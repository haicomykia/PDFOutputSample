<?php

	require_once './components/ArticleCollector.php';

	$ArticleCollector = new Article_Collector();

	$result = [];
	if (isset($_POST['delPosts']) && $ArticleCollector -> tryDelete($_POST['delPosts']) > 0) {
		$result['stat'] = 'success';
	} else {
		$result['stat'] = 'fail';
	}

	header('Content-type: application/result');
	echo json_encode($result);
	die;