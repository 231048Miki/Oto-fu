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
            .mid{
                display: block;
            }
        </style>
        <title>タイトル</title>
    </head>

    <body>
    <div class="main">
        <header>
            <div class="title"><h1>タグ検索</h1></div>
            <div class="banner">
            <button class="btn-gradient-3d-simple" onclick="location.href=''">就活アプリ</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../mypage/mypage.php'">マイページ</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='#'">閲覧履歴</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='tagSearch.php'">戻る</button>
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
        <h1>タグ検索したぜ</h1>
            <?php 
            $result = searchComOnTag($dbh,$_POST['tags']);
            echo "絞り込み中使用タグ：<br>";
            outputTagsName($_POST['tags'],$dbh);
            // var_dump($result);
            searchByComId($dbh,$result);
            ?>
    </div>
    <script>
        document.querySelector('.hamburger').addEventListener('click', function(){
        this.classList.toggle('active');
        document.querySelector('.slide-menu').classList.toggle('active');
        });
    </script>
    </body>