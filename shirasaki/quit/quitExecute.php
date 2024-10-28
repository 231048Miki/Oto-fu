<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>

        </style>
    </head>
    <body>
        <h3>退会しました</h3>
        <div class="buttonSpace" >
            <button onclick="location.href='../../fujii/login.php'">登録画面へ</button>
        </div>
    </body>
</html>

<?php 
    require("../functions/userCtlFunc.php");
    require("../../db_open.php");
    login($dbh);
    session_start();
    $sql = $dbh->prepare('DELETE from student_table WHERE stu_id = :stu_id');
    $sql->bindValue(':stu_id',$_SESSION['user_id'],PDO::PARAM_INT);
    $sql->execute();
    session_destroy();
    //消すデータは後々バカみたいに増えるからその都度ってことで。
?>
