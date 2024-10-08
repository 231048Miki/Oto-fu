<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="../header.css">
    <link rel="stylesheet" , href="../css/detail.css">
    <meta name="viewport" content="width=device-width" />

    <title>企業詳細</title>
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
    <h2 class='company'>$rec2[com_name]</h2>
    
    <div class='info'>

    <h4>企業理念</h4>
    <p>$rec[com_rinen]</p>
    
    <h4>先輩社員の声</h4>
    <p>$rec[advice]</p>

    <h4>フリースペース</h4>
    
    ___EOF;

    if (empty($rec['free1'])) {
        echo "<p hidden>$rec[free1]</p>";
    } else {
        echo "<p>$rec[free1]</p>";
    }
    if (empty($rec['free2'])) {
        echo "<p hidden>$rec[free2]</p>";
    } else {
        echo "<p>$rec[free2]</p>";
    }
    // if (empty($rec['free3'])) {
    //     echo "<p hidden>$rec[free3]</p>";
    // }else{
    //     echo "<p>$rec[free3]</p>";
    // }

    echo <<<___EOF
    <p>$rec2[com_address]</p>
    <p>$rec2[com_tell]</p>
    <p>$rec2[com_mail]</p>
    ___EOF;

    echo "<h4>イベント情報</h4>";

    // null判定。tuleだと出力なし。
    if (empty($rec['event1'])) {
        echo "<ul hidden>";
        echo "<p hidden>$rec[event1]</p>";
        echo "</ul>";
    } else {
        // falseだとform　日付クリックでイベント予約に遷移
        echo "<ul>";
        // echo "<p>‣$rec[event1]</p>";

        echo <<<___EOF
            <form action="../../komatsu/eventbooking.php" method="post">
                <input type="hidden" name="delete" value="$rec[eventdata1]">
                <p>‣$rec[event1]<input type="submit" name="submit" value = "$rec[eventdata1]"></p>
            </form>

         ___EOF;
        echo "</ul>";
    }
    if (isset($rec['event2'])) {
        echo "<ul hidden>";
        echo "<p hidden>$rec[event2]</p>";
        echo "</ul>";
    } else {
        echo "<ul>";
        echo <<<___EOF
            <form action="../../komatsu/eventbooking.php" method="post">
                <input type="hidden" name="delete" value="$rec[eventdata2]">
                <p>‣$rec[event2]<input type="submit" name="submit" value = "$rec[eventdata2]"></p>
            </form>

         ___EOF;
        // echo "<p>‣$rec[event2]</p>";
        // echo "<a>$rec[eventdata2]</a>";
        echo "</ul>";
    }
    if (isset($rec['event3'])) {
        echo "<ul hidden>";
        echo "<p hidden>$rec[event3]</p>";
        echo "</ul>";
    } else {
        echo "<ul>";
        echo <<<___EOF
            <form action="../../komatsu/eventbooking.php" method="post">
                <input type="hidden" name="delete" value="$rec[eventdata3]">
                <p>‣$rec[event3]<input type="submit" name="submit" value = "$rec[eventdata3]"></p>
            </form>

         ___EOF;
        // echo "<p>‣$rec[event3]</p>";
        // echo "<a>$rec[eventdata3]</a>";
        echo "</ul>";
    }

    echo "</div>";



    ?>
</body>

</html>