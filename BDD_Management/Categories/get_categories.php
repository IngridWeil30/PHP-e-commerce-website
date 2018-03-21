<?php
function get_categories($db){
  $stmt = $db->prepare("SELECT * FROM categories");
  $stmt->execute();
  $element = $stmt->fetchAll(PDO::FETCH_OBJ);
  $i = 0;
  if ($element){
    foreach ($element as $category) {
      $categoriestable[$i]=$category;
      $i++;
    }
  }
  return($categoriestable);
}
?>
