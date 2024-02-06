<?php
session_start();
$_SESSION["error"] = "";
if (!empty($_POST["email"]) and !empty($_POST["password"]))
{
    $user_email = $_POST["email"];
    $user_pwd = $_POST["password"];

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
        $stmt->execute(["email" => $user_email, "password" => password_hash($user_pwd, PASSWORD_DEFAULT)]);

        $_SESSION["error"] = "Вы успешно зарегистрировались.";
        header("Location: /1_stage/user_page.php");
        exit();
    } else
    {
        if(password_verify($user_pwd ,$results["password"]))
        {
            $_SESSION["error"] = "Добро пожаловать в личный кабинет";
            var_dump($_SESSION["error"]);
            header("Location: /1_stage/user_page.php");
            exit();
        } else
        {
            $_SESSION["error"] = "Вы ввели неправильный пароль";
            header("Location: /1_stage/task_15.php");
            exit();
        }
    }
} else
{
    $_SESSION["error"] = "Вы не ввели логин или пароль";
    header("Location: /1_stage/task_15.php");
    exit();
}

?>