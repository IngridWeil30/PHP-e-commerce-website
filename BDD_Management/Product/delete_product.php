<?php
include "../connect_db.php";
$db = connect_db();

if(isset($_GET["id"])) {
  $data = [
    'id' => $_GET['id']
  ];

  $stmt = $db->prepare(
  "DELETE FROM products
  WHERE 'id' = :id"
  );

  $stmt->execute($data);
  //header('Location: ../../Admin/Product_Management/product_management.php');
}
?>
