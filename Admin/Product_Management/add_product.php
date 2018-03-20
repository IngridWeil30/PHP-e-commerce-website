<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Product/create_product.php";
session_start();
$errors = array();
$db = connect_db();

if (isset($_POST['Create'])) {

	foreach($_POST as $key=>$value){
		if($value==NULL && $key !="Create"){
				array_push($errors, $key." is required");
		}
	}

	if (count($errors) == 0) {
		create_product($db,$_POST['Name'], $_POST['Price'], $_POST['Category_id']);
		header('Location: product_management.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product creation</title>
</head>
<body>
	<?php
		include "../../PHP_Generated/Generate_form.php";
		$form = new form($errors, "Create Product", "add_product.php",0,"Create",
		array(
			"Name", "text",
			"Price", "number",
			"Category_id", "number"
		),
		array()
		);
	?>
	<p>
		<a href="product_management.php">Back</a>
	</p>
</body>
</html>
