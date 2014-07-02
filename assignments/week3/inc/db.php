<?php

	/**
	 * CHSDatabase
	 *
	 * This class hides some of the more complicated tasks of the blog assignment.
	 * It handles preparing the database and tables as well as abstracting
	 * saving blogs and comments.
	 *
	 * A more typical application might use something like Doctrine or have its own
	 * utlities for peristing data. This is, for many reasons, a terrible example
	 * of a database abstraction (hard-coded password information, no error handling,
	 * mixed concerns), but it will make the class very convenient!
	 */
	class CHSDatabase {
		public function __construct() {
			$this->init();
		}

		private function init() {
			// Connect to the database
			if (!mysql_connect(':/tmp/mysql.sock', 'root', 'root')) {
				die('Error connecting to the database');
			}

			// Create a database
			if (!mysql_query('CREATE DATABASE IF NOT EXISTS `php101`')) {
				die('Error creating database');
			}

			$sql = "CREATE TABLE IF NOT EXISTS `php101`.`blogs` (
			`blogID` int unsigned NOT NULL AUTO_INCREMENT,
			`blogTitle` varchar(255) NOT NULL DEFAULT '',
			`blogBody` text NOT NULL,
			PRIMARY KEY (`blogID`)
			) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;";

			if (!mysql_query($sql)) {
				die('Could not create blog table: ' . mysql_error());
			}
		}

		/**
		 * @param Blog
		 * @return int|null
		 */
		public static function saveBlog($Blog) {
			$sql = sprintf("INSERT INTO `php101`.`blogs` (`blogTitle`,`blogBody`) VALUES ('%s','%s')", $Blog->title, $Blog->body);

			if (mysql_query($sql)) {
				return mysql_insert_id();
			}
		}

		/**
		 * @return array
		 */
		public static function getBlogs() {
			$return = array ();
			$result	= mysql_query("SELECT * FROM `php101`.`blogs` ORDER BY `blogID` DESC");

			while($row = mysql_fetch_array($result)) {
				$blog = new Blog();

				$blog->id			= $row['blogID'];
				$blog->title		= $row['blogTitle'];
				$blog->body			= $row['blogBody'];

				$return[] = $blog;
			}

			return $return;
		}
	}