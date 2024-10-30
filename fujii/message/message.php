<?php
session_start();
// データベース接続
try {
    $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
    $user = 'pojobot_user';
    $password = 'Hirata317';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $destination_user_id = htmlspecialchars($_GET['user_id'], ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['user_id']; // 現在のユーザーIDを取得

    // メッセージを取得
    $sql = 'SELECT * FROM message WHERE (user_id = ? AND destination_user_id = ?) OR (user_id = ? AND destination_user_id = ?) ORDER BY created_at';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$user_id, $destination_user_id, $destination_user_id, $user_id]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    error_log('エラー発生: ' . $e->getMessage());
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>メッセージ</title>
    <link rel="stylesheet" href="../css/message.css"> <!-- CSSファイルのパスを指定 -->
    <style>
        .my_message {
            margin: 10px;
        }

        .mycomment {
            background-color: #D1F2EB;
            padding: 10px;
            border-radius: 5px;
        }

        .says {
            background-color: #F2F2F2;
            padding: 10px;
            border-radius: 5px;
        }

        .message_created_at {
            font-size: 0.8em;
            color: gray;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" , href="../../iizuka/header.css">
    <meta name="viewport" content="width=device-width" />
    <!-- Ajax対応のjs -->
    <script>
        $(document).ready(function() {
            const messagesContainer = $('#messages');
            const destinationUserId = <?= json_encode($destination_user_id); ?>;

            // スクロール位置のトラッキング
            let isScrollingUp = false;

            // メッセージをロードする関数
            function loadMessages() {
                $.ajax({
                    url: 'load_messages.php',
                    type: 'GET',
                    data: {
                        user_id: destinationUserId
                    },
                    success: function(data) {
                        messagesContainer.html(data);
                        // 自動スクロール処理
                        if (!isScrollingUp) {
                            messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
                        }
                    }
                });
            }

            // メッセージ表示初期化
            loadMessages();
            // 定期的にメッセージをロード
            setInterval(loadMessages, 2000);

            // メッセージ送信処理
            $('#message-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'send_message.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.status === 'success') {
                            $('textarea[name="text"]').val('');
                            loadMessages();
                        } else {
                            alert(result.message);
                        }
                    }
                });
            });

            // スクロール位置の監視
            messagesContainer.on('scroll', function() {
                const scrollTop = $(this).scrollTop();
                const scrollHeight = this.scrollHeight;
                const clientHeight = this.clientHeight;

                // スクロール位置が上部に近い場合
                if (scrollTop + clientHeight < scrollHeight - 50) {
                    isScrollingUp = true; // 上にスクロール中
                } else {
                    isScrollingUp = false; // 下にスクロール
                }
            });
        });
    </script>




</head>

<body>
    <header>
        <div class="header">
            <h2>

                <?php

                
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
    <h2>メッセージ</h2>
    <?php if (isset($_GET['name'])) {
    $name = $_GET['name'];
    echo  htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "さんとのチャットです";
} else {
    echo "Name parameter is not set.";
} ?>
    <div id="messages">
        <?php foreach ($messages as $message) : ?>
            <div class="my_message">
                <?php if ($message['stucom'] == 1) : // 学生からのメッセージ 
                ?>
                    <div class="mycomment right" style="text-align: right">
                        <p><?= htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') ?></p>
                        <span class="message_created_at"><?= htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                <?php else : // 企業からのメッセージ 
                ?>
                    <div class="says">
                        <p><?= htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') ?></p>
                        <span class="message_created_at"><?= htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <form id="message-form" action="send_message.php" method="post">
        <input type="hidden" name="destination_user_id" value="<?= htmlspecialchars($destination_user_id, ENT_QUOTES, 'UTF-8') ?>">
        <textarea name="text" required></textarea>
        <button type="submit">送信</button>
    </form>
</body>

</html>