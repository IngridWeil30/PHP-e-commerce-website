<?php
function create_product($db, $name, $price, $category) {
    $data = [
      'name' => $name,
      'price' => $price,
      'category_id' => $category,
    ];
    $stmt= $db->prepare("INSERT INTO products (name, price, category_id) VALUES (:name, :price, :category_id)");
    $stmt->execute($data);
  }
?>
