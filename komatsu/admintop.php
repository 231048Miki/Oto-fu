<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>管理者トップ</title>
  <link rel="stylesheet" , href="../iizuka/header.css">
  <link rel="stylesheet" , href="../iizuka/css/admintop.css">
  <meta name="viewport" content="width=device-width" />
</head>

<body>
  <header>
    <div class="header">
      <h2>
        <a href="admintop.php" class="web-name">job hunting</a>
      </h2>
      <div class="menu">
        <a onclick="history.back(-1)" class="header-nav">戻る</a>
        <a href="logout.php" class="header-nav" id="logout">ログアウト</a>
      </div>
    </div>
  </header>
  <h2 class="page-name">管理者画面</h2>

  <h3 class="sub-header">ブロックワード編集</h3>
  <div class="word-edit">
    <button class="tag" onclick="location.href='../iizuka/php/NGword_in.php'">追加</button>
    <button class="tag" onclick="location.href='../iizuka/php/NGword_list.php'">一覧</button>
  </div>

  <h3 class="sub-header">利用者関連</h3>
  <div class="user-connection">
    <button class="tag" onclick="location.href='../fujii/admin/report.html'">通報履歴</button>
    <button class="tag" onclick="location.href='../iizuka/php/approval.php'">企業承認</button>
    <button class="tag" onclick="location.href='../fujii/admin/re_pass.html'">パスワードリセット</button>
  </div>
</body>

</html>