<?php
//trust me
include '../db_open.php';

$HTML_HEADER = <<<___EOF___
    <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>ログイン画面</title>     
        </head>
        <body>
    ___EOF___;

$HTML_FOOTER = <<<___EOF___
    </body>
    </html>
    ___EOF___;

$HTML_BODY = <<<___EOF___
    <a href="">就活アプリ</a>
    <a href="comrogin.php">企業の方はこちら</a>
    <h1>学生ログイン</h1>
    <form method="POST" action="rogincheck.php">
        <p class="text">メールアドレス：<input type='text' name='mail'  value='' required></p>
        <p class="text">パスワード：<input type='password' name='pass'  value='' required></p>
        <p><input type="submit" class="submit" name="rogin"></p>

        <a href="signup.php">新規登録はこちら</a>

    </form>
    </div>
    ___EOF___;

echo $HTML_HEADER;
echo $HTML_BODY;
echo $HTML_FOOTER;