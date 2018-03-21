<?php
include "../connect_db.php";
$db = connect_db();

if(isset($_GET["id"])) {
  $data = [
    'id' => $_GET['id']
  ];

  $stmt = $db->prepare(
  "DELETE FROM categories
  WHERE id = :id"
  );

  $stmt->execute($data);
  $_SESSION['msg'] = "You must log in first";
  header('location: ../../Admin/Categories_Management/categories_management.php');
}
?>
