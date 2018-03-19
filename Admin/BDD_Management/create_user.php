<?php
function create_user($db,$name,$email,$password){
  $data = [
    'name' => "$name",
    'email' => "$email",
    'password' => "$password",
    'is_admin' => 0,
  ];

  $stmt= $db->prepare(
    "INSERT INTO users (name, email, password, created_at, is_admin)
    VALUES (:name, :email, :password, NOW(), :is_admin)"
  );

  $stmt->execute($data);
}
?>
