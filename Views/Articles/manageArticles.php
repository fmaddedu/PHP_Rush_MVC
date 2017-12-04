<?php 
include_once '../components/sessionStart.php'; 
include_once '../components/main.php';
include_once '../products/FormProduct.php';
include_once '../products/FormCategory.php';
include_once '../products/Product.php';
include_once '../products/Category.php';
?>

<!DOCTYPE html>
<html>

	<?php include_once 'components/head.php'; ?>
	
	<body class="manageAdmin">

		<?php 
		include_once 'components/headerAdmin.php'; 

		if (isset($_SESSION['message']))
		{
			echo $_SESSION['message'];
			$_SESSION['message'] = "";
		}
		?>

		
		<?php 
			if (isset($_SESSION['message']))
			{
				echo $_SESSION['message'];
				$_SESSION['message'] = "";
			}
		?>

		<section class="manageUsers">

			<div class="row">
				<div class="col s12 m6 l4">
				  <div class="card white">
				    <div class="card-content black-text">
						<form action='../products/createProduct.php' method="post">

							<h1 class="title">Create a new product</h1>
							
							<label for="name">Name :</label>
							<input type="text" id="name" name="name" /><br>

							<label for="price">Price in $ :</label>
							<input type="text" id="price" name="price" /><br>

							<label for="category">Category :</label>
							<select id="category" name="category" class="btn-block">
								<?php
									$array_cat = FormCategory::arrayCategories();
									foreach ($array_cat as $value) 
									{
										echo '<option value="' . $value["name"] . '"> ' . $value['name'] . '</option>';
									}
								?>
							</select>
							
							<label for="desc">Description :</label>
							<textarea cols="70" rows="5" id="desc" name="desc" ></textarea><br>

							<input type="submit" name="Submit" class="waves-effect waves-light btn"/><br>
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
							<form method="GET" action="../products/editForm.php" id="editForm">
								<h1>Edit product</h1>
								
								<label for="name">Name :</label>
								<input type="text" name="name" value="'.$_GET['name'].'" id="name"><br>
								
								<label for="price">Price in $ :</label>
								<input type="text" name="price" value="'.$_GET['price'].'" id="price"><br>
								
								<label for="category">Category :</label>
								<select id="category" name="category" class="btn-block">
									<?php
										$array_cat = FormCategory::arrayCategories();';
										foreach ($array_cat as $value) 
										{
											echo '<option value="' . $value['name']. '"> ' . $value['name'] . '</option>';
										}
										echo '
											
								</select>
								
								<label for="desc">Description :</label>
								<textarea cols="70" rows="5" id="desc" name="desc">'.$_GET['description'].'</textarea><br>';

				
								$_SESSION['id'] = $_GET['id'];
					
								echo '
								<input type="submit" value="Submit" class="waves-effect waves-light btn">
							</form>
			              	
			            </div>
			          </div>
			        </div>
			        ' ;
			    }?>
			</div>


			
			<section class="productsList row">
				<?php
					
					if (isset($_GET["del_product"]))
					{
						Product::delete();
						//User::reorderId();
					}
					$products = Product::getList();
					echo '<ul class="mainList collection col s12">';
					foreach ($products as $value) 
					{
						$id = $value->getId();
						$href='manageProducts.php?del_product='.$id;
						echo '
						<li>
							<ul class="itemsList collection-item avatar">
								<li class="title">'.$value->getId().'</li>
								<li class="name"><a href="">'.$value->getName().'</a></li>
								<li class="email">'.$value->getPrice().'</li>
								<li>'.$value->getCategory().'</li>
								<li class="flex">'.$value->getDesc().'</li>
								<div>

									<li><a class="btn btn-floating btn-large" href="manageProducts.php?name='.$value->getName().'&price='.$value->getPrice().'&description='.$value->getDesc().'&id='.$value->getId().'&categoryName='.$value->getCategory().'&edit=1"><i class="material-icons">create</i></a></li>
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

	</body>
</html>