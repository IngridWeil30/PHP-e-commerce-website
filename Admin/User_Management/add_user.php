<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/create_user.php";
session_start();

$errors = array();
$_SESSION['success'] = "";
$db = connect_db("127.0.0.1", "root", "RvMiRPZsk3", NULL, "pool_php_rush");

if (isset($_POST['reg_user'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = "pass";

	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (count($errors) == 0) {
		$password = md5($password_1);
		create_user($db,$username,$email,$password);
		$_SESSION['username'] = $username;
		header('Location: User_Management.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
	<div class="header">
		<h2>Add user</h2>
	</div>

	<form method="post" action="add_user.php">

		<?php include('../../errors.php'); ?>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Add
			</button>
		</div>
		<a href="User_Management.php">Back</a>
	</form>
</body>
</html>
