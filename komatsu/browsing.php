<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" , href="../iizuka/header.css">
  <link rel="stylesheet" , href="browsing.css">
  <!-- cssファイル作ったのでそっちにデザイン系移しました　飯塚 -->
  <!-- クラス名はわかりやすいもののほうがいいと思います。aaaとかわからん、、、 -->
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

  <h3 class="sub-header">閲覧履歴</h3>
  <div class="history-P">
    <div id="wrapper" class="histry-C">
      <?php
      include "../db_open.php";
      $sql = 'SELECT * FROM test order by comid desc;';
      $stmt = $dbh->query($sql);
      while ($record = $stmt->fetch()) {
        echo "<div class='record'>";
        echo "<div class='comid-msg'><strong>$record[comid]</strong></div>";
        echo "<div class='msg'>$record[msg]</div>";
        echo "</div>";
      }
      ?>
    </div>
  </div>
</body>

</html>