<?php 
include_once '../config/dbPdo.php';
include_once '../config/sessionStart.php';
include_once '../models/Form.php';
include_once '../models/User.php';
include_once '../models/Product.php';
?>

<!DOCTYPE html>
<html>
	
	<?php include_once 'components/head.php'; ?>

	<body>
		
		<form method="POST" action="../controllers/loginController.php">

		<?php 
			if (!empty($_SESSION['message'])) {
				echo $_SESSION['message'];
				$_SESSION['message'] = "";
			}
		?>

		<h1>Se connecter</h1>
		
		<label for="email">Email :</label>
		<input type="text" name="email" value="" id="email"><br>
		
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" value="" id="password"><br>
		
<!-- 	TO BE DONE
 		<p><a href="reset_password">Réinitialiser le mot de passe</a></p>
 -->
		<div class="checkbox">
			<input type="checkbox" name="remember_me" id="remember">
			<label for="remember_me">Rester connecté</label><br>
		</div>

		<input type="submit" value="Se connecter">

		<h2>Pas encore client ?<a href="register.php">S'inscrire</a></h2>

	</form>

	</body>
</html>