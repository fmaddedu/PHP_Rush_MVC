<?php

// router.php contains your route map which is composed by your routes and the methods and controllers to which they are pointing;

class Router
{
	private $url;
	private $controller = 'login';
	private $action = 'index';
	private $params = [];
	
	public function __construct() {
		// if (isset($_GET["url"]))
		// 	$this->url_str = $_GET["url"];
		// var_dump($_GET["url"]);
		if (isset($_SERVER["REQUEST_URI"]))
			$this->url = $_SERVER["REQUEST_URI"];
		// var_dump($_SERVER["REQUEST_URI"]);
		// echo "<br>";
	}

	public function parse()
	{
		// trim = strip "/" from beginning and end of string
		// explode = separate around a delimiter and returns an array of strings
		$this->url = explode("/", trim($this->url, "/"));
		// var_dump($this->url);
		// echo "<br>";
		// set controller, action, params
		$this->setController();
		$this->setAction();
		$this->setParams();
		return TRUE;
	}

	public function setController() {
		if (sizeof($this->url) > 1)
			$this->controller = $this->url[1];
		else
			$this->controller = 'login';
	}

	public function setAction() {
		if (sizeof($this->url) > 2)
			$this->action = $this->url[2];
		else
			$this->action = 'index';			
	}

	public function setParams() {
		if (sizeof($this->url) > 3)
			$this->params = array_slice($this->url, 3);
		else
			$this->params = [];
	}

	public function getURL() {
		return $this->url;
	}

	public function getController() {
		return $this->controller;
	}

	public function getAction() {
		return $this->action;
	}

	public function getParams() {
		return $this->params;
	}
}