<?php
require_once('Src/router.php');
require_once('Src/session.php');
require_once('Config/core.php');

class Dispatcher
{
	private $request;

	public function dispatch()
	{
		$this->request = new Request();
		Router::parse($this->request->url, $this->request);
		$controller = $this->loadController();
		var_dump($this->request);
		call_user_func_array(array($controller, $this->request->action, $this->request->params));
	}

	public function loadController()
	{
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