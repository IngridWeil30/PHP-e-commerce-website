<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/Categories/edit_category.php";
include "../../BDD_Management/Categories/get_categories.php";
include "../../PHP_FUNCTIONS/errors.php";

$errors = array();
$db = connect_db();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Categories</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../Style/form.css">
</head>

<body>
<div class="header">
	<h2>Categories Management</h2>
</div>
<form method="post">
	<table class="table">
		<tr>
			<th>Id</th>
			<th>Name</th>
		</tr>
		<?php
		if(get_categories($db)){
		foreach(get_categories($db) as $cat){ ?>
			<td style="width:6px">
				<?php
					echo $cat->id;
				?>
			</td>
			<td>
				<?php
					echo $cat->name;
				?>
			</td>
			<td>
				<?php
					echo '<a href="print_category.php?id='.$cat->id.'"><span style="text-align : center"class="glyphicon glyphicon-pencil"></span>'
				?>
			</td>
			<td>
				<?php
					echo '<a href="../../BDD_Management/Categories/delete_category.php?id='.$cat->id.'"><span style="text-align : center"class="glyphicon glyphicon-trash"></span>'
				?>
			</td>
			</tr>
		<?php }
			}
 ?>
	</table>
	<a href="add_category.php">Add Category</a>
	<p>
		<a href="../admin.php">Back</a>
	</p>
</form>

</body>
</html>
