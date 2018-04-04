<?php 

include_once '../config/dbPdo.php';
include_once '../config/sessionStart.php';
include_once '../models/Form.php';
include_once '../models/User.php';
include_once '../models/Product.php';

/************** GO TO INDEX IF EVERYTHING IS OK **************/
if (!empty($_POST) && Form::valid_register_form() == "") {
	User::create();
	$_SESSION['message'] = "<p class='success'>Compte créé avec succès</p><br>";
	if (!$_SESSION['admin']) {
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['email'] = $_POST['email'];
		header("Location: ../index.php");
	}
	else
/************* WHEN ADMIN CREATES AN ACCOUNT *************/
		header("Location: ../views/adminUsers.php");			
}

/************ STAY IN REGISTER PAGE IF ERRORS ************/
elseif (!empty($_POST) && Form::valid_register_form() != "") {
	$message_error = Form::valid_register_form();
	$_SESSION['message'] = "<p class='error'>$message_error</p>";
	if (!$_SESSION['admin'])
		header("Location: ../views/register.php");
	else
/************* WHEN ADMIN CREATES AN ACCOUNT *************/
		header("Location: ../views/adminUsers.php");			
}

