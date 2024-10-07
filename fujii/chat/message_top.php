<?php
include '../db_open.php';
session_start();
//GETで送るユーザーidを送る

$sql = "SELECT * FROM company_table";
$sql_res = $dbh->query($sql);
while ($rec = $sql_res->fetch()) {
    //送信する相手のurl
    
    echo "<a href='message.php?user_id={$rec['com_id']}'>チャット</a> <br>";
   
}

// echo "<br>";
// echo "<a href='message.php'>チャット</a>";