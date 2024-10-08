<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ログアウト画面</title>
    <link rel="stylesheet" , href="header.css">
    <meta name="viewport" content="width=device-width,
             initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
</head>

<body>
    <?php

    include "../db_open.php";

    //sessionない
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location:../fujii/login.php");
        exit();
    }else{

    //session破棄
    $_SESSION = array();
    session_destroy();

    //scriptでメッセージ
    echo "<script>";
    echo "alert('ログアウトしましたー')";
    echo "</script>";

    echo "<center>";
    echo "<h1 class='log'>ログアウトしました</h1>";
    echo "<a class='log' href=../fujii/login.php>ログイン画面へ</a>";    
    echo "</center>";
    }

    ?>
</body>

</html>