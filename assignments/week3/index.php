<?php

	// Load Composer dependencies (Twig, in our case)
	require_once './vendor/autoload.php';
	$loader	= new Twig_Loader_Filesystem('./');
	$twig	= new Twig_Environment($loader);

	class Blog {
		public $title;

		public $body;
	}

	class Comment {
		public $body;

		public function __construct($body) {
			$this->body = $body;
		}
	}

	// Render the homepage
	function handleIndex() {
		global $twig;

		$data = array (
			'blogs'	=> CHSDatabase::getBlogs(),
		);

		echo $twig->render('index.html', $data);
	}

	// Respond to the incoming request
	$path	= ltrim($_SERVER['REQUEST_URI'], '/');
	$parts	= explode('/', $path);

	switch ($parts[0]) {
		case '':
			handleIndex();
			break;
	}