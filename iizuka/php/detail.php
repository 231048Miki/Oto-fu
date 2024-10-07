<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="../header.css">
    <!-- <link rel="stylesheet" , href=""> -->
    <meta name="viewport" content="width=device-width" />

    <title>企業詳細</title>
</head>

<body>

    <header>
        <div class="header">
            <h2>
                <a href="適当にいれてね" class="web-name">job hunting</a>
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
                        <a href="../../komatsu/browsing.php" class="header-nav">閲覧履歴</a><br>
                        <a onclick="history.back()" class="header-nav">戻る</a><br>
                        <a href="logout.php" class="header-nav">ログアウト</a><br>
                    </div>

                    <!-- 通常メニュー -->
                    <nav id="desktop-menu">
                        <a href="com_mypage.php" class="header-nav">マイページ</a>
                        <a href="../../komatsu/browsing.php" class="header-nav">閲覧履歴</a>
                        <a onclick="history.back()" class="header-nav">戻る</a>
                        <a href="logout.php" class="header-nav" id="logout">ログアウト</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <h2>詳細画面</h2>

    <?php
    include '../../db_open.php';

    // $sql = "SELECT * FROM cominfo_table where com_id = $id";
    $sql = "SELECT * FROM cominfo_table where com_id = 11";
    $sql_res = $dbh->query($sql);
    $rec = $sql_res->fetch();

    // $sql2 = "SELECT * FROM company_table where com_id = $id";
    $sql2 = "SELECT * FROM company_table where com_id = 11";
    $sql_res2 = $dbh->query($sql2);
    $rec2 = $sql_res2->fetch();

    echo <<<___EOF
    <h3>$rec2[com_name]</h3>
    
    <h4>企業理念</h4>
    <p>$rec[com_rinen]</p>
    
    <h4>先輩社員の声</h4>
    <p>$rec[advice]</p>

    <h4>フリースペース</h4>
    
    ___EOF;

    if (isset($rec['free1'])) {
        echo "<p>$rec[free1]</p>";
    }
    if (isset($rec['free2'])) {
        echo "<p>$rec[free2]</p>";
    }
    if (isset($rec['free3'])) {
        echo "<p>$rec[free3]</p>";
    }


    echo "<h4>イベント情報</h4>";

    if (isset($rec['event1'])) {
        echo "<ul>";
        echo "<li><p>$rec[event1]</p></ul>";
        echo "</ul>";
    }else{

    }
    if (isset($rec['event2'])) {
        echo "<ul>";
        echo "<li><p>$rec[event2]</p></ul>";
        echo "</ul>";
    }else{

    }
    if (isset($rec['event3'])) {
        echo "<ul>";
        echo "<li><p>$rec[event3]</p></li>";
        echo "</ul>";
    }else{
        
    }

    echo <<<___EOF
    <p>$rec2[com_address]</p>
    <p>$rec2[com_tell]</p>
    <p>$rec2[com_mail]</p>

    ___EOF;



    ?>
</body>

</html>