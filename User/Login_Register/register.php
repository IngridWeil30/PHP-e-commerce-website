<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/create_user.php";

session_start();
$errors = array();
$db = connect_db();

if (isset($_POST['Register'])) {
	foreach($_POST as $key=>$value){
		if($value==NULL && $key !="Register"){
				array_push($errors, $key." is required");
		}
	}
	if ($_POST['Confirm'] != $_POST['Password']){
		array_push($errors, "The two passwords do not match");
	}

	if (count($errors) == 0) {
		$password = md5($_POST['Password']);
		create_user($db,$_POST['Username'],$_POST['Email'],$password);
		header('Location: ../../index.php');
	}
}

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
		$form = new form($errors, "Register", "register.php",0,"Register",
		array(
			"Username", "text",
			"Email", "email",
			"Password", "password",
			"Confirm", "password"),
  	array()
  	);
	?>
	<p>
		Already have account? <a href="login.php">Log in</a>
	</p>
</body>
</html>
