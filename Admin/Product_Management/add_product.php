<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Product/create_product.php";
include "../../BDD_Management/Categories/get_categories.php";
session_start();
$errors = array();
$db = connect_db();

if (isset($_POST['Create'])) {

	foreach($_POST as $key=>$value){
		if($value==NULL && $key !="Create"){
				array_push($errors, $key." is required");
		}
	}

	$data = [
		'id' => $_POST['Category'],
	];

	$stmt = $db->prepare("SELECT id FROM categories WHERE id = :id or name = :id");
	$stmt->execute($data);
	$cat = $stmt->fetch(PDO::FETCH_OBJ);
	if($cat==NULL){
			array_push($errors, $_POST['Category']." not exists");
	}

	if (count($errors) == 0) {
		create_product($db,$_POST['Name'], $_POST['Price'], $_POST['Category']);
		header('Location: product_management.php');
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
		$form = new form($errors, "Create Product", "add_product.php",0,"Create",
		array(
			"Name", "text",
			"Price", "number",
			"Category Id", "number"
		),
		array()
		);
		?>
			<b>Categories Available </b>
			<table class="table">
				<tr>
					<th>Id</th>
					<th>Name</th>
				</tr>
					<?php
						if(get_categories($db)){
						foreach(get_categories($db) as $cat){ ?>
							<tr>
								<td>
								<?php
										echo $cat->id;
								?>
								</td>
							<td>
							<?php
									echo $cat->name;
							?>
							</td>
							</tr>
					<?php }
						}
				?>
			</table>



	<p>
		<a href="product_management.php">Back</a>
	</p>
</body>
</html>
