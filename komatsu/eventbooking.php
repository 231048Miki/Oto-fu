<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>イベント予約</title>
  <link rel="stylesheet" , href="../iizuka/header.css">
  <link rel="stylesheet" , href="eventbooking.css">
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
          <!-- ハンバーガーメニュー開いたときの挙動。これないと機能しません -->
          <input id="nav-input" type="checkbox" class="nav-unshown">
          <!-- 三本線 -->
          <label id="nav-open" for="nav-input" class="nav-unshown"><span></span></label>
          <label class="nav-unshown" id="nav-close" for="nav-input"></label>

          <!-- レスポンシブが効いてるとき -->
          <div id="nav-content">
            <a onclick="history.back()" class="header-nav">戻る</a><br>
            <a href="../iizuka/logout.php" class="header-nav">ログアウト</a><br>
            <a href="" class="header-nav">閲覧履歴</a><br>
            <a href="../shirasaki/mypage/mypage.php" class="header-nav">マイページ</a><br>
          </div>

          <!-- 通常メニュー -->
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

  <form method="POST">
    <?php
    session_start();
    include "../db_open.php";

    try {

      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT com_name FROM company_table ORDER BY com_id DESC LIMIT 1";
      $stmt = $dbh->query($sql);

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

      $sql_event_dates = "SELECT eventdata1 FROM cominfo_table ORDER BY com_id DESC LIMIT 1";
      $stmt_event_dates = $dbh->query($sql_event_dates);
      echo '<div class="company-details2">';
      echo "<h4>イベント日付</h4>";
      echo "<ul>";
      $event_date_value = '';
      while ($row_event_dates = $stmt_event_dates->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . htmlspecialchars($row_event_dates['eventdata1'], ENT_QUOTES, 'UTF-8') . "</li>";
        $event_date_value = $row_event_dates['eventdata1'];
      }
      echo "</ul>";
      echo '</div>';

      $sql_events = "SELECT event1, event2, event3 FROM cominfo_table ORDER BY com_id desc limit 1";
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