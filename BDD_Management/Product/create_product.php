<?php
function create_product($db, $name, $price, $category, $image) {
    $data = [
      'name' => $name,
      'price' => $price,
      'category_id' => $category,
      'image' => $image,
    ];
    $stmt= $db->prepare("INSERT INTO products (name, price, category_id, image) VALUES (:name, :price, :category_id, :image)");
    $stmt->execute($data);
  }
?>
