<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="stu_info_update.css">
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

    //idに基づいて表示
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location:");
        // セッション追加頼む
        exit();
    }
    function fileSave($com_name, $manager, $mail, $tell, $address,  $pass) {}

    // $userid = $_SESSION['id'];
    // include '../db_open.php';

    // $sql2 = "SELECT * FROM company_table WHERE com_id = $userid";
    // $sql_res2 = $dbh->query($sql2);
    // $rec2 = $sql_res2->fetch();

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        echo <<<___EOF___
            <form method="POST" enctype="multipart/form-data" class="stu_form">
            <input type="hidden" name="MAX_FILE_SIZE" value="1500000" /> 
            <h3>名前：<input type="text" name="name" value="{$rec2['stu_name']}" required></h3>
            <h3>メールアドレス：<input type="text" name="mail" value="{$rec2['stu_mail']}" required></h3>
            <h3>生年月日：<input type="text" name="birth" value="{$rec2['birth']}" required></h3>
            <h3>住所：<input type="text" name="address" value="{$rec2['stu_address']}" required></h3>
            <h3>電話番号：<input type="text" name="tell" value="{$rec2['stu_tell']}" required></h3>
            <h3>学校名：<input type="text" name="school" value="{$rec2['school']}" required></h3>
            <h3>パスワード：<input type="password" name="pass" value="{$rec2['pass']}" required></h3>
            <h3>再入力：<input type="password" name="pass" value="{$rec2['pass']}" required></h3>
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
        $sql = "SELECT * FROM student_table WHERE userid = $userid";
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