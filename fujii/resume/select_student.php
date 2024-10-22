<?php
session_start();
include '../db_open.php';
//trust me;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>公開者選択</title>
</head>
<body>
    <main>
        <?php 
        $sql="SELECT resume_id FROM resume_table WHERE public = 1";
        $sql_res = $dbh->query($sql);
        while($rec = $sql_res->fetch() ){
            $resume_id=$rec['resume_id'];
            echo "<a href='resume_detail.php?resume_id=$resume_id'>履歴書ID:$resume_id</a>";
            echo "<br>";
            
        }
        
        ?>
            
    </main>
</body>
</html>