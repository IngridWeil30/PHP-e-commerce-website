<?php
include "BDD_Management/connect_db.php";
include "BDD_Management/create_user.php";
session_start();
$errors = array();
$db = connect_db("127.0.0.1", "root", "RvMiRPZsk3", NULL, "pool_php_rush");

if (isset($_POST['login_user'])) {
	$username = $_POST['Username'];
	$email = $_POST['Email'];
	$password_1 = $_POST['Password'];
	$password_2 = $_POST['Confirm'];

	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}
	if (count($errors) == 0) {
		$password = md5($password_1);
		create_user($db,$username,$email,$password);
		header('Location: index.php');
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
</head>
<body>
	<?php
		include "PHP_Generated/Generate_form.php";
		$form = new form("Register", "register.php",0,"Register",
		array(
			"Username", "text",
			"Email", "email",
			"Password", "password",
			"Confirm", "password")
		);
	?>
	<p>
		Already have account? <a href="login.php">Log in</a>
	</p>
</body>
</html>
