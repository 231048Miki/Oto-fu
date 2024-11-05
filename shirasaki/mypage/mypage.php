<?PHP if (isset($_SESSION_["keyword"])) {
    unset($_SESSION_["keyword"]);
}
require("../functions/xssBlock.php");
require("../../db_open.php");
require("../functions/userCtlFunc.php");
session_start();

$login = login($dbh);
// var_dump($login);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="mypage.css">

    <title>マイページ</title>
</head>

<body>
    <div class="main">
        <header>
            <div class="banner">
                <button class="btn-gradient-3d-simple" onclick="location.href='../top/top.php'">job hunting</button>
                <button class="btn-gradient-3d-simple" onclick="history.back()">もどる</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../../fujii/login.php'">ログアウト</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../../komatsu/browsing.php'">閲覧履歴</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../quit/quit.php'">退会</button>
            </div>

            <div class="title">
                <h2>マイページ</h2>
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
        <div class="flex">
            <div class="mid">
                <div class="block" id="b1">
                    <button class="btn" onclick="location.href='../dummy/offer.html'">
                        <h2>『オファーリスト』:受け取ったオファーを閲覧できるでやんす。</h2>
                    </button>
                </div>
                <div class="block">
                    <button class="btn" onclick="location.href='../kininaru/kininaru.php'">
                        <h2>『気になる企業』:気になる企業を閲覧できるでやんす。</h2>
                    </button>
                </div>
                <div class="block">
                    <button class="btn" onclick="location.href='../resume/resumeForm.php'">
                        <h2>『履歴書』:履歴書的なものを書いて保管できるでやんす。</h2>
                    </button>
                </div>
                <div class="block">
                    <button class="btn" onclick="location.href='../resume/resumeReview.php'">
                        <h2>『履歴書レビュー』:履歴書の添削を閲覧できるでやんす。</h2>
                    </button>
                </div>
                <div class="block">
                    <button class="btn" onclick="location.href='../../iizuka/php/stu_info_update.php'">
                        <h2>『設定』:アカウント情報を変更できるでやんす。</h2>
                    </button>
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
>>>>>>> shirasaki
</html>