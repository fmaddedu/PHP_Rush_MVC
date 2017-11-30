<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php 
	if (empty($_SESSION))
	{
		header("Location: views/login.php");
	}
	elseif (isset($_COOKIE["user_log"]))
	{
		echo 'Bonjour ' . $_COOKIE["user_name"];
		$_SESSION["name"] = $_COOKIE["user_name"];
		$_SESSION["email"] = $_COOKIE["user_log"];
	}
?>

	<section class="productsList row">
		<?php
			$products = Product::getList();
			echo '<ul class="mainList collection col s12 m10">';
			foreach ($products as $value) 
			{
				echo '
				<li>
					<ul class="itemsList collection-item avatar">
						<li class="title">'.$value->getId().'</li>
						<li class="name"><a href="">'.$value->getName().'</a></li>
						<li class="email price">'.$value->getPrice().'</li>
						<li>'.$value->getCategory().'</li>
						<li>'.$value->getDesc().'</li>
						<li><a href="">See details</a></li>
					</ul>
				</li>
				';
			}
			echo '</ul>';
		?>
	</section>

</body>
</html>