<?php
function create_category($db, $name, $parent_id) {
    $data = [
      'name' => $name,
    ];
    $stmt= $db->prepare("INSERT INTO categories (name) VALUES (:name)");
    $stmt->execute($data);
  }
?>
