
<?PHP if(isset($_SESSION_["keyword"])){unset($_SESSION_["keyword"]);}
require("../functions/xssBlock.php");
require("../../db_open.php");
require("../functions/userCtlFunc.php");
session_start();

$login = login($dbh);
// var_dump($login);
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="top.css">

    <title>トップページ</title>
</head>

<body>
    <div class="main">
        <header>

            <div class="banner">
                <button class="btn-gradient-3d-simple" onclick="location.href=''">job hunting</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../mypage/mypage.php'">マイページ</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../../komatsu/browsing.php'">閲覧履歴</button>
                <button class="btn-gradient-3d-simple" onclick="history.back()">戻る</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../../iizuka/logout.php'">ログアウト</button>
            </div>

            <div class="title">
                <h2>トップページ</h2>
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
            <div class="right">
                <div class="block" id="b1">
                    <?php
                    require_once("../calender/myCalendar.php");
                    ?>
                </div>
                <div class="block"> 
                    <button class="btn-gradient-3d-simple" onclick="location.href='../../fujii/message/chat_top.php'">トークルームへ</button>
                </div>
            </div>
            <div class="left">
                        <div class="block">
                            <form method="POST" action="../search/companySearch.php">
                                <input type="text" name="company" placeholder="空欄で全て表示">
                                <input type="submit" value="検索">
                            </form>
                            <button class="" onclick="location.href='../search/tagSearch.php'">タグで検索</button>

                        </div>

                        <div class="block"> 
                            <button class="btn-gradient-3d-simple" onclick="location.href='../keiziban/selectKeiziban.html'">掲示板一覧(はりぼて)へ</button>
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