<?php
function edit_category($db,$id,$name,$parent_id){
  $data = [
    'name' => $name,
    'parent_id' => $parent_id,
    'id' => $id,
  ];

  $stmt = $db->prepare(
    "UPDATE categories
    SET name = :name, parent_id = :parent_id
    WHERE id = :id"
  );
  $stmt->execute($data);
}
?>
