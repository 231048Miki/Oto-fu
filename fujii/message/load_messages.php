<?php
session_start();
$destination_user_id = htmlspecialchars($_GET['user_id'], ENT_QUOTES, 'UTF-8');
$user_id = $_SESSION['user_id'];

// DB接続
try {
    $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
    $user = 'fujii231109_user';
    $password = 'f21053879i';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // メッセージを取得
    $sql = 'SELECT * FROM message WHERE (user_id = ? AND destination_user_id = ?) OR (user_id = ? AND destination_user_id = ?) ORDER BY created_at';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$user_id, $destination_user_id, $destination_user_id, $user_id]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // メッセージをHTML形式で返す
    foreach ($messages as $message) {
        if ($message['stucom'] == 1) {
            echo "<div class='mycomment right' style='text-align: right'><p>" . htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') . "</p><span class='message_created_at'>" . htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') . "</span></div>";
        } else {
            echo "<div class='says'><p>" . htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') . "</p><span class='message_created_at'>" . htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') . "</span></div>";
        }
    }
} catch (Exception $e) {
    error_log('エラー発生: ' . $e->getMessage());
    exit;
}
