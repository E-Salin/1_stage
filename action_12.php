<?php
session_start();
$_SESSION["error"] = "";
if (!empty($_POST["email"]) and !empty($_POST["password"]))
{
    $user_email = htmlspecialchars($_POST["email"]);
    $user_pwd = htmlspecialchars($_POST["password"]);

    $host = "localhost:8889";
    $db_name = "task_10";
    $user = "root";
    $pwd = "root";
    $opt = [PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];
    $db = new PDO("mysql:host=$host;dbname=$db_name", $user, $pwd, $opt);

    $sql = "select * from users where email = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute(["email" => $user_email]);
    $results = $stmt->fetch();

    if (empty($results))
    {
        $sql_ins = "insert into users(email, password) values(:email, :password)";
        $stmt = $db->prepare($sql_ins);
        $stmt->execute(["email" => $user_email, "password" => $user_pwd]);

        $_SESSION["error"] = "Вы успешно зарегистрировались";
        header("Location: localhost:8888/1_stage/task_12.php");
        die();
    } else
    {
        $_SESSION["error"] = "Такой пользователь существует";
        header("Location: localhost:8888/1_stage/task_12.php");

    }
} else
{
    $_SESSION["error"] = "Вы не ввели пароль";
    header("Location: localhost:8888/1_stage/task_12.php");
}
