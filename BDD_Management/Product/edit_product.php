<?php
function edit_product($db,$oldid,$name,$price,$category){
  $data = [
    'name' => $name,
    'price' => $price,
    'category' => $category,
    'oldid' => $oldid,
  ];

  $stmt = $db->prepare(
    "UPDATE products
    SET name = :name, price = :price, category_id = :category
    WHERE id = :oldid"
  );
  $stmt->execute($data);
}
?>
