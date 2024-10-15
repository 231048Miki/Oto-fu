<?PHP if (isset($_SESSION_["keyword"])) {
    unset($_SESSION_["keyword"]);
} ?>
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

            <div class="banner">
                <button class="btn-gradient-3d-simple" onclick="location.href=''">就活アプリ</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../mypage/mypage.php'">マイページ</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../../komastu/browsing.php'">閲覧履歴</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='history.back()'">戻る</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../../iizuka/logout.php'">ログアウト</button>
            </div>

            <div class="title">
                <h1>トップページ</h1>
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
                        <input type="text" name="company" placeholder="空欄で全て表示">
                        <input type="submit" value="検索">
                    </form>

                    <div class="tags">
                        <form method="POST" action="../search/companySearch.php">
                            転勤:有<input type="radio" id="tenkin" name="tenkin" value="y" checked>
                            無<input type="radio" id="tenkin" name="tenkin" value="n">
                            <br>
                            勤務地:道内<input type="radio" id="basyo" name="basyo" value="h" checked>
                            都心部<input type="radio" id="basyo" name="basyo" value="t">
                            <br><input type="submit" value="タグで検索">
                        </form>
                    </div>
                </div>

                <div class="block">
                    掲示板予定
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.hamburger').addEventListener('click', function() {
            this.classList.toggle('active');
            document.querySelector('.slide-menu').classList.toggle('active');
        });
    </script>
</body>

</html>