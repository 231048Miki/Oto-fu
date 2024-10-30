<?php
include "../db_open.php";
$com_id = $_POST['com_id'];
$stu_id = $_POST['stu_id'];
//イベント名などあればそれに変更する
$event = $_POST['event'];//文字列"event1"とか
$eventname = $_POST['eventname'];//
$eventdata = $_POST['eventdata'];//イベントの開催日

echo $com_id;
echo $stu_id;
echo $event;//eventの番号
echo $eventname;//eventなまえ
echo $eventdata;//eventひずけ
 try{
    $sql_insert = "INSERT INTO eventbooking_table (stu_id , com_id ,event_name,EventData) VALUES ( :stu_id, :com_id,:event_name,:event_data)";
    $stmt_insert = $dbh->prepare($sql_insert);
    $stmt_insert->bindParam(':stu_id', $stu_id, PDO::PARAM_INT);
    $stmt_insert->bindParam(':com_id', $com_id, PDO::PARAM_INT);
    $stmt_insert->bindParam(':event_name',  $eventname, PDO::PARAM_STR);
    $stmt_insert->bindParam(':event_data',  $eventdata, PDO::PARAM_STR);
    $stmt_insert->execute();
 }catch(Exception $e){
    echo "予約済み";
 }

    // echo "<script>alert('予約しました。'); window.location.href = '../iizuka/php/detail.php';</script>";
    ?>
         
        <form method="POST" action="../shirasaki/top/top.php">
        <input type="hidden" name="eventDate" value=<?php echo $eventdata ?>>
        <input type="hidden" name="eventText" value=<?php echo $eventname ?>>
        <input type="submit" value="予約完了">
        </form>

