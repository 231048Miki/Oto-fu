<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チャットルーム選択</title>
    <link rel="stylesheet" type="text/css" href="../css/chat_top.css">
    <link rel="stylesheet" href="../../iizuka/header.css">
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
                    echo "<a href='../../iizuka/php/com_top.php' class='web-name'>job hunting</a>";
                }
                ?>
            </h2>
            <div class="menu">
                <div id="nav-drawer">
                    <input id="nav-input" type="checkbox" class="nav-unshown">
                    <label id="nav-open" for="nav-input" class="nav-unshown"><span></span></label>
                    <label class="nav-unshown" id="nav-close" for="nav-input"></label>
                    <div id="nav-content">
                        <?php
                        if ($_SESSION['user_type'] == 'student') {
                            echo "<a href='../../shirasaki/mypage/mypage.php' class='header-nav'>マイページ</a><br>";
                        } else {
                            echo "<a href='../../iizuka/php/com_mypage.php' class='header-nav'>マイページ</a><br>";
                        }
                        ?>
                        <a onclick="history.back()" class="header-nav">戻る</a><br>
                        <a href="../../iizuka/logout.php" class="header-nav">ログアウト</a><br>
                    </div>
                    <nav id="desktop-menu">
                        <?php
                        if ($_SESSION['user_type'] == 'student') {
                            echo "<a href='../../shirasaki/mypage/mypage.php' class='header-nav'>マイページ</a>";
                        } else {
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

        if ($_SESSION['user_type'] == 'student') {
            $sql = "SELECT c.com_id, c.com_name FROM company_table AS c 
                    INNER JOIN eninfo_table AS e ON c.com_id = e.com_id 
                    WHERE e.stu_id = ?";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$_SESSION['stu_id']]);
        } else {
            $sql = "SELECT s.stu_id, s.stu_name, s.stu_school FROM student_table AS s 
                    INNER JOIN eninfo_table AS e ON s.stu_id = e.stu_id 
                    WHERE e.com_id = ?";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$_SESSION['com_id']]);
        }

        echo "<div class='chat-list'>";
        while ($row = $stmt->fetch()) {
            $id = htmlspecialchars($_SESSION['user_type'] == 'student' ? $row['com_id'] : $row['stu_id'], ENT_QUOTES, 'UTF-8');
            $name = htmlspecialchars($_SESSION['user_type'] == 'student' ? $row['com_name'] : $row['stu_name'], ENT_QUOTES, 'UTF-8');
            $info = isset($row['stu_school']) ? htmlspecialchars($row['stu_school'], ENT_QUOTES, 'UTF-8') : '';
            
            echo "<div class='chat-item'>";
            echo "<div class='chat-id'>ID: $id</div>";
            echo "<div class='chat-name'>Name: $name</div>";
            if ($info) {
                echo "<div class='chat-info'>School: $info</div>";
            }
            echo "<a class='chat-link' href='message.php?user_id=$id&name=$name'>Start Chat</a>";
            echo "</div>";
        }
        echo "</div>";
        ?>
    </div>
</body>
</html>
