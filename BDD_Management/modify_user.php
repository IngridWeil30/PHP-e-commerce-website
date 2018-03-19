<?php
function modify_user($db,$oldusername,$username,$email){
  $data = [
    'username' => $username,
    'email' => $email,
    'oldusername' => $oldusername,
  ];

  $stmt = $db->prepare(
    "UPDATE users
    SET name = :username, email = :email
    WHERE name = :oldusername"
  );
  $stmt->execute($data);
}
?>
