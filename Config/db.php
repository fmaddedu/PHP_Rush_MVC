<?php

// The db.php is where you have your Database class which is performing all operations with the database;

include_once (__DIR__."/config.php");

class Database
{
	private $connect;
	private static $_instance = null;

	private $host = HOST;
	private $user = USERNAME;
	private $pass = PASSWORD;
	private $port = PORT;
	private $dbname = DB;

	private function __construct() {
		try {
			$dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname . ';charset=utf8';
			$this->connect = new PDO($dsn, $this->user, $this->pass);
	  	echo "Connected to database.";
		}
		catch (PDOException $e) {
	  	error_log($e->getMessage(), 3, ERROR_LOG_FILE);
			echo "PDO ERROR: " . $e->getMessage() . " storage in " . ERROR_LOG_FILE . "\n";
		}
	}

	public static function getInstance() {
		if(is_null(self::$_instance))
			self::$_instance = new Database();
		return self::$_instance;
	}

	public function connect() {
		return $this->connect;
	}

	private function __clone(){}
	
}