<?php
include "../connect_db.php";
$db = connect_db();

if(isset($_GET["id"])) {
  $data = [
    'id' => $_GET['id']
  ];

  $stmt = $db->prepare(
  "DELETE FROM products
  WHERE id = :id"
  );

  $stmt->execute($data);
<<<<<<< HEAD
  $_SESSION['msg'] = "You must log in first";
  header('location: ../../Admin/Product_Management/product_management.php');
=======
  header('Location: ../../Admin/Product_Management/product_management.php');
>>>>>>> 82fb2c3a96de765cbed9b964534bb40f5f66969c
}
?>
