<?php
include '../db_open.php';
session_start();
//GETで送るユーザーidを送る
if(isset($_SESSION['stu_id'])){
$sql = "SELECT * FROM company_table";
$sql_res = $dbh->query($sql);
while ($rec = $sql_res->fetch()) {
    //送信する相手のurl
    
    echo "<a>ID $rec[com_id]</a>";
    echo "<a>Company Name $rec[com_name]</a>";
    echo "<a href='message.php?user_id={$rec['com_id']}'>チャット</a> <br>";
   
}
}else{
    
    $sql = "SELECT * FROM student_table";
    $sql_res = $dbh->query($sql);
    while ($rec = $sql_res->fetch()) {
    //送信する相手のurl
    
    echo "<a>ID $rec[stu_id]</a>";
    echo "<a>Student Name $rec[stu_name]</a>";
    echo "<a href='message.php?user_id={$rec['stu_id']}'>チャット</a> <br>";
   
}

}