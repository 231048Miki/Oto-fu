<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <style>
    #wrapper {
      height: 400px;
      width: 600px;
      overflow-y: scroll;
    }
  </style>
</head>

<br><br><br><br>閲覧履歴<br><br><br>
<body>
    <center>
  <div id="wrapper">
<?php
include "../db_open.php";
$sql = 'SELECT * FROM test order by comid desc;';
$stmt = $dbh->query($sql);
//$result = $stmt->fetchAll(PDO::FETCH_ASSOC)
while($record = $stmt->fetch()){
    echo "$record[comid] <br>";
    echo "$record[msg]<br>";
}
?>
 </div>
 </center>
</body>
</html>



