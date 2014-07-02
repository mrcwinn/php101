<?php
	
	$_SESSION['token'] = md5(uniqid(rand(), true));

	$data = array (
		'blogs'	=> CHSDatabase::getBlogs(),
		'token'	=> $_SESSION['token'],
	);

	echo $twig->render('index.html', $data);