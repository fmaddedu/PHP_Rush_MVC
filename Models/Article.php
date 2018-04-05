<?php 

include_once __DIR__.'../Config/db.php';
include_once __DIR__.'/Form.php';

class Article {
/********************** CREATE AN ARTICLE **********************/
	static function create() {
		$database = Database::getInstance();
		$db = $database->connect();			
		$sql = "INSERT INTO articles (title, content, creation_date, id_creator, id_category) VALUES (:title, ::content, :creation_date, :id_creator, :id_category)";
		$request = $db->prepare($sql);
		$request->execute(array(
			'title' => $_POST['title'],
			'content' => $_POST['content'], 
			'creation_date' => datetime(),
			'id_creator' => ,
			'id_category' =>
		));
	}

/************************* DELETE ARTICLE **************************/		
	static function delete() {
		$id = $_POST['id'];
		$database = Database::getInstance();
		$db = $database->connect();			
		$sql = "DELETE FROM articles WHERE id='$id'";
		$request = $db->prepare($sql);
		$request->execute();
	}

/********************** DELETE ARTICLE FROM ID **********************/		
	static function delete_from($id) {
		$database = Database::getInstance();
		$db = $database->connect();			
		$sql = "DELETE FROM articles WHERE id='$id'";
		$request = $db->prepare($sql);
		$request->execute();
	}

/**** RETURNS ARTICLE INFORMATION AS AN ARRAY INDEXED BY COLUMN NAME ****/
	static function get_article() {
	  if (Form::title_valid()) {
	  	$title = $_POST['title'];
			$database = Database::getInstance();
			$db = $database->connect();			
			$sql = "SELECT * FROM articles WHERE title='$title'";
			$request = $db->prepare($sql);
			$request->execute();
			$article = $request->fetch(PDO::FETCH_ASSOC);
			return $article;
		}
	}

/**** RETURNS USER INFORMATION AS AN ARRAY INDEXED BY COLUMN NAME ****/
	static function get_article_from($id) {
	  if (is_int($id)) {
			$database = Database::getInstance();
			$db = $database->connect();			
			$sql = "SELECT * FROM articles WHERE id='$id'";
			$request = $db->prepare($sql);
			$request->execute();
			$article = $request->fetch(PDO::FETCH_ASSOC);
			return $article;
		}
	}

/************************* RETURNS ALL USERS *************************/		
	static function get_articles() {
		$database = Database::getInstance();
		$db = $database->connect();			
		$sql = "SELECT * FROM articles ORDER BY id DESC";
		$request = $db->prepare($sql);
		$request->execute();
		$articles = $request->fetchAll();
		return $articles;
	}
}
