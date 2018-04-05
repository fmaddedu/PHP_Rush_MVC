<?php

// dispatcher.php contains the class Dispatcher which will redirect data received by the client side to the corresponding method with the router map information.

// require_once __DIR__.'/../Config/core.php');

class Dispatcher 
{
  private $request;
  private $controller;
	
	public function dispatch()
	{
		$this->request = new Request();
		Router::parse($this->request->getURL(), $this->request);
		// echo("<main>");
		$this->controller = $this->load_Controller();
		call_user_func_array(array($this->controller,$this->request->getAction()), $this->request->getParams());
		// echo("</main>");
	}

	private function load_Controller()
	{
		if(!isset($_SESSION["user"]))
		{
			$name = "loginController";
			$file = ROOT."Controllers/".$name.".php";
		}
		else if($this->request->getController() != "")
		{
			$name = $this->request->getController()."Controller";
			$file = ROOT."Controllers/".$name.".php";
		}
		if(file_exists($file))
		{
			include_once $file;
			if(method_exists($name, $this->request->getAction())) {
				return($name::getInstance());
				// return($name::getInstance($this->request));
			}	
			else
			{
				http_response_code(404);
				include_once('Views/my_404.php'); 
				die();
	      // header('HTTP/1.0 404 Not Found');
	      // exit;				
			}
		}
		else
		{
			http_response_code(404);
			include_once('Views/my_404.php'); 
			die();
      // header('HTTP/1.0 404 Not Found');
      // exit;				}
		}
	}
}

