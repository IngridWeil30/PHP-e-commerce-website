<?php
include "connect_db.php";
$db = connect_db();

if(isset($_GET["id"])) {
 $data = [
  'id' => $_GET['id']
 ];

 $stmt = $db->prepare(
 "DELETE FROM users
 WHERE id = :id"
 );

 $stmt->execute($data);
 header('location: ../Admin/User_Management/User_Management.php');
}
?>
