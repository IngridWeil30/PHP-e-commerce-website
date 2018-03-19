<?php
include "connect_db.php";
$db = connect_db("127.0.0.1", "root", "RvMiRPZsk3", NULL, "day10db");
function delete_user($id){

  $section_id = $_GET['id'];
  echo $section_id;
  var_dump($_GET['id']);
  if(isset($_GET["id"])) {

    $data = [
      'id' => $_GET['id']
    ];

    $stmt = $db->prepare(
      "DELETE FROM users
      WHERE `id` = :id"
    );

    $stmt->execute($data);
    header("location: index.php");
    exit();
  }
}
?>
