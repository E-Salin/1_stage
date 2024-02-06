<?php

if (isset($_FILES))
{
    $dir = "upload/";

    $db = new PDO("mysql:host=localhost:8889;dbname=task_17", 'root', 'root');
    $sql = "insert into images(path) values(:path)";

    for ($i=0; $i < count($_FILES["images"]["name"]); $i++)
    {
        $tmp_dir = $_FILES["images"]["tmp_name"][$i];
        $file_extension = pathinfo($_FILES["images"]["name"][$i], PATHINFO_EXTENSION);
        $file_name = $dir . uniqid() . '.' . $file_extension;

        if(move_uploaded_file($tmp_dir, $file_name))
        {
            insert_image($db, $sql, $file_name);
        }
    }
    header("Location: /1_stage/task_17.php");
} else {
    exit(UPLOAD_ERR_OK);
}

function insert_image($db, $sql, $file_name)
{
    $stmt = $db->prepare($sql);
    $stmt->execute(["path" => $file_name]);
}


