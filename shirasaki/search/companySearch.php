<?php
include("../../db_open.php");
include("searchCtl.php");
$keyword = $_POST["company"];
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
            <button class="btn-gradient-3d-simple" onclick="location.href=''">就活アプリ</button>
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
                <input type="text" name="company">
                <input type="submit" value="検索">
                </form>
                <?PHP search($keyword,$dbh); ?>
                </div>
                <div class="block"> 
            
                </div>
            </div>

            <div class="left">
                <div class="block"> 
                    ii
                </div>
                <div class="block"> 
                    ii
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