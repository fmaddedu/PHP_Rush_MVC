<?php 
/*************** INITIALIZES THE DISPATCHER **************/
echo "hello";
session_start(); 
?>

<head>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="/PHP_Rush_MVC/Webroot/style.css" />
</head>
<!--header>
	<img src="/PHP_Rush_MVC/Webroot/Img/header.jpeg" class="header">
</header-->
<body>

<?php
define("WEBROOT", dirname(__FILE__));
define("ROOT", dirname(WEBROOT));
define("DS", DIRECTORY_SEPARATOR);
define("CORE", ROOT.DS."core");
define("BASE_URL", dirname(dirname($_SERVER["SCRIPT_NAME"])));
include_once("request.php");
include_once("router.php");
include_once("dispatcher.php");
//echo "<br><br>Webroot = ".WEBROOT."<br><br>ROOT = ".ROOT."<br><br>DS = ".DS."<br><br>Core = ".CORE."<br><br>BASE_URL = ".BASE_URL."<br><br>";
new dispatcher;
?>

<!--pre>
	<?php print_r($_SERVER);
	echo dirname(__FILE__);
	echo("\n");
	echo BASE_URL?>
</pre-->
</body>