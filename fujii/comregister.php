<?php
//この辺にセッションでこのファイルを開けないようにする

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
$address = $_POST['address'];
$tell = $_POST['tell'];
$pass = $_POST['pass'];
$re = $_POST['repass'];

if(strlen($name) > 100 && strlen($name) != 0){
    //文字数の判定
    echo "企業名が不適切な形式です";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";
}elseif(strlen($mail) > 100 && strlen($mail) != 0){    
    echo "メールアドレスが不適切な形式です";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";
}elseif(strlen($address) > 100 && strlen($address) != 0){
    echo "所在地が不適切な形式です";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";
}elseif(strlen($pass) > 100 && strlen($pass) != 0){
    echo "パスワードが不適切な形式です";
    echo "<div class='back'>";
    echo "<a onclick='history.back(-1)'>戻る</a>";
    echo "</div>";
}else{
    //正しい時の処理
    // パスワードをハッシュ化
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
   
    include 'db_open.php';
    $sql = "INSERT INTO company_table (com_name, com_address, com_tell, com_mail, com_pass) 
            VALUES (:name, :address, :tell, :mail, :pass)";
    $stmt = $dbh->prepare($sql);

    // プレースホルダーに値をバインド
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':tell', $tell);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':pass', $hashedPassword);

    // SQLを実行
    if ($stmt->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting record";
    }

   
   
}
}