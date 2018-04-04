<?php

class Request
{
	public $url;

	public function __construct()
	{
	if (isset($_SERVER['REQUEST_URI']));
		$this->url = $_SERVER['REQUEST_URI'];
	}	
}