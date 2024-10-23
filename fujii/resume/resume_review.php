<?php
include '../db_open.php';
session_start();
$review = $_POST['review'];

$resume_id = $_POST['resume_id'];
$com_id = $_POST['com_id'];

echo $_POST['resume_id'];
echo $review;
echo $resume_id;
echo $com_id;

$sql="INSERT INTO resume_review ( resume_id , com_id , review) VALUES ( :resume_id , :com_id ,:review) ";
$sql_res = $dbh->prepare($sql);
$sql_res->bindvalue(':resume_id',$resume_id,PDO::PARAM_INT);
$sql_res->bindvalue(':com_id',$com_id,PDO::PARAM_INT);
$sql_res->bindvalue(':review',$review,PDO::PARAM_STR);
$sql_res -> execute();
?>
<script>
alert("送信しました。");
window.location.href='select_student.php';
</script> 
