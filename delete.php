<?php
$id = $_GET["id"];
$path = $_GET["path"];

$db = new PDO("mysql:host=localhost:8889;dbname=task_17", 'root', 'root');
$sql = "delete from images where id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(["id" => $id]);

unlink($path);
header("Location: /1_stage/task_17.php");



