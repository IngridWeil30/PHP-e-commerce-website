<?php
include "BDD_Management/connect_db.php";
session_start();

$errors = array();
$db = connect_db("127.0.0.1", "root", "takenoko", NULL, "pool_php_rush");

if (isset($_POST['login_user'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$rememberme = $_POST['remember_me'];

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	if (count($errors) == 0) {

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
			$_SESSION['password'] = $userdatas["password"];
			$_SESSION['is_admin'] = $userdatas["is_admin"];
			if ($_SESSION['is_admin']==1){
				header('location: Admin/admin_login.php');
			}
			else{
				$_SESSION['success'] = "Welcome $username";
				header('location: index.php');
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
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Login</h2>
	</div>

	<form method="post" action="login.php">

		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Username/email</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<p class="remember_me">
      <label>

        <input type="checkbox" name="remember_me" id="remember_me">
        Remember me
      </label>
    </p>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>


</body>
</html>
