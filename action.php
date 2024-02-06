<?php
session_start();

if (isset($_POST["text"]))
{
    $data = $_POST["text"];
}
echo "Session:";

$db = new PDO("mysql:host=localhost:8889;dbname=task_10", "root", "root", [PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);

$query_searh = "select * from data where text = :text";
$stmt = $db->prepare($query_searh);
$stmt->execute(["text" => $data]);
$results = $stmt->fetchAll();
if ($results)
{
    $_SESSION["data_used"] = true;
    header("Location: localhost:8888/1_stage/task_11.php");
    exit();
}
else
{
    $query ="insert into data(text) values(?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$data]);

    header("Location: localhost:8888/1_stage/task_11.php");
}


