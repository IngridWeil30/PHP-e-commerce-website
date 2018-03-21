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
	<link rel="stylesheet" type="text/css" href="../../Style/form.css">
</head>

<body>
<div class="header">
	<h2>Categories Management</h2>
</div>
<form method="post">
	<table class="table">
		<?php
		if(get_categories($db)){
		foreach(get_categories($db) as $cat){ ?>
			<tr>
			<td>
			<?php
					echo '<a href="print_category.php?id='.$cat->id.'">'.$cat->name.'</a>';
			?>
			</td>
			</tr>
		<?php }
			}
		else{
				echo "No Categories";
			} ?>
	</table>
	<a href="add_category.php">Add Category</a>
	<p>
		<a href="../admin.php">Back</a>
	</p>
</form>

</body>
</html>
