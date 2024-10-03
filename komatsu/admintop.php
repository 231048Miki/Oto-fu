<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <style>
    .right {
      position: absolute;
      right: 300px;
      top: 450px;
    }
    .right1 {
      position: absolute;
      right: 300px;
      top: 250px;
    }
    .left {
      position: absolute;
      left: 300px;
    }
    .left1 {
      position: absolute;
      left: 300px;
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
    input[type="button"] {
      width: 150px;   
      height: 50px;   
      font-size: 15px;  
    }
    .rounded {
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <br><br><br><br><br><br>
  <input type="button" onclick="location.href='./admintop.php'" value="ブロックワード編集"><br><br><br>
  
  <div class="left1">
    <input type="button" class="rounded" onclick="location.href='./index.html'" value="追加">
  </div>

  <center>
    <input type="button" class="rounded" onclick="location.href='./index.html'" value="編集">
  </center>

  <div class="right1">
    <input type="button" class="rounded" onclick="location.href='./index.html'" value="一覧"><br><br><br>
  </div>

  <div class="aaa">
    <input type="button" onclick="location.href='./admintop.php'" value="利用者関連"><br><br><br>
  </div>

  <br><br>
  <div class="left">
    <input type="button" class="rounded" onclick="location.href='./index.html'" value="通報履歴">
  </div>

  <center>
    <input type="button" class="rounded" onclick="location.href='./index.html'" value="企業承認">
  </center>

  <div class="right">
    <input type="button" class="rounded" onclick="location.href='./index.html'" value="パスワードリセット">
  </div>

  <div class="bottom">
    <center>
      <input type="button" class="rounded" onclick="location.href='./index.html'" value="タグ編集">
    </center>
  </div>
</body>
</html>
