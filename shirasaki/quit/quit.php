<?php 
require("../functions/userCtlFunc.php");
require("../../db_open.php");
session_start();
login($dbh);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            .buttonSpace{
                display: flex;
            }
            body{
                
            }
        </style>
    </head>
    <body>
        <h3>ほんとに退会しますか？</h3>
        <div class="buttonSpace" >
            <button onclick="location.href='./quitExecute.php'">はい</button>
            <button onclick="history.back()">いいえ</button>
        </div>
    </body>
</html>
