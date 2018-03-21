<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Product/edit_product.php";
include "../../PHP_FUNCTIONS/errors.php";

$db = connect_db();
$errors = array();

if (isset($_POST['Save'])) {
  foreach($_POST as $key=>$value){
		if($value==NULL && $key !="Save"){
				array_push($errors, $key." is required");
		}
	}
  if (count($errors) == 0) {
    edit_product($db,$_GET['id'],$_POST['name'],$_POST['price'],$_POST['Category']);
  }
}

$data = [
  'id' => $_GET['id'],
];

$stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute($data);
$prod = $stmt->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
</head>
<body>
	<?php
		include "../../PHP_Generated/Generate_form.php";
		$form = new form($errors, "Edit product : $prod->name", "print_product.php?id=$prod->id",0,"Save Changes",
		array(
			"Name", "text",
			"Price", "number",
      "Category", "name"
		),
		array(
      $prod->name,
			$prod->price,
      $prod->category_id
    )
		);
    echo '<a href="../../BDD_Management/Product/delete_product.php?id='.$prod->id.'">Delete product</a>';
	?>
	<p>
		<a href="product_management.php">Back</a>
	</p>
</body>
</html>
