<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>エントリー（ダミー）</title>
    <link rel="stylesheet" , href="../header.css">
</head>

<body>
    <header>
        <div class="header">
            <h2>
                <a href="../../shirasaki/top/top.php" class="web-name">job hunting</a>
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

    <h2>エントリー画面</h2>

    <p>ダミーです</p>

    <?php
    session_start();

    if (!isset($_SESSION['login']) && !isset($_SESSION['com_id'])) {
        header("Location:../../fujii/login.php");
        // セッション追加頼む
        exit();
    } else {
        // $userid = $_SESSION['com_id'];
        // echo $userid;  
    }
    // $userid = $_SESSION["com_id"];
    // echo $_SESSION["com_id"];
    include '../../db_open.php';

    $sql = "SELECT * FROM resume_table where com_id = $_SESSION[com_id]";
    // $sql = "SELECT * FROM resume_table where com_id = 11";
    $sql_res = $dbh->query($sql);
    $rec = $sql_res->fetch();

    // null判定。tuleだと出力なし。
    if (empty($rec['event1'])) {
        echo "<p>履歴書を作成してください</p>";
        echo <<<___EOF
            <form action="../../shirasaki/resumeForm.php" method="post">
                <input type="hidden" name="delete" value="$rec[com_id]">
                <p><input type="submit" name="submit" value = "履歴書フォームはこちら！"></p>
            </form>
            ___EOF;
    } else {
        // falseだとform　日付クリックでイベント予約に遷移
        echo "<ul>";
        // echo "<p>‣$rec[event1]</p>";
    }
    ?>

</body>

</html>