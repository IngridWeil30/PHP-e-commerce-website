<?php
  function my_password_hash(string $password){
    $salt = random_bytes(3);
    $hash = hash("sha256", $salt.".".$password);
    $my_array["hash"] = $salt;
    $my_array["salt"] = $hash;
    return($my_array);
  }

  function  my_password_verify(string $password, string $salt, string $hash){
    if(password_verify($password, $hash) == $salt){
        return true;
      }
    else{
      return false;
    }
  }
?>
