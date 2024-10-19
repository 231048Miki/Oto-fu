<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="../css/com_mypage.css">
    <link rel="stylesheet" , href="../header.css">
    <meta name="viewport" content="width=device-width" />
    <title>企業マイページ</title>
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
                        <a href="com_mypage.php" class="header-nav">マイページ</a><br>
                        <a onclick="history.back()" class="header-nav">戻る</a><br>
                        <a href="../logout.php" class="header-nav">ログアウト</a><br>
                        <a href="../../shirasaki/quit/quit.php" class="header-nav">退会</a>
                    </div>

                    <!-- 通常メニュー -->
                    <nav id="desktop-menu">
                        <a href="com_mypage.php" class="header-nav">マイページ</a><br>
                        <a onclick="history.back()" class="header-nav">戻る</a><br>
                        <a href="../logout.php" class="header-nav">ログアウト</a><br>
                        <a href="../../shirasaki/quit/quit.php" class="header-nav">退会</a>
                    </nav>
                    </nav>
                </div>
            </div>
        </div>
    </header>


    <?php
    session_start();
    
    if (!isset($_SESSION['login']) && !isset($_SESSION['com_id'])) {
        header("Location:../../fujii/login.php");
        // セッション追加頼む
        exit();
    }else{
        $userid = $_SESSION['com_id'];
        // echo $userid;  
    }
    // $userid = $_SESSION["com_id"];
    // echo $_SESSION["com_id"];
    
    include '../../db_open.php';
    

    $sql = "SELECT * FROM company_table WHERE com_id = $_SESSION[com_id]";
    $sql_res = $dbh->query($sql);
    $rec = $sql_res->fetch();
    echo <<<___EOF
    <h2 class="com-name">{$rec['com_name']}様</h2>

    ___EOF;
    ?>
    <div class="mypage_boo">
        <button class="cmypage_button" onclick="location.href='#'">オファーリスト</button>
        <!-- <button class="cmypage_button" onclick="location.href='#'">イベント</button> -->
        <button class="cmypage_button" onclick="location.href='../../komatsu/companypage.php'">ページ編集</button>
        <button class="cmypage_button" onclick="location.href='com_info_update.php'">設定</button>
    </div>
</body>

</html>