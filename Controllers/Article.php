<?php

include_once (__DIR__."/Controller.php");
include_once (__DIR__."/../Config/config.php");
include_once (__DIR__."/../Config/db.php");
include_once (__DIR__."/../Config/sessionStart.php");
include_once (__DIR__."/../Models/Form.php");
include_once (__DIR__."/../Models/User.php");

echo "Article controller";

class Article extends Controller
{
	public function test() {
		echo "test";
	}
}

if (!$_SESSION['admin']) {
	header("Location: ../index.php");
}

if (!empty($_POST) && Form::valid_product_form() =="") {
	Product::create();
	$_SESSION['message'] = "<p class='success'>Produit créé avec succès</p><br>";
}
elseif (!empty($_POST) && Form::valid_product_form() != "") {
	$message_error = Form::valid_product_form();
	$_SESSION['message'] = "<p class='error'>$message_error</p>";
}