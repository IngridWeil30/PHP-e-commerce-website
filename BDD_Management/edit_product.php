<?php
function edit_product($db,$oldproduct,$product){
  $data = [
    'name' => $name,
    'price' => $price,
    'category' => $category,
  ];

  $stmt = $db->prepare(
    "UPDATE products
    SET name = :name, price = :price, category = :category;
    WHERE name = :oldproduct"
  );
  $stmt->execute($data);
}
?>
