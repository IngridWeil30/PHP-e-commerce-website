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
    $username = $_POST['Username/Email'];
		$password = $_POST['Password'];
		if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on'){
      $hour = time() + 3600 * 24 * 30;
      setcookie('username', $username, $hour);
      setcookie('password', $password, $hour);
    }

		$data = [
		'username' => $username,
		'email' => $username,
		'password' => md5($password),
		];

		$stmt= $db->prepare(
			"SELECT * FROM users
			WHERE name= :username or email= :email
			AND password= :password"
		);
		$stmt->execute($data);

		if($stmt->rowCount() > 0){
    	$userdatas = $stmt->fetch(\PDO::FETCH_ASSOC);
			$_SESSION['username'] = $userdatas["name"];
			$_SESSION['email'] = $userdatas["email"];
			$_SESSION['is_admin'] = $userdatas["is_admin"];

			if ($_SESSION['is_admin']==1){
				header('location: ../../Admin/Login/admin_login.php');
			}
			else{
				$_SESSION['success'] = "Welcome $username";
				header('location: ../../index.php');
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
	<title>Registration system PHP and MySQL</title>
</head>
<body>
	<?php
    include "../../PHP_Generated/Generate_form.php";
		$form = new form($errors,"Login", "login.php",1,"Login",
		array(
			"Username/Email", "text",
			"Password", "password"),
  	array(
      $user->name,
  		$user->email,
    )
  );
    $errors = NULL;
	?>
	<p>
		Not yet a member? <a href="register.php">Sign up</a>
	</p>
</body>
</html>
