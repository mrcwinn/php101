<?php

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$hashedPassword = md5($_POST['password']);

		$correctPassword = CHSDatabase::getPasswordByUsername($_POST['username']);

		if ($correctPassword === $hashedPassword) {
			$_SESSION['signed-in'] = true;
			header('Location: /admin');
		} else {
			header('Location: /sign-in');
		}
	} else {
		echo $twig->render('sign-in.html');
	}