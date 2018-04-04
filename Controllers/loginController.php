<?php 

include_once '../config/dbPdo.php';
include_once '../config/sessionStart.php';
include_once '../models/Form.php';
include_once '../models/User.php';
include_once '../models/Product.php';
include_once '../models/Category.php';

if (!empty($_POST) && Form::email_exists() && Form::pwd_checked()) 
{
	$user = User::get_user();
	// if "Remember me" is checked, $_POST('remember_me') = 1, else 0
	if (!empty($_POST['remember_me'])) {
		setcookie('email', $_POST['email'], time() + 365*24*3600, NULL, NULL, FALSE, TRUE);
		setcookie('username', $user['username'], time() + 365*24*3600, NULL, NULL, FALSE, TRUE);
	}
	$_SESSION['email'] = $user['email'];
	$_SESSION['username'] = $user['username'];
	

/***************** HEAD TO ADMIN IF IS ADMIN *****************/	
	if (User::is_admin()) {
		$_SESSION['admin'] = TRUE;
		header("Location: ../views/adminUsers.php");
	} 
/******************* HEAD TO INDEX IF NOT *******************/
	else {
		$_SESSION['admin'] = FALSE;
		header("Location: ../index.php");
	}
}
/*************** STAY IN LOGIN PAGE IF ERRORS ***************/
elseif (!Form::email_exists()) {
	$_SESSION['message'] = "<p class='error'>Email inconnu</p>";
	header("Location: ../views/login.php");
}
elseif (Form::email_exists() && !Form::pwd_checked()) {
	$_SESSION['message'] = "<p class='error'>Mot de passe erroné</p>";
	header("Location: ../views/login.php");
}

