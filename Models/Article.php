<?php
include_once(dirname(__FILE__).'/../Config/db.php');

class articleManager
{
	private $db;
 
	public function __construct()
	{
		$this->db = DB;
	}

	public function get_db()
	{
		return $this->db;
	}

	public function get_articles()
	{
		$query = 'SELECT * FROM articles';
		$dbConnect->sql_query($query);
	}

	public function get_article($id)
	{
		$query = 'SELECT * FROM articles WHERE id = :id');
		$variable = array('id' => $id);
		$db_connect->sql_query($query, $variable);
	} 

/*
	// categoryName to categoryId
	public static function categoryName($categoryId)
	{
		$bdd = connect_db("127.0.0.1", "root", "root", 3306, "pool_php_rush");
		$request = $bdd->prepare("SELECT name FROM categories WHERE id = ?");
		$request->execute(array($categoryId));
		$result = $request->fetch();
		echo "<br>";
        $request->closeCursor();
		return $result[0];
	}
*/

	public function post_article($title, $content, $creator, $category)
	{
		$query = 'INSERT INTO articles (title, content, creator, category, creation_date, edition_date) VALUES (:title, :content, :creator, :category, :creation_date, :edition_date)';
    $variable = array(
    	'title' => $title,
    	'content' => $content,
    	'creator' => $creator,
    	'category' => $category,
    	'creation_date' => date("Y-m-d H:i:s"),    	
    	'edition_date' => date("Y-m-d H:i:s")
        );	
  	$db_connect->sql_query($query, $variable);
	}

	public function edit_article($id, $title = null, $content = null, $creator = null, $category = null)
	{
		$query = 'UPDATE articles SET title = COALESCE(:title, title), content = COALESCE(:content, content), creator = COALESCE(:creator, creator), category = COALESCE(:category, category), edition_date = :edition_date WHERE id = :id';
    $variable = array(
    	'title' => $title,
    	'content' => $content,
    	'creator' => $creator,
    	'category' => $category,
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

?>