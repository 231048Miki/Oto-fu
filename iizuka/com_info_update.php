<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="com_info_update.css">
    <link rel="stylesheet" , href="header.css">
</head>

<body>
    <header>
        <div class="header">
            <h2 class="sns">job hunting</h2>
            <div class="menu">
                <a onclick="history.back(-1)" class="header-nav">戻る</a>
            </div>
        </div>
    </header>
    <h2 class="page-name">情報更新</h2>

    <?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location:");
        // セッション追加頼む
        exit();
    }
    function fileSave($com_name, $manager, $mail, $tell, $address,  $pass) {}

    $userid = $_SESSION['id'];
    include '../db_open.php';

    $sql2 = "SELECT * FROM company_table WHERE com_id = $userid";
    $sql_res2 = $dbh->query($sql2);
    $rec2 = $sql_res2->fetch();

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        echo <<<___EOF___
            <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="1500000" /> 
            <h3>企業名：<input type="text" name="com_name" value={$rec2['com_name']} required></h3>
            <h3>採用担当者名：<input type="text" name="cmanager" value={$rec2['manager']} required></h3>
            <h3>メールアドレス：<input type="text" name="mail" value={$rec2['mail']} required></h3>
            <h3>電話番号：<input type="text" name="tell" value={$rec2['tell']} required></h3>
            <h3>所在地：<input type="text" name="address" value={$rec2['address']} required></h3>
            <h3>パスワード：<input type="password" name="pass" value={$rec2['pass']} required></h3>
            <h3>再入力：<input type="password" name="pass" value={$rec2['pass']} required></h3>
            <input type="submit" value="更新">
        </form>
___EOF___;
    } else {
        $name = $_POST['name'];
        $manager = $_POST['manager'];
        $mail = $_POST['mail'];
        $tell = $_POST['tell'];
        $address = $_POST['address'];
        $pass = $_POST['pass'];

        {

        // エラー処理
        $sql = "SELECT * FROM user_table2 WHERE userid = $userid";
        $sql_res = $dbh->query($sql);

        if (mb_strlen($name) > 10) {
            echo "<script>";
            echo "alert('ユーザー名が長すぎます')";
            echo "</script>";
            echo '<script>location.href = "infoedit.php";</script>';
        } elseif (mb_strlen($mail) > 100) {
            echo "<script>";
            echo "alert('メールアドレスが長すぎます')";
            echo "</script>";
            echo '<script>location.href = "infoedit.php";</script>';
        } elseif (mb_strlen($pass) > 8) {
            echo "<script>";
            echo "alert('パスワードが長すぎます')";
            echo "</script>";
            echo '<script>location.href = "infoedit.php";</script>';
        } elseif (!preg_match('/^[a-zA-Z0-9@._-]+$/u', $mail)) {
            echo "<script>";
            echo "alert('無効な文字が含まれています')";
            echo "</script>";
            echo '<script>location.href = "infoedit.php";</script>';
        } elseif (!preg_match('/^[a-zA-Z0-9]+$/u', $pass)) {
            echo "<script>";
            echo "alert('無効な文字が含まれています')";
            echo "</script>";
            echo '<script>location.href = "infoedit.php";</script>';
        } elseif (!preg_match('/^[0-9\-]+$/', $tell)) {
            echo "<script>";
            echo "alert('無効な文字が含まれています')";
            echo "</script>";
            echo '<script>location.href = "infoedit.php";</script>';
        // } elseif ($filename && $sql_res) {
        //     $sql = "UPDATE user_table2 SET icon='{$filename}', username='{$name}', mail='{$mail}', birth='{$brith}', pass='{$pass}',  file_path='{$save_path}' where userid = $userid";
        //     $sql_res = $dbh->query($sql);
        //     echo "<script>";
        //     echo "alert('更新が完了しました')";
        //     echo "</script>";
        //     echo '<script>location.href = "setting.php";</script>';
        } elseif ($sql_res) {
            $sql = "UPDATE company_table SET com_name='{$name}', manager='{$manager}, mail='{$mail}', tell='{$tell}', address='{$address}, pass='{$pass}' where userid = $userid";
            $sql_res = $dbh->query($sql);
            echo "<script>";
            echo "alert('更新が完了しました。')";
            echo "</script>";
            echo '<script>location.href = "setting.php";</script>';
        }
    }
}
    ?>
</body>

</html>