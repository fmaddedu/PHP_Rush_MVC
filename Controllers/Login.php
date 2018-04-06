<?php 

include_once (__DIR__."/Controller.php");
include_once (__DIR__."/../Config/config.php");
include_once (__DIR__."/../Config/db.php");
include_once (__DIR__."/../Config/sessionStart.php");
include_once (__DIR__."/../Models/Form.php");
include_once (__DIR__."/../Models/User.php");

echo "loginController<br>";

class Login extends Controller
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
				// header("Location: ../index.php?route=login");
				$this->render("Users/login");
			}
	}

	public function register() {
		// echo "register";
		$this->render("Users/register");

			/************** GO TO INDEX IF EVERYTHING IS OK **************/
		if (!empty($_POST) && Form::valid_register_form() == "") {
			User::create();
			$_SESSION['message'] = "<p class='success'>Compte créé avec succès</p><br>";
			if (!$_SESSION['admin']) {
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['email'] = $_POST['email'];
				header("Location: ../index.php");
			}
			else
		/************* WHEN ADMIN CREATES AN ACCOUNT *************/
				header("Location: ../views/adminUsers.php");			
		}

		/************ STAY IN REGISTER PAGE IF ERRORS ************/
		elseif (!empty($_POST) && Form::valid_register_form() != "") {
			$message_error = Form::valid_register_form();
			$_SESSION['message'] = "<p class='error'>$message_error</p>";
			if (!$_SESSION['admin'])
				header("Location: ../views/register.php");
			else
		/************* WHEN ADMIN CREATES AN ACCOUNT *************/
				header("Location: ../views/adminUsers.php");			
		}
	}

	public function logout() {
		
		session_destroy();

		if (isset($_COOKIE))
			setcookie($_COOKIE, NULL, -1);

		header("Location: ../index.php");

	}
}

