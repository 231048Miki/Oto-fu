<?php
include "../db_open.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_date = $_POST['event_date'];
    $event_text = $_POST['event_text'];
    $event_company = $_POST['event_company'];
 
    $sql = "INSERT INTO event_table (event_date, event_text, event_company) VALUES (:event_date, :event_text, :event_company)";
    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(':event_date', $event_date, PDO::PARAM_STR);
    $stmt->bindParam(':event_text', $event_text, PDO::PARAM_STR);
    $stmt->bindParam(':event_company', $event_company, PDO::PARAM_STR);

    try {
        $stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit(); 
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}
?>

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
    .bbb textarea, .ccc textarea, .text textarea {
      border: 2px solid #000000;
      display: flex;
      justify-content: center;
      align-items: center; 
      text-align: center; 
    }
    .ccc {
      position: absolute;
      bottom: 280px;
      left: 370px;
    }
    .text {
      position: absolute;
      right: 400px;
      bottom: 128px;
    }
    .button {
      position: fixed;
      bottom: 20px;
      left: 700px;
      transform: translateX(-50%);
      padding: 20px 40px;
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

  <form action="" method="POST">
    <div class="bbb">
      <textarea name="event_company" placeholder="株式会社〇〇" cols="30" rows="7" required></textarea>
    </div>
    <div class="ccc">
      <textarea name="event_date" placeholder="〇月×日" cols="30" rows="5" required></textarea>
    </div>
    <div class="text">
      <textarea name="event_text" placeholder="イベント内容・詳細等" rows="11" cols="70" required></textarea>
    </div>
    <button type="submit" class="button">予約</button>
  </form>

</body>
</html>
