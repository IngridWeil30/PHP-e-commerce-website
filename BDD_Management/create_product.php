<?php
include "connect_db.php";
$db = connect_db("127.0.0.1", "root", "takenoko", NULL, "pool_php_rush");
  function create_product($name, $price, $category) {
    $data = [
      'name' => "$name",
      'price' => "$price",
      'category' => "$category",
    ];

    $stmt= $db->prepare(
      "INSERT INTO products (id, name, price, category)
      VALUES (:id, :name, :price, :category)"
    );

    $stmt->execute($data);
  }
?>

create_product("Banane Bleue", 50, "A");
