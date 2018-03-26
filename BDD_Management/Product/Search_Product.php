<?php
function search_product($db, $cat, $name, $min_price, $max_price, $order, $way)
{
   if ($cat == null) {
      $data = [
      'name' => $name,
      'min_price' => $min_price,
      'max_price' => $max_price,
      'order' => $order,
      'way' => $way
   ];

   $stmt = $db->prepare(
      "SELECT * FROM products WHERE name like :name
      AND price >=:min_price
      AND price <= :max_price
      ORDER BY :order :way"
   );
   }

   else {
        $data = [
      'cat' => $cat,
      'name' => $name,
      'min_price' => $min_price,
      'max_price' => $max_price,
      'order' => $order,
      'way' => $way
      ];

      $stmt = $db->prepare(
      "SELECT * FROM products WHERE category_id = :cat
      AND name like :name
      AND price >=:min_price
      AND price <= :max_price
      ORDER BY :order :way"
      );
   }



    $stmt->execute($data);

    $element = $stmt->fetchAll(PDO::FETCH_OBJ);

    $i = 0;
    if ($element) {
        foreach ($element as $product) {
            $productstable[$i]=$product;
            $i++;
        }
    }
    return($productstable);
}
