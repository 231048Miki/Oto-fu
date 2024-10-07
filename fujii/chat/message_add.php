<?php
session_start();
//セットフラッシュ
function set_flash($key, $message) {
    $_SESSION['flash'][$key] = $message;
}

define('ERR_MSG1', 'An error has occurred. Please try again.');
//ログインユーザーIDと送信先ユーザーIDの取得
function check_relation_message($user_id,$destination_user_id){
    try {
      $dsn='mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
      $user='fujii231109_user';
      $password='f21053879i';
      $dbh=new PDO($dsn,$user,$password);
      $sql = "SELECT user_id,destination_user_id
              FROM message_relation
              WHERE (user_id = :user_id and destination_user_id = :destination_user_id)
                    or (user_id = :destination_user_id and destination_user_id = :user_id)";
      $stmt = $dbh->prepare($sql);
      $stmt->execute(array(':user_id' => $user_id,
                           ':destination_user_id' => $destination_user_id));
      return $stmt->fetch();
    } catch (\Exception $e) {
      error_log('エラー発生:' . $e->getMessage());
      set_flash('error',ERR_MSG1);
exit;
    }
  }
  function reload(){
    
  }

//メッセージ追加機能
try
{
$date = new DateTime();
$date->setTimeZone(new DateTimeZone('Asia/Tokyo'));

$message_text=$_POST['text'];
$user_id=$_SESSION['user_id'];
$destination_user_id = $_POST['destination_user_id'];

if($message_text=='')
{
    set_flash('danger','メッセージ内容が未記入です');
    reload();
}


//一応入れてる（使うかは不明）
function insert_message(){
    
}
//XSS対策
$message_text=htmlspecialchars($message_text,ENT_QUOTES,'UTF-8');
$user_id=htmlspecialchars($user_id,ENT_QUOTES,'UTF-8');
//DB接続と送られてきたデータを保存
$dsn='mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
$user='fujii231109_user';
$password='f21053879i';
$dbh = new PDO($dsn,$user,$password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'INSERT INTO message(text,user_id,destination_user_id,created_at) VALUES (?,?,?,?)';
$stmt = $dbh -> prepare($sql);
$data[] = $message_text;
$data[] = $user_id;
$data[] = $destination_user_id;
$data[] = $date->format('Y-m-d H:i:s');
$stmt -> execute($data);
$dbh = null;

if(!check_relation_message($user_id,$destination_user_id)){
insert_message($user_id,$destination_user_id);
}
set_flash('sucsess','メッセージを送信しました');
header('Location:message.php?user_id='.$destination_user_id.'');

}   
catch (Exception $e)
{
  //なんかあった時のエラー
print'ただいま障害により大変ご迷惑をお掛けしております。';
exit();
// echo $_POST['destination_user_id'];
}

?>

<!-- <a href="post_index.php">戻る</a> -->