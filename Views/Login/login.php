<?php
include_once (dirname(__FILE__).'/../classForm.php');

$form = array();

$form["email"] = "Email";
$form["password"] = "Password";

new Form($form, "Login");

?>