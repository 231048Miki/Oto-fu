<?php 
require("searchCtl.php");
require("../../db_open.php");

if(!(isset($_POST['tags']))){
    header('Location:\otofu\Oto-fu\shirasaki/search/tagSearch.php');
}
$startNo = 0;
if(isset($_GET['startNo'])){
    $startNo = $_GET['startNo'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="tagSearchResult.css">
        <style>
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
        <div class="selectTag">
            <h1>タグ検索したぜ</h1>
            <?php 
            $result = searchComOnTag($dbh,$_POST['tags']);
            echo "<h3>絞り込み中使用タグ：</h3>";
            outputTagsName($_POST['tags'],$dbh);
  echo  "</div>";

  echo "<div class='result'>";
            searchByComId($dbh,$result,$startNo);
            ?>
        </div>
    </div>
    <script>
        document.querySelector('.hamburger').addEventListener('click', function(){
        this.classList.toggle('active');
        document.querySelector('.slide-menu').classList.toggle('active');
        });
    </script>
    </body>