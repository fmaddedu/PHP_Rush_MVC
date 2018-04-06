<?php

// dispatcher.php contains the class Dispatcher which will redirect data received by the client side to the corresponding method with the router map information.

// require_once __DIR__.'/../Config/core.php');

class Dispatcher 
{
  private $request;			// contains url -> controller/action/params 
  private $controller;	// instance of controller

	public function __construct()
	{
		// echo "dispatcher<br>";
		$this->request = new Router();
		$this->request->parse();
		echo "\$this->request->getURL() : ";
		var_dump($this->request->getURL());
		echo "<br>";
		echo "\$this->request->getController() : ";
		var_dump($this->request->getController());
		echo "<br>";
		echo "\$this->request->getAction() : ";
		var_dump($this->request->getAction());
		echo "<br>";
		echo "<br>";
		$this->controller = $this->load_Controller();
		var_dump($this->controller);
		echo "<br>";
		if (is_callable(array($this->controller, $this->request->getAction())))
			call_user_func_array([$this->controller, $this->request->getAction()], $this->request->getParams()); 	// call_user_func_array(array('ClassName', 'method'), $args)
	}

	private function load_Controller()
	{
		if(!isset($_SESSION["user"]))
		{
			$name = "login";
			$file = ROOT."Controllers/".ucfirst($name).".php";
		}
		else if($this->request->getController() != "")
		{
			$name = $this->request->getController();
			$file = ROOT."Controllers/".ucfirst($name).".php";
		}
		if(file_exists($file))
		{
			include_once $file;
			if(method_exists($name, $this->request->getAction())) {
				return(ucfirst($name)::getInstance($this->request));
			}	
			else
			{
				http_response_code(404);
				include_once('Views/my_404.php'); 
				die();
	      // header('HTTP/1.0 404 Not Found');
			}
		}
		else
		{
			http_response_code(404);
			include_once('Views/my_404.php'); 
			die();
      // header('HTTP/1.0 404 Not Found');
		}
	}
}

