<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="../header.css">
    <link rel="stylesheet" , href="../css/NGword_in.css">
    <meta name="viewport" content="width=device-width" />
    <title>NGワード追加</title>
</head>

<body>
    <div class="header">
        <h2>
            <a href="com_top.php" class="web-name">job hunting</a>
        </h2>
        <div class="menu">
            <a onclick="history.back(-1)" class="header-nav">戻る</a>
        </div>
    </div>
    <h2>ブロックワード追加</h2>
    <?php
    include '../../db_open.php';

    $sql2 = "SELECT * FROM ngword_table";
    $sql_res2 = $dbh->query($sql2);
    $rec2 = $sql_res2->fetch();

    echo <<<___EOF

        <div class="form">
            <form method="POST" class="ng_form" action="">
                <h3>ブロックワード：<input type="text" name="ngword" value="" required></h3>
                <input type="submit" value="追加" class="button">
            </form>
            </div>
        ___EOF;

    if (isset($_POST['ngword'])) {
        $word = $_POST['ngword'];
        $sql = "INSERT INTO ngword_table (ngword) VALUES ('$word')";
        $sql_res = $dbh->query($sql);

        echo <<<___EOF
        <script>alert('追加されました！！')</script>
        <script>location.href = "";</script>
        ___EOF;
    }
    ?>
</body>

</html>