<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../baseLayout.css">

        <title>トップページ</title>
    </head>

    <body>
    <div class="main">
        <header>
            <div class="title"><h1>トップページ</h1></div>
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
            <li><a href="">マイページ</a></li>
            <li><a href="">閲覧履歴</a></li>
            <li><a href="">戻る</a></li>
            <li><a href="">ログアウト</a></li>
            </ul>
        </header>

        <div class="mid">
            <div class="right">
                <div class="block" id="b1">
                <?php 
                require_once("../calender/myCalendar.php");
                ?>
                </div>
                <div class="block"> 
                    トークルーム予定
                </div>
            </div>

            <div class="left">
                <div class="block"> 
                <form method="POST" action="../search/companySearch.php">
                <input type="text" name="company">
                <input type="submit" value="検索">
                </form>
                </div>
                <div class="block"> 
                    掲示板予定
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