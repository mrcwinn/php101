<?php

	require_once('./db.php');

	$CHSDatabase = new CHSDatabase();

	$blog				= new stdClass();
	$blog->title		= 'This is my test blog';
	$blog->body			= 'Hello there. Here is my own blog entry.';

	$CHSDatabase->saveBlog($blog);

	$blog				= new stdClass();
	$blog->title		= 'This is my test blog';
	$blog->body			= 'Hello there. Here is my own blog entry.';

	$CHSDatabase->saveBlog($blog);