<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <style>
    .a {
      position: relative;
      bottom: 50px;
      left: 350px;
      margin: 17px 10px 10px 10px;
      border: 1px solid #afadad;
      padding: 8px;
    }
    .b {
      position: absolute;
      right: 350px;
      top: 68px;
    }
    .c, .d, .e, .f, .g, .h, .i {
      position: absolute;
      right: 350px;
    }
    .c { bottom: 450px; }
    .d { bottom: 390px; }
    .e { bottom: 330px; }
    .f { bottom: 270px; }
    .g { bottom: 210px; }
    .h { bottom: 150px; }
    .i { bottom: 93px; }
    .update-button {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      padding: 10px 20px;
      color: black;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    .update-button:hover {
      background-color: whitesmoke;
    }
  </style>
</head>

就活アプリ<br>
ページ編集ホーム
</head><br><br><br>
<body>

<form method="POST" action="">
  <div class="a" style="border: 2px solid; width: 150px;">
    <center>企業理念</center>
  </div>
  <div class="b">
    <textarea name="message1" rows="3" cols="50"></textarea>
  </div>

  <div class="a" style="border: 2px solid; width: 150px;">
    <center>給与</center>
  </div>
  <div class="c">
    <textarea name="message2" rows="3" cols="50"></textarea>
  </div>

  <div class="a" style="border: 2px solid; width: 150px;">
    <center>先輩社員の声</center>
  </div>
  <div class="d">
    <textarea name="message3" rows="3" cols="50"></textarea>
  </div>

  <div class="a" style="border: 2px solid; width: 150px;">
    <center>フリースペース１</center>
  </div>
  <div class="e">
    <textarea name="message4" rows="3" cols="50"></textarea>
  </div>

  <div class="a" style="border: 2px solid; width: 150px;">
    <center>フリースペース２</center>
  </div>
  <div class="f">
    <textarea name="message5" rows="3" cols="50"></textarea>
  </div>

  <div class="a" style="border: 2px solid; width: 150px;">
    <center>イベント情報１</center>
  </div>
  <div class="g">
    <textarea name="message6" rows="3" cols="50"></textarea>
  </div>

  <div class="a" style="border: 2px solid; width: 150px;">
    <center>イベント情報２</center>
  </div>
  <div class="h">
    <textarea name="message7" rows="3" cols="50"></textarea>
  </div>

  <div class="a" style="border: 2px solid; width: 150px;">
    <center>イベント情報３</center>
  </div>
  <div class="i">
    <textarea name="message8" rows="3" cols="50"></textarea>
  </div>
  <input type="hidden" name="com_id" value="1">
  
  <button type="submit" class="update-button">更新</button>
</form>

<?php
include "../db_open.php";

try {
    // データベースに接続
    $pdo = new PDO("mysql:host=$dbserver;dbname=$dbname;charset=utf8", $dbuser, $dbpasswd, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // 企業情報を会社テーブルに挿入 (カラム名を適切に修正)
    $stmt = $pdo->prepare("INSERT INTO company_table () VALUES ()");
    $stmt->execute();

    // 最後に挿入したcom_idを取得
    $com_id = $pdo->lastInsertId();

    // cominfo_tableにデータを挿入
    $stmt = $pdo->prepare("INSERT INTO cominfo_table (com_id, com_rinen, salary, advice, free1, free2, event1, event2, event3)
                           VALUES (:com_id, :message1, :message2, :message3, :message4, :message5, :message6, :message7, :message8)");
    $stmt->bindParam(':com_id', $com_id);
    $stmt->bindParam(':message1', $_POST['message1']);
    $stmt->bindParam(':message2', $_POST['message2']);
    $stmt->bindParam(':message3', $_POST['message3']);
    $stmt->bindParam(':message4', $_POST['message4']);
    $stmt->bindParam(':message5', $_POST['message5']);
    $stmt->bindParam(':message6', $_POST['message6']);
    $stmt->bindParam(':message7', $_POST['message7']);
    $stmt->bindParam(':message8', $_POST['message8']);

    $stmt->execute();

   
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
}
?>

  
</body>
</html>
