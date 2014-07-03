<?php

	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	session_start();

	// Load Composer dependencies (Twig, in our case)
	require_once '../vendor/autoload.php';
	$loader	= new Twig_Loader_Filesystem('../templates');
	$twig	= new Twig_Environment($loader);

	/**
	 * Class Comment represents a comment on the website.
	 */
	class Comment {
		/** @var string **/
		public $body;

		/** @var integer **/
		public $blog_id;

		/** @var integer **/
		public $user_id;

		/**
		 * @param string
		 * @return void
		 */
		public function __construct($body = '') {
			$this->body = $body;
		}

		public function save() {
			$this->id = CHSDatabase::saveComment($this);
		}
	}

	/**
	 * Class Blog represent a blog entry.
	 */
	class Blog {
		/** @var string **/
		public $title;

		/** @var string **/
		public $body;

		/**
		 * @return void
		 */
		public function save() {
			$this->id = CHSDatabase::saveBlog($this);
		}

		/**
		 * @return array
		 */
		public function getComments() {
			return CHSDatabase::getComments($this->id);
		}
	}


	// Load a helper so we can access a database
	require_once '../inc/db.php';
	$Database = new CHSDatabase();

	// Handle not found.
	function handle404() {
		global $twig;

		http_response_code(404);

		echo $twig->render('404.html');
		die;
	}

	// Respond to the incoming request
	$path	= ltrim($_SERVER['REQUEST_URI'], '/');
	$parts	= explode('/', $path);
	$rid	= null;

	switch ($parts[0]) {
		case 'sign-in':
		case 'sign-out':
		case 'admin':
		case 'comments':
			$rid = $parts[0];
			break;
		case '':
			$rid = 'home';
			break;
		default:
			handle404();
			break;
	}

	if ($rid !== null) {
		$file = "../inc/{$rid}.php";

		if (file_exists($file)) {
			require $file;
		} else {
			handle404();
		}
	}

	die;