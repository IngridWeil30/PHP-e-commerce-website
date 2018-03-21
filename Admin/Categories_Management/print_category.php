<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Categories/edit_category.php";

$selection_id = $_GET['id'];
$db = connect_db();
$errors = array();


if (isset($_POST['Save'])) {
  foreach($_POST as $key=>$value){
		if($value==NULL && $key !="Save"){
				array_push($errors, $key." is required");
		}
	}
  if (count($errors) == 0) {
    edit_category($db,"$selection_id",$_POST['Name'],$_POST['Parent']);
  }
}

$data = [
  'id' => $selection_id,
];

$stmt = $db->prepare("SELECT * FROM categories WHERE id = :id");
$stmt->execute($data);
$category = $stmt->fetch(PDO::FETCH_OBJ);
?>



<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
</head>
<body>
	<?php
		include "../../PHP_Generated/Generate_form.php";
		$form = new form($errors, "Modify $category->name", "print_category.php?id=$category->id",0,"Save Changes",
		array(
			"Name", "text",
			"Parent Id", "text",
		),
		array(
      $category->name,
			$category->parent_id,
    )
		);
    echo '<a href="../../BDD_Management/Categories/delete_category.php?id='.$category->id.'">Delete Category</a>';
	?>
	<p>
		<a href="categories_Management.php">Back</a>
	</p>
</body>
</html>
