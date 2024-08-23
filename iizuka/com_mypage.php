<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="com_mypage.css">
    <link rel="stylesheet" , href="header.css">
</head>

<body>
    <header>
        <div class="header">
            <h2 class="sns">job hunting</h2>
            <div class="menu">
                <a href="#" class="header-nav">マイページ</a>
                <a onclick="history.back(-1)" class="header-nav">戻る</a>
                <!-- <a href="#" class="header-nav">登録</a> -->
                <!-- <a href="#" class="header-nav">ログイン</a> -->
                <a href="#" class="header-nav">ログアウト</a>
                <a href="#" class="header-nav">退会</a>
            </div>
        </div>
    </header>

    <h2 class="com-name">~~~様</h2>

    <div class="mypage_boo">
        <button class="cmypage_button" onclick="location.href='#'">オファーリスト</button>
        <button class="cmypage_button" onclick="location.href='#'">イベント</button>
        <button class="cmypage_button" onclick="location.href='#'">ページ編集</button>
        <button class="cmypage_button" onclick="location.href='info_update.php'">設定</button>
    </div>
</body>

</html>