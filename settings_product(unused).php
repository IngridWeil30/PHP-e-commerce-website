<!-- <?php
include "BDD_Management/connect_db.php";
include "BDD_Management/edit_product.php";
include "BDD_Management/get_products.php";
session_start();
$errors = array();
$db = connect_db("127.0.0.1", "root", "takenoko", NULL, "pool_php_rush");

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

$defaults = array(
      'name' => $_SESSION['name'],
      'price' => $_SESSION['price'],
			'category_id' => $_SESSION['category_id'],
   );

if (isset($_POST['changes'])) {

  $name = $_POST['name'];
  $price = $_POST['price'];
  $category_id = $_POST['category_id'];

  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($price)) { array_push($errors, "Price is required"); }
  if (empty($category_id)) { array_push($errors, "Category_id is required"); }
  }

  if (count($errors) == 0) {
      edit_product($db,$_SESSION['name'],$name,$price, $category_id);
     	$_SESSION['name'] = $name;
      $_SESSION['success'] = "Changes Saved !";
    }
    else{
      array_push($errors, "Wrong informations");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modify Product</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php if($_SESSION['is_admin']==0){ ?>
		<div class="header">
			<h2>Modify Account</h2>
		</div>
		<form method="post" action="index.php">
			</div>
		 <?php include('errors.php'); ?>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username" value="<?php echo $defaults['name']; ?>">
			</div>
			<div class="input-group">
				<label>Email</label>
				<input type="email" name="email" value="<?php echo $defaults['email'] ?>">
			</div> -->
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password_1">
			</div>
			<div class="input-group">
				<label>Confirm password</label>
				<input type="password" name="password_2">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="changes">Save Changes</button>
			</div>
			<p>
				<a href="index.php">Back</a>
			</p>
		</form>
  <?php } ?>

	<?php if($_SESSION['is_admin']==1){ ?>
		<div class="header">
			<h2>Admin Pannel</h2>
		</div>
		<form method="post" action="settings.php">
			<table class="table">
				<?php foreach(get_users($db) as $user){ ?>
					<tr>
					<td>
						<?php
						echo '<a href="BDD_Management/delete_user.php?id=15">'.$user->email.'</a>';
						?>
						<b>
						<?php
							if ($user->is_admin == 1){
									echo "admin";
							}
						?>
						</b>
					</td>
					</tr>
				<?php } ?>
			</table>
			<p>
				<a href="index.php">Back</a>
			</p>
		</form>
	<?php } ?>
</body>
</html> -->
