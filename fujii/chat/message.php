<?php
// 学生用のチャット画面
session_start();

// ログインしているユーザーの情報を取得
function get_user() {
    if (isset($_SESSION["stu_id"])) {
        return get_student_by_id($_SESSION["stu_id"]);
    } elseif (isset($_SESSION["com_id"])) {
        return get_company_by_id($_SESSION["com_id"]);
    }
    return null;
}

// 学生の情報を取得
function get_student_by_id($stu_id) {
    try {
        $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
        $user = 'fujii231109_user';
        $password = 'f21053879i';
        $dbh = new PDO($dsn, $user, $password);
        $sql = "SELECT * FROM student_table WHERE stu_id = :stu_id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':stu_id' => $stu_id));
        return $stmt->fetch();
    } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        return false;
    }
}

// 企業の情報を取得
function get_company_by_id($com_id) {
    try {
        $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
        $user = 'fujii231109_user';
        $password = 'f21053879i';
        $dbh = new PDO($dsn, $user, $password);
        $sql = "SELECT * FROM company_table WHERE com_id = :com_id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':com_id' => $com_id));
        return $stmt->fetch();
    } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        return false;
    }
}

// チャット相手の情報を取得
function get_destination_user($destination_user_id) {
    if (isset($_SESSION["com_id"])) {
        return get_student_by_id($destination_user_id);
    } elseif (isset($_SESSION["stu_id"])) {
        return get_company_by_id($destination_user_id);
    }
    return null;
}

// メッセージを取得
function get_messages($user_id, $destination_user_id) {
    try {
        $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
        $user = 'fujii231109_user';
        $password = 'f21053879i';
        $dbh = new PDO($dsn, $user, $password);
        $sql = "SELECT * FROM message
                WHERE (user_id = :user_id AND destination_user_id = :destination_user_id)
                   OR (user_id = :destination_user_id AND destination_user_id = :user_id)
                ORDER BY created_at ASC";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':user_id' => $user_id, ':destination_user_id' => $destination_user_id));
        return $stmt->fetchAll();
    } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        return [];
    }
}

// ログインしているユーザーを取得
$current_user = get_user();
if (!$current_user) {
    echo "ユーザー情報が取得できませんでした。";
    exit;
}

// チャット相手のユーザーIDを取得
$destination_user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
if (!$destination_user_id) {
    echo "送信先のユーザーが指定されていません。";
    exit;
}

// チャット相手の情報を取得
$destination_user = get_destination_user($destination_user_id);
if (!$destination_user) {
    echo "送信先のユーザー情報が取得できませんでした。";
    exit;
}

// メッセージを取得
$messages = get_messages($current_user['stu_id'] ?? $current_user['com_id'], $destination_user_id);

// 名前を表示する部分（学生なら stu_name、企業なら com_name）
?>
<h2 class="center">
  「<?= isset($destination_user['stu_name']) ? $destination_user['stu_name'] : (isset($destination_user['com_name']) ? $destination_user['com_name'] : '不明なユーザー') ?>」さんとのチャット
</h2>

<?php foreach ($messages as $message) : ?>
    <div class="my_message">
        <?php if ($message['user_id'] == $current_user['stu_id'] || $message['user_id'] == $current_user['com_id']) : ?>
            <!-- 現在のユーザーからのメッセージを表示 -->
            <div class="mycomment right" style="text-align: right">
                <p><?= htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') ?></p>
                <span class="message_created_id"><?= convert_to_fuzzy_time($message['created_at']) ?></span>
            </div>
        <?php else : ?>
            <!-- 他のユーザーからのメッセージを表示 -->
            <div class="says"><?= htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') ?>
                <span class="message_created_at"><?= convert_to_fuzzy_time($message['created_at']) ?></span>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<!-- メッセージ送信フォーム -->
<div class="message_process">
    <h2 class="message_title">メッセージ</h2>
    <form method="post" action="message_add.php" enctype="multipart/form-data">
        <textarea class="textarea form-control" placeholder="メッセージを入力ください" name="text" oninput="checkLength(this)" maxlength="1000" required></textarea>
        <input type="hidden" name="destination_user_id" value="<?= $destination_user_id ?>">
        <div class="message_btn">
            <button class="btn btn-outline-primary" type="submit" name="post" value="post" id="post">投稿</button>
        </div>
    </form>
</div>

<a href="chat_top.php">←</a>
</body>
</html>
<?php
var_dump($destination_user);
