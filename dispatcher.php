<?php

// dispatcher.php contains the class Dispatcher which will redirect data received by the client side to the corresponding method with the router map information.

// require_once __DIR__.'/../Config/core.php');

class Dispatcher 
{
  private $request;

  public function dispatch()
  {
    echo 'dispatch';
    $this->request = new Request();
    Router::parse($this->request->url, $this->request);
    $controller = $this->loadController();
    var_dump($this->request);
    call_user_func_array(array($controller, $this->request->action, $this->request->params));
    $controller->render($this->request->action);
  }

  public function loadController()
  {
    echo 'totototo';
    $name = $this->request->controller . 'Controller';
    $file = 'Controllers/' . $name . '.php';
    

    if (!file_exists($file))
    {
      header('HTTP/1.0 404 Not Found');
      exit;
    }
    require $file;
    $controller = new $name($this->request);
    return $controller;
  }
}

?>