<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="com_top.css">
    <link rel="stylesheet" , href="header.css">
    <!-- <title>企業用トップページ</title> -->
</head>

<body>
<div class="header">
        <h2 class="sns" onclick="適当にいれてね">job hunting</h2>
        <div class="menu">
            <a href="#" class="header-nav">マイページ</a>
            <a onclick="history.back(-1)" class="header-nav">戻る</a>
            <a href="#" class="header-nav">ログアウト</a>
        </div>
    </div>

    <div class="flex1">
        <?php
        require_once("../shirasaki/myCalendar.php");
        ?>
    </div>
    <div class="talk">
        <h3 class="talk_t">トークルーム予定</h3>
    </div>

    <!-- #のところに遷移するところのパス入れてください -->
    <button class="tag" onclick="location.href='#'">タグ追加・更新予定</button>
</body>

</html>