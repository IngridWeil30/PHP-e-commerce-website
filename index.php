<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: register.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		setcookie('username',$username, time()-3600);
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">

		<?php if (isset($_SESSION['success'])) : ?>
			<div class="message success" >
				<h3>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<div class="Menu">
			<p> <a href="settings.php" style="color: blue;">Settings</a> </p>
		</div>

		<?php  if (isset($_SESSION['username'])) : ?>
			<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
		<?php endif ?>
	</div>

</body>
</html>
