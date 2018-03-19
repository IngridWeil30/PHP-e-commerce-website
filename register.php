<?php
include "BDD_Management/connect_db.php";
include "BDD_Management/create_user.php";
session_start();

$errors = array();
$_SESSION['success'] = "";
$db = connect_db("127.0.0.1", "root", "RvMiRPZsk3", NULL, "pool_php_rush");

if (isset($_POST['reg_user'])) {

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password_1 = $_POST['password_1'];
	$password_2 = $_POST['password_2'];

	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	if (count($errors) == 0) {
		$password = md5($password_1);
		create_user($db,$username,$email,$password);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('Location: login.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>

	<form method="post" action="register.php">

		<?php include('errors.php'); ?>
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
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		<p>
			Do U have an account?<a href="login.php">Log In</a>
		</p>
	</form>
</body>
</html>
