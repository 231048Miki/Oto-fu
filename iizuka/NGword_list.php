<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="header.css">
    <link rel="stylesheet" , href="NGword_list.css">
    <!-- <title>NGワード一覧</title> -->
</head>

<body>
    <div class="header">
        <h2>
            <a href="login.php" class="web-name">job hunting</a>
        </h2>
        <div class="menu">
            <a onclick="history.back(-1)" class="header-nav">戻る</a>
        </div>
    </div>
    <h2>ブロックワード一覧</h2>
    <?php
    include '../db_open.php';

    $sql = "SELECT * FROM ngword_table";
    $sql_res = $dbh->query($sql);

    while ($rec = $sql_res->fetch()) {
        $id = $rec['ngword_id'];
        echo <<<___EOF
        <div class='center'>
            <h2 class="form-p">$rec[ngword]</h2>
            <div class="flex">
                <div class="form">
                    <form action="" method="post">
                        <input type="hidden" name="delete" value="$rec[ngword_id]">
                        <input type="submit" name="submit" value = "削除" class="button">
                    </form>
                </div>

                <div class="form">
                    <form action="NGword_update.php" method="POST">
                        <input type="hidden" name="update" value="$id">
                        <input type="submit" value="更新" class="button">
                    </form>
                </div>
            </div>
        </div>
     ___EOF;
    }

    if (isset($_POST["delete"])) {
        $sql2 = "DELETE FROM ngword_table WHERE ngword_id = $_POST[delete]";
        $sql_res2 = $dbh->query($sql2);
        // echo $sql2;
        // $rec2 = $sql_res2->fetch()

        echo <<<___EOF
        <script>alert('削除されました！！')</script>
        <script>location.href = "";</script>
        ___EOF;
    }

    ?>
</body>

</html>