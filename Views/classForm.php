<?php

class Form
{
	public function __construct($array = array(), $submit, $action = NULL)
	{
		echo '<form action="'.$action.'" method="post">';
		
		if (isset($_SESSION['message']))
		{
			echo $_SESSION['message'];
			$_SESSION['message'] = "";
		}
		
		foreach ($array as $key => $value)
		{
			if($key == "username")
			{
				echo '<label for='.$key.'> '.$value.': </label><input type="text" class="form" name='.$key.' id='.$key.' /></br>';		
			}
			else if($key == "email")
			{
				echo '<label for='.$key.'> '.$value.': </label><input type="email" class="form" name='.$key.' id='.$key.' /></br>';
			}
			else if($key == "password" || $key == "password_confirmation")
			{
				echo '<label for='.$key.'> '.$value.': </label><input type="password" class="form" name='.$key.' id='.$key.' /></br>';	
			}
			else if($key == "title")
			{
				echo '<label for='.$key.'> '.$value.': </label><input type="text" class="form" name='.$key.' id='.$key.' /></br>';
			}
			else if($key == "content")
			{
				echo '<label for='.$key.'> '.$value.': </label><input type="text" class="form" name='.$key.' id='.$key.' /></br>';
			}
			else if($key == "category")
			{
				echo '<label for='.$key.'> '.$value.': </label><input type="text" class="form" name='.$key.' id='.$key.' /></br>';
			}
		}

		echo '<div><button class="btn" type="submit">'.$submit.'</button>';
		
		if ($submit = 'Login')
			echo "<p>You don't have any account yet ? <a href='register.php'>Register</a></p>";
		else if ($submit = 'Register')
			echo "<p>You already have an account ?<a href='login.php'>Log in</a></p>";

		echo '</div></form>';
	}
}

?>