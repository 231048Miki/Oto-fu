<?php
//trust me
include '../db_open.php';

//セッションでregister.phpに入れないようにするためにセッションを作る
$HTML_HEADER = <<<___EOF___
    <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>学生用新規登録</title>     
        </head>
        <body>
    ___EOF___;

$HTML_FOOTER = <<<___EOF___
    </body>
    </html>
    ___EOF___;

$HTML_BODY = <<<___EOF___
    <div class="torogin">
        <ul>
            <a href="rogin.php">就活サイト(仮)</a>
        </ul>
    </div>
    <div class=tocomsignup>
        <ul>
            <a href="comsignup.php">企業登録</a>
        </ul>
        
    </div>
    <div>
    <h1>学生用新規登録</h1>
    </div>
    <div>
        <form action="register.php" method="post">
    </div>
    <div>
        <label>
            名前：
            <input type="text" name="name" required>
        </label>
    </div>
    <div>
        <label>
            メールアドレス：
            <input type="text" name="mail" required>
        </label>
    </div>
    <div>
        <label>
            生年月日：
            <input type="text" name="date" required>
        </label>
    </div>
    <div>
        <label>
            住所：
            <input type="text" name="address" required>
        </label>
    </div>
    <div>
        <label>
            電話番号：
            <input type="text" name="tell" required>
        </label>
    </div>
    <div>
        <label>
            学校名：
            <input type="text" name="school" required>
        </label>
    </div>
    <div>
        <label>
            パスワード：
            <input type="password" name="pass" required>
        </label>
    </div>
    <div>
        <label>
            再入力：
            <input type="password" name="repass" required>
        </label>
    </div>
    <input type="submit" value="新規登録">
    </form>
    ___EOF___;




    
echo $HTML_HEADER;
echo $HTML_BODY;
echo $HTML_FOOTER;