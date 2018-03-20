<?php
include "connect_db.php";
$db = connect_db();
$section_id = $_GET['id'];
if(isset($_GET["id"])) {
 $data = [
  'id' => $_GET['id']
 ];
 $stmt = $db->prepare(
 "DELETE FROM users
 WHERE `id` = :id"
 );
 $stmt->execute($data);
 $_SESSION['msg'] = "You must log in first";
 header('location: ../Admin/User_Management/User_Management.php');
}
?>
