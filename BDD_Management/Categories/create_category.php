<?php
function create_category($db, $name, $parent_id) {
    $data = [
      'name' => $name,
      'parent_id' => $parent_id,
    ];
    $stmt= $db->prepare("INSERT INTO categories (name, parent_id) VALUES (:name, :parent_id)");
    $stmt->execute($data);
  }
?>
