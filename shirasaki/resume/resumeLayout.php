<?PHP 
session_start();
require("../functions/userCtlFunc.php");
require("../../db_open.php");
login($dbh);
$id=$_SESSION['user_id'];

$quals = [];


$sikaku1Time = "2024年4月";
$sikaku2Time = "2018年3月";//こいつらを外部から受け取るようにする。

include("../../db_open.php");
include("../functions/userCtlFunc.php");
$user=getUser($id,$dbh);
$name = $user['name'];
$seinengappi = $user['birth'];
$zyusyo = $user['address'];
$mail = $user['mail'];
$denwa = $user['tell'];


$getRsume = $dbh->prepare('SELECT * FROM resume_table WHERE stu_id = :stu_id');
$getRsume->bindValue(':stu_id',$id,PDO::PARAM_STR);//ユーザーIDを入れる、今はテストで１を入れている
$getRsume->execute();
while($resume = $getRsume->fetch(PDO::FETCH_ASSOC)){
            $douki = $resume['reazon'];
            $pr = $resume['pr'];
            $syumi = $resume['skill'];
            $photoID = $resume['photoID'];
};

$count = 0;

$get = $dbh->prepare('SELECT * FROM history_table WHERE stu_id = :stu_id');//資格
$get -> bindValue(':stu_id',$id,PDO::PARAM_STR);
$get->execute();
while($qual = $get->fetch(PDO::FETCH_ASSOC)){
    $quals[$count][] = $qual['history_name'];
    $quals[$count][] = $qual['history_time'];
    $count++;
};

$get = $dbh->prepare('SELECT * FROM qual_table WHERE stu_id = :stu_id');//経歴
$get -> bindValue(':stu_id',$id,PDO::PARAM_STR);
$get->execute();
while($qual = $get->fetch(PDO::FETCH_ASSOC)){
    $quals[$count][] = $qual['qual_name'];
    $quals[$count][] = $qual['qual_time'];
    $count++;
};


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="resumeLayout.css">

        <title>タイトル</title>
    </head>

    <body>
        <div class="resumeL">
            <div class="me">
                <div class="name">
                <?php 
                    echo "<h3>名前:　".$name."</h3>";
                ?>  
                </div>
                <div class="kao">
                    <img src="<?php echo $photoID?>">
                </div>
            </div>    

            <div class="seinengappi">
            <?php 
                echo "<div class='seinengappiOutput'>生年月日：".$seinengappi."</div>";
            ?>  
            </div>

 
            <div class="zyusyo">
            <?php 

                echo "<br>住所".$zyusyo;
            ?>  
            </div>
            <div class="denwa">
            <?php 
                echo "電話番号:".$denwa;
            ?>  
            </div>
            <div class="mail">
            <?php 
                echo "メール:".$mail;
            ?>  
            </div>
            <div class="sikaku">
            <div class="sikakuTitle">資格取得、経歴</div>
            <div class="sikakuMain">
            <?php
            for($i=0;$i<count($quals);$i++){
            echo "<div class='sikakuOutput'><div class='syutokubi'>".$quals[$i][1]."</div><div class='sikakumei'>".$quals[$i][0]."</div></div>";
            }
            ?>
            </div>
            </div>
        </div>
        <div class="resumeR">
            <div class="syumi">
            <h3>・趣味、特技</h3>
            <?php 
                echo $syumi;
            ?>  
            </div>    

            <div class="pr">
            <h3>・自己PR</h3>
            <?php 
                echo $pr;
            ?>  
            </div>

            <div class="douki">
            <h3>・志望動機</h3>
            <?php 
                echo $douki;
            ?>  
            </div>
            <div class="back">
                <button onclick="location.href='resumeForm.php'">もどる</button>
            </div>
        </div>
    </body>
</html>