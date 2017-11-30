<?php
include_once(dirname(__FILE__).'/../Config/db.php');
include_once(dirname(__FILE__).'User.php');
include_once(dirname(__FILE__).'Article.php');

class commentManager
{
	private static $instance = null;

	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = new commentManager();
		return self::$instance;
	}

	private function __clone(){}

	public function get_comments()
	{
		$query = 'SELECT * FROM comments';
		$dbConnect->sql_query($query);
	}

	public function get_comments_on_article($articleTitle)
	{
		$query = 'SELECT * FROM comments WHERE article = :article';
		//$articleM = articleManager::getInstance();
		$article = $articleM->get_article_by_();
		$variable = array('article' => $article['id']);
		$dbConnect->sql_query($query);
	}

	public function get_comment($id)
	{
		$query = 'SELECT * FROM comments WHERE id = :id';
		$variable = array('id' => $id);
		$db_connect->sql_query($query, $variable);
	}

	public function post_comment($content, $creatorUsername, $articleTitle)
	{
		$query = 'INSERT INTO comments (content, creator, article, creation_date, edition_date) VALUES (:content, :creator, :article, :creation_date)';
		//$userM = userManager::getInstance();
		$creator = $userM->get_user_by_username($creatorUsername);
		//$articleM = articleManager::getInstance();
		$article = $articleM->get_article_by_title($articleTitle);
    $variable = array(
    	'content' => $content,
    	'creator' => $creator['id'],
    	'article' => $article['id'],
    	'creation_date' => date("Y-m-d H:i:s")    	
        );	
  	$db_connect->sql_query($query, $variable);
	}

	public function delete_comment($id)
	{
		$query = 'DELETE FROM comments WHERE id = :id';
    $variable = array('id' => $id );
   	$db_connect->sql_query($query, $variable);
	}
}

$commentM = commentManager::getInstance();

?>