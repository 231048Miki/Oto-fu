<?PHP 
session_start();
include("../db_open.php");


?>









<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            textarea{
                vertical-align:top;
            }
        </style>
    </head>
    <body>
    <button onclick="history.back()">もどる</button>
    <form method="post" enctype="multipart/form-data" action="">
    <br>
    志望動機
    <br>
    <textarea name="douki" cols="40" rows="10"></textarea>
    <br>
    自己PR
    <br>
    <textarea name="pr" cols="40" rows="10"></textarea>
    <br>
    趣味特技
    <br>
    <textarea name="syumi" cols="40" rows="10"></textarea>
    <br>
    <input type="file" name="example" accept="image/jpeg, image/png">
    <br>
    <label for="sikaku">資格:
    </label>
    <input type="text" name="sikaku">
    <br>
    <label for="his">学歴職歴:
    </label>
    <input type="text" name="his">
    <input type="submit" value="保存">
    </form>
    </body>

</html>
