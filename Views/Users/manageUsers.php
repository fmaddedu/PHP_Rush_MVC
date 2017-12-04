
<?php include '../components/sessionStart.php'; ?>

<!DOCTYPE html>
<html> 

	<?php 
		include_once 'components/head.php'; 
		include_once '../users/User.php'; 
	?>
	
	<body>
		<?php include_once 'components/headerAdmin.php' ?>
        
		<section class="register">
			<div id="createBtn"></div>

				<div class="row">
					<div class="col s12 m6 l4">
					  <div class="card white">
					    <div class="card-content black-text">
					      	<form method="POST" action="../users/registerFormAdmin.php" id="createForm">
								<?php 
									if (isset($_SESSION['message']))
									{
										echo $_SESSION['message'];
									}
									else
									{
										echo $_SESSION['message'] = "";
									}
								?>
								<h1>Create a new user</h1>
								<label for="name">Name :</label>
								<input type="text" name="name" value="name" id="name"><br>
								<label for="email">Email :</label>
								<input type="text" name="email" value="email" id="email"><br>
								<label for="passwd">Password :</label>
								<input type="password" name="password" id="passwd"><br>
								<label for="confirm_passwd" >Confirm password :</label>
								<input type="password" name="password_confirmation" id="confirm_passwd"><br>
								<input type="checkbox" name="is_admin" id="is_admin">
								<label for="is_admin" >Admin</label>
								<input type="submit" value="Create" class="waves-effect waves-light btn">
							</form>
					    </div>
					  </div>
					</div>

					<?php 
						if (isset($_GET['edit']))
						{
							echo '
				        <div class="col s12 m6 l4">
				          <div class="card white">
				            <div class="card-content black-text">
									<form method="GET" action="../users/editForm.php" id="editForm">
										<h1>Edit user</h1>
										<label for="name">Name :</label>
										<input type="text" name="name" value="'.$_GET["name"].'" id="name"><br>
										<label for="email">Email :</label>
										<input type="text" name="email" value="'.$_GET["email"].'" id="email"><br>
										<label for="passwd">Password :</label>
										<input type="password" name="password" id="passwd"><br>
										<label for="confirm_passwd">Confirm password :</label>
										<input type="password" name="password_confirmation" value="" id="confirm_passwd"><br>
										<input type="checkbox" name="is_admin" id="is_admin">
										<label for="is_admin">Admin</label>
										<input type="submit" value="Submit" class="waves-effect waves-light btn">
									</form>
				            </div>
				          </div>
				        </div>
								';
							}
						 ?>
		              	


				</div>


			<section class="usersList row">

				<?php

					if (isset($_GET["del_user"]))
					{
						User::delete();
					}
					$users = User::getUsers();
					echo '<ul class="mainList collection col s12">';
					foreach ($users as $value) 
					{
						$id = $value->getId();
						$href='manageUsers.php?del_user='.$id;
						echo '
						<li>
							<ul class="itemsList collection-item avatar">
								<li class="title">'.$value->getId().'</li>
								<li class="name"><a href="">'.$value->getName().'</a></li>
								<li class="email">'.$value->getEmail().'</li>
								<li class="flex">'.$value->getIsAdmin_letters().'</li>
								<div>
									<li><a class="btn btn-floating btn-large" href="manageUsers.php?name='.$value->getName().'&email='.$value->getEmail().'&admin='.$value->getIsAdmin().'&id='.$value->getId().'&edit=1"><i class="material-icons">create</i></a></li>
									<li><a class="btn btn-floating btn-large blue" href="'.$href.'"><i class="material-icons">delete_forever</i></a></li>
								</div>
							</ul>
						</li>
						';
					}
					echo '</ul>';

				?>
			</section>
			
		</section>

		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      	<script type="text/javascript" src="js/materialize.min.js"></script>

	</body>
</html>