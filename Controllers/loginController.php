<?php 

include_once (__DIR__."/appController.php");
include_once (__DIR__."/../Config/config.php");
include_once (__DIR__."/../Config/db.php");
include_once (__DIR__."/../Config/sessionStart.php");
include_once (__DIR__."/../Models/Form.php");
include_once (__DIR__."/../Models/User.php");

echo "loginController";

class LoginController extends appController
{
	protected $request;
	protected $message;
	// protected $userModel;
	// protected $formModel;
	protected static $instance;

	protected function __construct($request) {
		$this->request = $request;
		// $this->userModel = User::getInstance();
		// $this->formModel = Form::getInstance();
	}

	public static function getInstance($request = NULL)
	{
		if(!isset(self::$instance)) {
			self::$instance = new self($request);
		}
		return(self::$instance);
	}

	public function index()
	{
/*************** GO TO HOME IF COOKIE OR SESSION EXIST ***************/
		if (!empty($_COOKIE['email']) && !empty($_COOKIE['username'])) {
			$_SESSION['username'] = $_COOKIE['username'];
			$_SESSION['email'] = $_COOKIE['email'];
		}
		if (!empty($_SESSION['email']) && !empty($_SESSION['username'])) {
			echo 'Bonjour ' . $_SESSION['username'];
			$this->render("Articles/home");
		}
/************************* CHECK LOGIN INPUT ************************/
		else 
			if (!empty($_SESSION['message'])) {
				echo $_SESSION['message'];
				$_SESSION['message'] = "";
			}
			if (!empty($_POST) && Form::email_exists() && Form::pwd_checked()) 
			{
				$user = User::get_user();
				// if "Remember me" is checked, $_POST('remember_me') = 1, else 0
				if (!empty($_POST['remember_me'])) {
					setcookie('email', $_POST['email'], time() + 365*24*3600);
					setcookie('username', $user['username'], time() + 365*24*3600);
				}
				$_SESSION['email'] = $user['email'];
				$_SESSION['username'] = $user['username'];

			/***************** CHECK USER GROUP *****************/	
				switch ($user['user_group'])
				{
					case "ADMIN":
						$_SESSION['user_group'] = "ADMIN";
						$this->render("Users/adminUsers");
						break;
					case "WRITER":
						$_SESSION['user_group'] = "WRITER";
						$this->render("Articles/postArticle");
						break;
					case "USER":
						$_SESSION['user_group'] = "USER";
						$this->render("Users/login");
						break;
					default:
						$_SESSION['message'] = "<p class='error'>Groupe utilisateur incorrect.</p>";
						$this->render("Articles/home");
						break;
				}
			}
			/*************** STAY IN LOGIN PAGE IF ERRORS ***************/
			elseif (!empty($_POST) && !Form::email_exists()) {
				$_SESSION['message'] = "<p class='error'>Email inconnu</p>";
				$this->render("Users/login");
			}
			elseif (!empty($_POST) && Form::email_exists() && !Form::pwd_checked()) {
				$_SESSION['message'] = "<p class='error'>Mot de passe erroné</p>";
				$this->render("Users/login");
			}
			elseif (empty($_POST)) {
				$_SESSION['message'] = "<p class='error'>Veuillez compléter le formulaire</p>";
				$this->render("Users/login");
			}
	}

	public function logout()
	{
		session_unset();
		session_destroy();
		session_reset();
		session_start();
		header("Location: ../../PHP_Rush_MVC");
	}
	private function Register_Form()
	{
		$form = array();
		$form["username"] = "Nom";
		
		$form["password"] = "Password";
				
		$this->form = FormGenerator::form($form, "Login");
		
		$this->render("login");
	}
	public function getForm()
	{
		return($this->form);
	}
}

