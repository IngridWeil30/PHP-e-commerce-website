<?php
function get_products($db){
  $stmt = $db->prepare("SELECT * FROM products");
  $stmt->execute();
  $element = $stmt->fetchAll(PDO::FETCH_OBJ);
  $i = 0;
  foreach ($element as $product) {
    $productstable[$i]=$product;
    $i++;
  }
  return($productstable);
}
?>
