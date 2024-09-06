<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="header.css">
    <link rel="stylesheet" , href="NGword_update.css">
    <!-- <title>NGワード一覧</title> -->
</head>

<body>
    <div class="header">
        <h2 class="sns" onclick="適当にいれてね">job hunting</h2>
        <div class="menu">
            <a onclick="history.back(-1)" class="header-nav">戻る</a>
        </div>
    </div>
    <h2>ブロックワード更新</h2>
    <?php
    include '../db_open.php';

    if(isset($_POST['update'])){
    $id = $_POST['update'];

    $sql = "SELECT * FROM ngword_table where ngword_id = $id";
    $sql_res = $dbh->query($sql);
    $rec = $sql_res->fetch();

    echo <<<___EOF
    <div class="form">
        <form class='form-up' action="" method="post">
            <input type='text' name='up' value='$rec[ngword]'>
            <input type='hidden' name='id' value='$id'>
            <input type="submit" name="submit" value = "更新" class="trash">
        </form>
    </div>
    ___EOF;
    }
    // echo $id;
    // echo "<input type='hidden' name='update' value='$_POST[$id]'>";

    if (isset($_POST["up"])) {
        $sql2 = "UPDATE ngword_table SET ngword='$_POST[up]' where ngword_id = $_POST[id]";
        $sql_res2 = $dbh->query($sql2);

        echo <<<___EOF
        <script>alert('更新されました！！')</script>
        <script>location.href = "NGword_list.php";</script>
        ___EOF;
    }
    ?>
</body>

</html>