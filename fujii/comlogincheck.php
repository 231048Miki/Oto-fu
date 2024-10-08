<?php
include 'db_open.php';

// POSTメソッドでメールアドレスとパスワードを受け取る
if (!isset($_POST['mail']) || !isset($_POST['pass'])) {
    echo "<center><h1 class='log'>不正なアクセスです。</h1>";
    echo "<a href='login.php'>ログイン画面へ</a></center>";
    exit();
}

$mail = $_POST['mail'];
$pass = $_POST['pass'];

// ユーザーの認証
$sql = "SELECT * FROM company_table WHERE com_mail = :mail";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':mail', $mail);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// パスワード検証
if ($user && password_verify($pass, $user['com_pass'])) {
    // ログイン成功
    session_start();
    $_SESSION['user_id'] = $user['com_id'];
    $_SESSION['user_name'] = $user['com_name'];
    $_SESSION['com_id'] = $user['com_id'] ;
    $_SESSION['user_type'] = 'company';
    echo "ログイン成功！";
    echo "<a href='chat/chat_top.php'>チャットへ</a>";
    // 必要に応じてリダイレクト
    // header('Location: welcome.php');
    // exit;
} else {
    // ログイン失敗
    // echo var_dump($user);
    echo "メールアドレスまたはパスワードが正しくありません。";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";
}
?>