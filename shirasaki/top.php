<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="top.css">

    <title>トップページ</title>
    </head>
</html>
<body>
<div class="main">


<div class="headBanner">
    <button class="btn-gradient-3d-simple" onclick="location.href=''">就活アプリ</button>
    <button class="btn-gradient-3d-simple" onclick="location.href='mypage'">マイページ</button>
    <button class="btn-gradient-3d-simple" onclick="location.href='history'">閲覧履歴</button>
    <button class="btn-gradient-3d-simple" onclick="location.href='modoru'">戻る</button>
    <button class="btn-gradient-3d-simple" onclick="location.href='login'">ログアウト</button>
</div>

<div class="flex1">
        <?php 
        require_once("myCalendar.php");
        ?>

    <!-- <div class="search">
    検索フォーム予定地
    <input type="text" name="com">
    <input type="submit" value="検索">
    </div>

    <button class="newInfo" onclick="location.href='newInfo'">新着情報</button>
</div> -->

<!-- <div class="flex2">
    <div class="talkRoom">
    トークルーム予定地
    </div>

    <div class="board">
    掲示板予定地
    </div>
</div> -->
</div>
</body>