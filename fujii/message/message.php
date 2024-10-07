<?php
session_start();

// データベース接続
try {
    $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
    $user = 'fujii231109_user';
    $password = 'f21053879i';
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

// メッセージ表示部分
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メッセージ</title>
    <style>
        .my_message { margin: 10px; }
        .mycomment { background-color: #D1F2EB; padding: 10px; border-radius: 5px; }
        .says { background-color: #F2F2F2; padding: 10px; border-radius: 5px; }
        .message_created_at { font-size: 0.8em; color: gray; }
    </style>
</head>
<body>
    <h2>メッセージ</h2>
    <?php foreach ($messages as $message) : ?>
        <div class="my_message">
            <?php if ($message['stucom'] == 1) : // 学生からのメッセージ ?>
                <div class="mycomment right" style="text-align: right">
                    <p><?= htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') ?></p>
                    <span class="message_created_at"><?= htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') ?></span>
                </div>
            <?php else : // 企業からのメッセージ ?>
                <div class="says">
                    <p><?= htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') ?></p>
                    <span class="message_created_at"><?= htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') ?></span>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <form action="send_message.php" method="post">
        <input type="hidden" name="destination_user_id" value="<?= htmlspecialchars($destination_user_id, ENT_QUOTES, 'UTF-8') ?>">
        <textarea name="text" required></textarea>
        <button type="submit">送信</button>
    </form>
</body>
</html>
