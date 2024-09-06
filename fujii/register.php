<?php
//この辺にセッションでこの直接ファイルを開けないようにする

if($_POST['pass'] != $_POST['repass']){
    //パスワードのあってるかの判定
    echo "パスワード違うよ";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";      
}else{
//パスワードがあっているときの判定
$name = $_POST['name'];
$mail = $_POST['mail'];
$date = $_POST['date'];
$address = $_POST['address'];
$tell = $_POST['tell'];
$school = $_POST['school'];
$pass = $_POST['pass'];
$re = $_POST['repass'];

$pattern="#^\d{4}([/-]?)\d{2}\\1\d{2}$#";

if(strlen($name) > 100 && strlen($name) != 0){
    //文字数の判定
    echo "名前が不適切な形式です";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";
}elseif(strlen($mail) > 100 && strlen($mail) != 0){    
    echo "メールアドレスが不適切な形式です";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";
}elseif(strlen($address) > 100 && strlen($address) != 0){
    echo "住所が不適切な形式です";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";
}elseif(strlen($school) > 100 && strlen($school) != 0){
    echo "学校名が不適切な形式です";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";
}elseif(strlen($pass) > 100 && strlen($pass) != 0){
    echo "パスワードが不適切な形式です";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";
}else{
    //生年月日の判定
    if(preg_match($pattern,$date,$match)){
    //正しい時の処理
    // パスワードをハッシュ化
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    include '../db_open.php';
    $sql = "INSERT INTO student_table (stu_name, stu_address, stu_school, stu_tell, stu_mail, stu_pass, birth) 
            VALUES (:name, :address, :school, :tell, :mail, :pass, :date)";
    $stmt = $dbh->prepare($sql);

    // プレースホルダーに値をバインド
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':school', $school);
    $stmt->bindParam(':tell', $tell);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':pass', $hashedPassword);
    $stmt->bindParam(':date', $date);

    // SQLを実行
    if ($stmt->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting record";
    }

    }else{
        //不適切な時の処理
        echo "生年月日が不適切な形式です";
        echo "<div class='back'>";
        echo "<a onclick='history.back(-1)'>戻る</a>";
        echo "</div>";
    }
   
}
}








