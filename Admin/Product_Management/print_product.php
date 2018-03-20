<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Product/edit_product.php";

$selection_id = $_GET['id'];
$db = connect_db();
$errors = array();

if (isset($_POST['changes'])) {

  $prod_id = $_POST['prod_id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $category = $_POST['category_id'];

  if (empty($prod_id)) { array_push($errors, "Product id is required"); }
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($price)) { array_push($errors, "Price is required"); }
  if (empty($category)) { array_push($errors, "Category id is required"); }
  if (count($errors) == 0) {
    edit_product($db,$selection_id,$name,$price,$category);
    $_SESSION['success'] = "Changes Saved !";
  }
}

$data = [
  'id' => $selection_id,
];

$stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute($data);
$prod = $stmt->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
<head>
	<title>
    <?php
      echo $prod->name;
    ?>
  </title>
	<link rel="stylesheet" type="text/css" href="../../Style/form.css">
</head>

<body>
  <div class="header">
  	<h2>
      <?php
        echo $prod->name;
      ?>
    </h2>
  </div>
  <?php
      echo '<form method="post" action="print_product.php?id='.$prod->id.'">';
  ?>
    <?php include('../../PHP_FUNCTIONS/errors.php'); ?>
    <div class="input-group">
      <label>Product id</label>
      <input type="text" name="prod_id" value="<?php echo $prod->id; ?>">
    </div>
    <div class="input-group">
      <label>Name</label>
      <input type="text" name="name" value="<?php echo $prod->name; ?>">
    </div>
    <div class="input-group">
      <label>Price</label>
      <input type="number" name="price" value="<?php echo $prod->price; ?>">
    </div>
    <div class="input-group">
      <label>Category id</label>
      <input type="number" name="category_id" value="<?php echo $prod->category_id; ?>">
    </div>
    <?php
    echo '<a href="../../BDD_Management/Product/delete_product.php?id='.$prod->id.'">Delete Product</a>';
    ?>
    <div class="input-group">
      <button type="submit" class="btn" name="changes">Save Changes</button>
    </div>
    <p>
      <a href="product_management.php">Back</a>
    </p>
  </form>
</body>
</html>
