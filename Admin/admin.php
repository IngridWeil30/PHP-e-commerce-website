<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header('location: admin_login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		setcookie('username',$username, time()-3600);
		unset($_SESSION['username']);
		header('location: admin_login.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<div class="header">
		<h2>Admin Pannel</h2>
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
			<p> <a href="settings.php" style="color: blue;">User Pannel</a> </p>
		</div>
		<div class="Menu">
			<p> <a href="settings.php" style="color: blue;">Product Pannel</a> </p>
		</div>

		<?php  if (isset($_SESSION['username'])) : ?>
			<p> <a href="admin.php?logout='1'" style="color: red;">Logout</a> </p>
		<?php endif ?>
	</div>

</body>
</html>
