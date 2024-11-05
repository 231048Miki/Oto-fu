<?php 
require("../shirasaki/functions/userCtlFunc.php");
require("../db_open.php");
session_start();
login($dbh);
?>
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
            <div class="banner">
            <button class="btn-gradient-3d-simple" onclick="location.href='../shirasaki/top/top.php'">job hunting</button>
            <button class="btn-gradient-3d-simple" onclick="history.back()">もどる</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../fujii/login.php'">ログアウト</button>
            <button class="btn-gradient-3d-simple" onclick="location.href=''">閲覧履歴</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../shirasaki/quit/quit.php'">退会</button>
            </div>

            <div class="title"><h2>閲覧履歴</h2></div>
            <div class="hamburger">
                <!-- ハンバーガーメニューの線 -->
                <span></span>
                <span></span>
                <span></span>
                <!-- /ハンバーガーメニューの線 -->
            </div>
            <ul class="slide-menu">
                <li><a href="../top/top.php">top</a></li>
                <li><a href="../../fujii/login.php">ログアウト</a></li>
                <li><a href="../../komatsu/browsing.php">閲覧履歴</a></li>
                <li><a href="../quit/quit.php">退会</a></li>
            </ul>
        </header>

  <div class="history-P">
    <div id="wrapper" class="histry-C">
      <?php
      include "../db_open.php";


      
try {
    
  $sql = 'SELECT c.com_name, i.com_rinen 
  FROM company_table c 
  JOIN cominfo_table i ON c.com_id = i.com_id
  ORDER BY c.com_id DESC;'; 
  $stmt = $dbh->query($sql);
  
//     while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
//         echo "<div class='record'>";
//         echo "<div class='com-name'><strong>" . htmlspecialchars($record['com_name'], ENT_QUOTES, 'UTF-8') . "</strong></div>";
//         echo "<div class='com-rinen'>" . htmlspecialchars($record['com_rinen'], ENT_QUOTES, 'UTF-8') . "</div>";
//         echo "</div>";
//     }
// } catch (PDOException $e) {
//     echo "エラー: " . $e->getMessage();
// }



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
          $id=htmlspecialchars($record['com_id'], ENT_QUOTES, 'UTF-8');
          // var_dump($id);
          echo "<div class='record'>";
          // 会社名をクリックできるリンクにする
          echo "<div class='com-name'><a href='../iizuka/php/detail.php?id=$id'><strong>" . htmlspecialchars($record['com_name'], ENT_QUOTES, 'UTF-8') . "</strong></a></div>";
          echo "<div class='com-rinen'>" . htmlspecialchars($record['com_rinen'], ENT_QUOTES, 'UTF-8') . "</div>";
          echo "</div>";
        }
      } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
      }
      ?>
    </div>
  </div>
  <script>
            document.querySelector('.hamburger').addEventListener('click', function(){
        this.classList.toggle('active');
        document.querySelector('.slide-menu').classList.toggle('active');
        });
        
 
  </script>
</body>

</html>