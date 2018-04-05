<?php 

include_once (__DIR__."/../Config/db.php");
include_once (__DIR__."/User.php");

class Form {
	protected static $instance;
	
	static function getInstance($request = NULL)
	{
		if(!isset(self::$instance)) {
			self::$instance = new self($request);
		}
		return(self::$instance);
	}

/********************* CHECK IF USERNAME IS VALID *********************/
	static function username_valid() {
		if (empty($_POST['username']) || strlen($_POST['username']) < 3 || strlen($_POST['username']) > 10 || !preg_match("/^[a-zA-Z ]*$/", $_POST['username']))
			return FALSE;
		else
			return TRUE;
	}

/********************** CHECK IF EMAIL IS VALID **********************/
	static function email_valid() {
	  if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			return FALSE;
		else
			return TRUE;
	}

/*********************** CHECK IF PWD IS VALID ***********************/
	static function pwd_valid() {
		if (empty($_POST['password']) || strlen($_POST['password']) < 3 || strlen($_POST['password']) > 10)
			return FALSE;
		else
			return TRUE;
	}

/**************** CHECK IF USERNAME EXISTS IN THE DB ****************/
	static function username_exists() {
	  if (self::username_valid()) {
	    $name = $_POST['username'];
	  	// check if user name already exists in the db
		  $sql = "SELECT * FROM users WHERE name='$name'";
			$database = Database::getInstance();
			$db = $database->connect();			
		  $request = $db->prepare($sql);
		  $request->execute();
		  $result = $request->fetchAll();
			if (count($result) > 0) 
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
  } 

/****************** CHECK IF EMAIL EXISTS IN THE DB ******************/
	static function email_exists() {
	  if (self::email_valid()) {
			$email = $_POST['email'];
			$database = Database::getInstance();
			$db = $database->connect();			
		  $sql = "SELECT * FROM users WHERE email='$email'";
		  $request = $db->prepare($sql);
		  $request->execute();
		  $result = $request->fetchAll();
			if (count($result) > 0)
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	} 

/***************** CHECK IF PWD CORRESPONDS TO EMAIL *****************/
	static function pwd_checked() {
		$user = User::get_user();
		// boolean password_verify ( string $password , string $hash )
		if (self::pwd_valid() && password_verify($_POST['password'], $user['password'])) 
	    	return TRUE;
			else
				return FALSE;
	}	

/***************** CHECK IF PWD CONFIRMATION IS OK *****************/
	static function pwd_confirm() {
		$user = User::get_user();
		// boolean password_verify ( string $password , string $hash )
		if (self::pwd_valid() && $_POST['password'] == $_POST['password_confirmation']) 
	    	return TRUE;
			else
				return FALSE;
	}	

/******************* CHECK IF REGISTER FORM IS OK *******************/
	static function valid_register_form() {
		$message_error = "";
		if (!self::username_valid())
			$message_error = $message_error . "Pseudo invalide. ";
		if (self::username_exists())
			$message_error = $message_error . "Ce pseudo n'est pas disponible. ";
		if (!self::email_valid())
			$message_error = $message_error . "Email invalide. ";
		if (self::email_exists()) 
			$message_error = $message_error . "Cet email n'est pas disponible. ";
		if (!self::pwd_valid()) 
			$message_error = $message_error . "Mot de passe invalide. ";
		if (self::pwd_valid() && !self::pwd_confirm()) 
			$message_error = $message_error . "La confirmation du mot de passe ne correspond pas. ";
		return $message_error;
	}

/******************** CHECK IF ARTICLE TITLE IS VALID ********************/
	static function article_title_valid() {
		if (!empty($_POST['title'])) {
			$title = strip_tags(trim(htmlspecialchars($_POST['title'])));
			if (strlen($title) < 3 || strlen($title) > 50)
				return FALSE;
			else
				return TRUE;
		}
		else
			return FALSE;
	}

/******************** CHECK IF ARTICLE CONTENT IS VALID *******************/
	static function article_content_valid() {
		if (!empty($_POST['content'])) {
			$content = strip_tags(trim(htmlspecialchars($_POST['content'])));
			if (strlen($content) > 500)
				return FALSE;
			else
				return TRUE;
		}
		else
			return FALSE;
	}

/******************* CHECK IF PRODUCT FORM IS OK *******************/
	static function valid_article_form() {
		$message_error = "";
		if (!self::product_title_valid())
			$message_error = $message_error . "Titre d'article invalide. ";
		if (!self::product_desc_valid())
			$message_error = $message_error . "Contenu de l'article invalide. ";
		return $message_error;
	}
}
