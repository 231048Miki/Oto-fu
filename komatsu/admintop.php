<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <style>
    .right {
      position: absolute;
      right: 250px;
      top: 450px;
    }
    .right1 {
      position: absolute;
      right: 250px;
      top: 250px;
    }
    .left {
      position: absolute;
      left: 250px;
    }
    .left1 {
      position: absolute;
      left: 250px;
    }
    .bottom {
      position: absolute;
      bottom: 30px;
      left: 607px;
    }
    .aaa {
      position: relative;
      top: 60px;
    }

    /* ボタンのサイズを変更するCSS */
    input[type="button"] {
      width: 150px;   /* 幅を指定 */
      height: 50px;   /* 高さを指定 */
      font-size: 16px;  /* 文字サイズを指定 */
    }

    /* 特定のボタンのサイズを変更する例 */
    .large-button {
      width: 200px;
      height: 60px;
    }
    .small-button {
      width: 100px;
      height: 40px;
    }

  </style>
</head>
<body>
  <br><br><br><br><br><br>
  <input type="button" onclick="location.href='./admintop.php'" value="ブロックワード編集" class="large-button"><br><br><br>
  
  <div class="left1">
    <input type="button" onclick="location.href='./index.html'" value="追加" class="small-button">
  </div>

  <center>
    <input type="button" onclick="location.href='./index.html'" value="編集" class="large-button">
  </center>

  <div class="right1">
    <input type="button" onclick="location.href='./index.html'" value="一覧" class="small-button"><br><br><br>
  </div>

  <div class="aaa">
    <input type="button" onclick="location.href='./admintop.php'" value="利用者関連" class="large-button"><br><br><br>
  </div>

  <br><br>
  <div class="left">
    <input type="button" onclick="location.href='./index.html'" value="通報履歴" class="small-button">
  </div>

  <center>
    <input type="button" onclick="location.href='./index.html'" value="企業承認" class="large-button">
  </center>

  <div class="right">
    <input type="button" onclick="location.href='./index.html'" value="パスワードリセット" class="small-button">
  </div>

  <div class="bottom">
    <center>
      <input type="button" onclick="location.href='./index.html'" value="タグ編集" class="large-button">
    </center>
  </div>
</body>
</html>
