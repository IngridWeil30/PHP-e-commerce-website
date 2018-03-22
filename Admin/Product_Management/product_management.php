<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Product/edit_product.php";
include "../../BDD_Management/Product/get_products.php";
include "../../PHP_FUNCTIONS/errors.php";


$errors = array();
$db = connect_db();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit product</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../Style/form.css">
	<link rel="stylesheet" type="text/css" href="../../Style/index.css">
</head>

<body>
<div class="header-large">
	<h2>Product Management</h2>
</div>
<form class="form-large" method="post">
	<table class="table">
		<tr>
			<th>Id</th>
			<th>Category</th>
			<th>Product Name</th>
			<th>Price</th>
			<th>Image Link</th>
		</tr>
		<?php
		if(get_products($db)){
		foreach(get_products($db) as $prod){ ?>
			<td style="width:6px">
				<?php
					echo $prod->id;
				?>
			</td>
			<td>
				<?php
				$data = [
				  'id' => $prod->category_id,
				];
				$stmt = $db->prepare("SELECT name FROM categories WHERE id = :id");
				$stmt->execute($data);
				$cat = $stmt->fetch(PDO::FETCH_OBJ);
				echo $cat->name;
				?>
			</td>
			<td>
				<?php
					echo $prod->name;
				?>
			</td>
			<td>
				<?php
					echo $prod->price;
				?>
			</td>
			<td>
				<?php
					echo $prod->image;
				?>
			</td>
			<td>
				<?php
					echo '<a href="print_product.php?id='.$prod->id.'"><span style="text-align : center"class="glyphicon glyphicon-pencil"></span>'
				?>
			</td>
			<td>
				<?php
					echo '<a href="../../BDD_Management/Product/delete_product.php?id='.$prod->id.'"><span style="text-align : center"class="glyphicon glyphicon-trash"></span>'
				?>
			</td>
			</tr>
		<?php }
			}
 ?>
	</table>
	<a href="add_product.php">Add Product</a>
	<p>
		<a href="../admin.php">Back</a>
	</p>
</form>

</body>
</html>
