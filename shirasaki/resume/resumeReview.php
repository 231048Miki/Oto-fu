<?PHP
session_start();
include("../../db_open.php");    
require("../functions/userCtlFunc.php");
login($dbh);
$getReview = $dbh->prepare('SELECT resume_review.*,company_table.com_name FROM resume_review join company_table ON resume_review.com_id = company_table.com_id  WHERE resume_id = (SELECT resume_id FROM student_table JOIN resume_table WHERE student_table.stu_id = resume_table.stu_id and student_table.stu_id = :stu_id)');
$getReview->bindValue(':stu_id',$_SESSION['user_id'],PDO::PARAM_STR);//ユーザーIDを入れる、今はテストで１を入れている
$getReview->execute();

$reviewArray = [];//こいつ宛ての企業の奴らからのレビューを格納する配列
while($get = $getReview->fetch(PDO::FETCH_ASSOC)){
    array_push($reviewArray,$get);
};
//$reviewArrayの構造： reviewArray[get[[],[],[]...],get[[],[],[]...],get[[],[],[]...]
//reviewArray[取り出した行[その行の列達]]って感じ
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="resumeReview.css">
    </head>
    <body>
        <div class="title"><h1>履歴書のレビュー</h1></div>
        <button class="btn" onclick="location.href='../mypage/mypage.php'">戻る</button>
            <?php 
                foreach($reviewArray as $review){
                   echo "<div class='review'>";
                   echo "<h3>".$review['com_name'].":からのレビュー</h3>";
                   echo "<p>".$review['review']."</p>";
                   echo "</div>";
                }
            ?>
    </body>
</html>