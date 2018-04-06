<!DOCTYPE html>
<html>
	
	<body>
		
		<form method="POST" action="../../PHP_Rush_MVC/login/index">

		<h1>Se connecter</h1>
		
		<label for="email">Email :</label>
		<input type="text" name="email" value="" id="email"><br>
		
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" value="" id="password"><br>
		
		<div class="checkbox">
			<input type="checkbox" name="remember_me" id="remember">
			<label for="remember_me">Rester connecté</label><br>
		</div>

		<input type="submit" value="Se connecter">

		<h2>Pas encore client ?<a href="register">S'inscrire</a></h2>

	</form>

	</body>
</html>