<?php 
include_once '../config/dbPdo.php';
include_once '../config/sessionStart.php';
include_once 'components/headerAdmin.php';
include_once 'components/head.php';
include_once '../models/User.php';

if (!$_SESSION['admin']) {
	header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>

	<body>
<!-- /************************* CREATE A NEW USER *************************/ -->  	
		<form method="POST" action="/pool_php_rush/controllers/registerController.php" id="createForm">
			<h1>Créer un compte client</h1>
			<?php 
			if (isset($_SESSION['message'])) {
				echo $_SESSION['message'];
				$_SESSION['message'] = "";
			}
			?>
		
			<label for="username">Pseudo :</label>
			<input type="text" name="username" id="username"><br>
			
			<label for="email">Email :</label>
			<input type="text" name="email" id="email"><br>
			
			<label for="password">Mot de passe :</label>
			<input type="password" name="password" id="password"><br>
			
			<label for="password_confirmation" >Confirmation du mot de passe :</label>
			<input type="password" name="password_confirmation" id="password_confirmation"><br>

			<input type="checkbox" name="admin" id="admin">
			<label for="admin" >Administrateur</label>
			
			<input type="submit" value="Valider">
		</form>

<!-- /************************* DISPLAY ALL USERS *************************/ -->  	
		<section class="usersList row">
			<?php 
				if (!empty($_GET)) {
					User::delete_from($_GET['id']);
				}				
				$_POST = array();
				$_SESSION['message'] = '';
				$users = User::get_users(); 
				foreach ($users as $user) {
			?>
				<div>
				<li>
					<ul>
						<li><?php echo $user['id'] ?></li>
						<li><a href='profilUser.php?id=<?php echo $user['id'] ?>'><?php echo $user['username'] ?></a></li>
						<li><?php echo $user['email'] ?></li>
						<li><?php echo $user['admin'] ?></li>
						<li><a href='editUser.php?id=<?php echo $user['id'] ?>'>Editer</a></li>
						<li><a href='adminUsers.php?id=<?php echo $user['id'] ?>'>Supprimer</a></li>
				 	</ul>
				</li>
				</div>
			<?php 
			}
			?>
		</section>				

	</body>
</html>