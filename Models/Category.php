<?php
include_once(dirname(__FILE__).'/../Config/db.php');

class categoryManager
{
	private static $instance = null;

	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = new categoryManager();
		return self::$instance;
	}

	private function __clone(){}

	public function get_categories()
	{
		$query = 'SELECT * FROM categories';
		$dbConnect->sql_query($query);
	}

	public function get_category_by_id($id)
	{
		$query = 'SELECT * FROM categories WHERE id = :id');
		$variable = array('id' => $id);
		$db_connect->sql_query($query, $variable);
	}

	public function get_category_by_name($name)
	{
		$query = 'SELECT * FROM categories WHERE name = :name');
		$variable = array('name' => $name);
		$db_connect->sql_query($query, $variable);
	}

	public function add_category($name)
	{
		$query = 'INSERT INTO categories (name) VALUES (:name)';
    $variable = array('name' => $name );	
  	$db_connect->sql_query($query, $variable);
	}

	public function edit_category($id, $name)
	{
		$query = 'UPDATE categories SET name = :name WHERE id = :id';
    $variable = array(
    	'id' => $id,
    	'name' => $name
        );
   	$db_connect->sql_query($query, $variable);
	}

	public function delete_category($id)
	{
		$query = 'DELETE FROM categories WHERE id = :id';
    $variable = array('id' => $id );
   	$db_connect->sql_query($query, $variable);
	}
}

$categoryM = categoryManager::getInstance();

?>