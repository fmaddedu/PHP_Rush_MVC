<?php
include_once (dirname(__FILE__).'/../classForm.php');

$form = array();

$form["content"] = "Content";

new Form($form, "Post comment");

?>