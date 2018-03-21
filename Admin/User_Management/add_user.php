<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/create_user.php";

session_start();
$errors = array();
$_SESSION['success'] = "";
$db = connect_db();

if (isset($_POST['Add'])) {
	foreach($_POST as $key=>$value){
		if($value==NULL && $key !="Add"){
				array_push($errors, $key." is required");
		}
	}
	if ($_POST['Confirm'] != $_POST['Password']){
		array_push($errors, "The two passwords do not match");
	}

	if (count($errors) == 0) {
		$password = md5($_POST['Password']);
		create_user($db,$_POST['Username'],$_POST['Email'],$password);
		header('Location: User_Management.php');
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
		include "../../PHP_Generated/Generate_form.php";
		$form = new form($errors, "Add User", "add_user.php",0,"Add",
		array(
			"Username", "text",
			"Email", "email",
			"Password", "password",
			"Confirm", "password"
		),
		NULL
		);
	?>
	<p>
		<a href="User_Management.php">Back</a>
	</p>
</body>
</html>
