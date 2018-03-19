<?php
include "password_functions.php";
function my_password_change($bdd, $login, $new_password){
    $parray = my_password_hash($new_password);
    if(my_password_verify($new_password, $parray["salt"], $parray["hash"])==TRUE){
      $stmt = $bdd->query("SET PASSWORD FOR $login = $parray[0]");
    }
}
?>
