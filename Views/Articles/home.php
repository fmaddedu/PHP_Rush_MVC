<?php
/***************** MAIN PAGE OF THE SITE *****************/ 
/********  ONLY ACCESSIBLE WHEN USER IS CONNECTED ********/

include_once 'config/dbPdo.php';
include_once 'config/sessionStart.php';
include_once 'models/Product.php';

if ($_SESSION['admin'])
	include_once 'views/components/headerAdmin.php';
else
	include_once 'views/components/headerUser.php';		
?>
		
<!DOCTYPE html>
<html>
	
	<head>
		<title>Welcome</title>
		<meta charset="utf-8">
	</head>
	
	<body>

		<section class="articlesList">
		<?php $articles = Product::get_articles() ?>
		
			<ul class="mainList collection col s12 m10">';
			<?php 
				foreach ($articles as $product) { 
					$category_name = Product::category_name($product['category_id']);?>
					<li>
						<ul>
							<li><a href='pageProduct.php?id=<?php echo $product['id'] ?>'><?php echo $product['name'] ?></a></li>
							<li><?php echo $product['price'] ?><span>€</span></li>
							<li><?php echo $category_name ?></li>
							<li><?php echo $product['description'] ?></li>
							<li><a href='cart.php?id=<?php echo $product['id'] ?>'>Ajouter au panier</a></li>
							<li><a href='adminProducts.php?id=<?php echo $product['id'] ?>'>Partager à un ami</a></li>
					 	</ul>
					</li>
				<?php 
				}
				?>			
		</section>		

	</body>
</html>
			