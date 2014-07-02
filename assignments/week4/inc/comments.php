<?php

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		handle404();
	}

	if ($_POST['token'] !== $_SESSION['token']) {
		handle404();
	}

	$comment			= new Comment($_POST['body']);
	$comment->blog_id	= $_POST['blog_id'];
	$comment->save();

	$data = array (
		'comment' => $comment,
	);

	echo $twig->render('comment.html', $data);