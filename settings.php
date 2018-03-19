<?php
include "BDD_Management/connect_db.php";
include "BDD_Management/modify_user.php";
include "BDD_Management/get_users.php";
session_start();
$errors = array();
$db = connect_db("127.0.0.1", "root", "RvMiRPZsk3", NULL, "day10db");

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

$defaults = array(
      'username' => $_SESSION['username'],
      'email' => $_SESSION['email'],
   );

if (isset($_POST['changes'])) {

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
    if(md5($password_1)==$_SESSION['password']){
      modify_user($db,$_SESSION['username'],$username,$email);
     	$_SESSION['username'] = $username;
      $_SESSION['success'] = "Changes Saved !";
    }
    else{
      array_push($errors, "Wrong password");
    }
  }
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Modify Account</title>
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
				<input type="text" name="username" value="<?php echo $defaults['username']; ?>">
			</div>
			<div class="input-group">
				<label>Email</label>
				<input type="email" name="email" value="<?php echo $defaults['email'] ?>">
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
</html>
