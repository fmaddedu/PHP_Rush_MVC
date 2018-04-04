<?php

// router.php contains your route map which is composed by your routes and the methods and controllers to which they are pointing;

Class Router
{
	public static function parse($url, $request)
	{
		$url = trim($url, "/");
		$params = explode("/", $url);
		$request->setController($params[0]);
		$request->setAction(isset($params[1]) ? $params[1]: "index");
		$request->setParams(array_slice($params, 2));
		return(TRUE);
	}
}