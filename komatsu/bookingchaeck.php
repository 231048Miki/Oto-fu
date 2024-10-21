<?php
include "../db_open.php";
$com_id = $_POST['com_id'];
$stu_id = $_POST['stu_id'];
//イベント名などあればそれに変更する
$event = $_POST['event'];
echo $com_id;
echo $stu_id;
echo $event;

 
    $sql_insert = "INSERT INTO eventbooking_table (stu_id , com_id , EventData) VALUES ( :stu_id, :com_id, CURRENT_DATE)";
    $stmt_insert = $dbh->prepare($sql_insert);
    $stmt_insert->bindParam(':stu_id', $stu_id, PDO::PARAM_INT);
    $stmt_insert->bindParam(':com_id', $com_id, PDO::PARAM_INT);
    $stmt_insert->execute();

    echo "<script>alert('予約しました。'); window.location.href = '../iizuka/php/detail.php';</script>";