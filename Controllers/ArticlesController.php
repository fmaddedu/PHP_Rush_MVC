<?php 
include_once(dirname(__FILE__).'/../Models/Article.php');

class articlesController
{
	private static $instance = null;
	protected $db;
	protected $blog;

	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = new articleManager();
		return self::$instance;
	}

	private function __clone(){}

	public function secure_input($data)
	{
		$data = trim($data); 
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function secure_get_articles()
	{
		$articles = $this->blog->get_articles();
		foreach ($articles as $article)
		{
			$articles['title'] = htmlspecialchars($article['title']);
			$articles['content'] = nl2br(htmlspecialchars($article['content']));
		}
		return $articles;
	}

	public function secure_get_article($id)
	{
		$article = $this->blog->get_article($id);
		foreach ($article as $article)
		{
			$articles['title'] = htmlspecialchars($article['title']);
			$articles['content'] = nl2br(htmlspecialchars($article['content']));
		}
		return $article;
	}

	public function secure_post_article($title, $content = null)
	{			
		$title = $this->secure_input($title);
		if ($content != null)
			$content = $this->secure_input($content);
		
		$post = $this->blog->post_article($title, $content);
		if ($post == -1)
			return -1;
	}

	public function secure_put_article($id, $title = null, $content = null)
	{
		if ($title != null)
			$title = $this->secure_input($title);
		if ($content != null)
			$content = $this->secure_input($content);
		
		$put = $this->blog->put_article($id, $title, $content);
		if ($put == -1)
			return -1;
	}
}

$articleC = articlesController::getInstance();

//include_once '../../Views/blogList/articles.php';
?>
