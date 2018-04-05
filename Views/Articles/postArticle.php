<?php

include_once '../config/dbPdo.php';
include_once '../config/sessionStart.php';
include_once '../views/components/headerAdmin.php';
include_once '../views/components/head.php';
include_once '../models/Product.php';
include_once '../models/Form.php';

?>

<!DOCTYPE html>
<html>

	<body>
<!-- /********************** CREATE A NEW PRODUCT **********************/ -->  	
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="createForm">
			<h1>Ajouter un produit</h1>
			<?php 
			if (isset($_SESSION['message'])) {
				echo $_SESSION['message'];
				$_SESSION['message'] = "";
			}
			?>
		
			<label for="title">Titre :</label>
			<input type="text" name="title" id="title"><br>
			
			<label for="content">Content :</label>
			<input type="text" name="content" id="content"><br>

			<label for="category">Categorie :</label>
			<select id="category" name="category">
				<?php
					$categories = Article::get_categories();
					foreach ($categories as $category) 
					{	?>
						<option value="<?php echo $category['name'] ?>"><?php echo $category['name'] ?></option>;
					<?php
					}	
					?>
			</select>
			
			<input type="submit" value="Valider">
		</form>