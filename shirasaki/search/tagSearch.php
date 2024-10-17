<?php 
require("searchCtl.php");
require("../../db_open.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../baseLayout.css">
        <style>
            .tagMenu{
                border: solid,3px,black;
                margin-left: 10%;

                width: 80%;
                height: 60%;
            }
        </style>
        <title>タイトル</title>
    </head>

    <body>
    <div class="main">
        <header>
            <div class="title"><h1>タグ検索</h1></div>
            <div class="banner">
            <button class="btn-gradient-3d-simple" onclick="location.href='../top/top.php'">就活アプリ</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../mypage/mypage.php'">マイページ</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='#'">閲覧履歴</button>
            <button class="btn-gradient-3d-simple" onclick="history.back()">戻る</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../../fujii/login.php'">ログアウト</button>
            </div>

            <div class="hamburger">
                <!-- ハンバーガーメニューの線 -->
                <span></span>
                <span></span>
                <span></span>
                <!-- /ハンバーガーメニューの線 -->
            </div>
            <ul class="slide-menu">
                <li><a href="">aaa</a></li>
                <li><a href="">iii</a></li>
                <li><a href="">uuu</a></li>
                <li><a href="">eee</a></li>
                <li><a href="">aaa</a></li>
                <li><a href="">iii</a></li>
                <li><a href="">uuu</a></li>
                <li><a href="">eee</a></li>
                <li><a href="">aaa</a></li>
                <li><a href="">iii</a></li>
                <li><a href="">uuu</a></li>
                <li><a href="">eee</a></li>
            </ul>
        </header>

        <div class="mid">
            <div class="tagMenu">
                <h3>・タグ一覧</h3>
                <form method="post" action="tagSearchResult.php">
                <?php makeTagForm($dbh); ?>
                <input type="submit"value="検索">
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.hamburger').addEventListener('click', function(){
        this.classList.toggle('active');
        document.querySelector('.slide-menu').classList.toggle('active');
        });
    </script>
    </body>