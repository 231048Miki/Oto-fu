<?php
include("../../db_open.php");
session_start();
function getKinanru($dbh, $stuID)
{
    $sql = $dbh->prepare('SELECT com_id,com_name FROM company_table WHERE com_id IN(SELECT com_id FROM likes_table WHERE stu_id = :stu_id)');
    $sql->bindValue(':stu_id', $stuID, PDO::PARAM_INT);
    $sql->execute();
    while ($rec = $sql->fetch(PDO::FETCH_ASSOC)) {
        echo <<<___EOF___
                <div class='msg'>
                    <h3>{$rec['com_name']}</h3>
                        <a href='../../iizuka/php/detail.php?com_id={$rec['com_id']}'>企業情報を見る</a>
                </div>
            ___EOF___;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="kininaru.css">

    <title>タイトル</title>
</head>

<body>
    <div class="main">
        <header>

            <div class="banner">
                <button class="btn-gradient-3d-simple" onclick="location.href='../top/top.php'">job hunting</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../mypage/mypage.php'">マイページ</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../../komatsu/browsing.php'">閲覧履歴</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../top/top.php'">戻る</button>
                <button class="btn-gradient-3d-simple" onclick="location.href='../../fujii/login.php'">ログアウト</button>
            </div>

            <div class="title">
                <h2>気になるリスト</h2>
            </div>

            <div class="hamburger">
                <!-- ハンバーガーメニューの線 -->
                <span></span>
                <span></span>
                <span></span>
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
            </div>

        </header>

        <div>
            <h3 style="margin-left: 30%;">・気になる企業一覧</h3>
            <?php getKinanru($dbh, $_SESSION['user_id']); ?>
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