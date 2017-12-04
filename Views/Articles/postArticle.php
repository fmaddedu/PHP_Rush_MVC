<?php
include_once (dirname(__FILE__).'/../classForm.php');

$form = array();

$form["title"] = "Title";
$form["content"] = "Content";
$form["category"] = "Category";

new Form($form, "Post article");

?>