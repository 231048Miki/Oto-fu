<?php
session_start();

include "../../db_open.php";

if (!isset($_SESSION['login']) && !isset($_SESSION['com_id'])) {
    header("Location:../../fujii/login.php");
    exit();
} else {
    //   $userid = $_SESSION['com_id'];
    // echo $userid;  
}

$name = $_POST['com_name'];
$manager = $_POST['manager'];
$mail = $_POST['mail'];
$tell = $_POST['tell'];
$address1 = $_POST['address']; {

    // エラー処理
    $sql = "SELECT * FROM company_table WHERE com_id = $_SESSION[com_id]";
    $sql_res = $dbh->query($sql);

    if (strlen($name) > 100 && strlen($name) != 0) {
        //文字数の判定
        echo "企業名が不適切な形式です";
        echo "<div class='back'>";
        echo "<a onclick='history.back(-1)'>戻る</a>";
        echo "</div>";
    } elseif (strlen($mail) > 100 && strlen($mail) != 0) {
        echo "メールアドレスが不適切な形式です";
        echo "<div class='back'>";
        echo "<a onclick='history.back(-1)'>戻る</a>";
        echo "</div>";
    } elseif (strlen($address1) > 100 && strlen($address1) != 0) {
        echo "所在地が不適切な形式です";
        echo "<div class='back'>";
        echo "<a onclick='history.back(-1)'>戻る</a>";
        echo "</div>";
    } elseif ($sql_res) {
        $sql1 = "UPDATE company_table SET com_name='{$name}', com_mail='{$mail}', com_tell='{$tell}', com_address='{$address1}' WHERE com_id = {$_SESSION['com_id']}";
        $sql_res1 = $dbh->query($sql1);

        $sql2 = "UPDATE manager_table SET manager = '{$manager}' where com_id = $_SESSION[com_id]";
        $sql_res2 = $dbh->query($sql2);
        echo "<script>";
        echo "alert('更新が完了しました。')";
        echo "</script>";
        echo '<script>location.href = "com_info_update.php";</script>';
    }
}
