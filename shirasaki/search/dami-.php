<h1>タグ検索したぜ</h1>
<?php 
require('../../db_open.php');
require('searchCtl.php');

$result = searchComOnTag($dbh,$_POST['tags']);
echo "絞り込み中使用タグ：<br>";
outputTagsName($_POST['tags'],$dbh);
// var_dump($result);
searchByComId($dbh,$result);
?>

<html>
    
</html>