<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Product/edit_product.php";
include "../../PHP_FUNCTIONS/errors.php";
include "../../BDD_Management/Categories/get_categories.php";

$db = connect_db();
$errors = array();

if (isset($_POST['Save'])) {
  foreach($_POST as $key=>$value){
		if($value==NULL && $key !="Save"){
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
    edit_product($db,$_GET['id'],$_POST['Name'],$_POST['Price'],$cat->id);
  }
}

$data = [
  'id' => $_GET['id'],
];

$stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute($data);
$prod = $stmt->fetch(PDO::FETCH_OBJ);

$data = [
  'id' => $prod->category_id,
];

$stmt = $db->prepare("SELECT name FROM categories WHERE id = :id");
$stmt->execute($data);
$cat = $stmt->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html>
<head>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Registration system PHP and MySQL</title>
</head>
<body>
	<?php
		include "../../PHP_Generated/Generate_form.php";
		$form = new form($errors, "Edit product : $prod->name", "print_product.php?id=$prod->id",0,"Save Changes",
		array(
			"Name", "text",
			"Price", "number",
      "Category Name (or id)", "name"
		),
		array(
      $prod->name,
			$prod->price,
      $cat->name
    )
		);
    echo '<a href="../../BDD_Management/Product/delete_product.php?id='.$prod->id.'">Delete product</a></br>';
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
