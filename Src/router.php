<?php
//The router.php file retrieves information from the URL and parses it. The dispatcher.php file executes it.

require (dirname(__FILE__).'/../Config/core.php');
// include the autoloader

$router = new Router($_GET['url']);

$router->get('/posts', function(){ echo "Tous les articles"; });
// lance la fonction lorqu'on appelle l'url x
$router->get('/posts/:param', function($param){ echo "Affiche l'article " . $id; });
// dans le cas où l'url a un paramètre

$router->run();

$path = ltrim($_SERVER[''])