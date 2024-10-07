<?php
//学生用のチャット画面
session_start();
function get_user() {
  // 学生がログインしている場合
  if (isset($_SESSION["stu_id"])) {
    try {
      $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
      $user = 'fujii231109_user';
      $password = 'f21053879i';
      $dbh = new PDO($dsn, $user, $password);

      // ログインしている学生の情報を取得
      $sql = "SELECT * FROM student_table WHERE stu_id = :stu_id";
      $stmt = $dbh->prepare($sql);
      $stmt->execute(array(':stu_id' => $_SESSION["stu_id"]));
      return $stmt->fetch();
    } catch (Exception $e) {
      error_log('エラー発生:' . $e->getMessage());
      return false;
    }

  // 会社がログインしている場合
  } elseif (isset($_SESSION["com_id"])) {
    try {
      $dsn = 'mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
      $user = 'fujii231109_user';
      $password = 'f21053879i';
      $dbh = new PDO($dsn, $user, $password);

      // ログインしている会社の情報を取得
      $sql = "SELECT * FROM com_table WHERE com_id = :com_id";
      $stmt = $dbh->prepare($sql);
      $stmt->execute(array(':com_id' => $_SESSION["com_id"]));
      return $stmt->fetch();
    } catch (Exception $e) {
      error_log('エラー発生:' . $e->getMessage());
      return false;
    }
  }
  
  return null;  // ログインしていない場合
}
  
  //チャット相手の情報を取る
  function get_destination_user($get_destination_user){
    try {
        $dsn='mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
        $user='fujii231109_user';
        $password='f21053879i';
        $dbh=new PDO($dsn,$user,$password);

        // 企業がログインしている場合、学生の情報を取得
        if (isset($_SESSION["com_id"])) {
            $sql = "SELECT * FROM student_table WHERE stu_id = :stu_id";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':stu_id' => $get_destination_user));
            return $stmt->fetch();
        }
        // 学生がログインしている場合、企業の情報を取得
        elseif (isset($_SESSION["stu_id"])) {
            $sql = "SELECT * FROM company_table WHERE com_id = :com_id";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':com_id' => $get_destination_user));
            return $stmt->fetch();
        }
    } catch (\Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
    }
}
  
  //送信先のユーザーの指定$get_destination_user
  if(isset($_SESSION["com_id"])){
    $get_destination_user = $_GET["user_id"];
    $destination_user_id = $get_destination_user;
  }elseif(isset($_SESSION["stu_id"])){
    $get_destination_user = $_GET["user_id"];
    $destination_user_id = $get_destination_user;
  }else{

  } 

  
  
  //メッセージ取得のファンクション
  function get_messages($user_id,$destination_user_id){
    try {
        $dsn='mysql:dbname=otofu_mydb;host=localhost;charset=utf8';
        $user='fujii231109_user';
        $password='f21053879i';
      $dbh=new PDO($dsn,$user,$password);
      //送信先ユーザー
      $sql = "SELECT *
              FROM message
              WHERE (user_id = :user_id and destination_user_id = :destination_user_id) 
              or (user_id = :destination_user_id and destination_user_id = :user_id)
              ORDER BY created_at ASC";
      $stmt = $dbh->prepare($sql);

      error_log('user_id: ' . $user_id . ', destination_user_id: ' . $destination_user_id);
      
      $stmt->execute(array(':user_id' => $user_id,
                           ':destination_user_id' => $destination_user_id));
      return $stmt->fetchAll();
    } catch (\Exception $e) {
      error_log('エラー発生:' . $e->getMessage());
    }
  }

//時間のfuncion
  function convert_to_fuzzy_time($time_db){
    date_default_timezone_set('Asia/Tokyo');

    $unix   = strtotime($time_db);
    $now    = time();
    $diff_sec   = $now - $unix;

    if($diff_sec < 60){
        $time   = $diff_sec;
        $unit   = "秒前";
    }
    elseif($diff_sec < 3600){
        $time   = $diff_sec/60;
        $unit   = "分前";
    }
    elseif($diff_sec < 86400){
        $time   = $diff_sec/3600;
        $unit   = "時間前";
    }
    elseif($diff_sec < 2764800){
        $time   = $diff_sec/86400;
        $unit   = "日前";
    }
    else{
        if(date("Y") != date("Y", $unix)){
            $time   = date("Y年n月j日", $unix);
        }
        else{
            $time   = date("n月j日", $unix);
        }

        return $time;
    }

    return (int)$time .$unit;
}



$current_user = get_user();

$destination_user = get_user($_GET['user_id']);
if (isset($current_user['stu_id']) && isset($destination_user['stu_id'])) {
  // 学生間のチャット
  $messages = get_messages($current_user['stu_id'], $destination_user['stu_id']);
} elseif (isset($current_user['com_id']) && isset($destination_user['com_id'])) {
  // 企業間のチャット
  $messages = get_messages($current_user['com_id'], $destination_user['com_id']);
} else {
  // 万が一どちらも存在しない場合
  $messages = [];
}

// 送信先のユーザーIDを取得
$get_destination_user = $_GET['user_id'];

// ログインしている企業が学生情報を取得するか、学生が企業情報を取得する
if (isset($_SESSION["com_id"])) {
    $destination_user = get_destination_user($get_destination_user); // 企業が学生情報を取得
} elseif (isset($_SESSION["stu_id"])) {
    $destination_user = get_destination_user($get_destination_user); // 学生が企業情報を取得
} else {
    // ユーザーが存在しない場合
    $destination_user = null;
}

// 名前を表示する部分（学生なら stu_name、企業なら com_name）
?>
<h2 class="center">
  「<?= isset($destination_user['stu_name']) ? $destination_user['stu_name'] : (isset($destination_user['com_name']) ? $destination_user['com_name'] : '不明なユーザー') ?>」さんとのチャット
</h2>
    
      <?php foreach ($messages as $message) : ?>
        <div class="my_message">
        <?php if ($message['user_id'] == $current_user['stu_id'] || $message['user_id'] == $current_user['com_id']) : ?>
               <!-- 現在のユーザーからのメッセージを表示 -->
                <div class="mycomment right" style="text-align: right">
                    <p><?= htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') ?></p>
                    <span class="message_created_id"><?= convert_to_fuzzy_time($message['created_at']) ?></span>
               </div>
           <?php else : ?>
                <!-- 他のユーザーからのメッセージを表示 -->
                <div class="says"><?= htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') ?>
                <span class="message_created_at"><?= convert_to_fuzzy_time($message['created_at']) ?></span>
                </div>
          <?php endif; ?>
            </div>
      <?php endforeach; ?>
    
<!-- 文字数チェックのfunctionなど -->
<script>
    function checkLength(textarea) {
      const maxLength = 1000; // 文字数制限
      const currentLength = textarea.value.length;

      if (currentLength > maxLength) {
        alert('文字数が超えています！最大 ' + maxLength + ' 文字までです。');
        textarea.value = textarea.value.substring(0, maxLength); // 余分な文字を削除
      }
    }
  </script>
        <!-- メッセージ送信フォーム -->
    <div class="message_process">
        <h2 class="message_title">メッセージ</h2>
        <form method="post" action="message_add.php" enctype="multipart/form-data">
        <textarea class="textarea form-control" placeholder="メッセージを入力ください" name="text" oninput="checkLength(this)" maxlength="1000" required></textarea>
        <input type="hidden" name="destination_user_id" value="<?= isset($destination_user['stu_id']) ? $destination_user['stu_id'] : $destination_user['com_id'] ?>">
        <div class="message_btn">
            
            <button class="btn btn-outline-primary" type="submit" name="post" value="post" id="post">投稿</button>
        </div>
        </form>
    </div>
    </div>
    <a href="chat_top.php">←</a>
</body>
