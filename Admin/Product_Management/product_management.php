<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Product/edit_product.php";
include "../../BDD_Management/Product/get_products.php";
include "../../PHP_FUNCTIONS/errors.php";

$errors = array();
$db = connect_db();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit product</title>
	<link rel="stylesheet" type="text/css" href="../../Style/index.css">
</head>

<body>
<div class="header">
	<h2>Product Management</h2>
</div>
<form method="post">
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
	<a href="add_product.php">Add Product</a>
	<p>
		<a href="../admin.php">Back</a>
	</p>
</form>

</body>
</html>
