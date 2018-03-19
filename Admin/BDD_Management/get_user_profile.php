<?php
function get_users($db){
  $stmt = $db->prepare("SELECT * FROM users");
  $stmt->execute();
  $element = $stmt->fetchAll(PDO::FETCH_OBJ);
  $i = 0;
  foreach ($element as $user) {
    $userstable[$i]=$user;
    $i++;
  }
  return($userstable);
}
?>
