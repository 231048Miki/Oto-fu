<?PHP
    function search($keyword,$dbh){
        $get = $dbh->prepare('SELECT * FROM company_table,cominfo_table WHERE com_name LIKE :com_name AND company_table.com_id = cominfo_table.com_id');
        $get->bindValue(':com_name',$keyword."%",PDO::PARAM_STR);
        $get->execute();
        echo"<ul>";
        while($com = $get->fetch(PDO::FETCH_ASSOC)){
            echo "<li><a href='dami-.php'>".$com['com_name']."</a>";
            echo "<br><b>企業理念：".$com['com_rinen']."</b></li><br>";
        };
        echo"</ul>";
    }
?>