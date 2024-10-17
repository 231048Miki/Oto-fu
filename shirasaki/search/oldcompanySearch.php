<?PHP 
    include("../../db_open.php");
    include("searchCtl.php");
    $keyword = $_POST["company"];
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="comSearch.css">
    <style>
        .com{
            margin-left: 50px;
        }
    </style>
    <title>検索結果</title>
    </head>
</html>
<body>
<header>

</header>
<div class="main">
<div class="header">
    <div class="r-header"><button class="btn-gradient-3d-simple" onclick="location.href=''">就活アプリ</button></div>
    <div class="hamburger">
        <!-- ハンバーガーメニューの線 -->
        <span></span>
        <span></span>
        <span></span>
        <!-- /ハンバーガーメニューの線 -->
    </div>
    <div class="headBanner">
        <button class="btn-gradient-3d-simple" onclick="location.href='../top/top.php'">就活アプリ</button>
        <button class="btn-gradient-3d-simple" onclick="location.href='../mypage/mypage.php'">マイページ</button>
        <button class="btn-gradient-3d-simple" onclick="location.href='#'">閲覧履歴</button>
        <button class="btn-gradient-3d-simple" onclick="location.href='modoru'">戻る</button>
        <button class="btn-gradient-3d-simple" onclick="location.href='../../fujii/login.php'">ログアウト</button>
    </div>

</div>

<div class="flex1">
        <div class="form">
        <form method="POST" action="">
        <input type="text" name="company">
        <input type="submit" value="検索">
        </form>
        </div>

        <ul class="slide-menu">
        <li><a href="">マイページ</a></li>
        <li><a href="">閲覧履歴</a></li>
        <li><a href="">戻る</a></li>
        <li><a href="">ログアウト</a></li>
</ul>
</div>



<div class="flex2">
        <?PHP search($keyword,$dbh); ?>
</div>
<script>
    document.querySelector('.hamburger').addEventListener('click', function(){
  this.classList.toggle('active');
  document.querySelector('.slide-menu').classList.toggle('active');
  });
</script>
</body>