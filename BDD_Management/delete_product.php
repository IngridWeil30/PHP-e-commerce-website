<?php
include "connect_db.php";
$db = connect_db("127.0.0.1", "root", "takenoko", NULL, "day10db");

$section_id = $_GET['id'];



echo '<input type="button" name="confirm" id="confirm" value="Confirm Deleting">';


if(isset($_GET["id"])) {
  $data = [
    'id' => $_GET['id']
  ];

  $stmt = $db->prepare(
  "DELETE FROM users
  WHERE `id` = :id"
  );

  $stmt->execute($data);
}
?>
