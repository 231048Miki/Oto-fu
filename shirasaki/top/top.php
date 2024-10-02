<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="top.css">

    <title>トップページ</title>
    </head>
</html>
<body>
<header>

</header>
<div class="main">
<?php
session_start(); 
if(isset($_SESSION['user_name'])){
echo "<h4>name:".$_SESSION['user_name']."</h4><h4>id:".$_SESSION['user_id']."</h4>";
}
?>

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
        <button class="btn-gradient-3d-simple" onclick="location.href=''">就活アプリ</button>
        <button class="btn-gradient-3d-simple" onclick="location.href='../mypage/mypage.php'">マイページ</button>
        <button class="btn-gradient-3d-simple" onclick="location.href='history'">閲覧履歴</button>
        <button class="btn-gradient-3d-simple" onclick="location.href='modoru'">戻る</button>
        <button class="btn-gradient-3d-simple" onclick="location.href='../../fujii/login.php'">ログアウト</button>
    </div>

</div>

<div class="flex1">
        <?php 
        require_once("../calender/myCalendar.php");
        ?>

        <div class="form">
        検索フォーム予定
        </div>

        <ul class="slide-menu">
        <li><a href="">マイページ</a></li>
        <li><a href="">閲覧履歴</a></li>
        <li><a href="">戻る</a></li>
        <li><a href="">ログアウト</a></li>
</ul>
</div>



<div class="flex2">
    <div class="talkroom">
            トークルーム予定
    </div>
    <div class="board">
        掲示板予定
    </div>
</div>
<script>
    document.querySelector('.hamburger').addEventListener('click', function(){
  this.classList.toggle('active');
  document.querySelector('.slide-menu').classList.toggle('active');
  });
</script>
</body>