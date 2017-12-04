<?php
//The router.php file retrieves information from the URL and parses it. The dispatcher.php file executes it, which means it will lead the user to the good controller, which include the good view.

require_once('Src/router.php');
require_once('Src/session.php');
require_once('Config/core.php');

if($params[1] === '')
{
  Session::load();
  if (Session::getAttribut('name') == -1)
    require_once('Views/Users/login.php');
  else
    require_once('Views/home.php');
}
else
  array_shift($params);

$found = false;

if ($params[0] == 'users')
{
  if ($params[1] == 'login')
  {
    UsersController::getInstance()->check_login();
    $found = true;
  }
  if ($params[1] == 'inscription')
  {
    UsersController::getInstance()->check_subscription();
    $found = true;
  }
}

if (!$found)
{
  header('HTTP/1.1 404 Not Found');
  //require_once('../Controllers/404Controller.php');
}