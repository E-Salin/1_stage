<?php
session_start();

$_SESSION["count"] += 1;

header("Location: localhost:8888/1_stage/task_14.php");