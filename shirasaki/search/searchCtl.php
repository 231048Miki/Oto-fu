<?PHP
    function search($keyword,$dbh){
        $get = $dbh->prepare('SELECT * FROM company_table');
        $get->execute();
        echo"<ul>";
        while($com = $get->fetch(PDO::FETCH_ASSOC)){
            echo "<li>".$com['com_name']."</li>";
        };
        echo"</ul>";
    }
?>