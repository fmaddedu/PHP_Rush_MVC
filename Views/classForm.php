<?php

class Form
{
	public function __construct($array = array(), $submit = "Submit", $action = NULL)
	{
		echo '<form action="'.$action.'" method="post">';
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
		}

		echo '<div><button class="btn" type="submit">'.$submit.'</button></div></form>';
	}
}

?>