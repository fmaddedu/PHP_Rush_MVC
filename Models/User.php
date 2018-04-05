<?php 

include_once (__DIR__."/../Config/db.php");
include_once (__DIR__."/Form.php");

class User
{
	protected static $instance;

	static function getInstance($request = NULL)
	{
		if(!isset(self::$instance)) {
			self::$instance = new self($request);
		}
		return(self::$instance);
	}

/********************** CREATE REGISTERED USER **********************/
	static function create() {
		$password = $_POST['password'];
		$pwd_hashed = password_hash($password, PASSWORD_DEFAULT);
		$verif_pwd = password_verify($password, $pwd_hashed);

		if (!empty($_POST['admin'])) 
			$admin = 1;
		else
			$admin = 0;

		if($verif_pwd) {
			$database = Database::getInstance();
			$db = $database->connect();			
			$sql = "INSERT INTO users (username, password, email, admin) VALUES (:username, :password, :email, :admin)";
			$request = $db->prepare($sql);
			$request->execute(array(
				'username' => $_POST['username'],
				'password' => $pwd_hashed,
				'email' => $_POST['email'], 
				'admin' => $admin
			));
		}
	}

/**************************** DELETE USER ****************************/		
	static function delete() {
		$id = $_POST['id'];
		$database = Database::getInstance();
		$db = $database->connect();			
		$sql = "DELETE FROM users WHERE id='$id'";
		$request = $db->prepare($sql);
		$request->execute();
	}

/********************** DELETE USER FROM ID **********************/		
	static function delete_from($id) {
		$database = Database::getInstance();
		$db = $database->connect();			
		$sql = "DELETE FROM users WHERE id='$id'";
		$request = $db->prepare($sql);
		$request->execute();
	}

/********************* CHECK IF USER IS AN ADMIN *********************/
	static function is_admin() {
	  if (Form::email_valid()) {
			$email = $_POST['email'];
			$database = Database::getInstance();
			$db = $database->connect();			
			$sql = "SELECT admin FROM users WHERE email='$email'";
			$request = $db->prepare($sql);
			$request->execute();
			$user = $request->fetch(PDO::FETCH_ASSOC);
			if ($user['admin'] == 1)
				return TRUE;
			else
				return FALSE;
		}
	}

/**** RETURNS USER INFORMATION AS AN ARRAY INDEXED BY COLUMN NAME ****/
	static function get_user() {
	  if (Form::email_valid()) {
	  	$email = $_POST['email'];
			$database = Database::getInstance();
			$db = $database->connect();			
			$sql = "SELECT * FROM users WHERE email='$email'";
			$request = $db->prepare($sql);
			$request->execute();
			$user = $request->fetch(PDO::FETCH_ASSOC);
			return $user;
		}
	}

/**** RETURNS USER INFORMATION AS AN ARRAY INDEXED BY COLUMN NAME ****/
	static function get_user_from($id) {
	  if (is_int($id)) {
			$database = Database::getInstance();
			$db = $database->connect();			
			$sql = "SELECT * FROM users WHERE id='$id'";
			$request = $db->prepare($sql);
			$request->execute();
			$user = $request->fetch(PDO::FETCH_ASSOC);
			return $user;
		}
	}

/************************* RETURNS ALL USERS *************************/		
	static function get_users() {
		$database = Database::getInstance();
		$db = $database->connect();			
		$sql = "SELECT * FROM users ORDER BY username";
		$request = $db->prepare($sql);
		$request->execute();
		$users = $request->fetchAll();
		return $users;
	}
			
/************************* RETURNS ALL ADMINS *************************/		
	static function get_admins() {
		$database = Database::getInstance();
		$db = $database->connect();			
		$sql = "SELECT id FROM users WHERE admin=1";
		$request = $db->prepare($sql);
		$request->execute();
		$admins = $request->fetchAll();
		return $admins;
	}
}
