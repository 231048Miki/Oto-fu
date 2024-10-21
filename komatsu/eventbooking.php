<?php ini_set( 'display_errors', 1 );?>
<?php
  session_start();
  $stu_id = $_SESSION['stu_id'];
  $com_id = isset($_POST['com_id']) ? $_POST['com_id'] : '';
  $event = isset($_POST['eventid']) ? $_POST['eventid'] : '';
  $event = $event;
  $com_id = $com_id;
?>
<!DOCTYPE html>
<ht>

<head>
  <meta charset="UTF-8">
  <title>イベント予約</title>
  <link rel="stylesheet" href="../iizuka/header.css">
  <link rel="stylesheet" href="eventbooking.css">
  <meta name="viewport" content="width=device-width" />
</head>

<body>
  <!-- ヘッダー追加 -->
  <header>
    <div class="header">
      <h2>
        <a href="admintop.php" class="web-name">job hunting</a>
      </h2>
      <div class="menu">
        <div id="nav-drawer">
          <input id="nav-input" type="checkbox" class="nav-unshown">
          <label id="nav-open" for="nav-input" class="nav-unshown"><span></span></label>
          <label class="nav-unshown" id="nav-close" for="nav-input"></label>

          <div id="nav-content">
            <a onclick="history.back()" class="header-nav">戻る</a><br>
            <a href="../iizuka/logout.php" class="header-nav">ログアウト</a><br>
            <a href="" class="header-nav">閲覧履歴</a><br>
            <a href="../shirasaki/mypage/mypage.php" class="header-nav">マイページ</a><br>
          </div>

          <nav id="desktop-menu">
            <a onclick="history.back()" class="header-nav">戻る</a>
            <a href="../iizuka/logout.php" class="header-nav">ログアウト</a>
            <a href="" class="header-nav">閲覧履歴</a>
            <a href="../shirasaki/mypage/mypage.php" class="header-nav">マイページ</a>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <div class="aaa">
    <p>予約画面</p>
  </div>

  <?php

include "../db_open.php";
try {
  
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //送られてきたcom_idから企業の情報全取得
  $sql = "SELECT * FROM company_table WHERE com_id = :com_id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':com_id', $com_id, PDO::PARAM_INT);
  $stmt->execute();
  
  echo '<div class="company-details">';
  echo "<h4>会社名</h4>";
  echo "<ul>";
  $company_name = ''; 
  if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<li>" . htmlspecialchars($row['com_name'], ENT_QUOTES, 'UTF-8') . "</li>";
    $company_name = $row['com_name']; 
  }
  echo "</ul>";
  echo '</div>';

      echo '<div class="company-details">';
      echo "<h4>会社名</h4>";
      echo "<ul>";
      $company_name = '';
      if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . htmlspecialchars($row['com_name'], ENT_QUOTES, 'UTF-8') . "</li>";
        $company_name = $row['com_name'];
      }
      echo "</ul>";
      echo '</div>';

  $sql_events = "SELECT $event FROM cominfo_table WHERE com_id = $com_id";
  $stmt_events = $dbh->prepare($sql_events);
  $stmt_events->execute();
  
  echo '<div class="event-container">';
  echo '<div class="event-details">';
  echo "<h4>イベント内容・詳細</h4>";
  $event_details_value = ''; 
  while ($row_events = $stmt_events->fetch(PDO::FETCH_ASSOC)) {
    echo "<p>" . htmlspecialchars($row_events[$event], ENT_QUOTES, 'UTF-8') . "</p>";
    $event_details_value = $row_events[$event] ; 
  }
  echo '</div>';
  echo '</div>';

  // 予約ボタンが押されたら処理を行う削除予定
  
//   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking'])) {
//     $sql_insert = "INSERT INTO eventbooking_table (stu_id , com_id , EventData) VALUES ( :stu_id, :com_id, CURRENT_DATE)";
//     $stmt_insert = $dbh->prepare($sql_insert);
//     $stmt_insert->bindParam(':stu_id', $stu_id, PDO::PARAM_INT);
//     $stmt_insert->bindParam(':com_id', $com_id, PDO::PARAM_INT);
//     $stmt_insert->execute();

//     echo "<script>alert('予約しました。'); window.location.href = '../iizuka/php/detail.php';</script>";
//   }

} catch (PDOException $e) {
  echo "エラー: " . $e->getMessage();
}
?>
  <form method="POST" action="bookingchaeck.php">
    <input type="hidden" name="stu_id" value="<?php echo htmlspecialchars($stu_id, ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="com_id" value="<?php echo htmlspecialchars($com_id, ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="event" value="<?php echo htmlspecialchars($event, ENT_QUOTES, 'UTF-8'); ?>">
    
    <button type="submit" name="booking" class="button">予約</button>
  </form>

</body>
</html>