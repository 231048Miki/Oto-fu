<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>閲覧履歴</title>
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

      try {

        // $sql = 'SELECT c.com_id, c.com_name, i.com_rinen, b.LastDate
        //           FROM company_table c
        //           JOIN cominfo_table i ON c.com_id = i.com_id
        //           LEFT JOIN browsing_table b ON c.com_id = b.com_id
        //           ORDER BY c.com_id DESC';

        $sql = 'SELECT c.com_id, c.com_name, i.com_rinen, b.LastDate
                  FROM company_table c
                  JOIN cominfo_table i ON c.com_id = i.com_id
                  LEFT JOIN browsing_table b ON c.com_id = b.com_id
                  ORDER BY b.LastDate DESC';
        $stmt = $dbh->query($sql);

        while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<div class='record'>";
          // 会社名をクリックできるリンクにする
          echo "<div class='com-name'><a href='../iizuka/php/detail.php?com_id=" . htmlspecialchars($record['com_id'], ENT_QUOTES, 'UTF-8') . "'><strong>" . htmlspecialchars($record['com_name'], ENT_QUOTES, 'UTF-8') . "</strong></a></div>";
          echo "<div class='com-rinen'>" . htmlspecialchars($record['com_rinen'], ENT_QUOTES, 'UTF-8') . "</div>";
          echo "</div>";
        }
      } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
      }
      ?>
    </div>
  </div>
</body>

</html>