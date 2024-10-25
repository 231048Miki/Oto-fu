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
    session_start();
    
    if (!isset($_SESSION['login']) && !isset($_SESSION['stu_id'])) {
        header("Location:../../fujii/login.php");
        exit();
    } else if (isset($_GET['com_id'])) {
        $_SESSION['com_id'] = $_GET['com_id'];  // GETパラメータが存在する場合はセッションに保存
    } else if (!isset($_SESSION['com_id'])) {  
        // セッションにもcom_idがない場合はエラー処理
        echo "ないよ！！";
        exit();
    }

    // $userid = $_SESSION["com_id"];
    // echo $_SESSION["com_id"];
    include '../../db_open.php';



    //com_idをどうにかして持ってくる（多分POST hidden）
    // $sql = "SELECT * FROM cominfo_table where com_id = $_SESSION[com_id]";
    $sql = "SELECT * FROM cominfo_table where com_id = " .  $_SESSION['com_id'];
    $sql_res = $dbh->query($sql);
    $rec = $sql_res->fetch();
    // $sql2 = "SELECT * FROM company_table where com_id = $_SESSION[com_id]";
    $sql2 = "SELECT * FROM company_table where com_id =" .  $_SESSION['com_id'];
    $sql_res2 = $dbh->query($sql2);
    $rec2 = $sql_res2->fetch();

    // echo <<<___EOF
    // <h2 class='company'>$rec2[com_name]</h2>

    // <form class='cnt'>
    //         <input type='hidden' name='company'>
    //         <input type='button' name='favoritebtn' id='fbtn' value='☆'>
    //     </form>
    
    //     <script>
    //         let favoriteBtn = document.getElementById('fbtn');
    //         let fcnt = 0; // いいね数を管理
    //         let fbool = false; // いいねされているかのフラグ
        
    //         // ボタンがクリックされたときの処理
    //         favoriteBtn.addEventListener('click', function() {
    //             if (fbool) {
    //                 // いいねを減らす
    //                 fcnt--;
    //                 favoriteBtn.value = '☆'; // ボタンのテキストを「☆」に
    //                 favoriteBtn.classList.remove('liked'); // likedクラスを削除
    //             } else {
    //                 // いいねを増やす
    //                 fcnt++;
    //                 favoriteBtn.value = '★'; // ボタンのテキストを「★」に
    //                 favoriteBtn.classList.add('liked'); // likedクラスを追加
    //             }
        
    //             // いいね数を表示
    //             // document.getElementById('likecnt').textContent = fcnt;
        
    //             // いいね状態を切り替え
    //             fbool = !fbool;
    //         });
    //     </script>
    echo <<<___EOF
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
    <h4>所在地</h4>
    <p>$rec2[com_address]</p>

    <h4>メールアドレス</h4>
    <p>$rec2[com_mail]</p>

    <h4>電話番号</h4>
    <p>$rec2[com_tell]</p>

    ___EOF;

    echo "<h4>イベント情報</h4>";

    // null判定。tuleだと出力なし。
    if (empty($rec['event1'])) {
        echo "<p>イベントの予定はありません。</p>";
        // echo "<ul hidden>";
        // echo "<p hidden>$rec[event1]</p>";
        echo "</ul>";
    } else {
        // falseだとform　日付クリックでイベント予約に遷移
        echo "<ul>";
        // echo "<p>‣$rec[event1]</p>";

        //name = event で event1~3のどれかを送るようにする
        echo <<<___EOF
            <form action="../../komatsu/eventbooking.php" method="post">
                <input type="hidden" name="event" value="$rec[eventdata1]">
                <input type="hidden" name="com_id" value="$_SESSION[com_id]">
                <input type="hidden" name="eventid" value="event1">
                <p>$rec[event1]<input type="submit" name="submit" value = "$rec[eventdata1]"></p>
            </form>

         ___EOF;
        echo "</ul>";
    }
    if (!isset($rec['event2'])) {
        //↓いらない説
        // echo "<ul hidden>";
        // echo "<p hidden>$rec[event2]</p>";
        // echo "</ul>";
    } else {
        echo "<ul>";
        echo <<<___EOF
            <form action="../../komatsu/eventbooking.php" method="POST">
                <input type="hidden" name="delete" value="$rec[eventdata2]">
                <input type="hidden" name="com_id" value="$_SESSION[com_id]">
                <input type="hidden" name="eventid" value="event2">
                <p>$rec[event2]<input type="submit" name="submit" value = "$rec[eventdata2]"></p>
            </form>

         ___EOF;
        // echo "<p>‣$rec[event2]</p>";
        // echo "<a>$rec[eventdata2]</a>";
        echo "</ul>";
    }
    if (!isset($rec['event3'])) {
        //↓いらない説
        // echo "<ul hidden>";
        // echo "<p hidden>$rec[event3]</p>";
        // echo "</ul>";
    } else {
        echo "<ul>";
        echo <<<___EOF
            <form action="../../komatsu/eventbooking.php" method="post">
                <input type="hidden" name="event" value="$rec[eventdata3]">
                <input type="hidden" name="com_id" value="$_SESSION[com_id]">
                <input type="hidden" name="eventid" value="event3">
                <p>$rec[event3]<input type="submit" name="submit" value = "$rec[eventdata3]"></p>
            </form>

         ___EOF;
        // echo "<p>‣$rec[event3]</p>";
        // echo "<a>$rec[eventdata3]</a>";
        echo "</ul>";
    }

    echo <<<___EOF
    <form action="entry.php" method="post">
                <input type="hidden" name="entry" value="$rec[com_id]">
                <p><input type="submit" name="entry" value = "エントリーする！"></p>
            </form>
    ___EOF;

    echo "</div>";
    ?>
</body>

</html>