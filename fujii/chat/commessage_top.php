<?php
include '../db_open.php';
session_start();
//GETで送るユーザーidを送る

$sql = "SELECT * FROM student_table";
$sql_res = $dbh->query($sql);
while ($rec = $sql_res->fetch()) {
    //送信する相手のurl
    echo "$rec[stu_id]";
    echo "<a href='commessage.php?user_id={$rec['stu_id']}'>チャット</a> <br>";
    

    
}

// echo "<br>";
// echo "<a href='message.php'>チャット</a>";