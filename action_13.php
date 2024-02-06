<?php
session_start();
$_SESSION["text"] = "";

if(!empty($_POST["text"]))
{
    $_SESSION["text"] = $_POST["text"];
    goback();
} else
{
    $_SESSION["text"] = "Вы не ввели сообщение";
    goback();
}

function goback()
{
    header("Location: localhost:8888/1_stage/task_13.php");
}