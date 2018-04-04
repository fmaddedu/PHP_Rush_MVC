<?php
include_once (dirname(__FILE__).'config.php');

class ConnectDb
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
			self::$_instance = new ConnectDb();
		return self::$_instance;
	}

	public function connect() {
		return $this->connect;
	}

	private function __clone(){}

	public function sql_query($query, $variable = null) {
		$request = $this->connect->prepare($query);
    if ($variable != null)
    	$request->execute($variable);
    else
    	$request->execute();    	
    if (!$request)
    	return -1;
		else {
			if ($request->fetchAll())
				$result = $request->fetchAll();
    	$request->closeCursor();
			if (isset($result))
				return $result;	
		}
	}
}

$database = ConnectDb::getInstance();
$db = $database->connect();