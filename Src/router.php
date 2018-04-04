<?php

// router.php contains your route map which is composed by your routes and the methods and controllers to which they are pointing;

class Router
{
	public static function parse($url, $request)
	{
		$url = trim($url);
		$url = preg_replace('/[\-]+$/', '', $url);
		$parts = explode('/', $url);
		$pattern = explode('-', end($parts));
		
		if(isset($pattern[0]) && $pattern[0] != '')
			$request->controller = $pattern[0];
		else
			$request->controller = 'Articles';
		if (isset($pattern[1]) && $pattern[1] != '') 	
			$request->action = $pattern[1];
		else
			$request->action = 'display_articles';

			$request->params = array_slice($pattern, 2);				
			$request->date = date('Y-m-d G:i:s');
			$request->base = basename(dirname(__FILE__));
	}
} 
