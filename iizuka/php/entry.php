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

    <?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location:../../fujii/login.php");
        // セッション追加頼む
        exit();
    } else {

    }
    include '../../db_open.php';
    $stu_id = $_SESSION['stu_id'];
    $com_id = $_POST['entry_id'];
    //一旦stu_idにstudent 2 と com_idでcompany 14
    
    $sql="INSERT  INTO eninfo_table (stu_id, com_id, entry_date) VALUES ( :stu_id , :com_id, CURRENT_TIMESTAMP)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':stu_id', $stu_id, PDO::PARAM_INT);
    $stmt->bindParam(':com_id', $com_id, PDO::PARAM_INT);
    $stmt->execute();
    ?>

    <h1>エントリーしました！</h1>
    <a href="../../shirasaki/top/top.php">トップへ</a>

</body>

</html>