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
$sql = "SELECT * FROM student_table WHERE stu_mail = :mail";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':mail', $mail);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// パスワード検証
if ($user && password_verify($pass, $user['stu_pass'])) {
    // ログイン成功
    session_start();
    $_SESSION['user_id'] = $user['stu_id'];
    $_SESSION['user_name'] = $user['stu_name'];
    $_SESSION['stu_id'] = $user['stu_id'];
    echo "ログイン成功！";
    //作成時用、実装時に削除
    echo $_SESSION['user_id'];
    echo "<a href='chat/chat_top.php'>チャット</a></center>";
    
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