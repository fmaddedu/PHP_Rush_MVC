<?php 
include_once(dirname(__FILE__).'/../Models/User.php');
include_once(dirname(__FILE__).'/CheckFunctions.php');

class UsersController
{
	private static $instance = null;

	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = new UsersController();
		return self::$instance;
	}

	private function __clone(){}

	public function secure_get_users()
	{
		$users = $userM->get_users();
		foreach ($users as $key => $user)
		{
			$users[$key]['username'] = htmlspecialchars($user['username']);
			$users[$key]['email'] = $checkFunctions->check_email($user['email']));
		}
		return $users;
	}

	public function secure_get_user_by_id($id)
	{
		$user = $userM->get_user_by_id();
		foreach ($user as $key => $user)
		{
			$user[$key]['username'] = htmlspecialchars($user['username']);
			$user[$key]['email'] = $checkFunctions->check_email($user['email']));
		}
		return $user;
	} 

	public function secure_get_user_by_username($username)
	{
		$user = $userM->get_user_by_username();
		foreach ($user as $key => $user)
		{
			$user[$key]['username'] = htmlspecialchars($user['username']);
			$user[$key]['email'] = $checkFunctions->check_email($user['email']));
		}
		return $user;
	} 

	public function secure_register($username, $email, $password)
	{
		$username = $checkFunctions->secure_input($username);
		$email = $checkFunctions->check_email($email);
		
		$register = $userM->register($username, $email, $password);
		if ($register == -1)
			return -1;
	}

	public function secure_admin_edit_user($id, $user_group = null, $status = null)
	{
		$admin_edit_user = $userM->admin_edit_user();

	}

	public function secure_admin_delete_user($id)
	{
		$admin_delete_user = $userM->admin_delete_user();
	}

public function secure_user_edit_user($id, $username = null, $email = null, $password = null)
	{
		$user_edit_user = $userM->user_edit_user();
	}
}




	public function is_logged()
	{
		$email_error = "Invalid email";
		$pwd_error = "Invalid password or password confirmation";

		if (!isset($_POST['name']) || $_POST['name'] == "name" || strlen($_POST['name']) < 3 || strlen($_POST['name']) > 10)
		{
			$_SESSION['message'] = "<p class='error'>Invalid name</p>";
			return FALSE;
		}
		if (!isset($_POST['email']) || $_POST['email'] == "email")
		{
			$_SESSION['message'] = "<p class='error'>$email_error</p>";
			return FALSE;
		}
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['message'] = "<p class='error'>$email_error</p>";
			return FALSE;
		}
		if (!isset($_POST['password']) || $_POST['password'] == "password" || strlen($_POST['password']) < 3 || strlen($_POST['password']) > 10)
		{
			$_SESSION['message'] = "<p class='error'>$pwd_error</p>";
			return FALSE;
		}
		if (!(isset($_POST['password_confirmation'])) || ($_POST['password_confirmation'] == "password_confirmation"))
		{
			$_SESSION['message'] = "<p class='error'>$pwd_error</p>";
			return FALSE;
		}
		if ($_POST['password'] != $_POST['password_confirmation'])
		{
			$_SESSION['message'] = "<p class='error'>$pwd_error</p>";
			return FALSE;
		}
		return TRUE;
	}

	public function check_field_to_edit($POST)
	{
		$email_error = "Invalid email";
		$pwd_error = "Invalid password or password confirmation";

		if (!isset($POST['name']) || $POST['name'] == "name" || strlen($POST['name']) < 3 || strlen($POST['name']) > 10)
		{
			$_SESSION['message'] = "<p class='error'>Invalid name</p>";
			return FALSE;
		}
		if (!isset($POST['email']) || $POST['email'] == "email")
		{
			$_SESSION['message'] = "<p class='error'>$email_error</p>";
			return FALSE;
		}
		if (!filter_var($POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['message'] = "<p class='error'>$email_error</p>";
			return FALSE;
		}
		if (!isset($POST['password']) || $POST['password'] == "password" || strlen($POST['password']) < 3 || strlen($POST['password']) > 10)
		{
			$_SESSION['message'] = "<p class='error'>$pwd_error</p>";
			return FALSE;
		}
		if (!(isset($POST['password_confirmation'])) || ($POST['password_confirmation'] == "password_confirmation"))
		{
			$_SESSION['message'] = "<p class='error'>$pwd_error</p>";
			return FALSE;
		}
		if ($POST['password'] != $POST['password_confirmation'])
		{
			$_SESSION['message'] = "<p class='error'>$pwd_error</p>";
			return FALSE;
		}
		return TRUE;
	}
}

?>