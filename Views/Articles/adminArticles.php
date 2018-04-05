<?php

include_once '../config/dbPdo.php';
include_once '../config/sessionStart.php';
include_once '../views/components/headerAdmin.php';
include_once '../views/components/head.php';
include_once '../models/Product.php';
include_once '../models/Form.php';

if (!$_SESSION['admin']) {
	header("Location: ../index.php");
}

if (!empty($_POST) && Form::valid_product_form() =="") {
	Product::create();
	$_SESSION['message'] = "<p class='success'>Produit créé avec succès</p><br>";
}
elseif (!empty($_POST) && Form::valid_product_form() != "") {
	$message_error = Form::valid_product_form();
	$_SESSION['message'] = "<p class='error'>$message_error</p>";
}
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
		
			<label for="name">Nom du produit :</label>
			<input type="text" name="name" id="name"><br>
			
			<label for="price">Prix :</label>
			<input type="text" id="price" name="price"><span>€</span><br>

			<label for="category">Categorie :</label>
			<select id="category" name="category">
				<?php
					$categories = Product::get_categories();
					foreach ($categories as $category) 
					{	?>
						<option value="<?php echo $category['name'] ?>"><?php echo $category['name'] ?></option>;
					<?php
					}	
					?>
			</select>
			
			<label for="desc">Description :</label>
			<textarea cols="70" rows="5" id="desc" name="desc" ></textarea><br>

			<input type="submit" value="Valider">
		</form>

<!-- /********************** DISPLAY ALL PRODUCTS **********************/ -->  	
		<section class="productsList row">
		<?php 
			if (!empty($_GET)) {
				Product::delete_from($_GET['id']);
			}				
			$_POST = array();
			$_SESSION['message'] = '';
			$products = Product::get_products(); 
			foreach ($products as $product) {
				$category_name = Product::category_name($product['category_id']);
		?>
				<div>
				<li>
					<ul>
						<li><?php echo $product['id'] ?></li>
						<li><a href='pageProduct.php?id=<?php echo $product['id'] ?>'><?php echo $product['name'] ?></a></li>
						<li><?php echo $product['price'] ?><span>€</span></li>
						<li><?php echo $category_name ?></li>
						<li><?php echo $product['description'] ?></li>
						<li><a href='editProduct.php?id=<?php echo $product['id'] ?>'>Editer</a></li>
						<li><a href='adminProducts.php?id=<?php echo $product['id'] ?>'>Supprimer</a></li>
				 	</ul>
				</li>
				</div>
			<?php 
			}
			?>
		</section>				

	</body>
</html>