<?php 

class Controller
{
	protected $request;
	protected $message;

	protected function __construct($request = NULL)
	{
		$this->request = $request;
	}
	
	//Method calling the view file. In the case where the parameter is null, we load the view file associated to the method. 
	//So without parameter, we get Views/<nom_du_controller>/<nom_de_l’action>.html.twig
	protected function render($view = NULL)
	{
		if (!empty($view))
			include_once(ROOT."Views/".$view.".php");
		else
			include_once(ROOT."Views/".$request->getController()."/".$request->getAction().".php");			
	}

	//Loads the Database class so that it can be accessed in the controller by using $this->$model
	protected function loadModel($model)
	{
		$this->userModel = $model::getInstance();
	}
	
	protected function getMessage()
	{
		return($this->message);
	}

	//Method called right before the call to the view. This is to do some actions before the rendering.
	protected function beforeRender()
	{

	}

	//Redirects a user from a method of the router to another method of the router.
	//– $param is an array with the URL of the route.
	//– You have to use Dispatcher class
	protected function redirect($param)
	{

	}
}