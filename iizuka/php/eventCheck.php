<?PHP 
include("../../db_open.php");
session_start();
$com_id = $_SESSION['com_id'];
if(isset($_POST['deleteEventName'])){
    $sql_events = "DELETE FROM eventbooking_table WHERE com_id = :com_id AND event_name = :event_name";
    $stmt = $dbh->prepare($sql_events);
    $stmt->bindParam(':com_id', $com_id, PDO::PARAM_INT);
    $stmt->bindParam(':event_name', $_POST['deleteEventName'], PDO::PARAM_INT);
    $stmt->execute();
}
$alert_handle = $dbh->query("UPDATE alert SET flag=0 WHERE alert_kind = 'event_alert' AND com_id={$com_id}");
$alert_handle->execute();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" , href="eventCheck.css">
    </head>
<body>
    <div class="flex">
    <h2>開催イベント状況(参加者０名のイベントは表示されません)</h2>
    <button onclick="location.href='com_mypage.php'" class="btn">もどる</button>
    </div>
    <div class="flex">
<?php 
//企業IDで絞る-> イベントの名前ごとにイベント名と予約の件数をcountで取り出す
$sql_events = "SELECT  event_name,EventData,COUNT(DISTINCT stu_id)as '予約人数'  FROM eventbooking_table WHERE com_id = :com_id  GROUP BY event_name";
$stmt = $dbh->prepare($sql_events);
$stmt->bindParam(':com_id', $com_id, PDO::PARAM_INT);
$stmt->execute();
while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='event'>";
    echo "<p>開催イベント名：" . htmlspecialchars($event['event_name'], ENT_QUOTES, 'UTF-8') . "</p>";
    echo "<p>開催日時：" . htmlspecialchars($event['EventData'], ENT_QUOTES, 'UTF-8') . "</p>";
    echo "<p>参加予約人数：" . htmlspecialchars($event['予約人数'], ENT_QUOTES, 'UTF-8') . "</p>";

    //イベント名に対して、そのイベントに参加している学生の名前を複数取得。 同じ名前のイベント名が存在する可能性を考慮して企業IDでも絞り込む処理
    $get_stu_name = $dbh->prepare("SELECT  DISTINCT stu_name FROM eventbooking_table JOIN student_table WHERE event_name = :event_name AND  com_id = :com_id   AND eventbooking_table.stu_id = student_table.stu_id");
    $get_stu_name->bindParam(':event_name', $event['event_name'], PDO::PARAM_INT);
    $get_stu_name->bindParam(':com_id', $com_id, PDO::PARAM_INT);
    $get_stu_name->execute();
    echo "<h4>参加予定者</h4><ul>";
    while ($stu_name =  $get_stu_name->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . htmlspecialchars($stu_name['stu_name'], ENT_QUOTES, 'UTF-8') . "</li>";
    }
    echo"<form method='post' action=''>
    <input type='hidden' name='deleteEventName' value={$event['event_name']}>
        <input type='submit' value=イベント終了>
    </form>";
    echo"</ul>";
    echo"</div>";
  }

  

  ?>
    </div>
  </body>
  </html>