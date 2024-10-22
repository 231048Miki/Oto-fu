<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="../header.css">
    <link rel="stylesheet" , href="../css/offer.css">
    <title>オファー画面（ダミー）</title>
</head>

<body>
    <header>
        <div class="header">
            <h2>
                <a href="com_top.php" class="web-name">job hunting</a>
            </h2>
            <div class="menu">
                <div id="nav-drawer">
                    <!-- ハンバーガーメニュー開いたときの挙動。これないと機能しません -->
                    <input id="nav-input" type="checkbox" class="nav-unshown">
                    <!-- 三本線 -->
                    <label id="nav-open" for="nav-input" class="nav-unshown"><span></span></label>
                    <label class="nav-unshown" id="nav-close" for="nav-input"></label>

                    <!-- レスポンシブが効いてるとき -->
                    <div id="nav-content">
                        <a href="stu_mypage.php" class="header-nav">マイページ</a><br>
                        <a href="../../komatsu/browsing.php" class="header-nav">閲覧履歴</a><br>
                        <a onclick="history.back()" class="header-nav">戻る</a><br>
                        <a href="logout.php" class="header-nav">ログアウト</a><br>
                    </div>

                    <!-- 通常メニュー -->
                    <nav id="desktop-menu">
                        <a href="stu_mypage.php" class="header-nav">マイページ</a>
                        <a href="../../komatsu/browsing.php" class="header-nav">閲覧履歴</a>
                        <a onclick="history.back()" class="header-nav">戻る</a>
                        <a href="logout.php" class="header-nav" id="logout">ログアウト</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <h2>オファーリスト</h2>

    <form>
        <div class="center">
            <p>学校名：<a>吉田学園</a></p>
            <p>名前：<a>さとうさん</a></p>
            <input type="button" id="btn" name="btn" value="オファーを送る！">
        </div>
    </form>

    <br>
    <form>
        <div class="center">
            <p>学校名：<a>吉田学園</a></p>
            <p>名前：<a>かとうさん</a></p>
            <input type="button" id="btn" name="btn" value="オファーを送る！">
        </div>
    </form>

</body>

</html>

<script>
    function move() {
        alert('送信しました。');
    }
    let BtnMove = document.getElementById('btn');
    BtnMove.addEventListener('click', move);
</script>