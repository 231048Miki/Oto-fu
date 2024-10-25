<?php
include("../../db_open.php");
include("searchCtl.php");
session_start();
if(isset($_POST["company"])){
    $_SESSION['keyword'] = $_POST["company"];
}
$startNo = 0;
if(isset($_GET['startNo'])){
    $startNo = $_GET['startNo'];
}
if(isset($_GET['likeId'])){
    likeCtl($dbh,$_SESSION['stu_id'],$_GET['likeId']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="comSearch.css">

        <title>検索結果</title>
    </head>

    <body>
    <div class="main">
        <header>
            <div class="title"><h1>企業検索</h1></div>
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
                <li><a href="../top/top.php">top</a></li>
                <li><a href="../../fujii/login.php">ログアウト</a></li>
                <li><a href="../../komatsu/browsing.php">閲覧履歴</a></li>
                <li><a href="../quit/quit.php">退会</a></li>
            </ul>
        </header>

        <div class="mid">
                    <div class="forms">
                    <form method="POST" action="">
                    <input type="text" name="company"  placeholder="空欄で全て表示">
                    <input type="submit" value="検索">
                    </form>
                    <button class="" onclick="location.href='tagSearch.php'">タグで検索</button>
                    </div>

                    <div class="result">
                    <?PHP if(isset($_SESSION['keyword'])){
                        search($_SESSION['keyword'],$dbh,$startNo);
                    } ?>
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
</html>