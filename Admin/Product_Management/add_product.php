<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Product/create_product.php";
session_start();

$errors = array();
$_SESSION['success'] = "";
$db = connect_db("127.0.0.1", "root", "takenoko", NULL, "pool_php_rush");

if (isset($_POST['reg_prod'])) {
	$name = $_POST['name'];
	$price = $_POST['price'];
	$category_id = $_POST['category_id'];

	if (empty($name)) { array_push($errors, "Name is required"); }
	if (empty($price)) { array_push($errors, "Price is required"); }
	if (count($errors) == 0) {
		create_product($db, $name, $price, $category_id);
		header('Location: product_management.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product creation</title>
	<link rel="stylesheet" type="text/css" href="../../Style/form.css">
</head>
<body>
	<div class="header">
		<h2>Add product</h2>
	</div>

	<form method="post" action="add_product.php">

		<?php include('../../PHP_FUNCTIONS/errors.php'); ?>
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name">
		</div>
		<div class="input-group">
			<label>Price</label>
			<input type="number" name="price">
		</div>
		<div class="input-group">
			<label>Category id</label>
			<input type="number" name="category_id">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_prod">Add
			</button>
		</div>
		<a href="product_management.php">Back</a>
	</form>
</body>
</html>
