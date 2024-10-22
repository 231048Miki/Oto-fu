<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>企業ページ</title>
  <link rel="stylecheet" , href="../iizuka/header.css">
  <link rel="stylesheet" , href="./companypage.css">
  <meta name="viewport" content="width=device-width" />
</head>

<body>

  <header>
    <div class="header">
      <h2>
        <a href="../iizuka/php/com_top.php" class="web-name">job hunting</a>
      </h2>
      <div class="menu">
        <a href="../iizuka/php/com_mypage.php">戻る</a>
      </div>
    </div>
  </header>
  <?php
  session_start();

  include "../db_open.php";

  if (!isset($_SESSION['login']) && !isset($_SESSION['com_id'])) {
    header("Location:../../fujii/login.php");
    exit();
  } else {
    // $userid = $_SESSION['com_id'];
    // echo $userid;  
  }

  $count = "SELECT count(com_id) as yes FROM cominfo_table where com_id = $_SESSION[com_id]";
  $count_res = $dbh->query($count);
  $crec = $count_res->fetch();
  // echo $crec['yes'];
  //cominfoの中身がない時
  if ($crec['yes'] == 0) {
    echo <<<___EOF
    
   <div class="form">
     <form method="POST" class="com_form" action="">
       <h3>企業理念：<input type="text" name="rinen" value="" required></h3>
       <h3>給与：<input type="text" name="salary" value="" required></h3>
       <h3>先輩社員の声：<input type="text" name="advice" value="" required></h3>
       <h3>フリースペース１：<input type="text" name="free1" value=""></h3>
       <h3>フリースペース２：<input type="text" name="free2" value=""></h3>
       
       <h3>イベント名１：<input type="text" name="event1" value=""></h3>
       <h3>日付：<input type="date" name="eventdata1" value=""></h3>
       <h3>イベント内容１：<input type="text" name="event_content1" value=""></h3>

       
       <h3>イベント情報２：<input type="date" name="event2" value=""></h3>
       <h3>日付：<input type="date" name="eventdata2" value=""></h3>
       <h3>イベント内容２：<input type="text" name="event_content2" value=""></h3>
       
       <h3>イベント情報３：<input type="date" name="event3" value=""></h3>
       <h3>日付：<input type="date" name="eventdata3" value=""></h3>
       <h3>イベント内容３：<input type="text" name="event_content3" value=""></h3>  

       <input type="submit" value="更新" class="button">
     </form>
   </div>
   ___EOF;
    //始めてinsertするときの処理
    if (isset($_POST["rinen"], $_POST["salary"], $_POST["advice"], $_POST["free1"], $_POST["free2"], $_POST["event1"], $_POST["event2"], $_POST["event3"], $_POST["eventdata1"], $_POST["eventdata2"], $_POST["eventdata3"], $_POST["event_content1"], $_POST["event_content2"], $_POST["event_content3"])) {
      $sql2 = "INSERT INTO cominfo_table (com_id, com_rinen, salary, advice , free1, free2, event1, event2, event3, eventdata1, eventdata2, eventdata3, event_content1, event_content2, event_content3) 
      VALUES ('$_SESSION[com_id]' , '$_POST[rinen]', '$_POST[salary]', '$_POST[advice]', '$_POST[free1]', '$_POST[free2]', '$_POST[event1]', '$_POST[event2]', '$_POST[event3]', '$_POST[eventdata1]','$_POST[eventdata2]' , '$_POST[eventdata3]','$_POST[event_content1]','$_POST[event_content2]','$_POST[event_content3]')";
      // echo $sql2;
      $sql_res2 = $dbh->query($sql2);
      echo "<script>alert('更新しました。');
        window.location.href = '';
      </script>";
    }
  } else {
    //すでにデータが入っているとき
    $sql = "SELECT * FROM cominfo_table where com_id = $_SESSION[com_id]";
    $sql_res = $dbh->query($sql);
    $rec = $sql_res->fetch();

    echo <<<___EOF
  <div class="form">
    <form method="POST" class="com_form" action="">
      <h3>企業理念：<input type="text" name="rinen" value="$rec[com_rinen]" required></h3>
      <h3>給与：<input type="text" name="salary" value="$rec[salary]" required></h3>
      <h3>先輩社員の声：<input type="text" name="advice" value="$rec[advice]"</h3>
      <h3>フリースペース１：<input type="text" name="free1" value="$rec[free1]"></h3>
      <h3>フリースペース２：<input type="text" name="free2" value="$rec[free2]"></h3>

      <h3>イベント名１：<input type="text" name="event1" value="$rec[event1]"></h3>
      <h3>日付：<input type="date" name="eventdata1" value="$rec[eventdata1]"></h3>
      <h3>イベント内容１：<input type="text" name="event_content1" value="$rec[event_content1]"></h3>

      <h3>イベント名２：<input type="text" name="event2" value="$rec[event2]"></h3>
      <h3>日付：<input type="date" name="eventdata2" value="$rec[eventdata2]"></h3>
      <h3>イベント内容２：<input type="text" name="event_content2" value="$rec[event_content2]"></h3>
      
      <h3>イベント名３：<input type="text" name="event3" value="$rec[event3]"></h3>
      <h3>日付：<input type="date" name="eventdata3" value="$rec[eventdata3]"></h3>
      <h3>イベント内容３：<input type="text" name="event_content3" value="$rec[event_content3]"></h3>
      <input type="submit" value="更新" class="button">
    </form>
  </div>

  ___EOF;
    //入力した内容にアップデート
    if (isset($_POST["rinen"], $_POST["salary"], $_POST["advice"], $_POST["free1"], $_POST["free2"], $_POST["event1"], $_POST["event2"], $_POST["event3"], $_POST["eventdata1"], $_POST["eventdata2"], $_POST["eventdata3"], $_POST["event_content1"], $_POST["event_content2"], $_POST["event_content3"])) {
      $sql3 = "UPDATE cominfo_table SET com_rinen='$_POST[rinen]' , salary='$_POST[salary]' , advice='$_POST[advice]' ,
              free1='$_POST[free1]' , free2='$_POST[free2]' , event1='$_POST[event1]' , event2='$_POST[event2]' , event3='$_POST[event3]' 
              , eventdata1='$_POST[eventdata1]',eventdata2='$_POST[eventdata2]' , eventdata3='$_POST[eventdata3]' ,
              event_content1='$_POST[event_content1]' , event_content2='$_POST[event_content2]' ,event_content3='$_POST[event_content3]' 
              where com_id = $_SESSION[com_id]";
      // echo $sql3;
      $sql_res3 = $dbh->query($sql3);
      echo "<script>alert('更新しました。');
        window.location.href = '';
      </script>";
    }
  }
  ?>
</body>

</html>