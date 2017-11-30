<?php
include_once (dirname(__FILE__).'configuration.php');

// voir singleton

class ConnectDb
{
	private $connect;
	private static $instance = null;

	private $host = HOST;
	private $user = USERNAME;
	private $pass = PASSWORD;
	private $port = PORT;
	private $db = DB;

	private function __construct()
	{
		try 
		{
			$dsn = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $db . ';charset=utf8';
			$this->connect = new PDO($dsn, $user, $pass);
	  	echo "Connected to database.";
		}
		catch (PDOException $e) 
		{
	  	error_log($e->getMessage(), 3, ERROR_LOG_FILE);
			echo "PDO ERROR: " . $e->getMessage() . " storage in " . ERROR_LOG_FILE . "\n";
		}
	}

	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = new ConnectDB();
		return self::$instance;
	}

	public function getConnection()
	{
		return $this->connect;
	}

//magic method clone is empty to prevent duplication of connection
	private function __clone(){}


	public function sql_query($query, $variable = null)
	{
		$request = $this->connect->prepare($query);
    if ($variable != null)
    	$request->execute($variable);
    else
    	$request->execute();    	
    if (!$request)
    	return -1;
		else
    {
			if ($request->fetchAll())
				$result = $request->fetchAll();
    	$request->closeCursor();
			if (isset($result))
				return $result;	
		}
	}
}

$dbConnect = ConnectDb::getInstance();

?>