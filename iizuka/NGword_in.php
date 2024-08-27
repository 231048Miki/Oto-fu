<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" , href="header.css">
</head>

<body>
    <h2>ブロックワード追加</h2>
    <?php
    include '../db_open.php';

    // $sql2 = "SELECT * FROM ngword_table";
    // $sql_res2 = $dbh->query($sql2);
    // $rec2 = $sql_res2->fetch();

    echo <<<___EOF
        <form method="POST" enctype="multipart/form-data" class="ng_form" action="">
            <input type="hidden" name="MAX_FILE_SIZE" value="1500000" /> 
            <h3>ブロックワード：<input type="text" name="word" value="" required></h3>
            <input type="submit" value="追加">
        </form>
        ___EOF;

        $word = $_POST['word'];

        $sql = "INSERT INTO ngword_table (ngword) VALUES ('$word')";
        $sql_res = $dbh->query($sql);

    ?>
</body>
</html>