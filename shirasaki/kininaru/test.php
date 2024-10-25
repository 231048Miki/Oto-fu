<?php 
    include("../../db_open.php");
    session_start();
        $sql = $dbh->prepare('SELECT com_id,com_name FROM company_table');
        
        while($rec=$sql->fetch(PDO::FETCH_ASSOC)){
            var_dump($rec);
            echo $rec['com_id'];
            echo $rec['com_name'];
        }
    
?>