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

	$blog = new Blog();
	$blog->title		= 'Charleston adds more ice cream';
	$blog->body			= "Jeni's ice cream has opened on King Street.";
	$blog->comments[]	= new Comment('All the flavors!');

	var_dump($blog);

	$data = array (
		'blog' => $blog,
	);

	echo $twig->render('index.html', $data);