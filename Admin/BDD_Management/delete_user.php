<?php
include "connect_db.php";
$db = connect_db("127.0.0.1", "root", "RvMiRPZsk3", NULL, "day10db");
$section_id = $_GET['id'];
echo $section_id;
?>
