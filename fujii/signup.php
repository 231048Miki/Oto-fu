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
            <link rel="stylesheet" , href="../iizuka/header.css">
            <title>学生用新規登録</title>     
        </head>
        <body>
    ___EOF___;

$HTML_FOOTER = <<<___EOF___
    </body>
    </html>
    ___EOF___;

$HTML_BODY = <<<___EOF___
    
    <div class="header">
    <div class="tologin">
        <ul>
            <h2>
                <a href="login.php"  class="web-name">job hunting</a>
            </h2>
        </ul>
    </div>
        <div class="menu">
            <a onclick="history.back(-1)" class="header-nav">戻る</a>
            <a href="comsignup.php" class="header-nav">企業登録</a>
        </div>
    </div>
    
    <div>
        <h2>学生用新規登録</h2>
    </div>
    <div>
        <form action="register.php" method="post">
    </div>

    <div class="center">
        <div class="field">
            <label>
                名前：
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
                生年月日：
                <input type="text" name="date" required>
            </label>
        </div>
        <div class="field">
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
        <div class="field">
            <label>
                学校名：
                <input type="text" name="school" required>
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
