<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/create_user.php";

session_start();
$errors = array();
$db = connect_db();

if (isset($_POST['Login'])) {
  foreach($_POST as $key=>$value){
    if($value==NULL && $key !="Login"){
        array_push($errors, $key." is required");
    }
  }

	if (count($errors) == 0) {
    $username = $_POST['Admin'];
		$password = $_POST['Password'];

		if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on'){
      $hour = time() + 3600 * 24 * 30;
      setcookie('username', $username, $hour);
      setcookie('password', $password, $hour);
    }

		$data = [
		'username' => $username,
		'password' => md5($password),
		];


		$stmt= $db->prepare(
			"SELECT * FROM users
			WHERE name= :username
			AND password= :password"
		);

		$stmt->execute($data);

		if($stmt->rowCount() > 0){
    	$userdatas = $stmt->fetch(\PDO::FETCH_ASSOC);
			$_SESSION['username'] = $userdatas["name"];
			$_SESSION['email'] = $userdatas["email"];
			$_SESSION['is_admin'] = $userdatas["is_admin"];

			if ($_SESSION['is_admin']==1){
				header('location: ../admin.php');
			}
		}
		else {
			array_push($errors, "Wrong username/password combination");
		}
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
		$form = new form($errors,"Admin Login", "admin_login.php",0,"Login",
		array(
			"Admin Login", "text",
			"Password", "password"),
  	array(
        $user->name,
  			$user->email,
      )
  	);
	?>
	<p>
		<a href="../../User/Login_Register/login.php">User Login</a>
	</p>
</body>
</html>
