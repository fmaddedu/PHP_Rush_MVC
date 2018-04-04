<?php 
include_once '../config/dbPdo.php';
include_once '../config/sessionStart.php';
include_once '../models/Form.php';
include_once '../models/User.php';
include_once '../models/Product.php';

session_destroy();

if (isset($_COOKIE))
	setcookie($_COOKIE, NULL, -1);

header("Location: ../index.php");
