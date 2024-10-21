<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="../css/com_info_update.css">
    <link rel="stylesheet" , href="../header.css">
    <meta name="viewport" content="width=device-width" />
    <title>企業情報更新</title>
</head>

<body>
    <header>
        <div class="header">
            <h2>
                <a href="com_top.php" class="web-name">job hunting</a>
            </h2>
            <div class="menu">
                <a href="./com_mypage.php" class="header-nav">戻る</a>
            </div>
        </div>
    </header>
    <h2 class="page-name">情報更新</h2>

    <?php
    session_start();

    if (!isset($_SESSION['login']) && !isset($_SESSION['com_id'])) {
        header("Location:../../fujii/login.php");
        exit();
    } else {
        // $userid = $_SESSION['com_id'];
        // echo $userid;  
    }
    function fileSave($com_name, $manager, $mail, $tell, $address,  $pass) {}

    //idに基づいて表示
    // $userid = $_SESSION['id'];
    include '../../db_open.php';

    $sql2 = "SELECT * FROM company_table WHERE com_id = $_SESSION[com_id]";
    $sql_res2 = $dbh->query($sql2);
    $rec2 = $sql_res2->fetch();

    $sql3 = "SELECT * FROM manager_table WHERE com_id = $_SESSION[com_id]";
    $sql_res3 = $dbh->query($sql3);
    $rec3 = $sql_res3->fetch();

    $count = "SELECT count(manager) as yes FROM manager_table where com_id = $_SESSION[com_id]";
    // echo $count;
    $count_res = $dbh->query($count);
    $crec = $count_res->fetch();
    // echo $crec['yes'];

    if ($crec['yes'] == 0) {

        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            echo <<<___EOF___
            <form method="POST" action="" class="com_form">
            <h3>企業名：<input type="text" name="com_name" value="{$rec2['com_name']}" required></h3>
            <h3>採用担当者名：<input type="text" name="manager" value="" required></h3>
            <h3>メールアドレス：<input type="text" name="mail" value="{$rec2['com_mail']}" required></h3>
            <h3>電話番号：<input type="text" name="tell" value="{$rec2['com_tell']}" required></h3>
            <h3>所在地：<input type="text" name="address" value="{$rec2['com_address']}" required></h3>
            <input type="submit" value="更新">
        </form>
        
___EOF___;
        } else {
            $name = $_POST['com_name'];
            $manager = $_POST['manager'];
            $mail = $_POST['mail'];
            $tell = $_POST['tell'];
            $address1 = $_POST['address'];
            // $pass = $_POST['pass'];
             {

                // エラー処理
                $sql = "SELECT * FROM company_table WHERE com_id = $_SESSION[com_id]";
                $sql_res = $dbh->query($sql);

                if(strlen($name) > 100 && strlen($name) != 0){
                    //文字数の判定
                    echo "企業名が不適切な形式です";
                    echo "<div class='back'>";
                    echo "<a onclick='history.back(-1)'>戻る</a>";
                    echo "</div>";
                }elseif(strlen($mail) > 100 && strlen($mail) != 0){    
                    echo "メールアドレスが不適切な形式です";
                    echo "<div class='back'>";
                    echo "<a onclick='history.back(-1)'>戻る</a>";
                    echo "</div>";
                }elseif(strlen($address1) > 100 && strlen($address1) != 0){
                    echo "所在地が不適切な形式です";
                    echo "<div class='back'>";
                    echo "<a onclick='history.back(-1)'>戻る</a>";
                    echo "</div>";
                }elseif ($sql_res) {
                    $sql1 = "UPDATE company_table SET com_name='{$name}', com_mail='{$mail}', com_tell='{$tell}', com_address='{$address1}' WHERE com_id = {$_SESSION['com_id']}";

                    // echo $sql1;
                    $sql_res1 = $dbh->query($sql1);

                    $sql2 = "INSERT INTO manager_table (com_id, manager) VALUES ({$_SESSION['com_id']}, '{$manager}')";
                    echo $sql2;
                    $sql_res2 = $dbh->query($sql2);

                    echo "<script>";
                    echo "alert('更新が完了しました。')";
                    echo "</script>";
                    echo '<script>location.href = "com_info_update.php";</script>';
                }
            }
        }
    } else {
        echo <<<___EOF___
            <form method="POST" action="info.php" class="com_form">
            <h3>企業名：<input type="text" name="com_name" value="{$rec2['com_name']}" required></h3>
            <h3>採用担当者名：<input type="text" name="manager" value="{$rec3['manager']}" required></h3>
            <h3>メールアドレス：<input type="text" name="mail" value="{$rec2['com_mail']}" required></h3>
            <h3>電話番号：<input type="text" name="tell" value="{$rec2['com_tell']}" required></h3>
            <h3>所在地：<input type="text" name="address" value="{$rec2['com_address']}" required></h3>
            <input type="submit" value="更新">
        </form>
        
___EOF___;
    }
    // <h3>パスワード：<input type="password" name="pass" value="{$rec2['pass']}" required></h3>
    // <h3>再入力：<input type="password" name="pass" value="{$rec2['pass']}" required></h3>
    ?>
</body>

</html>