<?php
include("../../db_open.php");
include("searchCtl.php");
session_start();
if(isset($_POST["company"])){
    $_SESSION['keyword'] = $_POST["company"];
}
if(isset($_POST["basyo"])){
    $_SESSION['basyo'] = $_POST["basyo"];
    $_SESSION['tenkin'] = $_POST["tenkin"];
}
echo "転勤：".$_SESSION['tenkin']."<br>";
echo "勤務地：".$_SESSION['basyo'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../baseLayout.css">

        <title>検索結果</title>
    </head>

    <body>
    <div class="main">
        <header>
            <div class="title"><h1>企業検索</h1></div>
            <div class="banner">
            <button class="btn-gradient-3d-simple" onclick="location.href='../top/top.php'">就活アプリ</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../mypage/mypage.php'">マイページ</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='history'">閲覧履歴</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='modoru'">戻る</button>
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
            <div class="right">
                <div class="block" id="b1">
                <form method="POST" action="">
                <input type="text" name="company"  placeholder="空欄で全て表示">
                <input type="submit" value="検索">
                </form>
                <div class="tags">
                        <form method="POST" action="../search/companySearch.php">
                        転勤:有<input type="radio" id="tenkin" name="tenkin" value="y">
                        無<input type="radio" id="tenkin" name="tenkin" value="n">
                        <br>
                        勤務地:道内<input type="radio" id="basyo" name="basyo" value="h">
                        都心部<input type="radio" id="basyo" name="basyo" value="t">
                        <br><input type="submit" value="タグで検索">
                        </form>
                    </div>
                <?PHP search($_SESSION['keyword'],$dbh); ?>
                </div>
                <div class="block"> 
            
                </div>
            </div>

            <div class="left">
                <div class="block"> 
                    
                </div>
                <div class="block"> 
                    
                </div>
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