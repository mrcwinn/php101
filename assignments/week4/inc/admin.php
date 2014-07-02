<?php

	if (!isset($_SESSION['signed-in']) || $_SESSION['signed-in'] !== true) {
		handle404();
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$blog = new Blog();
		$blog->title	= $_POST['title'];
		$blog->body		= $_POST['body'];

		CHSDatabase::saveBlog($blog);

		header('Location: /');
	} else {
		echo $twig->render('admin.html');
	}