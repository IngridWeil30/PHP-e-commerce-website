<?php
function modify_user($db,$oldid,$username,$email){
  $data = [
    'username' => $username,
    'email' => $email,
    'oldid' => $oldid,
  ];

  $stmt = $db->prepare(
    "UPDATE users
    SET name = :username, email = :email
    WHERE id = :oldid"
  );
  $stmt->execute($data);
}
?>
