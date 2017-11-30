<?php
include_once(dirname(__FILE__).'/../Config/db.php');
include_once(dirname(__FILE__).'User.php');
include_once(dirname(__FILE__).'Category.php');

class articleManager
{
	private static $instance = null;

	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = new articleManager();
		return self::$instance;
	}

	private function __clone(){}

	public function get_articles()
	{
		$query = 'SELECT * FROM articles';
		$dbConnect->sql_query($query);
	}

	public function get_article_by_id($id)
	{
		$query = 'SELECT * FROM articles WHERE id = :id';
		$variable = array('id' => $id);
		$db_connect->sql_query($query, $variable);
	}

	public function get_article_by_title($title)
	{
		$query = 'SELECT * FROM articles WHERE title = :title';
		$variable = array('title' => $title);
		$db_connect->sql_query($query, $variable);
	}

	public function post_article($title, $content, $creatorUsername, $categoryName)
	{
		$query = 'INSERT INTO articles (title, content, creator, category, creation_date, edition_date) VALUES (:title, :content, :creator, :category, :creation_date, :edition_date)';
		//$userM = userManager::getInstance();
		$creator = $userM->get_user_by_username($creatorUsername);
		//$categoryM = categoryManager::getInstance();
		$category = $categoryM->get_category_by_name($categoryName);
    $variable = array(
    	'title' => $title,
    	'content' => $content,
    	'creator' => $creator['id'],
    	'category' => $category['id'],
    	'creation_date' => date("Y-m-d H:i:s"),    	
    	'edition_date' => date("Y-m-d H:i:s")
        );	
  	$db_connect->sql_query($query, $variable);
	}

	public function edit_article($id, $title = null, $content = null, $creatorUsername = null, $categoryName = null)
	{
		$query = 'UPDATE articles SET title = COALESCE(:title, title), content = COALESCE(:content, content), creator = COALESCE(:creator, creator), category = COALESCE(:category, category), edition_date = :edition_date WHERE id = :id';
		//$userM = userManager::getInstance();
		if ($creatorUsername != null)
			$creator = $userM->get_user_by_username($creatorUsername);
		//$categoryM = categoryManager::getInstance();
		if ($categoryName != null)
			$category = $categoryM->get_category_by_name($categoryName);
    $variable = array(
    	'title' => $title,
    	'content' => $content,
    	'creator' => $creator['id'],
    	'category' => $category['id'],
    	'edition_date' => date("Y-m-d H:i:s"),
    	'id' => $id
        );
   	$db_connect->sql_query($query, $variable);
	}

	public function delete_article($id)
	{
		$query = 'DELETE FROM articles WHERE id = :id';
    $variable = array('id' => $id );
   	$db_connect->sql_query($query, $variable);
	}
}

$articleM = articleManager::getInstance();

?>