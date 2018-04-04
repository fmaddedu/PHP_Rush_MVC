<?php 
include_once '../config/dbPdo.php';
include_once '../config/sessionStart.php';
include_once '../models/Form.php';
include_once '../models/User.php';
include_once '../models/Product.php';
include_once '../models/Category.php';
include_once 'components/head.php'; 

if (!empty($_GET)){
	// echo 'GET<br>';
	$user = User::get_user_from((int)$_GET['id']);
	// var_dump($user);
}
// PROBLEME ICI, SI ON SE TROMPE 2x PENDANT L'EDIT, LE COMPTE EST SUPPRIME
// SOLUTION = UPDATE ARBITRAIRE SUR USERNAME ET EMAIL, POUR METTRE LE DELETE APRES LA VALIDATION DU FORM
if (!empty($_POST)) {
	// echo 'POST<br>';
	$user = User::get_user_from((int)$_POST['id']);
	// var_dump($user);
	User::delete();
	if (Form::valid_register_form() == "") {
		User::create();
		$_SESSION['message'] = "<p class='success'>Compte édité avec succès</p><br>";
		header("Location: ../views/adminUsers.php");	
	}
	elseif (Form::valid_register_form() != "") {
		$message_error = Form::valid_register_form();
		$_SESSION['message'] = "<p class='error'>$message_error</p>";
	}
}

?>

	<body>

		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" >
		
		<h1>Editer le compte client de <?php echo " " . $user['username'] ?></h1>
		<?php 
			if (!empty($_SESSION['message'])) {
				echo $_SESSION['message'];
				$_SESSION['message'] = "";
			}
		?>

		<input type="hidden" name="id" value="<?php echo $user['id'] ?>" id="id"><br>

		<label for="username">Pseudo :</label>
		<input type="text" name="username" value="<?php echo $user['username'] ?>" id="username"><br>
		
		<label for="email">Email :</label>
		<input type="text" name="email" value="<?php echo $user['email'] ?>" id="email"><br>
		
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password"><br>
		
		<label for="password_confirmation" >Confirmation du mot de passe :</label>
		<input type="password" name="password_confirmation" id="password_confirmation"><br>
		
		<input type="checkbox" name="admin" <?php if ($user['admin'] == '1') echo "checked" ?> id="admin">
		<label for="admin" >Admin</label>
			
		<a href='adminUsers.php'>Annuler</a>	
		<input type="submit" value="Valider">
		
		</form>

	</body>
</html>