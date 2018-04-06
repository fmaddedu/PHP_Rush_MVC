<?php 
/*************** INITIALIZES THE DISPATCHER **************/

// $_SERVER["SCRIPT_NAME"] contient le nom du script courant.
// $_SERVER["SCRIPT_FILENAME"] contient le chemin absolu vers le fichier contenant le script en cours d'exécution

define("WEBROOT", str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define("ROOT", str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require(ROOT . "Src/router.php");
require(ROOT . "dispatcher.php");

// echo "index <br>";

$dispatch = new Dispatcher;