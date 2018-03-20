<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/edit_product.php";
include "../../BDD_Management/get_products.php";
include "../../errors.php";

$errors = array();
$db = connect_db("127.0.0.1", "root", "takenoko", NULL, "pool_php_rush");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit product</title>
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>

<body>
<div class="header">
	<h2>Product Management</h2>
</div>
<form method="post" action="settings.php">
	<table class="table">
		<?php foreach(get_products($db) as $prod){ ?>
			<tr>
			<td>
			<?php
					echo '<a href="print_product.php?id='.$prod->id.'">'.$prod->name.'</a>';
			?>
			</td>
			</tr>
		<?php } ?>
	</table>
	<a href="add_user.php">Add Product</a>
	<p>
		<a href="../admin.php">Back</a>
	</p>
</form>

</body>
</html>
