<?php 
$comID = 1;//会社のID
require('../../db_open.php');
//POST['tags']はタグのIDが入った配列

foreach($POST['tags'] as $tag_id){
    $sql = $dbh->prepare('INSERT INTO selecttags (com_id,tag_id) VALUES(:com_id,:tag_id)');
    $sql->bindValue(':com_id',$comID,PDO::PARAM_INT);
    $sql->bindValue(':tag_id',$tag_id,PDO::PARAM_INT);
}

$sql->execute();