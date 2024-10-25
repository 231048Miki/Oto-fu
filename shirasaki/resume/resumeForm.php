<?PHP 
session_start();
include("../../db_open.php");
include("resumeFunc.php");
$id=$_SESSION['user_id'];
$getSuccess = false;
$reazon="";
$pr="";
$skill="";
$public="2";
$status="未作成";


$resumeInfo=[];//ID拾って全データ取り出し
$getRsume = $dbh->prepare('SELECT * FROM resume_table WHERE stu_id = :stu_id');
$getRsume->bindValue(':stu_id',$_SESSION['user_id'],PDO::PARAM_STR);//ユーザーIDを入れる、今はテストで１を入れている
$getRsume->execute();

//取り出せるデータがあるなら表示用の変数に値を入れて、取り出せたか判別する$getSuccessにtrueを入れる
while($resume = $getRsume->fetch(PDO::FETCH_ASSOC)){
            $getSuccess = true;
            $reazon = $resume['reazon'];
            $pr = $resume['pr'];
            $skill = $resume['skill'];
            $public = $resume['public'];
};

//保存が押された時の処理
if(isset($_POST['save'])){
    resumeSave($dbh,$getSuccess,$id);
    $reazon = $_POST['reazon'];
    $pr = $_POST['pr'];
    $skill = $_POST['skill'];
}

if(isset($_POST['imgSend'])){
    imgUpload($dbh,$id);
}

if(isset($_POST['qual'])){
    qualAdd($dbh,$_POST['qual'],$_POST['timeQ'],$id);
    header("Location:./resumeForm.php");
    exit(); 
}
if(isset($_POST['history'])){
    historyAdd($dbh,$_POST['history'],$_POST['timeH'],$id);
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
    <form method="post"  action="" >
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
    <?php getQual($dbh,$id)?>
    <br>

    <form method="post"  action="">
    <label for="history">学歴職歴:
    </label>
    <input type="text" name="history"><br>
    <label for="qualH">年月:
    </label>
    <input type="month" name="timeH">
    <input type="submit" value="追加">
    </form>
    <?php getHistory($dbh,$id)?>
    <br>
    ・画像変更用フォーム
    <form method="post"  action="" enctype="multipart/form-data">
    <input type="hidden" name="max_file_size" value="2097152">
    <input type="hidden" name="imgSend" value="y">
    <input type="file" name="img"> 
    <input type="submit" value="画像保存">
    </form>
    <button onclick="location.href='resumeLayout.php'">履歴書もどき</button>

    <!-- 藤井 -->
    <!-- ファンクションを白崎さんのとこに書いとく -->
    <!-- 公開中非公開中を出せるように -->
    <?php
    if($public == 0){
        $status = "非公開";
    }elseif($public == 1){
        $status = "公開中";
    }else{
    }
    ?>
     <br>
     <br>
     ・履歴書の公開
    <p>　現在:<?php echo $status; ?></p>
    <form method="post" action="">
    <input type="hidden" name="changeP" value="<?php echo $_SESSION['stu_id']; ?>">
    <input type="submit" value="変更する">
    </form>
    <?php
    if (isset($_POST['changeP'])) {
        // セッションから stu_id を取得
        $stu_id = $_SESSION['stu_id'];
    
        // stu_id に基づいて resume_id を取得
        $resume_stmt = $dbh->prepare("SELECT resume_id, public FROM resume_table WHERE stu_id = :stu_id LIMIT 1");
        $resume_stmt->execute([':stu_id' => $stu_id]);
        $resume = $resume_stmt->fetch();
    
        if ($resume) {


            $resume_id = $resume['resume_id'];
            $current_public = $resume['public'];
            // changePublic 関数を呼び出して public の値を変更
            $new_public = changePublic($dbh, $resume_id, $current_public);
            // JavaScript アラートを表示
            echo "<script>alert('状態を変更しました。')
                window.location.href = '';
                </script>";
        } else {
            // JavaScript アラートを表示
            echo "<script>alert('指定された学生IDの履歴書が見つかりません。');
            
            </script>";
        }
    }
    ?>
    <!-- 藤井ここまで -->
    </div>
    </div>
    </body>


</html>
