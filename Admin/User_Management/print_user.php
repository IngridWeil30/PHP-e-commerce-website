<?php
include "../../BDD_Management/connect_db.php";
$db = connect_db("127.0.0.1", "root", "RvMiRPZsk3", NULL, "day10db");
$selection_id = $_GET['id'];

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
	<title>
    <?php
      echo $user->name;
    ?>
  </title>
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>

<body>
<div class="header">
	<h2>
    <?php
      echo $user->name;
    ?>
  </h2>
</div>
<form method="post" action="User_Management.php">
  </div>
  <?php include('../../errors.php'); ?>
  <div class="input-group">
    <label>Username</label>
    <input type="text" name="username" value="<?php echo $user->name; ?>">
  </div>
  <div class="input-group">
    <label>Email</label>
    <input type="email" name="email" value="<?php echo $user->email; ?>">
  </div>
  <?php
      echo '<a href="../../BDD_Management/delete_user.php?id='.$user->id.'">Delete User</a>';
  ?>
  <div class="input-group">
    <button type="submit" class="btn" name="changes">Save Changes</button>
  </div>
  <p>
    <a href="User_Management.php">Back</a>
  </p>
</form>
</body>
</html>
