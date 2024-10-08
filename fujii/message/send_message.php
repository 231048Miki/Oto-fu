<?php
session_start();

// フラッシュメッセージをセット
function set_flash($key, $message) {
    $_SESSION['flash'][$key] = $message;
}

define('ERR_MSG1', 'エラーが発生しました。もう一度お試しください。');

// メッセージ関係を確認する
function check_relation_message($user_id, $destination_user_id) {
    try {
        $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
        $user = 'fujii231109_user';
        $password = 'f21053879i';
        $dbh = new PDO($dsn, $user, $password);

        $sql = "SELECT user_id, destination_user_id FROM message_relation 
                WHERE (user_id = :user_id AND destination_user_id = :destination_user_id) 
                OR (user_id = :destination_user_id AND destination_user_id = :user_id)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':user_id' => $user_id, ':destination_user_id' => $destination_user_id));
        return $stmt->fetch();
    } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        set_flash('error', ERR_MSG1);
        exit;
    }
}

// 新たなメッセージ関係を挿入
function insert_message($user_id, $destination_user_id) {
    try {
        $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
        $user = 'fujii231109_user';
        $password = 'f21053879i';
        $dbh = new PDO($dsn, $user, $password);

        $sql = 'INSERT INTO message_relation(user_id, destination_user_id) VALUES (?, ?)';
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$user_id, $destination_user_id]);
    } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        set_flash('error', ERR_MSG1);
        exit;
    }
}

// メッセージ送信処理
try {
    $date = new DateTime();
    $date->setTimeZone(new DateTimeZone('Asia/Tokyo'));

    $message_text = htmlspecialchars($_POST['text'], ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['user_id']; // 現在のユーザーIDを取得
    $destination_user_id = htmlspecialchars($_POST['destination_user_id'], ENT_QUOTES, 'UTF-8');

    if (empty($message_text)) {
        set_flash('danger', 'メッセージ内容が未記入です');
        echo json_encode(['status' => 'error', 'message' => 'メッセージ内容が未記入です']);
        exit;
    }

    // チャット相手のタイプを判別しstucomを設定
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'student') {
        $stucom = 1; // 学生の場合
    } else {
        $stucom = 0; // 企業の場合
    }

    // DB接続と送られてきたデータを保存
    $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
    $user = 'fujii231109_user';
    $password = 'f21053879i';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO message (text, user_id, destination_user_id, created_at, stucom) VALUES (?, ?, ?, ?, ?)';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$message_text, $user_id, $destination_user_id, $date->format('Y-m-d H:i:s'), $stucom]);

    // メッセージ関係を確認し、存在しない場合は新しく追加
    if (!check_relation_message($user_id, $destination_user_id)) {
        insert_message($user_id, $destination_user_id);
    }

    // 成功時のJSONレスポンス
    echo json_encode(['status' => 'success', 'message' => 'メッセージを送信しました。']);
    exit;

} catch (Exception $e) {
    // 例外発生時のエラーメッセージ
    error_log('エラー発生: ' . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'エラーが発生しました。もう一度お試しください。']);
    exit;
}
