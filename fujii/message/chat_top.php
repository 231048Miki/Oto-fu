<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チャットルーム選択</title>
    <!-- CSSファイルを読み込む -->
    <link rel="stylesheet" type="text/css" href="../css/chat_top.css"> <!-- モバイル対応のCSS -->
    <!-- ヘッダー用のCSS -->
    <link rel="stylesheet" , href="../../iizuka/header.css">
</head>

<body>
    <header>
        <div class="header">
            <h2>
                <?php
                session_start();
                if ($_SESSION['user_type'] == 'student') {
                    echo "<a href='../../shirasaki/top/top.php' class='web-name'>job hunting</a>";

                } else {
                    echo "<a href='../../iizuka/php/com_top.php' class='web-name'>job hunting";

                }
                ?>
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

                        <?php
                        if ($_SESSION['user_type'] == 'student') {
                            //就活生でログインしているとき
                            echo "<a href='../../shirasaki/mypage/mypage.php' class='header-nav'>マイページ</a><br>";
                        } else {
                            //企業でログインしているとき
                            echo "<a href='../../iizuka/php/com_mypage.php' class='header-nav'>マイページ</a><br>";
                        }
                        ?>

                        <a onclick="history.back()" class="header-nav">戻る</a><br>
                        <a href="../../iizuka/logout.php" class="header-nav">ログアウト</a><br>
                    </div>

                    <!-- 通常メニュー -->
                    <nav id="desktop-menu">

                        <?php
                        if ($_SESSION['user_type'] == 'student') {
                            //就活生でログインしているとき
                            echo "<a href='../../shirasaki/mypage/mypage.php' class='header-nav'>マイページ</a>";
                        } else {
                            //企業でログインしているとき
                            echo "<a href='../../iizuka/php/com_mypage.php' class='header-nav'>マイページ</a>";
                        }
                        ?>

                        <a onclick="history.back()" class="header-nav">戻る</a>
                        <a href="../../iizuka/logout.php" class="header-nav" id="logout">ログアウト</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="page-container">
        <?php
        include '../db_open.php';
        // session_start();

        // SQLクエリを実行し、リンクを生成する関数
        function generateLinks($table, $idColumn, $nameColumn, $additionalInfo = '')
        {
            global $dbh; // $dbhを関数内で使用するためにglobal宣言
            $sql = "SELECT * FROM $table";
            $sql_res = $dbh->query($sql);

            echo "<div class='chat-list'>";  // CSSでデザインするためのクラス
            while ($rec = $sql_res->fetch()) {
                $id = htmlspecialchars($rec[$idColumn], ENT_QUOTES, 'UTF-8');
                $name = htmlspecialchars($rec[$nameColumn], ENT_QUOTES, 'UTF-8');
                $info = htmlspecialchars($additionalInfo ? $rec[$additionalInfo] : '', ENT_QUOTES, 'UTF-8');
                echo "<div class='chat-item'>";  // 個々のチャットリンク用のコンテナ
                echo "<div class='chat-id'>ID: $id</div>";
                echo "<div class='chat-name'>Name: $name</div>";
                if ($info) {
                    echo "<div class='chat-info'>School: $info</div>";  // 学校情報を表示する場合
                }
                echo "<a class='chat-link' href='message.php?user_id=$id&name=$name'>Start Chat</a>";  // チャットリンク
                echo "</div>";
            }
            echo "</div>";
        }

        // 学生か企業かで表示内容を切り替え
        if (isset($_SESSION['stu_id'])) {
            // 企業のリストを表示
            generateLinks('company_table', 'com_id', 'com_name');
        } else {
            // 学生のリストを表示
            generateLinks('student_table', 'stu_id', 'stu_name', 'stu_school');
        }
        ?>
    </div>
</body>

</html>