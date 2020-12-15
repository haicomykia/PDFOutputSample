<?php

	require_once 'components/ArticleCollector.php';

	$ArticleCollector = new Article_Collector();

	$articles = $ArticleCollector -> fetchAll();
	header('Content-type: application/json');
	echo json_encode($articles);