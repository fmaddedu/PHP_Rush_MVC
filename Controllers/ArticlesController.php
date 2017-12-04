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
class FormProduct
{	

	public function validName($postName)
	{
		if (!is_string($postName) || empty($postName) || $postName == "" || strlen($postName) < 3 || strlen($postName) > 40)
		{
			echo "<p class='error'>Invalid name</p>";
			return FALSE;
		}
		return TRUE;
	}

	public function validPrice($postPrice)
	{	
		if (empty($postPrice) || !is_numeric($postPrice) || $postPrice <= 0)
		{
			echo "<p class='error'>Invalid price</p>";
			return FALSE;
		}
		return TRUE;
	}

	public function validDesc($postDesc)
	{
		if (!is_string($postDesc) || strlen($postDesc) > 500)
		{
			echo "<p class='error'>Invalid description</p>";
			return FALSE;
		}
		return TRUE;
	}
}
?>

<?php
	include_once '../components/sessionStart.php';
	include_once '../components/main.php';
	include_once 'Product.php';
	include_once 'FormProduct.php';

	
	$product = new FormProduct();
	$nameErr = $priceErr = $descErr = "";
	$name = $price = $desc = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  	{
    	if (! $product->validName($_POST['name']))
		{
			$nameErr = 'Invalid name';
			$_SESSION['message'] = $nameErr;
			$name = $_POST['name']; 
		}
	    else 
	    {
	      	$name = $_POST['name'];
		    if (! $product->validPrice($_POST['price']))
	    	{
	    		$priceErr = 'Invalid price';
		    	$_SESSION['message'] = $priceErr;
		    	$price = $_POST['price'];
	    	}
	    	else
		    {
		    	$price = $_POST['price'];
			    if (! $product->validDesc($_POST['desc']))
			    {
					$descErr = 'Invalid description';
					$_SESSION['message'] = $descErr;
					$desc = $_POST['desc']; 
				}
			    else 
			    {
			      	$desc = $_POST['desc'];
			    }
		    }
	    }
    }

    if ($_SESSION['message'] == 0)
    {
		Product::create($_POST['name'], $_POST['price'], $_POST['category'], $_POST['desc']);
    }

	header("Location: ../views/manageProducts.php");	
?>