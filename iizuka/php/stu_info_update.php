<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="../css/stu_info_update.css">
    <!-- <link rel="stylesheet" , href="../header.css"> -->
    <title>学生情報更新</title>
</head>

<body>
    <header>
        <div class="header">
            <h2>
                <div class="banner">
                    <button class="btn-gradient-3d-simple" onclick="location.href='../../shirasaki/top/top.php'">job hunting</button>
                    <button class="btn-gradient-3d-simple" onclick="history.back()">戻る</button>
                </div>
            </h2>
            <!-- <div class="menu">
                <a onclick="history.back(-1)" class="header-nav">戻る</a>
            </div> -->
        </div>
    </header>

    <div class="title">
        <h2>情報更新</h2>
    </div>

    <?php
    session_start();

    if (!isset($_SESSION['login']) && !isset($_SESSION['com_id'])) {
        header("Location:../../fujii/login.php");
        // セッション追加頼む
        exit();
    } else {
        $userid = $_SESSION['stu_id'];
        // echo $userid;  
    }
    // $userid = $_SESSION["com_id"];
    // echo $_SESSION["com_id"];

    include '../../db_open.php';
    function fileSave($stu_name, $stu_address, $stu_school, $stu_tell, $stu_mail, $stu_pass) {}

    // $userid = $_SESSION['id'];

    $sql2 = "SELECT * FROM student_table WHERE stu_id = $_SESSION[stu_id]";
    $sql_res2 = $dbh->query($sql2);
    $rec2 = $sql_res2->fetch();

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        echo <<<___EOF___
            <form method="POST" action="" class="stu_form"> 
            <h3>名前：<input type="text" name="name" value="{$rec2['stu_name']}" required></h3>
            <h3>メールアドレス：<input type="text" name="mail" value="{$rec2['stu_mail']}" required></h3>
            <h3>生年月日：<input type="text" name="birth" value="{$rec2['birth']}" required></h3>
            <h3>住所：<input type="text" name="address" value="{$rec2['stu_address']}" required></h3>
            <h3>電話番号：<input type="text" name="tell" value="{$rec2['stu_tell']}" required></h3>
            <h3>学校名：<input type="text" name="school" value="{$rec2['stu_school']}" required></h3>
            <input type="submit" value="更新">
        </form>
___EOF___;
        // <h3>パスワード：<input type="password" name="pass" value="{$rec2['stu_pass']}" required></h3>
        // <h3>再入力：<input type="password" name="pass" value="{$rec2['stu_pass']}" required></h3>
    } else {
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $birth = $_POST['birth'];
        $address = $_POST['address'];
        $tell = $_POST['tell'];
        $school = $_POST['school']; {

            // エラー処理
            $sql = "SELECT * FROM student_table WHERE stu_id = $userid";
            $sql_res = $dbh->query($sql);

            if (strlen($name) > 100 && strlen($name) != 0) {
                //文字数の判定
                echo "名前が不適切な形式です";
                echo "<div class='back'>";
                echo "<a onclick='history.back(-1)'>戻る</a>";
                echo "</div>";
            } elseif (strlen($mail) > 100 && strlen($mail) != 0) {
                echo "メールアドレスが不適切な形式です";
                echo "<div class='back'>";
                echo "<a onclick='history.back(-1)'>戻る</a>";
                echo "</div>";
            } elseif (strlen($address) > 100 && strlen($address) != 0) {
                echo "住所が不適切な形式です";
                echo "<div class='back'>";
                echo "<a onclick='history.back(-1)'>戻る</a>";
                echo "</div>";
            } elseif (strlen($school) > 100 && strlen($school) != 0) {
                echo "学校名が不適切な形式です";
                echo "<div class='back'>";
                echo "<a onclick='history.back(-1)'>戻る</a>";
                echo "</div>";
            } elseif ($sql_res) {
                $sql = "UPDATE student_table SET stu_name='{$name}',stu_mail='{$mail}',birth='{$birth}' ,stu_tell='{$tell}', stu_address='{$address}',stu_school='{$school}' where stu_id = $userid";
                echo $sql;
                $sql_res = $dbh->query($sql);
                echo "<script>";
                echo "alert('更新が完了しました。')";
                echo "</script>";
                echo '<script>location.href = "";</script>';
            }
        }
    }
    ?>
</body>

</html>