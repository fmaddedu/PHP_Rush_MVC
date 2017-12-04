<?php

class CheckFunctions
{
	public function secure_input($data)
	{
		$data = trim($data); 
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function check_login_email($email)
	{

	}

	public function check_register_email($email)
	{

	}

	public function email_already_exist($email)
	{
		$bdd = connect_db("127.0.0.1", "root", "root", "3306", "pool_php_rush");
		$request = $bdd->prepare('SELECT username, email FROM users WHERE email = :email');
		$request->execute(array('email' => $email));
		$user = $request->fetch(PDO::FETCH_ASSOC);
		if ($user['email'] == $email)
		{
			$_SESSION['message'] = "This email is already taken.</p>";
			return FALSE;
		}
		return TRUE;
	}

	//Check email for edit password
	public function updateEmail($email, $id)
	{
		$bdd = connect_db("127.0.0.1", "root", "root", "3306", "pool_php_rush");
		$request = $bdd->prepare('SELECT id, email FROM users WHERE email = :email');
		$request->execute(array('email' => $email));
		$user = $request->fetch(PDO::FETCH_ASSOC);
		/*
		if ($user['email'] == $email && $id != $user['id'])
		{
			$_SESSION['message'] = "This email is already taken.</p>";
			return FALSE;
		}*/
		return TRUE;
	}
	
	//Check if email set correspond to email bdd FOR LOGIN
	public function check_email()
	{
		$email = $_POST['email'];

		$bdd = connect_db("127.0.0.1", "root", "root", "3306", "pool_php_rush");

		$sql = "SELECT email FROM users WHERE email='$email'";
		$request = $bdd->prepare($sql);
		$request->execute(array('email' => $email));
		$result = $request->fetch(PDO::FETCH_ASSOC);

		if ($email == $result['email'])	
		{
			return $this->pwd_checked();
		}
		else
		{
			$_SESSION['message'] = "<p class='error'>Incorrect email/password</p>";
			return FALSE;
		}
	}

	public function get_name($email)
	{
		$bdd = connect_db("127.0.0.1", "root", "root", "3306", "pool_php_rush");

		$sql = "SELECT username FROM users WHERE email= '$email' ";

		$sth = $bdd->query($sql);

		$user_name = $sth->fetch();
		return $user_name[0];
	}

	//Check if email set correspond to password bdd
	/**
	 * @return [type]
	 */
	public function pwd_checked()
	{
		$email = $_POST['email'];
		$user_name = $this->get_name($email);
		$sql_bdd_password = "SELECT password, id, admin FROM users WHERE email='$email'";

		$bdd = connect_db("127.0.0.1", "root", "root", "3306", "pool_php_rush");
		$sth = $bdd->query($sql_bdd_password);
		$bdd_password = $sth->fetch();

		$password_field = $_POST['password'];
		$verif_pwd = password_verify($password_field, $bdd_password[0]);

		if ($verif_pwd)
		{
			$_SESSION['name'] = $user_name;
			$_SESSION['email'] = $email;
			$_SESSION['id'] = $bdd_password[1];
			$_SESSION['admin'] = $bdd_password[2];
			return TRUE;
		}
		else
		{
			echo "<p class='error'>Incorrect email/password</p>";	
			return FALSE;
		}	
	}

	public function check_password($password)
	{

	}

	public function check_title($title)
	{

	}

	public function check_content($content)
	{

	}
}

$checkFunctions = new CheckFunctions();

?>