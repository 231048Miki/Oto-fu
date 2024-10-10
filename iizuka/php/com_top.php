<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" , href="reset.css"> -->
    <link rel="stylesheet" , href="../css/com_top.css">
    <link rel="stylesheet" , href="../header.css">
    <!-- <link rel="stylesheet" href="../shirasaki/top.css"> -->
    <meta name="viewport" content="width=device-width" />
    <title>企業トップページ</title>
</head>

<body>
    <div class="main">
        <?php

        require("../../shirasaki/xssBlock.php");

        session_start();
        if (isset($_SESSION['user_name'])) {
            echo "<h4>name:" . $_SESSION['user_name'] . "</h4><h4>id:" . $_SESSION['user_id'] . "</h4>";
        }
        ?>
        <header>
            <div class="header">
                <h2>
                    <a href="com_top.php" class="web-name">job hunting</a>
                </h2>
                <div class="menu">
                    <div id="nav-drawer">
                        <!-- ハンバーガーメニュー開いたときの挙動。これないと機能しません -->
                        <input id="nav-input" type="checkbox" class="nav-unshown">
                        <!-- 三本線 -->
                        <label id="nav-open" for="nav-input" class="nav-unshown"><span></span></label>
                        <label class="nav-unshown" id="nav-close" for="nav-input"></label>

                        <!-- レスポンシブが効いてるとき -->
                        <div id="nav-content">
                            <a href="com_mypage.php" class="header-nav">マイページ</a><br>
                            <a onclick="history.back()" class="header-nav">戻る</a><br>
                            <a href="../logout.php" class="header-nav">ログアウト</a><br>
                        </div>

                        <!-- 通常メニュー -->
                        <nav id="desktop-menu">
                            <a href="com_mypage.php" class="header-nav">マイページ</a>
                            <a onclick="history.back()" class="header-nav">戻る</a>
                            <a href="../logout.php" class="header-nav" id="logout">ログアウト</a>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex1">
            <?php
            require_once("../../shirasaki/calender/myCalendar.php");
            ?>
        </div>
        <div class="all">
            <div class="talkroom">
                <button class="tag" onclick="location.href='../../fujii/message/chat_top.php'">チャット一覧へ！</button>
            </div>

            <!-- #のところに遷移するところのパス入れてください -->
            <div class="btn-flex">
                <button class="tag" onclick="location.href='#'">公開履歴書一覧予定</button><br>
                <button class="tag" onclick="location.href='#'">タグ追加・更新予定</button>
            </div>
        </div>

</body>

</html>