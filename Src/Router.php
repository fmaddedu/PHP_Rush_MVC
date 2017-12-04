<?php

class Router
{
	public static function parse($url, $request)
	{
		$url = trim($url);
		$url = preg_replace('/[\-]+$/', '', $url);
		$parts = explode('/', $url);
		$pattern = explode('-', end($parts));
		$request->controller = $pattern[0];
		$request->action = $pattern[1];
		$request->params = array_slice($pattern, 2);				
		$request->date = date('Y-m-d G:i:s');
		$request->base = basename(dirname(__FILE__));
	}
}

?>