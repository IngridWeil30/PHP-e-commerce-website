<?php
$db = connect_db("127.0.0.1", "root", "RvMiRPZsk3", NULL, "day10db");
$selection_id = $_GET['id'];

$data = [
  'id' => $selection_id,
];

$stmt = $db->prepare("SELECT email FROM users WHERE id = :id");
$stmt->execute($data);
$element = $stmt->fetchAll(PDO::FETCH_OBJ);

echo $element;
?>
