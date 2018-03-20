<?php
include "../../BDD_Management/connect_db.php";
include "../../BDD_Management/modify_user.php";
include "../../PHP_FUNCTIONS/errors.php";

$selection_id = $_GET['id'];

$db = connect_db("127.0.0.1", "root", "RvMiRPZsk3", NULL, "pool_php_rush");
$errors = array();

if (isset($_POST['Save'])) {
  foreach($_POST as $key=>$value){
		if($value==NULL && $key !="Save"){
				array_push($errors, $key." is required");
		}
	}
  if (count($errors) == 0) {
    modify_user($db,"$selection_id",$_POST['Username'],$_POST['Email']);
  }
}

$data = [
  'id' => $selection_id,
];

$stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute($data);
$user = $stmt->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
</head>
<body>
	<?php
		include "../../PHP_Generated/Generate_form.php";
		$form = new form($errors, "Modify $user->name", "print_user.php?id=$user->id",0,"Save Changes",
		array(
			"Username", "text",
			"Email", "email",
		),
		array(
      $user->name,
			$user->email,
    )
		);
    echo '<a href="../../BDD_Management/delete_user.php?id='.$user->id.'">Delete User</a>';
	?>
	<p>
		<a href="User_Management.php">Back</a>
	</p>
</body>
</html>
