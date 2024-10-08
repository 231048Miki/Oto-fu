<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <style>
    .aaa {
      padding: 0.5em 1em;
      margin: 2em 0;
      font-weight: bold;
      border: 2px solid #000000;
      width: 100px;
      text-align: center;
      margin-left: 0;
    }
    .aaa p {
      margin: 0;
      padding: 0;
    }
    
    ul {
      list-style-type: none;
      padding: 0;
    }

    li {
      margin-bottom: 10px;
    }

    .company-details {
      border: 2px solid #000;
      padding: 2px;
      text-align: center;
      width: 190px;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
    }
    .company-details2 {
      position: fixed;
      left: 320px;
      top: 300px;
      border: 2px solid #000;
      padding: 2px;
      text-align: center;
      width: 190px;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
    }

    .event-container {
      display: flex;
      justify-content: center;
      margin-top: 30px;
    }

    .event-details {
      position: fixed;
      top: 300px;
      border: 2px solid #000;
      padding: 5px;
      text-align: center;
      width: 300px;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .button {
      position: fixed;
      bottom: 20px;
      left: 680px;
      transform: translateX(-50%);
      padding: 10px 20px;
      color: black;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      border: 2px solid #000000;
    }
  </style>
</head>
<body>
  <br><br><br><br>
  <div class="aaa">
    <p>予約画面</p>
  </div>

  <form method="POST">
    <?php
      include "../db_open.php";

      try {
        
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $sql = "SELECT com_name FROM company_table";
        $stmt = $dbh->query($sql);

        echo '<div class="company-details">';
        echo "<h4>会社名</h4>";
        echo "<ul>";
        $company_name = ''; 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<li>" . htmlspecialchars($row['com_name'], ENT_QUOTES, 'UTF-8') . "</li>";
          $company_name = $row['com_name']; 
        }
        echo "</ul>";
        echo '</div>';

        $sql_event_dates = "SELECT event_date FROM event_table";
        $stmt_event_dates = $dbh->query($sql_event_dates);
        echo '<div class="company-details2">';
        echo "<h4>イベント日付</h4>";
        echo "<ul>";
        $event_date_value = ''; // イベント日付を格納
        while ($row_event_dates = $stmt_event_dates->fetch(PDO::FETCH_ASSOC)) {
          echo "<li>" . htmlspecialchars($row_event_dates['event_date'], ENT_QUOTES, 'UTF-8') . "</li>";
          $event_date_value = $row_event_dates['event_date']; // ループ中の最後の値を取得
        }
        echo "</ul>";
        echo '</div>';

        $sql_events = "SELECT event1, event2, event3 FROM cominfo_table";
        $stmt_events = $dbh->query($sql_events);
        echo '<div class="event-container">';
        echo '<div class="event-details">';
        echo "<h4>イベント内容・詳細</h4>";
        $event_details_value = ''; 
        while ($row_events = $stmt_events->fetch(PDO::FETCH_ASSOC)) {
          echo "<p>" . htmlspecialchars($row_events['event1'], ENT_QUOTES, 'UTF-8') . "</p>";
          echo "<p>" . htmlspecialchars($row_events['event2'], ENT_QUOTES, 'UTF-8') . "</p>";
          echo "<p>" . htmlspecialchars($row_events['event3'], ENT_QUOTES, 'UTF-8') . "</p>";
          $event_details_value = $row_events['event1'] . ', ' . $row_events['event2'] . ', ' . $row_events['event3']; // 全体を結合
        }
        echo '</div>';
        echo '</div>';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          
          $com_name = $_POST['com_name'];
          $event_date = $_POST['event_date'];
          $event_details = $_POST['event_details'];

       
          $sql_insert = "INSERT INTO eventbooking_table (student_id, com_name, event_date, event_details) VALUES (NULL, :com_name, :event_date, :event_details)";
          $stmt_insert = $dbh->prepare($sql_insert);
          $stmt_insert->bindParam(':com_name', $com_name);
          $stmt_insert->bindParam(':event_date', $event_date);
          $stmt_insert->bindParam(':event_details', $event_details);
          $stmt_insert->execute();
        }

      } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
      }
    ?>

    
    <input type="hidden" name="com_name" value="<?php echo htmlspecialchars($company_name, ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="event_date" value="<?php echo htmlspecialchars($event_date_value, ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="event_details" value="<?php echo htmlspecialchars($event_details_value, ENT_QUOTES, 'UTF-8'); ?>">
    <button type="submit" class="button">予約</button>
  </form>

</body>
</html>
