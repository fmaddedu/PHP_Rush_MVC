<?php

class Router
{
	private $url;
	private $routes = [];

	public function __construct($url)
	{
		$this->url = $url;
	}

	public function get($path, $calable)
	{
		$route = new Route($path, $calable);
		$this->routes['GET'][] = $route;
	}

	public function post($path, $calable)
	{
		$route = new Route($path, $calable);
		$this->routes['POST'][] = $route;
	}

	public function run()
	{
		echo '<pre>';
		echo print_r($this->routes);
		echo '<pre>';
	}


}