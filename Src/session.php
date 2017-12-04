<?php
/*
Contains a class Session that will implement methods read, write, delete, destroy and load. These methods are static.
Session class overlays PHP sessions, which means that a session variable is accessible by: $_SESSION[’key’]; or Session::read(’key’); 
(key represents a path with a dot separator).
Example: Session::read(‘Auth.User.id’) == $_SESSION[‘Auth’][‘User’][‘id’];

	if (!isset($_SESSION))
	{
		session_start();
	}
*/

class Session
{
	static function read()
	{

	}

	static function write()
	{
		
	}

	static function delete()
	{
		
	}

	static function destroy()
	{
		
	}

	static function load()
	{
		
	}

	static function getAttribute()
	{
		
	}

}

?>

