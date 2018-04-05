<?php

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