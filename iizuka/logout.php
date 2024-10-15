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

    //sessionをアレイ
    $_SESSION = array();
    //session破棄
    session_destroy();

    //scriptでメッセージ
    echo "<script>";
    echo "alert('ログアウトしました。')";
    echo "</script>";

    echo "<script>";
    echo "location.href='../fujii/login.php'";
    echo "</script>";


    
    // echo "<div class='log'>";
    // echo "<a class='log' href=../fujii/login.php>ログイン画面へ</a>";
    // echo "</div>";



    }

 

    ?>
</body>

</html>