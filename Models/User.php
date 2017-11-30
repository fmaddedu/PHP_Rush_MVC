<?php
include_once(dirname(__FILE__).'/../Config/db.php');

class userManager
{
	private static $instance = null;

	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = new userManager();
		return self::$instance;
	}

	private function __clone(){}

	public function get_users()
	{
		$query = 'SELECT * FROM users';
		$dbConnect->sql_query($query);
	}

	public function get_user_by_id($id)
	{
		$query = 'SELECT * FROM users WHERE id = :id');
		$variable = array('id' => $id);
		$db_connect->sql_query($query, $variable);
	} 

	public function get_user_by_username($username)
	{
		$query = 'SELECT * FROM users WHERE username = :username');
		$variable = array('username' => $username);
		$db_connect->sql_query($query, $variable);
	} 

	public function register($username, $email, $password)
	{
		$query = 'INSERT INTO users (username, email, password, user_group, status, creation_date, edition_date) VALUES (:username, :email, :password, :user_group, :status, :creation_date, :edition_date)';
    $variable = array(
    	'username' => $username,
    	'email' => $email,
    	'password' => $password,
    	'user_group' => 'user',
    	'status' => 1,
    	'creation_date' => date("Y-m-d H:i:s"),    	
    	'edition_date' => date("Y-m-d H:i:s")
        );	
  	$db_connect->sql_query($query, $variable);
	}

	public function admin_edit_user($id, $user_group = null, $status = null)
	{
		$query = 'UPDATE users SET user_group = COALESCE(:user_group, user_group), status = COALESCE(:status, status), edition_date = :edition_date WHERE id = :id';
    $variable = array(
    	'id' => $id,
    	'user_group' => $user_group,
    	'status' => $status,
    	'edition_date' => date("Y-m-d H:i:s")
        );
   	$db_connect->sql_query($query, $variable);
	}

	public function admin_delete_user($id)
	{
		$query = 'DELETE FROM users WHERE id = :id';
    $variable = array('id' => $id );
   	$db_connect->sql_query($query, $variable);
	}

public function user_edit_user($id, $username = null, $email = null, $password = null)
	{
		$query = 'UPDATE users SET username = COALESCE(:username, username), email = COALESCE(:email, email), password = COALESCE(:password, password), edition_date = :edition_date WHERE id = :id';
    $variable = array(
    	'id' => $id,
    	'username' => $username,
    	'email' => $email,
    	'password' => $password,
    	'edition_date' => date("Y-m-d H:i:s")
        );
   	$db_connect->sql_query($query, $variable);
	}
}

$userM = userManager::getInstance();

?>