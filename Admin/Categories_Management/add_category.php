<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Categories/create_category.php";
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
		create_category($db, $_POST['Name'], $_POST['Parent_id']);
		header('Location: categories_management.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Product creation</title>
</head>
<body>
	<?php
		include "../../PHP_Generated/Generate_form.php";
		$form = new form($errors, "Create Category", "add_category.php",0,"Create",
		array(
			"Name", "text",
			"Parent Id", "number",
		),
		array()
		);
	?>
	<p>
		<a href="categories_management.php">Back</a>
	</p>
</body>
</html>
