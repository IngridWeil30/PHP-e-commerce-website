<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/modify_user.php";
include "../../BDD_Management/get_users.php";
include "../../errors.php";

$errors = array();
$db = connect_db("127.0.0.1", "root", "RvMiRPZsk3", NULL, "pool_php_rush");

// if ($_SESSION['is_admin']==0) {
// 	$_SESSION['msg'] = "You must log in first";
// 	header('location: login.php');
// }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Modify Account</title>
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>

<body>
<div class="header">
	<h2>User Management</h2>
</div>
<form method="post" action="settings.php">
	<table class="table">
		<?php foreach(get_users($db) as $user){ ?>
			<tr>
			<td>
			<?php
					echo '<a href="print_user.php?id='.$user->id.'">'.$user->email.'</a>';
			?>
			</td>
			</tr>
		<?php } ?>
	</table>
	<a href="add_user.php">Add User</a>
	<p>
		<a href="../admin.php">Back</a>
	</p>
</form>

</body>
</html>
