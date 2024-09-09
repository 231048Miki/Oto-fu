<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <style>
    #wrapper {
      height: 400px;
      width: 600px;
      overflow-y: scroll;
      font-size: 20px; 
    }
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
    .record {
      margin-bottom: 20px; 
    }
    .comid-msg {
      margin-bottom: 10px;     }
    .msg {
      word-wrap: break-word; /* 単語を切って改行 */
      word-break: break-all; /* 長い単語を改行 */
      width: 400px; /* 約20文字程度で改行される幅を設定 */
    }
  </style>
</head>
<body>
  <br><br><br><br><br><br>
  <div class="aaa">
    <p>閲覧履歴</p>
  </div>
  <center>
    <div id="wrapper">
      <?php
      include "../db_open.php";
      $sql = 'SELECT * FROM test order by comid desc;';
      $stmt = $dbh->query($sql);
      while($record = $stmt->fetch()){
          echo "<div class='record'>";
          echo "<div class='comid-msg'><strong>$record[comid]</strong></div>";
          echo "<div class='msg'>$record[msg]</div>";
          echo "</div>";
      }
      ?>
    </div>
  </center>
</body>
</html>
