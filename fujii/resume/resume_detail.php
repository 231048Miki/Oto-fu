<?php
include '../db_open.php';
//trust me
$resume_id = $_GET["resume_id"];


$sql="SELECT reazon , pr ,skill FROM resume_table WHERE resume_id = $resume_id";
$sql_res = $dbh->query($sql);
$rec = $sql_res->fetch();
echo "志望動機";
echo "<br>";
echo $rec['reazon'];
echo "<br>";
echo "自己PR";
echo "<br>";
echo $rec['pr'];
echo "<br>";
echo "趣味・特技";
echo "<br>";
echo $rec['skill'];
