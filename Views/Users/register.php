<?php
include_once (dirname(__FILE__).'/../classForm.php');

$form = array();

$form["username"] = "Username";
$form["email"] = "Email";
$form["password"] = "Password";
$form["password_confirmation"] = "Password confirmation";

new Form($form, "Register");

?>