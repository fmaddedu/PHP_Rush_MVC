<?php 
include_once '../config/dbPdo.php';
include_once '../config/sessionStart.php';
include_once '../views/components/headerAdmin.php';
include_once '../views/components/head.php';
include_once '../models/User.php';

if (!$_SESSION['admin']) {
	header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>
<body>

</body>
</html>