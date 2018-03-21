<?php
function edit_product($db,$id,$name,$price,$category,$image){
  $data = [
    'name' => $name,
    'price' => $price,
    'category' => $category,
    'image' => $image,
    'id' => $id,
  ];

  $stmt = $db->prepare(
    "UPDATE products
    SET name = :name, price = :price, category_id = :category, image = :image
    WHERE id = :id"
  );
  $stmt->execute($data);
}
?>
