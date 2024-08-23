<?php
//trust me
include '../db_open.php';

//セッションでregister.phpに入れないようにするためにセッションを作る
$HTML_HEADER = <<<___EOF___
    <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" , href="signup.css">
            <title>企業用新規登録</title>     
        </head>
        <body>
    ___EOF___;

$HTML_FOOTER = <<<___EOF___
    </body>
    </html>
    ___EOF___;

$HTML_BODY = <<<___EOF___
    <div class="tologin">
        <ul>
            <a href="login.php">就活サイト(仮)</a>
        </ul>
    </div>
    <div class=tocomsignup>
        <ul>
            <a href="signup.php">学生登録</a>
        </ul>
        
    </div>
    <div>
    <h1>企業用用新規登録</h1>
    </div>
    <div>
        <form action="comregister.php" method="post">
    </div>
    <div class="center">
    <div class="field">
        <label>
            企業名：
            <input type="text" name="name" required>
        </label>
    </div>
    <div class="field">
        <label>
            メールアドレス：
            <input type="text" name="mail" required>
        </label>
    </div>
    <div class="field">
        <label>
            所在地：
            <input type="text" name="address" required>
        </label>
    </div>
    <div class="field">
        <label>
            電話番号：
            <input type="text" name="tell" required>
        </label>
    </div>
    <div class="field">
        <label>
            パスワード：
            <input type="password" name="pass" required>
        </label>
    </div>
    <div class="field">
        <label>
            再入力：
            <input type="password" name="repass" required>
        </label>
    </div>
    </div>
    <div class="submit">
    <input type="submit" value="新規登録">
    </div>
    </form>
    ___EOF___;




    
echo $HTML_HEADER;
echo $HTML_BODY;
echo $HTML_FOOTER;