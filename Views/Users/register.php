<!DOCTYPE html>
<html>

	<?php include_once 'components/head.php'; ?>
	
	<body>

		<form method="POST" action="../../PHP_Rush_MVC/login/register">
			
		<h1>S'inscrire</h1>
		
		<label for="username">Pseudo :</label>
		<input type="text" name="username" placeholder="GeorgesAbitbol" id="username"><br>
		
		<label for="email">Email :</label>
		<input type="text" name="email" placeholder="georges.abitbol@wanadoo.fr" id="email"><br>
		
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password"><br>
		
		<label for="password_confirmation" >Confirmation du mot de passe :</label>
		<input type="password" name="password_confirmation" id="password_confirmation"><br>
		
		<p>En cliquant sur <span>S'inscrire</span>, je confirme avoir lu les Conditions d'utilisation. Je confirme également que j'accepte le traitement de mes données et de recevoir des communications marketing.</p>

		<input type="submit" value="S'inscrire">
		
		<h2>Déjà client ?<a href="login.php">Se connecter</a></p>
		
		</form>

	</body>
</html>