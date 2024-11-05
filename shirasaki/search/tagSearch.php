<?php
require("searchCtl.php");
require("../../db_open.php");
session_start();
if (isset($_SESSION['tags'])) {
    unset($_SESSION['tags']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="tagSearch.css">

    <title>タイトル</title>
</head>

<body>
    <div class="main">
        <header>

            <div class="banner">
            <button class="btn-gradient-3d-simple" onclick="location.href='../top/top.php'">job hunting</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../mypage/mypage.php'">マイページ</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../../komatsu/browsing.php'">閲覧履歴</button>
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
            <div class="tagMenu">
                <h3>・タグ一覧</h3>
                <form method="post" action="tagSearchResult.php">
                    <?php makeTagForm($dbh); ?>
                    <input type="submit" value="検索">
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.hamburger').addEventListener('click', function() {
            this.classList.toggle('active');
            document.querySelector('.slide-menu').classList.toggle('active');
        });
        function change(){
            const btn = document.getElementById('btn');
            const checkboxes = document.querySelectorAll('input[name="tags[]"]:checked');
            if (checkboxes.length === 0) {
                btn.disabled = true;
            } else {
                btn.disabled = false;
            }
        }
        
    </script>
</body>