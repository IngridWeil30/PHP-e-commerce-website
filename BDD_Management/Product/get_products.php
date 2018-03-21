<?php
function get_products($db){
  $stmt = $db->prepare("SELECT * FROM products");
  $stmt->execute();
  $element = $stmt->fetchAll(PDO::FETCH_OBJ);
  $i = 0;
<<<<<<< HEAD
  foreach ($element as $product) {
    $productstable[$i]=$product;
    $i++;
=======
  if ($element){
    foreach ($element as $product) {
      $productstable[$i]=$product;
      $i++;
    }
>>>>>>> 432febe0428dacd4749547fc04c99aa969c9f996
  }
  return($productstable);
}
?>
