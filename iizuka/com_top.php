<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" , href="reset.css"> -->
    <link rel="stylesheet" , href="com_top.css">
    <link rel="stylesheet" , href="header.css">
    <link rel="stylesheet" href="../shirasaki/top.css">
    <!-- <title>企業用トップページ</title> -->
</head>

<body>
    <div class="main">
        <?php
        session_start();
        if (isset($_SESSION['user_name'])) {
            echo "<h4>name:" . $_SESSION['user_name'] . "</h4><h4>id:" . $_SESSION['user_id'] . "</h4>";
        }
        ?>
        <div class="header">
            <!-- <div class="r-header"><button class="btn-gradient-3d-simple" onclick="location.href=''">就活アプリ</button></div> -->
            <div class="hamburger">
                <!-- ハンバーガーメニューの線 -->
                <span></span>
                <span></span>
                <span></span>
                <!-- /ハンバーガーメニューの線 -->
            </div>
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
        <div class="talkroom">
            トークルーム予定
        

        <!-- #のところに遷移するところのパス入れてください -->
        <button class="tag" onclick="location.href='#'">公開履歴書一覧予定</button><br>
        <button class="tag2" onclick="location.href='#'">タグ追加・更新予定</button>
        </div>
</body>

</html>