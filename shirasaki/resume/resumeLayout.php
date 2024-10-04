<?PHP 
$douki = "あああああああああああああああああああああああああああああああああああああああああ。
ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ";
$pr = "私は、とくになんもできません。";
$syumi = "寝る事";
$name = "高田健志";
$hurigana = "たかだけんし";
$seinengappi = "2001年3月17日生まれ,満(23)歳";
$seibetu="男";
$zyusyo = "北海道根室市明治町3-99";
$furiganazyusyo = "ほっかいどうねむろしめいじちょう";
$yuubin = "087-0003";
$denwa = "090-6998-7056";
$mail = "kakaka111@gmail.com";

// $sikaku1 = "基本情報,取得";
// $sikaku2 = "乙四,取得";

$quals = [];


$sikaku1Time = "2024年4月";
$sikaku2Time = "2018年3月";//こいつらを外部から受け取るようにする。

include("../../db_open.php");
$resumeInfo=[];//ID拾って全データ取り出し
$getRsume = $dbh->prepare('SELECT * FROM resume_table WHERE stu_id = :stu_id');
$getRsume->bindValue(':stu_id',1,PDO::PARAM_STR);//ユーザーIDを入れる、今はテストで１を入れている
$getRsume->execute();
while($resume = $getRsume->fetch(PDO::FETCH_ASSOC)){
            $douki = $resume['reazon'];
            $pr = $resume['pr'];
            $syumi = $resume['skill'];
};

$count = 0;

$get = $dbh->prepare('SELECT * FROM history_table WHERE stu_id = :stu_id');
$get -> bindValue(':stu_id',1,PDO::PARAM_STR);
$get->execute();
while($qual = $get->fetch(PDO::FETCH_ASSOC)){
    $quals[$count][] = $qual['history_name'];
    $quals[$count][] = $qual['history_time'];
    $count++;
};

$get = $dbh->prepare('SELECT * FROM qual_table WHERE stu_id = :stu_id');
$get -> bindValue(':stu_id',1,PDO::PARAM_STR);
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
        <link rel="stylesheet" href="baseLayout.css">

        <title>タイトル</title>
    </head>
    <style>
        html{
            height: 100%;
        }
        body{
            height: 100%;
            display: flex;
        }
        .resumeR{
            border: solid 3px black ;
            height: 90%;
            width: 49%;
            padding: 1px;
            margin-left: 1%;
        }
        .resumeL{
            border: solid 3px black ;
            height: 90%;
            width: 49%;
            padding: 1px;
        }


        .douki{
            margin-top: 1px;
            height: 35%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;

        }

        .pr{
            margin-top: 1px;
            height: 39%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
        }

        .syumi{
            margin-top: 1px;
            height: 20%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
        }

        .me{
            margin-top: 1px;
            height: 10%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
            display: flex;
        }
        .hurigana{
            margin-top: 1px;
            height: 3%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
        }

        .seinengappi{
            margin-top: 1px;
            height: 3%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
            display: flex;
        }
        .furiganazyusyo{
            margin-top: 1px;
            height: 3%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
        }
        .zyusyo{
            margin-top: 1px;
            height: 7%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
        }
        .denwa{
            margin-top: 1px;
            height: 3%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
        }
        .mail{
            margin-top: 1px;
            height: 3%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
        }
        .sikaku{
            margin-top: 1px;
            height: 61%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
        }
        .sikakuTitle{
            margin-top: 1px;
            height: 5%;
            border: solid 3px black ;
            padding-left: 1px;
            padding-right: 1px;
            text-align: center;
        }
        .sikakuMain{
            margin-top: 2px;
            height: 91%;
            border: solid 3px black ;

           
        }
        .sikakuOutput{
            margin-top: 1px;
            height: 6%;
            border-bottom: solid 2px black;
            display: flex;
        }

        .syutokubi{
            margin-top: 1px;
            border-right: dotted 3px black;
            display: flex;
        }
        .kao{
            padding-left: 10px;
            margin-top: 1px;
            text-align: center;
        }
        .name{
            width: 90%;
            margin-top: 1px;
            border-right: dotted 3px black;
        }
        img{
            /*コレ*/object-fit: cover;
            width: 100%;
            height: 100%;
        }
        .seinengappiOutput{
            width: 85%;
            margin-top: 1px;
            border-right: dotted 3px black;
        }
        button{
            margin-left: 93%;
        }
    @media (max-width: 600px){
        body{
            display: block;
        }
        .resumeR{
            margin-top: 3px;
            border: solid 3px black ;
            height: 90%;
            width: 100%;
            padding: 1px;
            margin-left: 0px;
        }
        .resumeL{
            border: solid 3px black ;
            height: 90%;
            width: 100%;
            padding: 1px;
        }
    }

    </style>
    <body>
        <div class="resumeL">
            <div class="hurigana">
            <?php 
                echo "フリガナ:　".$hurigana;
            ?>  
            </div>   
            <div class="me">
                <div class="name">
                <?php 
                    echo "<h3>名前:　".$name."</h3>";
                ?>  
                </div>
                <div class="kao">
                    <img src="./20240126040133takadagood.jpg">
                </div>
            </div>    

            <div class="seinengappi">
            <?php 
                echo "<div class='seinengappiOutput'>生年月日：".$seinengappi."</div>";
                echo "性別：".$seibetu;
            ?>  
            </div>

            <div class="furiganazyusyo">
            <?php 
                echo "フリガナ:".$furiganazyusyo;
            ?>  
            </div>
            <div class="zyusyo">
            <?php 
                echo "〒".$yuubin;
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