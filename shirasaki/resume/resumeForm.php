<?PHP 
session_start();
include("../../db_open.php");
include("resumeFunc.php");

$getSuccess = false;
$reazon;
$pr;
$skill;


$resumeInfo=[];//ID拾って全データ取り出し
$getRsume = $dbh->prepare('SELECT * FROM resume_table WHERE stu_id = :stu_id');
$getRsume->bindValue(':stu_id',1,PDO::PARAM_STR);//ユーザーIDを入れる、今はテストで１を入れている
$getRsume->execute();

while($resume = $getRsume->fetch(PDO::FETCH_ASSOC)){
            $getSuccess = true;
            $reazon = $resume['reazon'];
            $pr = $resume['pr'];
            $skill = $resume['skill'];
};

if(isset($_POST['save'])){//一番上のフォーム
    resumeSave($dbh,$getSuccess);
    $reazon = $_POST['reazon'];
    $pr = $_POST['pr'];
    $skill = $_POST['skill'];
}

if(isset($_POST['qual'])){
    qualAdd($dbh,$_POST['qual'],$_POST['timeQ']);
    header("Location:./resumeForm.php");
    exit(); 
}

if(isset($_POST['history'])){
    historyAdd($dbh,$_POST['history'],$_POST['timeH']);
    header("Location:./resumeForm.php");
    exit(); 
}

if(isset($_POST['qdl'])){
    deleteQual($dbh,$_POST['qdl']);
    header("Location:./resumeForm.php");
    exit(); 
}

if(isset($_POST['hdl'])){
    deleteHitory($dbh,$_POST['hdl']);
    header("Location:./resumeForm.php");
    exit(); 
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            textarea{
                vertical-align:top;
            }
            .flex{
                display: flex;
            }
            .main{
                margin-top: 50px;
                margin-left: 100px ;
                display: flex;
            }
            .right{
                margin-top: 100px;
                margin-left: 200px;
            }
        </style>
    </head>
    <body>
    <div class="main">
    <div class="left">
    <h1>履歴書コピペ保存場所</h1>
    <button onclick="location.href='../mypage/mypage.php'">もどる</button>
    <form method="post"  action="">
    <br>
    志望動機
    <br>
    <textarea name="reazon" cols="40" rows="10"><?PHP echo $reazon;?></textarea>
    <br>
    自己PR
    <br>
    <textarea name="pr" cols="40" rows="10"><?PHP echo $pr;?></textarea>
    <br>
    趣味特技
    <br>
    <textarea name="skill" cols="40" rows="10"><?PHP echo $skill?></textarea>
    <br>
    <!-- <input type="file" name="example" accept="image/jpeg, image/png"> --> 
    <input type="hidden" name="save">
    <input type="submit" value="保存">
    </form>
    <br>
    </div>

    <div class="right">
    <form method="post"  action="">
    <label for="qual">資格:
    </label>
    <input type="text" name="qual"><br>
    <label for="qualQ">年月:
    </label>
    <input type="month" name="timeQ">
    <input type="submit" value="追加">
    </form>
    <?php getQual($dbh,1)?>
    <br>

    <form method="post"  action="">
    <label for="history">学歴職歴:
    </label>
    <input type="text" name="history"><br>
    <label for="qualH">年月:
    </label>
    <input type="month" name="timehH">
    <input type="submit" value="追加">
    </form>
    <?php getHistory($dbh,1)?>
    </div>
    </div>
    </body>


</html>
